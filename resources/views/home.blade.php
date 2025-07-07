@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="welcome-header text-center">
                    <h1 class="casino-welcome animate__animated animate__fadeInDown">
                        <i class="fas fa-crown"></i> Selamat Datang di W568 Casino <i class="fas fa-crown"></i>
                    </h1>
                    <p class="welcome-subtitle animate__animated animate__fadeInUp" style="animation-delay: 0.5s;">
                        Destinasi Terbaik untuk Pengalaman Judi Online Premium
                    </p>
                    
                    <!-- Trigger falling gold on page load -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            setTimeout(() => {
                                if (typeof startFallingGold === 'function') {
                                    startFallingGold();
                                }
                            }, 2000);
                        });
                    </script>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="dashboard-card animate__animated animate__zoomIn">
                    <div class="card-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="card-content">
                        <h3>Rp {{ number_format(Auth::user()->balance) }}</h3>
                        <p>Saldo Anda</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="dashboard-card animate__animated animate__zoomIn" style="animation-delay: 0.1s;">
                    <div class="card-icon">
                        <i class="fas fa-gamepad"></i>
                    </div>
                    <div class="card-content">
                        <h3>{{ Auth::user()->total_attempts }}</h3>
                        <p>Total Permainan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="dashboard-card animate__animated animate__zoomIn" style="animation-delay: 0.2s;">
                    <div class="card-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="card-content">
                        <h3>{{ Auth::user()->total_wins }}</h3>
                        <p>Kemenangan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="dashboard-card animate__animated animate__zoomIn" style="animation-delay: 0.3s;">
                    <div class="card-icon">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <div class="card-content">
                        <h3>{{ Auth::user()->total_attempts > 0 ? number_format((Auth::user()->total_wins / Auth::user()->total_attempts) * 100, 1) : 0 }}%</h3>
                        <p>Win Rate</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <!-- Game Categories -->
            <div class="col-lg-8 mb-4">
                <div class="game-categories">
                    <h3 class="section-title">
                        <i class="fas fa-fire"></i> Permainan Populer
                    </h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="game-item">
                                <div class="game-thumbnail">
                                    <div class="game-icon">🎰</div>
                                </div>
                                <div class="game-info">
                                    <h5>Mega Slot Machine</h5>
                                    <p>RTP: 98% | Jackpot: Rp 1M+</p>
                                    <a href="{{ route('gambling.index') }}" class="btn btn-casino btn-sm">
                                        <i class="fas fa-play"></i> Main Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="game-item">
                                <div class="game-thumbnail">
                                    <div class="game-icon">⚡</div>
                                </div>
                                <div class="game-info">
                                    <h5>Zeus Lightning</h5>
                                    <p>RTP: 96% | Bonus: 25x</p>
                                    <a href="#" class="btn btn-secondary btn-sm disabled">
                                        <i class="fas fa-clock"></i> Segera Hadir
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="game-item">
                                <div class="game-thumbnail">
                                    <div class="game-icon">💎</div>
                                </div>
                                <div class="game-info">
                                    <h5>Diamond Rush</h5>
                                    <p>RTP: 95% | Maxwin: 1000x</p>
                                    <a href="#" class="btn btn-secondary btn-sm disabled">
                                        <i class="fas fa-clock"></i> Segera Hadir
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="game-item">
                                <div class="game-thumbnail">
                                    <div class="game-icon">🏆</div>
                                </div>
                                <div class="game-info">
                                    <h5>Golden Trophy</h5>
                                    <p>RTP: 97% | Feature Buy</p>
                                    <a href="#" class="btn btn-secondary btn-sm disabled">
                                        <i class="fas fa-clock"></i> Segera Hadir
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="recent-activity mt-4">
                    <h3 class="section-title">
                        <i class="fas fa-history"></i> Aktivitas Terbaru
                    </h3>
                    <div class="activity-list">
                        @if(Auth::user()->last_played_at)
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-dice"></i>
                                </div>
                                <div class="activity-content">
                                    <h6>Permainan Terakhir</h6>
                                    <p>{{ Auth::user()->last_played_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endif
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Bergabung dengan W568</h6>
                                <p>{{ Auth::user()->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Daily Bonus -->
                <div class="bonus-card mb-4">
                    <div class="bonus-header">
                        <h5><i class="fas fa-gift"></i> Bonus Harian</h5>
                    </div>
                    <div class="bonus-content">
                        <div class="bonus-amount">Rp 50.000</div>
                        <p>Klaim bonus harian Anda!</p>
                        <button class="btn btn-casino w-100" onclick="alert('Fitur bonus akan segera hadir!')">
                            <i class="fas fa-hand-holding-usd"></i> Klaim Sekarang
                        </button>
                    </div>
                </div>

                <!-- VIP Status -->
                <div class="vip-card mb-4">
                    <div class="vip-header">
                        <h5><i class="fas fa-crown"></i> Status VIP</h5>
                    </div>
                    <div class="vip-content">
                        <div class="vip-level">
                            @php
                                $totalGames = Auth::user()->total_attempts;
                                $vipLevel = 'BRONZE';
                                if ($totalGames >= 1000) $vipLevel = 'DIAMOND';
                                elseif ($totalGames >= 500) $vipLevel = 'PLATINUM';
                                elseif ($totalGames >= 200) $vipLevel = 'GOLD';
                                elseif ($totalGames >= 100) $vipLevel = 'SILVER';
                            @endphp
                            <span class="level-badge level-{{ strtolower($vipLevel) }}">{{ $vipLevel }}</span>
                        </div>
                        <div class="progress mb-2">
                            @php
                                $nextLevel = 100;
                                if ($totalGames >= 100) $nextLevel = 200;
                                if ($totalGames >= 200) $nextLevel = 500;
                                if ($totalGames >= 500) $nextLevel = 1000;
                                if ($totalGames >= 1000) $nextLevel = $totalGames;
                                
                                $progress = $nextLevel > $totalGames ? ($totalGames / $nextLevel) * 100 : 100;
                            @endphp
                            <div class="progress-bar bg-warning" style="width: {{ min((float) $progress, 100) }}%"></div>
                        </div>
                        <p class="small">
                            @if($totalGames < 1000)
                                {{ $nextLevel - $totalGames }} permainan lagi untuk naik level
                            @else
                                Anda telah mencapai level tertinggi!
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <h5 class="section-title">
                        <i class="fas fa-bolt"></i> Aksi Cepat
                    </h5>
                    <div class="d-grid gap-2">
                        <a href="{{ route('gambling.index') }}" class="btn btn-casino">
                            <i class="fas fa-play"></i> Main Slot
                        </a>
                        <a href="{{ route('gambling.statistics') }}" class="btn btn-outline-warning">
                            <i class="fas fa-chart-bar"></i> Lihat Statistik
                        </a>
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('gambling.admin') }}" class="btn btn-outline-danger">
                                <i class="fas fa-cog"></i> Admin Panel
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
/* Home Page Specific Styles */
.container-fluid {
    padding: 0;
}

.container {
    max-width: 1200px;
    padding-top: 20px;
    z-index: 10;
    position: relative;
}

.welcome-header {
    padding: 30px 20px;
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.15), rgba(255, 107, 53, 0.15));
    border-radius: 20px;
    margin-bottom: 30px;
    border: 2px solid #ffd700;
    backdrop-filter: blur(10px);
}

