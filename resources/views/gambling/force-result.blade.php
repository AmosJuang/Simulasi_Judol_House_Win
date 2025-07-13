@extends('layouts.app')

@section('content')
<div class="container-fluid admin-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="admin-header text-center mb-4">
                    <h2 class="admin-title">
                        <i class="fas fa-magic"></i> CASINO CONTROL CENTER <i class="fas fa-magic"></i>
                    </h2>
                    <p class="admin-subtitle">Force Next Spin Result - Ultimate Admin Power</p>
                </div>

                <div class="casino-admin-card">
                    <div class="admin-card-header">
                        <h4><i class="fas fa-dice-d20"></i> Controller Hasil Permainan</h4>
                        <p class="mb-0">Kendalikan hasil dari next spin player anda!</p>
                    </div>
                    
                    <div class="admin-card-body">
                        @if(session('success'))
                            <div class="casino-alert casino-alert-success mb-4">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="casino-alert casino-alert-danger mb-4">
                                <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                            </div>
                        @endif

                        <!-- Player Information Panel -->
                        <div class="player-info-panel mb-4">
                            <div class="panel-header">
                                <h5><i class="fas fa-user-circle"></i> Informasi PLayer Target </h5>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="player-stat">
                                            <div class="stat-icon">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div class="stat-info">
                                                <h6>Nama Player </h6>
                                                <p>{{ $user->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="player-stat">
                                            <div class="stat-icon">
                                                <i class="fas fa-coins"></i>
                                            </div>
                                            <div class="stat-info">
                                                <h6>Saldo Saat ini </h6>
                                                <p class="text-warning">Rp {{ number_format($user->balance) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="player-stat">
                                            <div class="stat-icon">
                                                <i class="fas fa-chart-line"></i>
                                            </div>
                                            <div class="stat-info">
                                                <h6>Win Rate</h6>
                                                @php
                                                    $winRate = $user->total_attempts > 0 ? ($user->total_wins / $user->total_attempts) * 100 : 0;
                                                @endphp
                                                <p class="{{ $winRate > 50 ? 'text-success' : 'text-danger' }}">
                                                    {{ number_format($winRate, 2) }}%
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <div class="mini-stat">
                                            <span class="label">Total Games:</span>
                                            <span class="value">{{ $user->total_attempts }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mini-stat">
                                            <span class="label">Wins:</span>
                                            <span class="value text-success">{{ $user->total_wins }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mini-stat">
                                            <span class="label">Losses:</span>
                                            <span class="value text-danger">{{ $user->total_losses }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mini-stat">
                                            <span class="label">Email:</span>
                                            <span class="value text-info">{{ Str::mask($user->email, '*', 3, -10) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Current Status -->
                        <div class="current-status-panel mb-4">
                            <h6><i class="fas fa-info-circle"></i>  STATUS SPIN SELANJUTNYA </h6>
                            <div class="status-display">
                                @if($user->forced_result)
                                    <div class="status-active">
                                        <i class="fas fa-bolt"></i>
                                        <span>Hasil spin selanjutnya akan dipaksa menjadi : </span>
                                        <span class="forced-result {{ $user->forced_result == 'win' ? 'result-win' : 'result-lose' }}">
                                            {{ $user->forced_result == 'win' ? '🎉 WIN' : '💀 LOSE' }}
                                        </span>
                                    </div>
                                @else
                                    <div class="status-inactive">
                                        <i class="fas fa-dice"></i>
                                        <span>Next spin result: </span>
                                        <span class="forced-result result-random">🎲 RANDOM</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Force Result Form -->
                        <div class="force-result-panel">
                            <h6><i class="fas fa-cogs"></i> Atur Hasil Spin Selanjutnya </h6>
                            
                            <form method="POST" action="{{ route('gambling.updateForceResult') }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                
                                <div class="result-options">
                                    <div class="row g-4">
                                        <div class="col-md-4">
                                            <div class="result-option" data-result="win">
                                                <input type="radio" name="result" value="win" id="win" 
                                                    {{ $user->forced_result == 'win' ? 'checked' : '' }}>
                                                <label for="win" class="result-card result-card-win">
                                                    <div class="result-icon">🎉</div>
                                                    <h5>FORCE WIN</h5>
                                                    <p>Player will win the next spin</p>
                                                    <div class="result-effects">
                                                        <span class="effect">✓ Pasti Menang</span>
                                                        <span class="effect">✓ Player Akan Senang</span>
                                                        <span class="effect">✓ Bangun Kepercayaan </span>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="result-option" data-result="lose">
                                                <input type="radio" name="result" value="lose" id="lose"
                                                    {{ $user->forced_result == 'lose' ? 'checked' : '' }}>
                                                <label for="lose" class="result-card result-card-lose">
                                                    <div class="result-icon">💀</div>
                                                    <h5>FORCE LOSE</h5>
                                                    <p>Player akan kalah di spin selanjutnya </p>
                                                    <div class="result-effects">
                                                        <span class="effect">✓ Pasti kalah</span>
                                                        <span class="effect">✓ Casino Untung</span>
                                                        <span class="effect">✓ Pastikan kita tidak rugi </span>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="result-option" data-result="random">
                                                <input type="radio" name="result" value="" id="reset"
                                                    {{ !$user->forced_result ? 'checked' : '' }}>
                                                <label for="reset" class="result-card result-card-random">
                                                    <div class="result-icon">🎲</div>
                                                    <h5>RANDOM MODE</h5>
                                                    <p>Return to normal random results</p>
                                                    <div class="result-effects">
                                                        <span class="effect">✓ Balik ke Algoritma Awal</span>
                                                        <span class="effect">✓ Kesempatan 'natural' sistem </span>
                                                        <span class="effect">✓ Player Tidak curiga</span>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Warning Panel -->
                                <div class="warning-panel mt-4">
                                    <div class="warning-content">
                                        <h6><i class="fas fa-exclamation-triangle"></i> ADMIN WARNINGS & NOTES</h6>
                                        <ul class="warning-list">
                                            <li>Setting ini berlaku hanya untuk <strong>SPIN SELANJUTNYA </strong></li>
                                            <li>Setelah Spin maka setting akan kembali menjadi acak</li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="action-buttons">
                                    <div class="d-flex gap-3 justify-content-end">
                                        <a href="{{ route('gambling.admin') }}" class="btn-admin-secondary">
                                            <i class="fas fa-arrow-left"></i> Kembali ke Panel Admin
                                        </a>
                                        <button type="submit" class="btn-admin-primary">
                                            <i class="fas fa-magic"></i> Terapkan setting paksa 
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
/* Admin Force Result Styles */
.admin-container {
    background: linear-gradient(135deg, #0a0a0a, #1a1a1a);
    min-height: 100vh;
    padding: 20px 0;
}

.admin-header {
    margin-bottom: 30px;
}

.admin-title {
    color: #ffd700;
    font-size: 2.5rem;
    font-weight: 900;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    margin-bottom: 10px;
}

.admin-subtitle {
    color: #ccc;
    font-size: 1.2rem;
    margin: 0;
}

.casino-admin-card {
    background: linear-gradient(135deg, rgba(26, 26, 26, 0.95), rgba(45, 45, 45, 0.95));
    border: 3px solid #ffd700;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 
        0 20px 60px rgba(255, 215, 0, 0.3),
        inset 0 0 30px rgba(255, 215, 0, 0.1);
    backdrop-filter: blur(10px);
}

.admin-card-header {
    background: linear-gradient(135deg, #ff6b35, #ff0000);
    padding: 25px 30px;
    color: #fff;
    border-bottom: 2px solid #ffd700;
}

.admin-card-header h4 {
    margin: 0 0 5px 0;
    font-weight: bold;
    font-size: 1.5rem;
}

.admin-card-body {
    padding: 40px 30px;
}

.player-info-panel {
    background: rgba(255, 215, 0, 0.1);
    border: 2px solid rgba(255, 215, 0, 0.3);
    border-radius: 15px;
    overflow: hidden;
}

.panel-header {
    background: linear-gradient(90deg, rgba(255, 215, 0, 0.2), rgba(255, 237, 74, 0.2));
    padding: 15px 20px;
    border-bottom: 1px solid rgba(255, 215, 0, 0.3);
}

.panel-header h5 {
    color: #ffd700;
    margin: 0;
    font-weight: bold;
}

.panel-body {
    padding: 25px 20px;
}

.player-stat {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 10px;
    border: 1px solid rgba(255, 215, 0, 0.2);
}

.stat-icon {
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    color: #000;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.stat-info h6 {
    color: #ffd700;
    font-size: 0.9rem;
    margin: 0 0 5px 0;
    font-weight: bold;
}

.stat-info p {
    color: #fff;
    margin: 0;
    font-size: 1rem;
    font-weight: 500;
}

.mini-stat {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 12px;
    background: rgba(0, 0, 0, 0.3);
    border-radius: 8px;
    border-left: 3px solid #ffd700;
}

.mini-stat .label {
    color: #ccc;
    font-size: 0.85rem;
}

.mini-stat .value {
    color: #fff;
    font-weight: bold;
    font-size: 0.9rem;
}

.current-status-panel {
    background: rgba(0, 0, 0, 0.3);
    border: 2px solid rgba(255, 215, 0, 0.3);
    border-radius: 12px;
    padding: 20px;
}

.current-status-panel h6 {
    color: #ffd700;
    margin-bottom: 15px;
    font-weight: bold;
}

.status-display {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 1.1rem;
}

.status-active, .status-inactive {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #fff;
}

.forced-result {
    padding: 8px 15px;
    border-radius: 20px;
    font-weight: bold;
    font-size: 1rem;
}

.result-win {
    background: linear-gradient(45deg, #00aa44, #32cd32);
    color: #fff;
}

.result-lose {
    background: linear-gradient(45deg, #dc3545, #ff4757);
    color: #fff;
}

.result-random {
    background: linear-gradient(45deg, #6c757d, #adb5bd);
    color: #fff;
}

.force-result-panel {
    background: rgba(255, 255, 255, 0.02);
    border: 2px solid rgba(255, 215, 0, 0.3);
    border-radius: 15px;
    padding: 25px;
}

.force-result-panel h6 {
    color: #ffd700;
    margin-bottom: 20px;
    font-weight: bold;
}

.result-options {
    margin-bottom: 25px;
}

.result-option {
    position: relative;
}

.result-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.result-card {
    display: block;
    background: linear-gradient(135deg, rgba(45, 45, 45, 0.8), rgba(26, 26, 26, 0.8));
    border: 3px solid transparent;
    border-radius: 15px;
    padding: 25px 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    height: 100%;
    text-decoration: none;
    color: inherit;
}

.result-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(255, 215, 0, 0.2);
}

.result-card-win {
    border-image: linear-gradient(135deg, #00aa44, #32cd32) 1;
}

.result-card-lose {
    border-image: linear-gradient(135deg, #dc3545, #ff4757) 1;
}

.result-card-random {
    border-image: linear-gradient(135deg, #6c757d, #adb5bd) 1;
}

.result-option input:checked + .result-card {
    border-color: #ffd700;
    box-shadow: 0 0 25px rgba(255, 215, 0, 0.5);
    transform: scale(1.02);
}

.result-icon {
    font-size: 3rem;
    margin-bottom: 15px;
    filter: drop-shadow(0 0 10px rgba(255, 215, 0, 0.5));
}

.result-card h5 {
    color: #ffd700;
    font-weight: bold;
    margin-bottom: 10px;
    font-size: 1.2rem;
}

.result-card p {
    color: #ccc;
    margin-bottom: 15px;
    font-size: 0.95rem;
}

.result-effects {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.effect {
    background: rgba(255, 255, 255, 0.1);
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 0.8rem;
    color: #ddd;
}

.warning-panel {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.1), rgba(255, 107, 53, 0.1));
    border: 2px solid rgba(255, 193, 7, 0.3);
    border-radius: 12px;
    padding: 20px;
}

.warning-content h6 {
    color: #ffc107;
    margin-bottom: 15px;
    font-weight: bold;
}

.warning-list {
    color: #fff;
    margin: 0;
    padding-left: 20px;
}

.warning-list li {
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.action-buttons {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid rgba(255, 215, 0, 0.3);
}

.btn-admin-primary {
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    border: none;
    color: #000;
    font-weight: bold;
    padding: 15px 30px;
    border-radius: 50px;
    font-size: 1.1rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-admin-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
    color: #000;
}

.btn-admin-secondary {
    background: rgba(108, 117, 125, 0.2);
    border: 2px solid #6c757d;
    color: #ccc;
    font-weight: bold;
    padding: 13px 25px;
    border-radius: 50px;
    font-size: 1.1rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.btn-admin-secondary:hover {
    background: rgba(108, 117, 125, 0.3);
    color: #fff;
    border-color: #adb5bd;
    transform: translateY(-2px);
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .admin-title {
        font-size: 1.8rem;
    }
    
    .admin-card-body {
        padding: 25px 20px;
    }
    
    .player-stat {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }
    
    .mini-stat {
        flex-direction: column;
        gap: 5px;
        text-align: center;
    }
    
    .action-buttons .d-flex {
        flex-direction: column;
        gap: 15px;
    }
    
    .result-card {
        padding: 20px 15px;
    }
    
    .result-icon {
        font-size: 2.5rem;
    }
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ensure all close functions are available on this page
    if (typeof checkClosedAds === 'function') {
        checkClosedAds();
    }
    
    // Make sure close buttons work on this page
    const closeButtons = document.querySelectorAll('.ads-close-btn, .demo-close-btn, .ticker-close-btn, .promo-close-btn');
    closeButtons.forEach(button => {
        if (!button.onclick) {
            // Add click handlers if they don't exist
            if (button.closest('#leftAds')) {
                button.onclick = function() { closeLeftAds(); };
            } else if (button.closest('#rightAds')) {
                button.onclick = function() { closeRightAds(); };
            } else if (button.closest('#slotDemo')) {
                button.onclick = function() { closeSlotDemo(); };
            } else if (button.closest('#jackpotTicker')) {
                button.onclick = function() { closeJackpotTicker(); };
            } else if (button.closest('#sidebarPromo')) {
                button.onclick = function() { closeSidebarPromo(); };
            }
        }
    });

    // Handle result option selection
    document.querySelectorAll('.result-option').forEach(option => {
        option.addEventListener('click', function() {
            const radio = this.querySelector('input[type="radio"]');
            if (radio) {
                radio.checked = true;
                
                // Remove active styling from all cards
                document.querySelectorAll('.result-card').forEach(card => {
                    card.classList.remove('active');
                });
                
                // Add active styling to selected card
                this.querySelector('.result-card').classList.add('active');
            }
        });
    });

    // Set initial active state
    const checkedRadio = document.querySelector('input[name="result"]:checked');
    if (checkedRadio) {
        checkedRadio.closest('.result-option').querySelector('.result-card').classList.add('active');
    }
});
</script>
@endsection