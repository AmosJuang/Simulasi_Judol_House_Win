<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GamblingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('gambling.index', compact('user'));
    }

    public function play(Request $request)
    {
        try {
            $request->validate([
                'bet_amount' => 'required|numeric|min:10000|max:500000',
            ]);

            $user = Auth::user();
            $betAmount = (int) $request->bet_amount;

            // Check balance
            if ($user->balance < $betAmount) {
                return response()->json([
                    'success' => false,
                    'message' => 'Saldo tidak mencukupi! Saldo Anda: Rp ' . number_format($user->balance)
                ], 400);
            }

            // Define slot symbols and their multipliers
            $symbols = [
                '🍒' => ['weight' => 30, 'multiplier' => 2],
                '🍋' => ['weight' => 25, 'multiplier' => 3],
                '🍊' => ['weight' => 20, 'multiplier' => 4],
                '⭐' => ['weight' => 15, 'multiplier' => 10],
                '💎' => ['weight' => 7, 'multiplier' => 25],
                '👑' => ['weight' => 2, 'multiplier' => 100],
                '🔥' => ['weight' => 1, 'multiplier' => 1000]
            ];

            // Generate slot result
            $isWin = false;
            $multiplier = 0;
            $slotResult = [];

            // Check if admin has set forced result for this user
            if ($user->forced_result !== null) {
                $isWin = $user->forced_result == 'win';
                // Reset forced result after use
                $user->forced_result = null;
                
                if ($isWin) {
                    // Force a winning combination
                    $winningSymbol = $this->getRandomSymbol($symbols, true);
                    $slotResult = [$winningSymbol, $winningSymbol, $winningSymbol];
                    $multiplier = $symbols[$winningSymbol]['multiplier'];
                } else {
                    // Force a losing combination
                    $slotResult = $this->generateLosingCombination($symbols);
                }
            } else {
                // Normal random result
                $slotResult = $this->generateSlotResult($symbols);
                
                // Check for winning combination (all three symbols match)
                if ($slotResult[0] === $slotResult[1] && $slotResult[1] === $slotResult[2]) {
                    $isWin = true;
                    $multiplier = $symbols[$slotResult[0]]['multiplier'];
                }
            }

            // Calculate payout
            $payout = 0;
            if ($isWin) {
                $payout = $betAmount * $multiplier;
                $user->balance -= $betAmount;
                $user->balance += $payout;
                $user->total_wins += 1;
                $message = "🎉 JACKPOT! Anda menang Rp " . number_format($payout) . "! (Multiplier: {$multiplier}x)";
            } else {
                $user->balance -= $betAmount;
                $user->total_losses += 1;
                $message = "💀 KALAH! Anda kehilangan Rp " . number_format($betAmount) . "!";
            }
            
            $user->total_attempts += 1;
            $user->last_played_at = now();
            $user->save();

            return response()->json([
                'success' => true,
                'win' => $isWin,
                'slot_result' => $slotResult,
                'multiplier' => $multiplier,
                'bet_amount' => $betAmount,
                'payout' => $payout,
                'new_balance' => $user->balance,
                'total_attempts' => $user->total_attempts,
                'total_wins' => $user->total_wins,
                'total_losses' => $user->total_losses,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            \Log::error('Gambling play error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server! Coba lagi.'
            ], 500);
        }
    }

    private function getRandomSymbol($symbols, $preferHighValue = false)
    {
        if ($preferHighValue) {
            // Prefer higher value symbols for forced wins
            $symbolKeys = array_keys($symbols);
            $weights = [];
            foreach ($symbolKeys as $symbol) {
                // Invert weights for high value preference
                $weights[] = 100 - $symbols[$symbol]['weight'];
            }
        } else {
            $symbolKeys = array_keys($symbols);
            $weights = array_column($symbols, 'weight');
        }

        $totalWeight = array_sum($weights);
        $random = rand(1, $totalWeight);
        $currentWeight = 0;

        foreach ($symbolKeys as $index => $symbol) {
            $currentWeight += $weights[$index];
            if ($random <= $currentWeight) {
                return $symbol;
            }
        }

        return $symbolKeys[0]; // Fallback
    }

    private function generateSlotResult($symbols)
    {
        $result = [];
        for ($i = 0; $i < 3; $i++) {
            $result[] = $this->getRandomSymbol($symbols);
        }
        return $result;
    }

    private function generateLosingCombination($symbols)
    {
        $symbolKeys = array_keys($symbols);
        $result = [];
        
        // Generate three different symbols to ensure no match
        $result[0] = $symbolKeys[array_rand($symbolKeys)];
        
        do {
            $result[1] = $symbolKeys[array_rand($symbolKeys)];
        } while ($result[1] === $result[0]);
        
        do {
            $result[2] = $symbolKeys[array_rand($symbolKeys)];
        } while ($result[2] === $result[0] || $result[2] === $result[1]);
        
        return $result;
    }

    public function statistics()
    {
        $user = Auth::user();
        $winRate = $user->total_attempts > 0 ? ($user->total_wins / $user->total_attempts) * 100 : 0;
        
        return view('gambling.statistics', compact('user', 'winRate'));
    }

    public function admin()
    {
        // Check if user is admin
        if (!Auth::user()->is_admin) {
            return redirect()->route('home')->with('error', 'Unauthorized access!');
        }

        $users = User::orderBy('balance', 'desc')->get();
        $totalUsers = User::count();
        $totalBalance = User::sum('balance');
        $totalGames = User::sum('total_attempts');
        $totalWins = User::sum('total_wins');
        $totalLosses = User::sum('total_losses');

        return view('gambling.admin', compact('users', 'totalUsers', 'totalBalance', 'totalGames', 'totalWins', 'totalLosses'));
    }

    public function forceResult(User $user)
    {
        // Ensure only admins can access this
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        return view('gambling.force-result', compact('user'));
    }

    public function updateForceResult(Request $request)
    {
        // Ensure only admins can access this
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'result' => 'nullable|in:win,lose',
        ]);

        $user = User::findOrFail($request->user_id);
        
        // Update the forced result
        $user->forced_result = $request->result ?: null;
        $user->save();

        $message = 'Pengaturan hasil spin berhasil diperbarui!';
        if ($request->result) {
            $resultText = $request->result == 'win' ? 'MENANG' : 'KALAH';
            $message = "Hasil spin berikutnya untuk {$user->name} telah diatur ke: {$resultText}";
        } else {
            $message = "Hasil spin untuk {$user->name} telah dikembalikan ke mode random";
        }

        return back()->with('success', $message);
    }

    public function adjustBalance(Request $request)
    {
        // Check if user is admin
        if (!Auth::user()->is_admin) {
            return redirect()->route('home')->with('error', 'Unauthorized access!');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'action' => 'required|in:add,subtract,set'
        ]);

        $user = User::find($request->user_id);
        $amount = $request->amount;

        switch ($request->action) {
            case 'add':
                $user->balance += $amount;
                $message = "Added Rp " . number_format($amount) . " to " . $user->name . "'s balance";
                break;
            case 'subtract':
                $user->balance -= $amount;
                $message = "Subtracted Rp " . number_format($amount) . " from " . $user->name . "'s balance";
                break;
            case 'set':
                $user->balance = $amount;
                $message = "Set " . $user->name . "'s balance to Rp " . number_format($amount);
                break;
        }

        $user->save();

        return redirect()->back()->with('success', $message);
    }
    
    public function roulette()
    {
        $user = Auth::user();
        return view('gambling.roulette', compact('user'));
    }

    public function playRoulette(Request $request)
    {
        $request->validate([
            'bet_type' => 'required|string|in:number,color,parity,range',
            'bet_value' => 'required|string',
            'bet_amount' => 'required|numeric|min:1000|max:1000000000000',
            'payout_ratio' => 'required|numeric|min:1|max:35',
        ]);

        $user = Auth::user();
        $betAmount = (int) $request->bet_amount;

        if ($betAmount < 15000) {
            return response() -> json ([
                'success' => false,
                'message' => 'Minimal taruhan adalah 15 ribu'
            ], 422);
        }

        if ($user->balance < $betAmount) {
            return response()->json([    
                'success' => false,
                'message' => 'Saldo tidak mencukupi!'
            ]);
        }

        // Generate winning number (0-36)
        $winningNumber = 0;
        $isWin = false;

        // Check if admin has set forced result for this user
        if ($user->forced_result !== null) {
            $isWin = $user->forced_result == 'win';
            // Reset forced result after use
            $user->forced_result = null;
            
            if ($isWin) {
                // Force a winning number based on bet type
                $winningNumber = $this->generateWinningNumber($request->bet_type, $request->bet_value);
            } else {
                // Force a losing number
                $winningNumber = $this->generateLosingNumber($request->bet_type, $request->bet_value);
            }
        } else {
            // Normal random result with house edge
            $winningNumber = $this->generateRouletteNumber();
            $isWin = $this->checkRouletteWin($winningNumber, $request->bet_type, $request->bet_value);
        }

        // Determine winning color
        $winningColor = $this->getNumberColor($winningNumber);

        // Calculate payout
        $payout = 0;
        if ($isWin) {
            $payout = $betAmount * ($request->payout_ratio + 1);
            $user->balance -= $betAmount;
            $user->balance += $payout;
            $user->total_wins += 1;
            $message = "🎉 MENANG! Nomor {$winningNumber} ({$winningColor})";
            $alertType = 'success';
        } else {
            $user->balance -= $betAmount;
            $user->total_losses += 1;
            $message = "💸 KALAH! Nomor {$winningNumber} ({$winningColor})";
            $alertType = 'error';
        }

        $user->total_attempts += 1;
        $user->last_played_at = now();
        $user->save();

        return response()->json([
            'success' => true,
            'win' => $isWin,
            'winning_number' => $winningNumber,
            'winning_color' => $winningColor,
            'bet_amount' => $betAmount,
            'payout' => $payout,
            'payout_ratio' => $request->payout_ratio,
            'new_balance' => $user->balance,
            'total_attempts' => $user->total_attempts,
            'total_wins' => $user->total_wins,
            'total_losses' => $user->total_losses,
            'message' => $message
        ]);
    }

    private function generateRouletteNumber()
    {
        return rand(0, 36);
    }

    private function generateWinningNumber($betType, $betValue)
    {
        switch ($betType) {
            case 'number':
                return (int) $betValue;
            case 'color':
                $redNumbers = [1,3,5,7,9,12,14,16,18,19,21,23,25,27,30,32,34,36];
                if ($betValue === 'red') {
                    return $redNumbers[array_rand($redNumbers)];
                } elseif ($betValue === 'black') {
                    $blackNumbers = array_diff(range(1, 36), $redNumbers);
                    return array_values($blackNumbers)[array_rand($blackNumbers)];
                }
                break;
            case 'parity':
                if ($betValue === 'even') {
                    $evenNumbers = range(2, 36, 2);
                    return $evenNumbers[array_rand($evenNumbers)];
                } else {
                    $oddNumbers = range(1, 35, 2);
                    return $oddNumbers[array_rand($oddNumbers)];
                }
                break;
            case 'range':
                if ($betValue === 'low') {
                    return rand(1, 18);
                } else {
                    return rand(19, 36);
                }
                break;
        }
        return rand(1, 36);
    }

    private function generateLosingNumber($betType, $betValue)
    {
        do {
            $number = rand(0, 36);
        } while ($this->checkRouletteWin($number, $betType, $betValue));
        
        return $number;
    }

    private function checkRouletteWin($winningNumber, $betType, $betValue)
    {
        switch ($betType) {
            case 'number':
                return $winningNumber == (int) $betValue;
            case 'color':
                $numberColor = $this->getNumberColor($winningNumber);
                return $numberColor === $betValue;
            case 'parity':
                if ($winningNumber === 0) return false;
                $isEven = $winningNumber % 2 === 0;
                return ($betValue === 'even' && $isEven) || ($betValue === 'odd' && !$isEven);
            case 'range':
                if ($winningNumber === 0) return false;
                return ($betValue === 'low' && $winningNumber >= 1 && $winningNumber <= 18) ||
                       ($betValue === 'high' && $winningNumber >= 19 && $winningNumber <= 36);
        }
        return false;
    }

    private function getNumberColor($number)
    {
        if ($number === 0) return 'green';
        
        $redNumbers = [1,3,5,7,9,12,14,16,18,19,21,23,25,27,30,32,34,36];
        return in_array($number, $redNumbers) ? 'red' : 'black';
    }
}