.casino-welcome {
    font-size: 2.2rem;
    font-weight: 900;
    color: #ffd700;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    margin-bottom: 15px;
}

.welcome-subtitle {
    font-size: 1.1rem;
    color: #ccc;
    margin: 0;
}

.dashboard-card {
    background: linear-gradient(145deg, #1a1a1a, #2d2d2d);
    border: 2px solid #ffd700;
    border-radius: 15px;
    padding: 20px;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
    height: 100%;
    min-height: 120px;
}

.dashboard-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.3);
}

.card-icon {
    font-size: 2.2rem;
    color: #ffd700;
    margin-right: 15px;
    text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
    flex-shrink: 0;
}

.card-content {
    flex-grow: 1;
}

.card-content h3 {
    color: #ffffff;
    font-size: 1.5rem;
    font-weight: bold;
    margin: 0 0 5px 0;
}

.card-content p {
    color: #ccc;
    margin: 0;
    font-size: 0.9rem;
}

.section-title {
    color: #ffd700;
    font-weight: bold;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #ffd700;
    font-size: 1.3rem;
}

.game-categories, .recent-activity {
    background: linear-gradient(145deg, rgba(26, 26, 26, 0.9), rgba(45, 45, 45, 0.9));
    border: 2px solid rgba(255, 215, 0, 0.3);
    border-radius: 15px;
    padding: 25px;
    backdrop-filter: blur(10px);
}

