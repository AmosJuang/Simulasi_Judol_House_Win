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
        $request->validate([
            'bet_amount' => 'required|numeric|min:1000|max:100000',
        ]);

        $user = Auth::user();
        $betAmount = $request->bet_amount;

        if ($user->balance < $betAmount) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Saldo tidak mencukupi!'
                ]);
            }
            return redirect()->back()->with('error', 'Saldo tidak mencukupi!');
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
            $alertType = 'success';
        } else {
            $user->balance -= $betAmount;
            $user->total_losses += 1;
            $message = "💀 KALAH! Anda kehilangan Rp " . number_format($betAmount) . "!";
            $alertType = 'error';
        }
        
        $user->total_attempts += 1;
        $user->last_played_at = now();
        $user->save();

        if ($request->expectsJson()) {
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
        }

        return redirect()->back()->with($alertType, $message);
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
}