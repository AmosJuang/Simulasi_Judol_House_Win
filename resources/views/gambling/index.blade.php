@extends('layouts.app')

@section('content')
<div class="container admin-clean">
    <!-- Game Categories -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="text-warning mb-4 animate__animated animate__fadeInDown">
                <i class="fas fa-fire"></i> MEGA SLOT MACHINE GACOR <i class="fas fa-fire"></i>
            </h2>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="game-card text-center p-3 animate__animated animate__fadeInUp">
                <i class="fas fa-wallet text-warning" style="font-size: 2rem;"></i>
                <h5 class="mt-2">SALDO ANDA</h5>
                <h3 class="text-success" id="balance">Rp {{ number_format($user->balance) }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="game-card text-center p-3 animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                <i class="fas fa-gamepad text-info" style="font-size: 2rem;"></i>
                <h5 class="mt-2">TOTAL MAIN</h5>
                <h3 class="text-info" id="total-attempts">{{ $user->total_attempts }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="game-card text-center p-3 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <i class="fas fa-trophy text-warning" style="font-size: 2rem;"></i>
                <h5 class="mt-2">KEMENANGAN</h5>
                <h3 class="text-warning" id="total-wins">{{ $user->total_wins }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="game-card text-center p-3 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                <i class="fas fa-chart-line text-success" style="font-size: 2rem;"></i>
                <h5 class="mt-2">WIN RATE</h5>
                <h3 class="text-success">
                    {{ $user->total_attempts > 0 ? number_format(($user->total_wins / $user->total_attempts) * 100, 1) : 0 }}%
                </h3>
            </div>
        </div>
    </div>

    <!-- Main Game Interface -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="slot-container animate__animated animate__zoomIn">
                <div class="text-center mb-4">
                    <h3 class="text-warning mb-3">
                        <i class="fas fa-dice-d20"></i> SLOT MACHINE PREMIUM <i class="fas fa-dice-d20"></i>
                    </h3>
                    <div class="alert alert-warning">
                        <i class="fas fa-fire blink"></i>
                        <strong>SLOT PALING GACOR HARI INI!</strong> 
                        Maxwin hingga 1000x! Jackpot Rp 1 Miliar!
                        <i class="fas fa-fire blink"></i>
                    </div>
                </div>

                <!-- Slot Machine Display -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="slot-machine-container p-4 text-center">
                            <div class="slot-machine-header mb-3">
                                <h4 class="text-warning">🎰 MEGA SLOT 🎰</h4>
                                <div class="jackpot-counter">
                                    <span class="text-danger">JACKPOT: </span>
                                    <span class="text-warning fw-bold" id="current-jackpot">Rp 1.000.000.000</span>
                                </div>
                            </div>
                            
                            <div class="slot-display">
                                <div class="row justify-content-center">
                                    <div class="col-3">
                                        <div class="slot-reel" id="reel-container-1">
                                            <div class="reel-symbol" id="reel1">🍒</div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="slot-reel" id="reel-container-2">
                                            <div class="reel-symbol" id="reel2">🍋</div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="slot-reel" id="reel-container-3">
                                            <div class="reel-symbol" id="reel3">🍊</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Win Line Display -->
                            <div class="win-line-display mt-3" id="win-line" style="display: none;">
                                <div class="win-line"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Betting Interface -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-warning fw-bold">
                            <i class="fas fa-coins"></i> JUMLAH BET
                        </label>
                        <select id="bet-amount" class="form-select form-select-lg slot-select" required>
                            <option value="10000">Rp 10.000 (Min Bet)</option>
                            <option value="25000">Rp 25.000</option>
                            <option value="50000" selected>Rp 50.000 (Recommended)</option>
                            <option value="100000">Rp 100.000</option>
                            <option value="250000">Rp 250.000</option>
                            <option value="500000">Rp 500.000 (Max Bet)</option>
                        </select>
                        <small class="text-muted">Pilih jumlah taruhan sebelum spin</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-warning fw-bold">
                            <i class="fas fa-lightning-bolt"></i> QUICK BET
                        </label>
                        <div class="d-grid gap-2">
                            <button class="btn btn-casino quick-bet" data-amount="50000">
                                <i class="fas fa-rocket"></i> MAIN CEPAT (50K)!
                            </button>
                        </div>
                        <small class="text-muted">Langsung spin dengan bet 50K</small>
                    </div>
                </div>

                <!-- Spin Button -->
                <div class="text-center mb-4">
                    <button id="spin-btn" class="btn btn-casino btn-lg slot-spin-btn animate__animated animate__pulse animate__infinite">
                        <i class="fas fa-play"></i> SPIN SEKARANG!
                    </button>
                </div>

                <!-- Enhanced Payout Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="payout-table-enhanced p-4">
                            <h5 class="text-warning text-center mb-4">
                                <i class="fas fa-trophy"></i> TABEL PEMBAYARAN LENGKAP
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="payout-item">
                                        <span class="symbols">🍒🍒🍒</span>
                                        <span class="multiplier">2x</span>
                                        <span class="desc">Cherry Triple</span>
                                    </div>
                                    <div class="payout-item">
                                        <span class="symbols">🍋🍋🍋</span>
                                        <span class="multiplier">3x</span>
                                        <span class="desc">Lemon Triple</span>
                                    </div>
                                    <div class="payout-item">
                                        <span class="symbols">🍊🍊🍊</span>
                                        <span class="multiplier">4x</span>
                                        <span class="desc">Orange Triple</span>
                                    </div>
                                    <div class="payout-item">
                                        <span class="symbols">⭐⭐⭐</span>
                                        <span class="multiplier">10x</span>
                                        <span class="desc">Star Triple</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="payout-item">
                                        <span class="symbols">💎💎💎</span>
                                        <span class="multiplier">25x</span>
                                        <span class="desc">Diamond Triple</span>
                                    </div>
                                    <div class="payout-item">
                                        <span class="symbols">👑👑👑</span>
                                        <span class="multiplier">100x</span>
                                        <span class="desc">Crown Triple</span>
                                    </div>
                                    <div class="payout-item special">
                                        <span class="symbols">🔥🔥🔥</span>
                                        <span class="multiplier">1000x</span>
                                        <span class="desc">MEGA JACKPOT!</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Game Result Display -->
        <div class="col-lg-4">
            <!-- Last Spin Result -->
            <div id="game-result" class="game-card p-4 text-center" style="display: none;">
                <h4 id="result-text" class="mb-3"></h4>
                <div id="result-details" class="mb-3"></div>
                <div id="win-animation" class="win-animation-container" style="display: none;">
                    <div class="fireworks">🎉</div>
                    <div class="confetti">🎊</div>
                </div>
            </div>

            <!-- Recent Winners -->
            <div class="game-card p-4 mt-4">
                <h5 class="text-warning text-center mb-3">
                    <i class="fas fa-crown"></i> PEMENANG TERBARU
                </h5>
                <div class="winner-list" id="winner-list">
                    <div class="winner-item animate__animated animate__fadeInRight">
                        <span class="winner-name">Budi****</span>
                        <span class="winner-amount text-success">+Rp 25.000.000</span>
                        <span class="winner-combo">🔥🔥🔥</span>
                    </div>
                    <div class="winner-item animate__animated animate__fadeInRight">
                        <span class="winner-name">Sari****</span>
                        <span class="winner-amount text-success">+Rp 5.750.000</span>
                        <span class="winner-combo">👑👑👑</span>
                    </div>
                    <div class="winner-item animate__animated animate__fadeInRight">
                        <span class="winner-name">Andi****</span>
                        <span class="winner-amount text-success">+Rp 1.250.000</span>
                        <span class="winner-combo">💎💎💎</span>
                    </div>
                    <div class="winner-item animate__animated animate__fadeInRight">
                        <span class="winner-name">Dina****</span>
                        <span class="winner-amount text-success">+Rp 500.000</span>
                        <span class="winner-combo">⭐⭐⭐</span>
                    </div>
                </div>
            </div>

            <!-- Progressive Jackpot -->
            <div class="game-card p-4 mt-4">
                <h5 class="text-warning text-center mb-3">
                    <i class="fas fa-gem"></i> PROGRESSIVE JACKPOT
                </h5>
                <div class="jackpot-progress">
                    <div class="jackpot-bar">
                        <div class="jackpot-fill"></div>
                    </div>
                    <div class="jackpot-info mt-2">
                        <small class="text-muted">Jackpot akan reset setelah ada yang menang 🔥🔥🔥</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Win Modal -->
<div class="modal fade" id="winModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content win-modal-content">
            <div class="modal-header border-0 text-center">
                <h3 class="modal-title w-100 win-title">
                    <i class="fas fa-trophy"></i> SELAMAT! ANDA MENANG! <i class="fas fa-trophy"></i>
                </h3>
            </div>
            <div class="modal-body text-center p-5">
                <div class="win-celebration">
                    <div class="win-symbols mb-4" id="modal-win-symbols"></div>
                    <div class="win-multiplier mb-3" id="modal-win-multiplier"></div>
                    <h2 id="modal-win-amount" class="win-amount mb-3"></h2>
                    <p class="win-message">Kemenangan telah ditambahkan ke saldo Anda!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
/* Enhanced Slot Machine Styles */
.container {
    max-width: 100%;
    overflow-x: hidden;
    padding-left: 15px;
    padding-right: 15px;
}

.row {
    margin-left: -15px;
    margin-right: -15px;
    overflow-x: hidden;
}

[class*="col-"] {
    padding-left: 15px;
    padding-right: 15px;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.slot-machine-container {
    background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
    border: 5px solid #ffd700;
    border-radius: 20px;
    position: relative;
    box-shadow: 
        inset 0 0 30px rgba(255, 215, 0, 0.3),
        0 0 50px rgba(255, 215, 0, 0.4);
    overflow: hidden;
    max-width: 100%;
}

.slot-display {
    background: #000;
    padding: 20px;
    border-radius: 15px;
    border: 3px solid #ffd700;
    position: relative;
    overflow: hidden;
    max-width: 100%;
}

.slot-display .row {
    margin-left: -5px;
    margin-right: -5px;
}

.slot-display .col-3 {
    padding-left: 5px;
    padding-right: 5px;
}

/* Better mobile handling for slot machine */
@media (max-width: 768px) {
    .container {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .row {
        margin-left: -10px;
        margin-right: -10px;
    }
    
    [class*="col-"] {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .slot-machine-container {
        margin: -10px;
        padding: 15px;
        border-width: 3px;
        border-radius: 15px;
    }
    
    .slot-display {
        padding: 15px;
        border-width: 2px;
        border-radius: 12px;
    }
    
    .slot-display .row {
        margin-left: -3px;
        margin-right: -3px;
    }
    
    .slot-display .col-3 {
        padding-left: 3px;
        padding-right: 3px;
    }
    
    .slot-reel {
        padding: 15px 8px;
        margin: 0 3px;
        border-width: 2px;
        border-radius: 10px;
        min-height: 80px;
    }
    
    .reel-symbol {
        font-size: 2.5rem;
    }
}

@media (max-width: 576px) {
    .container {
        padding-left: 5px;
        padding-right: 5px;
    }
    
    .row {
        margin-left: -5px;
        margin-right: -5px;
    }
    
    [class*="col-"] {
        padding-left: 5px;
        padding-right: 5px;
    }
    
    .slot-machine-container {
        margin: -5px;
        padding: 10px;
        border-width: 2px;
        border-radius: 12px;
    }
    
    .slot-display {
        padding: 10px;
        border-width: 2px;
        border-radius: 10px;
    }
    
    .slot-display .row {
        margin-left: -2px;
        margin-right: -2px;
    }
    
    .slot-display .col-3 {
        padding-left: 2px;
        padding-right: 2px;
    }
    
    .slot-reel {
        padding: 8px 3px;
        margin: 0 1px;
        min-height: 60px;
    }
    
    .reel-symbol {
        font-size: 1.5rem;
    }
}

/* Fix payout table overflow */
.payout-table-enhanced {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.1), rgba(255, 107, 53, 0.1));
    border: 2px solid #ffd700;
    border-radius: 15px;
    backdrop-filter: blur(10px);
    overflow: hidden;
    max-width: 100%;
}

.payout-table-enhanced .row {
    margin-left: -10px;
    margin-right: -10px;
}

.payout-table-enhanced .col-md-6 {
    padding-left: 10px;
    padding-right: 10px;
}

@media (max-width: 768px) {
    .payout-table-enhanced .row {
        margin-left: -5px;
        margin-right: -5px;
    }
    
    .payout-table-enhanced .col-md-6 {
        padding-left: 5px;
        padding-right: 5px;
    }
}

@media (max-width: 576px) {
    .payout-table-enhanced .row {
        margin-left: 0;
        margin-right: 0;
    }
    
    .payout-table-enhanced .col-md-6 {
        padding-left: 0;
        padding-right: 0;
    }
    
    .payout-item {
        flex-direction: column;
        text-align: center;
        gap: 5px;
        padding: 8px;
    }
    
    .payout-item .symbols {
        min-width: auto;
        margin-bottom: 5px;
    }
    
    .payout-item .multiplier {
        min-width: auto;
        margin-bottom: 5px;
    }
    
    .payout-item .desc {
        min-width: auto;
    }
}

/* Fix winner list overflow */
.winner-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 15px;
    margin: 8px 0;
    background: linear-gradient(90deg, rgba(255, 215, 0, 0.1), rgba(255, 107, 53, 0.1));
    border-radius: 10px;
    border-left: 4px solid #00ff00;
    transition: all 0.3s ease;
    overflow: hidden;
    word-wrap: break-word;
}

@media (max-width: 576px) {
    .winner-item {
        flex-direction: column;
        text-align: center;
        padding: 10px;
        gap: 5px;
    }
    
    .winner-name {
        font-size: 0.8rem;
    }
    
    .winner-amount {
        font-size: 0.85rem;
    }
    
    .winner-combo {
        font-size: 0.9rem;
    }
}

/* Fix modal overflow */
.win-modal-content {
    max-width: 95%;
    margin: 10px auto;
    overflow: hidden;
}

.modal-body {
    max-height: 70vh;
    overflow-y: auto;
    word-wrap: break-word;
}

@media (max-width: 576px) {
    .win-title {
        font-size: 1.3rem;
    }
    
    .win-symbols {
        font-size: 2.5rem;
    }
    
    .win-multiplier {
        font-size: 1.2rem;
    }
    
    .win-amount {
        font-size: 1.8rem;
        word-break: break-all;
    }
}

/* Enhanced Slot Machine Styles */
.slot-machine-container {
    background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
    border: 5px solid #ffd700;
    border-radius: 20px;
    position: relative;
    box-shadow: 
        inset 0 0 30px rgba(255, 215, 0, 0.3),
        0 0 50px rgba(255, 215, 0, 0.4);
}

.slot-machine-header {
    background: linear-gradient(135deg, #ff6b35, #ff0000);
    margin: -20px -20px 20px -20px;
    padding: 15px;
    border-radius: 15px 15px 0 0;
    border-bottom: 3px solid #ffd700;
}

.jackpot-counter {
    font-size: 1.2rem;
    animation: pulse 2s infinite;
}

.slot-display {
    background: #000;
    padding: 20px;
    border-radius: 15px;
    border: 3px solid #ffd700;
    position: relative;
}

.slot-reel {
    background: linear-gradient(145deg, #2d2d2d, #1a1a1a);
    border: 3px solid #ffd700;
    border-radius: 15px;
    padding: 20px;
    margin: 0 5px;
    position: relative;
    overflow: hidden;
    box-shadow: inset 0 0 20px rgba(255, 215, 0, 0.2);
    transition: all 0.3s ease;
    min-height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.slot-reel.spinning {
    animation: reelSpin 0.1s infinite linear;
    box-shadow: 
        inset 0 0 20px rgba(255, 215, 0, 0.5),
        0 0 30px rgba(255, 215, 0, 0.7);
}

.slot-reel.winning {
    animation: winGlow 1s infinite alternate;
    transform: scale(1.1);
}

@keyframes reelSpin {
    0% { background-position: 0% 0%; }
    100% { background-position: 100% 100%; }
}

@keyframes winGlow {
    0% { 
        box-shadow: 
            inset 0 0 20px rgba(255, 215, 0, 0.5),
            0 0 30px rgba(255, 215, 0, 0.7);
    }
    100% { 
        box-shadow: 
            inset 0 0 30px rgba(255, 215, 0, 0.8),
            0 0 50px rgba(255, 215, 0, 1);
    }
}

.reel-symbol {
    font-size: 4rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    animation: symbolGlow 2s ease-in-out infinite alternate;
}

@keyframes symbolGlow {
    0% { filter: brightness(1); }
    100% { filter: brightness(1.2); }
}

.win-line {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #ff6b35, #ffd700, #ff6b35);
    transform: translateY(-50%);
    box-shadow: 0 0 10px rgba(255, 215, 0, 0.8);
}

/* Enhanced Payout Table */
.payout-table-enhanced {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.1), rgba(255, 107, 53, 0.1));
    border: 2px solid #ffd700;
    border-radius: 15px;
    backdrop-filter: blur(10px);
    overflow: hidden;
    max-width: 100%;
}

.payout-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 15px;
    margin: 5px 0;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 10px;
    border-left: 4px solid #ffd700;
    transition: all 0.3s ease;
}

.payout-item:hover {
    background: rgba(255, 215, 0, 0.1);
    transform: translateX(5px);
}

.payout-item.special {
    background: linear-gradient(90deg, rgba(255, 0, 0, 0.2), rgba(255, 215, 0, 0.2));
    border-left-color: #ff0000;
    animation: specialGlow 2s infinite alternate;
}

@keyframes specialGlow {
    0% { box-shadow: 0 0 10px rgba(255, 0, 0, 0.5); }
    100% { box-shadow: 0 0 20px rgba(255, 215, 0, 0.8); }
}

.payout-item .symbols {
    font-size: 1.5rem;
    min-width: 100px;
}

.payout-item .multiplier {
    font-weight: bold;
    color: #ffd700;
    font-size: 1.2rem;
    min-width: 60px;
    text-align: center;
}

.payout-item .desc {
    color: #ccc;
    font-size: 0.9rem;
}

/* Enhanced Slot Select */
.slot-select {
    background: linear-gradient(145deg, #1a1a1a, #2d2d2d) !important;
    border: 3px solid #ffd700 !important;
    color: #ffd700 !important;
    border-radius: 15px !important;
    padding: 15px 20px !important;
    font-weight: bold !important;
    box-shadow: 0 0 20px rgba(255, 215, 0, 0.3) !important;
}

.slot-select:focus {
    box-shadow: 0 0 30px rgba(255, 215, 0, 0.6) !important;
    border-color: #ffed4a !important;
}

/* Enhanced Spin Button */
.slot-spin-btn {
    font-size: 1.8rem !important;
    padding: 25px 80px !important;
    border-radius: 50px !important;
    position: relative;
    overflow: hidden;
    box-shadow: 
        0 10px 30px rgba(255, 215, 0, 0.4),
        inset 0 0 20px rgba(255, 255, 255, 0.1) !important;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.slot-spin-btn:hover {
    transform: translateY(-5px) scale(1.05) !important;
    box-shadow: 
        0 15px 40px rgba(255, 215, 0, 0.6),
        inset 0 0 30px rgba(255, 255, 255, 0.2) !important;
}

/* Winner List Enhancements */
.winner-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 15px;
    margin: 8px 0;
    background: linear-gradient(90deg, rgba(255, 215, 0, 0.1), rgba(255, 107, 53, 0.1));
    border-radius: 10px;
    border-left: 4px solid #00ff00;
    transition: all 0.3s ease;
    overflow: hidden;
    word-wrap: break-word;
}

.winner-item:hover {
    transform: translateX(5px);
    background: linear-gradient(90deg, rgba(255, 215, 0, 0.2), rgba(255, 107, 53, 0.2));
}

.winner-name {
    font-weight: bold;
    color: #ffd700;
}

.winner-amount {
    font-weight: bold;
    font-size: 1.1rem;
}

.winner-combo {
    font-size: 1.2rem;
}

/* Enhanced Win Modal */
.win-modal-content {
    background: linear-gradient(135deg, #ffd700, #ffed4a, #ff6b35) !important;
    color: #000 !important;
    border: 5px solid #ff0000 !important;
    border-radius: 25px !important;
    box-shadow: 0 0 50px rgba(255, 0, 0, 0.8) !important;
    animation: modalPulse 1s infinite alternate;
}

@keyframes modalPulse {
    0% { transform: scale(1); }
    100% { transform: scale(1.02); }
}

.win-title {
    font-size: 2rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    animation: titleBounce 1s infinite;
}

@keyframes titleBounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.win-symbols {
    font-size: 4rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.win-multiplier {
    font-size: 1.8rem;
    font-weight: bold;
    color: #ff0000;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}

.win-amount {
    font-size: 3rem;
    font-weight: 900;
    color: #ff0000;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    animation: amountPulse 0.5s infinite alternate;
}

@keyframes amountPulse {
    0% { transform: scale(1); }
    100% { transform: scale(1.1); }
}

/* Jackpot Progress */
.jackpot-progress {
    margin-top: 15px;
}

.jackpot-bar {
    background: #333;
    height: 20px;
    border-radius: 10px;
    overflow: hidden;
    border: 2px solid #ffd700;
}

.jackpot-fill {
    background: linear-gradient(90deg, #ff6b35, #ffd700, #ff0000);
    height: 100%;
    width: 75%;
    animation: jackpotFill 3s ease-in-out infinite alternate;
}

@keyframes jackpotFill {
    0% { width: 70%; }
    100% { width: 85%; }
}

/* Enhanced Bet Amount Section for Slot Machine */
.bet-amount-section {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.25), rgba(255, 107, 53, 0.15));
    border: 4px solid #ffd700;
    border-radius: 20px;
    padding: 25px;
    margin-bottom: 25px;
    box-shadow: 
        0 0 30px rgba(255, 215, 0, 0.5),
        inset 0 0 20px rgba(255, 215, 0, 0.1);
    animation: betAmountPulse 4s ease-in-out infinite;
    position: relative;
    overflow: hidden;
}

@keyframes betAmountPulse {
    0%, 100% { 
        box-shadow: 0 0 30px rgba(255, 215, 0, 0.5), inset 0 0 20px rgba(255, 215, 0, 0.1);
        border-color: #ffd700;
    }
    50% { 
        box-shadow: 0 0 50px rgba(255, 215, 0, 0.8), inset 0 0 30px rgba(255, 215, 0, 0.2);
        border-color: #ffed4a;
    }
}

.bet-amount-section::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    animation: shimmer 3s linear infinite;
    pointer-events: none;
}

@keyframes shimmer {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.bet-amount-title {
    color: #ffd700;
    font-size: 1.4rem;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-align: center;
    margin-bottom: 20px;
    text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.8);
    animation: titleBounce 2s ease-in-out infinite;
}

@keyframes titleBounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-3px); }
}

.bet-amount-title::before {
    content: '💎 ';
    font-size: 1.6rem;
    animation: sparkle 1.5s ease-in-out infinite;
}

.bet-amount-title::after {
    content: ' 💎';
    font-size: 1.6rem;
    animation: sparkle 1.5s ease-in-out infinite 0.5s;
}

@keyframes sparkle {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.7; transform: scale(1.2); }
}

.bet-buttons-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.bet-amount-btn {
    background: linear-gradient(145deg, #2d2d2d, #1a1a1a);
    border: 3px solid #ffd700;
    color: #ffd700;
    padding: 18px 20px;
    border-radius: 15px;
    font-weight: 900;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.bet-amount-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.bet-amount-btn:hover::before {
    left: 100%;
}

.bet-amount-btn:hover {
    background: linear-gradient(145deg, #ffd700, #ffed4a);
    color: #000;
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.6);
    border-color: #ffed4a;
}

.bet-amount-btn.active {
    background: linear-gradient(145deg, #ffd700, #ffed4a);
    color: #000;
    transform: scale(1.05);
    box-shadow: 
        0 0 25px rgba(255, 215, 0, 0.8),
        inset 0 0 20px rgba(255, 255, 255, 0.2);
    border-color: #ffed4a;
    animation: activeBetPulse 1.5s ease-in-out infinite;
}

@keyframes activeBetPulse {
    0%, 100% { 
        box-shadow: 0 0 25px rgba(255, 215, 0, 0.8), inset 0 0 20px rgba(255, 255, 255, 0.2);
    }
    50% { 
        box-shadow: 0 0 35px rgba(255, 215, 0, 1), inset 0 0 30px rgba(255, 255, 255, 0.3);
    }
}

/* Custom Bet Input */
.custom-bet-container {
    background: linear-gradient(145deg, #1a1a1a, #000000);
    border: 3px solid #ffd700;
    border-radius: 15px;
    padding: 20px;
    margin-top: 15px;
    box-shadow: inset 0 0 20px rgba(255, 215, 0, 0.2);
}

.custom-bet-label {
    color: #ffd700;
    font-size: 1.1rem;
    font-weight: bold;
    text-align: center;
    margin-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.custom-bet-input {
    background: linear-gradient(145deg, #000000, #1a1a1a) !important;
    border: 3px solid #ffd700 !important;
    color: #ffd700 !important;
    padding: 15px 20px !important;
    border-radius: 12px !important;
    font-size: 1.2rem !important;
    font-weight: bold !important;
    text-align: center !important;
    width: 100% !important;
    box-shadow: 
        inset 0 0 15px rgba(255, 215, 0, 0.2),
        0 0 20px rgba(255, 215, 0, 0.3) !important;
    transition: all 0.3s ease !important;
}

.custom-bet-input:focus {
    outline: none !important;
    border-color: #ffed4a !important;
    box-shadow: 
        inset 0 0 20px rgba(255, 215, 0, 0.3),
        0 0 30px rgba(255, 215, 0, 0.8) !important;
    transform: scale(1.02) !important;
}

.custom-bet-input::placeholder {
    color: rgba(255, 215, 0, 0.6) !important;
    font-style: italic !important;
}

/* Current Bet Display for Slot */
.current-bet-display {
    background: linear-gradient(135deg, rgba(0, 255, 0, 0.2), rgba(0, 200, 0, 0.1));
    border: 3px solid #00ff00;
    border-radius: 15px;
    padding: 20px;
    margin-top: 20px;
    text-align: center;
    box-shadow: 0 0 30px rgba(0, 255, 0, 0.5);
    animation: currentBetGlow 2s ease-in-out infinite alternate;
}

.current-bet-display h5 {
    color: #00ff00;
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 15px;
    text-transform: uppercase;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
}

.current-bet-display h5::before {
    content: '🎰 ';
    font-size: 1.3rem;
}

.current-bet-display h5::after {
    content: ' 🎰';
    font-size: 1.3rem;
}

.bet-amount-value {
    font-size: 2rem;
    font-weight: 900;
    color: #ffd700;
    text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.8);
    margin-bottom: 10px;
    animation: valueFlicker 3s ease-in-out infinite;
}

@keyframes valueFlicker {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
}

.potential-win {
    font-size: 1.1rem;
    color: #fff;
    background: rgba(0, 0, 0, 0.3);
    padding: 8px 15px;
    border-radius: 8px;
    border-left: 4px solid #00ff00;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .bet-amount-section {
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .bet-amount-title {
        font-size: 1.2rem;
        margin-bottom: 15px;
    }
    
    .bet-buttons-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }
    
    .bet-amount-btn {
        padding: 15px 18px;
        font-size: 1rem;
    }
    
    .custom-bet-container {
        padding: 15px;
    }
    
    .custom-bet-input {
        padding: 12px 15px !important;
        font-size: 1.1rem !important;
    }
    
    .current-bet-display {
        padding: 15px;
    }
    
    .bet-amount-value {
        font-size: 1.6rem;
    }
}

@media (max-width: 576px) {
    .bet-amount-section {
        padding: 15px;
    }
    
    .bet-amount-title {
        font-size: 1rem;
        letter-spacing: 1px;
    }
    
    .bet-buttons-grid {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    .bet-amount-btn {
        padding: 12px 15px;
        font-size: 0.9rem;
    }
    
    .custom-bet-input {
        padding: 10px 12px !important;
        font-size: 1rem !important;
    }
    
    .bet-amount-value {
        font-size: 1.4rem;
    }
    
    .potential-win {
        font-size: 1rem;
        padding: 6px 12px;
    }
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const symbols = ['🍒', '🍋', '🍊', '⭐', '💎', '👑', '🔥'];
    const spinBtn = document.getElementById('spin-btn');
    const betAmountSelect = document.getElementById('bet-amount');
    
    // Ensure the select has a default value
    if (!betAmountSelect.value) {
        betAmountSelect.value = '50000';
    }
    
    // Quick bet buttons
    document.querySelectorAll('.quick-bet').forEach(btn => {
        btn.addEventListener('click', function() {
            const amount = this.getAttribute('data-amount');
            betAmountSelect.value = amount;
            spin();
        });
    });
    
    spinBtn.addEventListener('click', spin);
    
    function spin() {
        // Get bet amount directly from select value
        const betAmount = parseInt(betAmountSelect.value);
        
        console.log('Bet amount:', betAmount); // Debug log
        
        // Simple validation - just check if we have a valid number
        if (!betAmount || isNaN(betAmount) || betAmount <= 0) {
            alert('Pilih jumlah bet terlebih dahulu!');
            return;
        }
        
        if (betAmount < 10000) {
            alert('Minimal bet adalah Rp 10.000!');
            return;
        }
        
        if (betAmount > 500000) {
            alert('Maksimal bet adalah Rp 500.000!');
            return;
        }
        
        // Check if user has enough balance
        const balanceText = document.getElementById('balance').textContent;
        const currentBalance = parseInt(balanceText.replace(/[^\d]/g, ''));
        
        if (currentBalance < betAmount) {
            alert('Saldo tidak mencukupi! Saldo Anda: Rp ' + currentBalance.toLocaleString('id-ID'));
            return;
        }
        
        console.log('Starting spin with amount:', betAmount);
        
        spinBtn.disabled = true;
        spinBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> SPINNING...';
        spinBtn.classList.remove('animate__pulse');
        
        // Add spinning animation to reels
        animateReels();
        
        // Make API call
        setTimeout(() => {
            fetch('/gambling/play', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    bet_amount: betAmount
                })
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    showSlotResult(data);
                } else {
                    alert(data.message || 'Terjadi kesalahan saat memproses taruhan!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan koneksi! Coba lagi.');
            })
            .finally(() => {
                resetSpinButton();
            });
        }, 3000);
    }
    
    function resetSpinButton() {
        spinBtn.disabled = false;
        spinBtn.innerHTML = '<i class="fas fa-play"></i> SPIN SEKARANG!';
        spinBtn.classList.add('animate__pulse');
    }
    
    function animateReels() {
        const reels = ['reel1', 'reel2', 'reel3'];
        
        reels.forEach((reelId, index) => {
            const reel = document.getElementById(reelId);
            const container = document.getElementById(`reel-container-${index + 1}`);
            
            // Add spinning class
            container.classList.add('spinning');
            
            let spins = 0;
            const maxSpins = 30 + (index * 10);
            
            const spinInterval = setInterval(() => {
                reel.textContent = symbols[Math.floor(Math.random() * symbols.length)];
                spins++;
                
                if (spins >= maxSpins) {
                    clearInterval(spinInterval);
                    container.classList.remove('spinning');
                }
            }, 100);
        });
    }
    
    function showSlotResult(data) {
        // Update stats
        document.getElementById('balance').textContent = 'Rp ' + data.new_balance.toLocaleString('id-ID');
        document.getElementById('total-attempts').textContent = data.total_attempts;
        document.getElementById('total-wins').textContent = data.total_wins;
        
        // Set final slot symbols
        setTimeout(() => {
            document.getElementById('reel1').textContent = data.slot_result[0];
            document.getElementById('reel2').textContent = data.slot_result[1];
            document.getElementById('reel3').textContent = data.slot_result[2];
            
            // Show win line if winning
            if (data.win) {
                showWinLine();
                showWinEffects();
            }
        }, 3000);
        
        // Show result
        setTimeout(() => {
            const resultDiv = document.getElementById('game-result');
            const resultText = document.getElementById('result-text');
            const resultDetails = document.getElementById('result-details');
            
            if (data.win) {
                resultText.innerHTML = `🎉 MEGA WIN! 🎉`;
                resultText.className = 'text-success mb-3 animate__animated animate__bounceIn';
                
                resultDetails.innerHTML = `
                    <div class="win-result">
                        <div class="win-symbols mb-2">${data.slot_result.join('')}</div>
                        <div class="win-multiplier text-warning mb-2">${data.multiplier}x MULTIPLIER!</div>
                        <h4 class="text-success">MENANG: Rp ${data.payout.toLocaleString('id-ID')}</h4>
                        <p class="text-muted">Taruhan: Rp ${data.bet_amount.toLocaleString('id-ID')}</p>
                    </div>
                `;
                
                // Show enhanced win modal
                document.getElementById('modal-win-symbols').textContent = data.slot_result.join('');
                document.getElementById('modal-win-multiplier').textContent = `${data.multiplier}x MULTIPLIER!`;
                document.getElementById('modal-win-amount').textContent = 'Rp ' + data.payout.toLocaleString('id-ID');
                
                setTimeout(() => {
                    new bootstrap.Modal(document.getElementById('winModal')).show();
                }, 1000);
                
                // Add to winner list
                addToWinnerList(data);
                
                // Enhanced win display with animations
                if (data.payout >= 100000) {
                    showBigWinAnimation(data.payout);
                }
                
                // Start falling gold animation
                if (typeof startFallingGold === 'function') {
                    startFallingGold();
                }
                
            } else {
                resultText.textContent = '💀 HOHOHO, TIDAK BERUNTUNG';
                resultText.className = 'text-danger mb-3';
                resultDetails.innerHTML = `
                    <div class="lose-result">
                        <div class="lose-symbols mb-2">${data.slot_result.join('')}</div>
                        <h4 class="text-danger">KALAH: Rp ${data.bet_amount.toLocaleString('id-ID')}</h4>
                        <p class="text-muted">Coba lagi untuk menang besar!</p>
                    </div>
                `;
            }
            
            resultDiv.style.display = 'block';
            resultDiv.classList.add('animate__animated', 'animate__fadeInUp');
        }, 3500);
    }
    
    function showWinLine() {
        const winLine = document.getElementById('win-line');
        winLine.style.display = 'block';
        winLine.classList.add('animate__animated', 'animate__flash');
    }
    
    function showWinEffects() {
        // Add celebration effects
        document.querySelectorAll('.slot-reel').forEach(reel => {
            reel.classList.add('winning');
        });
        
        setTimeout(() => {
            document.querySelectorAll('.slot-reel').forEach(reel => {
                reel.classList.remove('winning');
            });
        }, 3000);
    }
    
    function addToWinnerList(data) {
        const winnerList = document.getElementById('winner-list');
        const newWinner = document.createElement('div');
        newWinner.className = 'winner-item animate__animated animate__fadeInRight';
        newWinner.innerHTML = `
            <span class="winner-name">Anda</span>
            <span class="winner-amount text-success">+Rp ${data.payout.toLocaleString('id-ID')}</span>
            <span class="winner-combo">${data.slot_result.join('')}</span>
        `;
        
        winnerList.insertBefore(newWinner, winnerList.firstChild);
        
        // Keep only last 4 winners
        if (winnerList.children.length > 4) {
            winnerList.removeChild(winnerList.lastChild);
        }
    }
    
    // Animate jackpot counter
    function animateJackpot() {
        const jackpotElement = document.getElementById('current-jackpot');
        let currentAmount = 1000000000;
        
        setInterval(() => {
            currentAmount += Math.floor(Math.random() * 50000) + 10000;
            jackpotElement.textContent = 'Rp ' + currentAmount.toLocaleString('id-ID');
        }, 2000);
    }
    
    animateJackpot();
});
</script>

<!-- Additional Gambling Page Scripts -->
<script>
// Enhanced flashy effects for gambling page
document.addEventListener('DOMContentLoaded', function() {
    // Create more frequent win notifications for this page
    function createGamblingWinNotification() {
        const bigWins = [
            { name: 'Lucky777****', amount: 'Rp 100.000.000', combo: '🔥🔥🔥' },
            { name: 'Jackpot****', amount: 'Rp 250.000.000', combo: '💎💎💎' },
            { name: 'Winner****', amount: 'Rp 500.000.000', combo: '👑👑👑' },
            { name: 'Gacor****', amount: 'Rp 75.000.000', combo: '⭐⭐⭐' }
        ];
        
        const randomWin = bigWins[Math.floor(Math.random() * bigWins.length)];
        
        // Create floating notification
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: ${Math.random() * 50 + 10}%;
            right: 20px;
            width: 220px;
            background: linear-gradient(45deg, #ff6b35, #ffd700);
            border: 3px solid #ff0000;
            border-radius: 15px;
            padding: 15px;
            color: #000;
            font-weight: bold;
            text-align: center;
            z-index: 1001;
            animation: slideInRight 0.5s ease-out, fadeOutDelay 5s ease-in;
            animation-fill-mode: forwards;
            box-shadow: 0 0 30px rgba(255, 0, 0, 0.8);
        `;
        
        notification.innerHTML = `
            <div style="font-size: 14px;">🎰 MEGA WIN! 🎰</div>
            <div style="font-size: 16px; margin: 5px 0;">${randomWin.name}</div>
            <div style="font-size: 18px; color: #ff0000; margin: 5px 0;">${randomWin.amount}</div>
            <div style="font-size: 20px;">${randomWin.combo}</div>
            <div style="font-size: 12px; margin-top: 5px;">JOIN NOW!</div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 5500);
    }
    
    // More frequent notifications on gambling page
    setInterval(createGamblingWinNotification, 5000);
    
    // Create pulsating glow effect on spin button
    function addSpinButtonEffects() {
        const spinBtn = document.getElementById('spin-btn');
        if (spinBtn) {
            setInterval(() => {
                spinBtn.style.boxShadow = '0 0 50px rgba(255, 215, 0, 0.9), 0 0 100px rgba(255, 0, 0, 0.5)';
                setTimeout(() => {
                    spinBtn.style.boxShadow = '0 10px 30px rgba(255, 215, 0, 0.4)';
                }, 500);
            }, 2000);
        }
    }
    
    addSpinButtonEffects();
});
</script>
                    spinBtn.style.boxShadow = '0 10px 30px rgba(255, 215, 0, 0.4)';
                }, 500);
            }, 2000);
        }
    }
    
    addSpinButtonEffects();
});
</script>


