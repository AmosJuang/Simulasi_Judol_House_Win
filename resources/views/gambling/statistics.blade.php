<!-- filepath: resources/views/gambling/statistics.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>📊 Statistik Gambling - House Analytics</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- User Statistics -->
                        <div class="col-md-6">
                            <h5>👥 User Statistics</h5>
                            <table class="table table-striped">
                                <tr>
                                    <td>Total Users</td>
                                    <td><strong>{{ number_format($totalUsers ?? 0) }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Total Attempts</td>
                                    <td><strong>{{ number_format($totalAttempts ?? 0) }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Total Wins</td>
                                    <td><strong class="text-success">{{ number_format($totalWins ?? 0) }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Total Losses</td>
                                    <td><strong class="text-danger">{{ number_format($totalLosses ?? 0) }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Overall Win Rate</td>
                                    <td><strong class="{{ ($overallWinRate ?? 0) > 50 ? 'text-danger' : 'text-success' }}">{{ $overallWinRate ?? 0 }}%</strong></td>
                                </tr>
                            </table>
                        </div>

                        <!-- House Statistics -->
                        <div class="col-md-6">
                            <h5>🏦 House Statistics</h5>
                            <table class="table table-striped">
                                <tr>
                                    <td>Total Starting Balance</td>
                                    <td><strong>Rp {{ number_format($totalStartingBalance ?? 0) }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Current Total Balance</td>
                                    <td><strong>Rp {{ number_format($totalCurrentBalance ?? 0) }}</strong></td>
                                </tr>
                                <tr>
                                    <td>House Profit</td>
                                    <td><strong class="{{ ($houseProfit ?? 0) > 0 ? 'text-success' : 'text-danger' }}">Rp {{ number_format($houseProfit ?? 0) }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Average Balance per User</td>
                                    <td><strong>Rp {{ number_format($averageBalancePerUser ?? 0) }}</strong></td>
                                </tr>
                                <tr>
                                    <td>House Edge Effectiveness</td>
                                    <td><strong class="{{ ($houseProfit ?? 0) > 0 ? 'text-success' : 'text-danger' }}">{{ ($houseProfit ?? 0) > 0 ? 'Profitable' : 'Loss' }}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Your Personal Stats -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h5>🎯 Your Personal Stats</h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h6>Current Balance</h6>
                                            <h4 class="text-primary">Rp {{ number_format($user->balance ?? 0) }}</h4>
                                        </div>
                                        <div class="col-md-3">
                                            <h6>Total Attempts</h6>
                                            <h4>{{ $user->total_attempts ?? 0 }}</h4>
                                        </div>
                                        <div class="col-md-3">
                                            <h6>Your Win Rate</h6>
                                            <h4 class="{{ ($user->total_attempts ?? 0) > 0 && (($user->total_wins ?? 0) / $user->total_attempts) > 0.5 ? 'text-success' : 'text-danger' }}">
                                                {{ ($user->total_attempts ?? 0) > 0 ? round((($user->total_wins ?? 0) / $user->total_attempts) * 100, 2) : 0 }}%
                                            </h4>
                                        </div>
                                        <div class="col-md-3">
                                            <h6>Profit/Loss</h6>
                                            <h4 class="{{ (($user->balance ?? 0) - 100000) > 0 ? 'text-success' : 'text-danger' }}">
                                                Rp {{ number_format(($user->balance ?? 0) - 100000) }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- System Information -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h5>⚙️ System Information</h5>
                            <div class="alert alert-info">
                                <ul class="mb-0">
                                    <li><strong>Base Win Rate:</strong> 30%</li>
                                    <li><strong>New User Bonus:</strong> Up to 40% (first 20 games)</li>
                                    <li><strong>Low Bet Bonus:</strong> Up to 25% (bets ≤ 5k)</li>
                                    <li><strong>High Bet Penalty:</strong> -20% (bets > 30k)</li>
                                    <li><strong>Win Streak Penalty:</strong> -25% (if win rate > 60%)</li>
                                    <li><strong>House Payout:</strong> 80% (1.8x multiplier)</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('gambling.index') }}" class="btn btn-primary">🎲 Back to Gambling</a>
                        <a href="{{ route('home') }}" class="btn btn-secondary">🏠 Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection