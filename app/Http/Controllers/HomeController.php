<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get some statistics for dashboard
        $totalUsers = User::count();
        $totalBalance = User::sum('balance');
        $totalGames = User::sum('total_attempts');
        $totalWins = User::sum('total_wins');
        
        return view('home', compact('user', 'totalUsers', 'totalBalance', 'totalGames', 'totalWins'));
    }
}