.game-item {
    background: linear-gradient(145deg, #2d2d2d, #1a1a1a);
    border: 1px solid rgba(255, 215, 0, 0.3);
    border-radius: 12px;
    padding: 15px;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
    height: 100%;
}

.game-item:hover {
    border-color: #ffd700;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 215, 0, 0.2);
}

.game-thumbnail {
    margin-right: 15px;
    flex-shrink: 0;
}

.game-icon {
    font-size: 2.5rem;
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.game-info {
    flex-grow: 1;
}

.game-info h5 {
    color: #ffd700;
    margin-bottom: 5px;
    font-weight: bold;
    font-size: 1rem;
}

.game-info p {
    color: #ccc;
    font-size: 0.8rem;
    margin-bottom: 10px;
}

.activity-item {
    background: rgba(255, 255, 255, 0.05);
    border-left: 4px solid #ffd700;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 0 10px 10px 0;
    display: flex;
    align-items: center;
}

.activity-icon {
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    color: #000;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0;
}

.activity-content h6 {
    color: #ffd700;
    margin-bottom: 5px;
    font-size: 0.95rem;
}

.activity-content p {
    color: #ccc;
    margin: 0;
    font-size: 0.8rem;
}

.bonus-card, .vip-card, .quick-actions {
    background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
    border: 2px solid #ffd700;
    border-radius: 15px;
    overflow: hidden;
}

.bonus-header, .vip-header {
    background: linear-gradient(90deg, #ffd700, #ffed4a);
    color: #000;
    padding: 12px 20px;
    font-weight: bold;
}

.bonus-content, .vip-content {
    padding: 20px;
    text-align: center;
}

.bonus-amount {
    font-size: 1.8rem;
    font-weight: bold;
    color: #ffd700;
    margin-bottom: 10px;
}

.level-badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: bold;
    font-size: 0.85rem;
    display: inline-block;
    margin-bottom: 15px;
}

.level-bronze { background: linear-gradient(45deg, #cd7f32, #daa520); color: #000; }
.level-silver { background: linear-gradient(45deg, #c0c0c0, #e5e5e5); color: #000; }
.level-gold { background: linear-gradient(45deg, #ffd700, #ffed4a); color: #000; }
.level-platinum { background: linear-gradient(45deg, #e5e4e2, #ffffff); color: #000; }
.level-diamond { background: linear-gradient(45deg, #b9f2ff, #00d4ff); color: #000; }

.quick-actions {
    padding: 20px;
}

.progress {
    height: 8px;
    background-color: #333;
    border-radius: 4px;
}

.progress-bar {
    border-radius: 4px;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .casino-welcome {
        font-size: 1.6rem;
    }
    
    .welcome-subtitle {
        font-size: 1rem;
    }
    
    .dashboard-card {
        flex-direction: column;
        text-align: center;
        padding: 15px;
        min-height: 100px;
    }
    
    .card-icon {
        margin-right: 0;
        margin-bottom: 10px;
        font-size: 2rem;
    }
    
    .game-item {
        flex-direction: column;
        text-align: center;
        padding: 15px;
    }
    
    .game-thumbnail {
        margin-right: 0;
        margin-bottom: 10px;
    }
    
    .game-icon {
        font-size: 2rem;
    }
}
</style>
<style>
/* Fix any overflow issues */
.row {
    margin-left: -12px;
    margin-right: -12px;
}

.col-md-3, .col-md-6, .col-lg-4, .col-lg-8 {
    padding-left: 12px;
    padding-right: 12px;
}
</style>
@endsection
