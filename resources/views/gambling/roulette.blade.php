@extends('layouts.app')

@section('title', 'Roulette Indonesia - Putar Roda Keberuntungan')

@section('content')
<div class="container roulette-container admin-clean">
    <div class="row justify-content-center">
        <div class="col-12 text-center mb-4">
            <h2 class="roulette-title animate__animated animate__fadeInDown">
                <i class="fas fa-circle-notch"></i> RODA ROULETTE <i class="fas fa-circle-notch"></i>
            </h2>
        </div>
    </div>

    <!-- User Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-wallet"></i>
                <h5>SALDO</h5>
                <h3 id="balance">Rp {{ number_format($user->balance) }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-gamepad"></i>
                <h5>TOTAL MAIN</h5>
                <h3 id="total-attempts">{{ $user->total_attempts }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-trophy"></i>
                <h5>KEMENANGAN</h5>
                <h3 id="total-wins">{{ $user->total_wins }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-percentage"></i>
                <h5>WIN RATE</h5>
                <h3>
                    {{ $user->total_attempts > 0 ? number_format(($user->total_wins / $user->total_attempts) * 100, 1) : 0 }}%
                </h3>
            </div>
        </div>
    </div>

    <!-- Main Roulette Game -->
    <div class="row justify-content-center">
        <!-- Roulette Wheel - Now Centered -->
        <div class="col-lg-8 col-md-10 col-sm-12 text-center mb-4">
            <div class="roulette-wheel-container mx-auto">
                <div class="wheel-container mx-auto">
                    <div class="roulette-wheel" id="rouletteWheel">
                        <!-- Roulette numbers positioned around the wheel -->
                        <div class="wheel-number" style="--angle: 0deg; transform: rotate(0deg);" data-number="0">
                            <span>0</span>
                        </div>
<div class="wheel-number" style="--angle: 9.73deg; transform: rotate(9.73deg);" data-number="32">
    <span>32</span>
</div>
<div class="wheel-number" style="--angle: 19.46deg; transform: rotate(19.46deg);" data-number="15">
    <span>15</span>
</div>
<div class="wheel-number" style="--angle: 29.19deg; transform: rotate(29.19deg);" data-number="19">
    <span>19</span>
</div>
<div class="wheel-number" style="--angle: 38.92deg; transform: rotate(38.92deg);" data-number="4">
    <span>4</span>
</div>
<div class="wheel-number" style="--angle: 48.65deg; transform: rotate(48.65deg);" data-number="21">
    <span>21</span>
</div>
<div class="wheel-number" style="--angle: 58.38deg; transform: rotate(58.38deg);" data-number="2">
    <span>2</span>
</div>
<div class="wheel-number" style="--angle: 68.11deg; transform: rotate(68.11deg);" data-number="25">
    <span>25</span>
</div>
<div class="wheel-number" style="--angle: 77.84deg; transform: rotate(77.84deg);" data-number="17">
    <span>17</span>
</div>
<div class="wheel-number" style="--angle: 87.57deg; transform: rotate(87.57deg);" data-number="34">
    <span>34</span>
</div>
<div class="wheel-number" style="--angle: 97.3deg; transform: rotate(97.3deg);" data-number="6">
    <span>6</span>
</div>
<div class="wheel-number" style="--angle: 107.03deg; transform: rotate(107.03deg);" data-number="27">
    <span>27</span>
</div>
<div class="wheel-number" style="--angle: 116.76deg; transform: rotate(116.76deg);" data-number="13">
    <span>13</span>
</div>
<div class="wheel-number" style="--angle: 126.49deg; transform: rotate(126.49deg);" data-number="36">
    <span>36</span>
</div>
<div class="wheel-number" style="--angle: 136.22deg; transform: rotate(136.22deg);" data-number="11">
    <span>11</span>
</div>
<div class="wheel-number" style="--angle: 145.95deg; transform: rotate(145.95deg);" data-number="30">
    <span>30</span>
</div>
<div class="wheel-number" style="--angle: 155.68deg; transform: rotate(155.68deg);" data-number="8">
    <span>8</span>
</div>
<div class="wheel-number" style="--angle: 165.41deg; transform: rotate(165.41deg);" data-number="23">
    <span>23</span>
</div>
<div class="wheel-number" style="--angle: 175.14deg; transform: rotate(175.14deg);" data-number="10">
    <span>10</span>
</div>
<div class="wheel-number" style="--angle: 184.87deg; transform: rotate(184.87deg);" data-number="5">
    <span>5</span>
</div>
<div class="wheel-number" style="--angle: 194.6deg; transform: rotate(194.6deg);" data-number="24">
    <span>24</span>
</div>
<div class="wheel-number" style="--angle: 204.33deg; transform: rotate(204.33deg);" data-number="16">
    <span>16</span>
</div>
<div class="wheel-number" style="--angle: 214.06deg; transform: rotate(214.06deg);" data-number="33">
    <span>33</span>
</div>
<div class="wheel-number" style="--angle: 223.79deg; transform: rotate(223.79deg);" data-number="1">
    <span>1</span>
</div>
<div class="wheel-number" style="--angle: 233.52deg; transform: rotate(233.52deg);" data-number="20">
    <span>20</span>
</div>
<div class="wheel-number" style="--angle: 243.25deg; transform: rotate(243.25deg);" data-number="14">
    <span>14</span>
</div>
<div class="wheel-number" style="--angle: 252.98deg; transform: rotate(252.98deg);" data-number="31">
    <span>31</span>
</div>
<div class="wheel-number" style="--angle: 262.71deg; transform: rotate(262.71deg);" data-number="9">
    <span>9</span>
</div>
<div class="wheel-number" style="--angle: 272.44deg; transform: rotate(272.44deg);" data-number="22">
    <span>22</span>
</div>
<div class="wheel-number" style="--angle: 282.17deg; transform: rotate(282.17deg);" data-number="18">
    <span>18</span>
</div>
<div class="wheel-number" style="--angle: 291.9deg; transform: rotate(291.9deg);" data-number="29">
    <span>29</span>
</div>
<div class="wheel-number" style="--angle: 301.63deg; transform: rotate(301.63deg);" data-number="7">
    <span>7</span>
</div>
<div class="wheel-number" style="--angle: 311.36deg; transform: rotate(311.36deg);" data-number="28">
    <span>28</span>
</div>
<div class="wheel-number" style="--angle: 321.09deg; transform: rotate(321.09deg);" data-number="12">
    <span>12</span>
</div>
<div class="wheel-number" style="--angle: 330.82deg; transform: rotate(330.82deg);" data-number="35">
    <span>35</span>
</div>
<div class="wheel-number" style="--angle: 340.55deg; transform: rotate(340.55deg);" data-number="3">
    <span>3</span>
</div>
<div class="wheel-number" style="--angle: 350.28deg; transform: rotate(350.28deg);" data-number="26">
    <span>26</span>
</div>
                        
                        <!-- Center of the wheel -->
                        <div class="wheel-center">
                            <i class="fas fa-circle-notch"></i>
                        </div>
                    </div>
                    
                    <!-- Fixed pointer -->
                    <div class="wheel-pointer">
                        <div class="pointer-arrow"></div>
                        <div class="pointer-base"></div>
                    </div>
                </div>
                
                <!-- Winning Number Display -->
                <div class="winning-number" id="winningNumber" style="display: none;">
                    <h3>NOMOR PEMENANG</h3>
                    <div class="winning-number-display">
                        <span id="numberDisplay">0</span>
                    </div>
                    <div class="winning-color">
                        <span id="colorDisplay">HIJAU</span>
                    </div>
                </div>
                
                <!-- Result Display -->
                <div class="result-display mt-4" id="gameResult" style="display: none;">
                    <h3 id="resultText"></h3>
                    <div id="resultDetails"></div>
                </div>
            </div>
        </div>

        <!-- Enhanced Betting Panel - Repositioned Below Wheel -->
        <div class="col-lg-10 col-md-12">
            <div class="premium-betting-panel">
                <div class="panel-header">
                    <h4><i class="fas fa-dice-d20"></i> CASINO BETTING ZONE</h4>
                    <div class="panel-subtitle">Place Your Bets & Win Big!</div>
                </div>
                
                <!-- Bet Amount Section -->
                <div class="bet-amount-section">
                    <div class="section-title">
                        <i class="fas fa-coins"></i> BETTING AMOUNT
                    </div>
                    <div class="bet-amount-grid">
                        <button class="bet-amount-card" data-amount="15000">
                            <div class="amount-icon">💰</div>
                            <div class="amount-text">Rp 15K</div>
                            <div class="amount-label">Starter</div>
                        </button>
                        <button class="bet-amount-card" data-amount="25000">
                            <div class="amount-icon">💎</div>
                            <div class="amount-text">Rp 25K</div>
                            <div class="amount-label">Regular</div>
                        </button>
                        <button class="bet-amount-card active" data-amount="50000">
                            <div class="amount-icon">👑</div>
                            <div class="amount-text">Rp 50K</div>
                            <div class="amount-label">Premium</div>
                        </button>
                        <button class="bet-amount-card" data-amount="100000">
                            <div class="amount-icon">🔥</div>
                            <div class="amount-text">Rp 100K</div>
                            <div class="amount-label">VIP</div>
                        </button>
                        <button class="bet-amount-card" data-amount="250000">
                            <div class="amount-icon">⚡</div>
                            <div class="amount-text">Rp 250K</div>
                            <div class="amount-label">Elite</div>
                        </button>
                        <button class="bet-amount-card" data-amount="500000">
                            <div class="amount-icon">💥</div>
                            <div class="amount-text">Rp 500K</div>
                            <div class="amount-label">MAXBET</div>
                        </button>
                    </div>
                </div>

                <!-- Bet Types Section -->
                <div class="bet-types-section">
                    <div class="section-title">
                        <i class="fas fa-target"></i> SELECT YOUR BET
                    </div>
                    
                    <!-- Color Bets -->
                    <div class="bet-category">
                        <div class="category-title">🎨 COLOR BETS</div>
                        <div class="bet-options-row">
                            <button class="premium-bet-btn color-red" data-type="color" data-value="red" data-payout="1">
                                <div class="bet-icon">🔴</div>
                                <div class="bet-text">MERAH</div>
                                <div class="bet-payout">2:1</div>
                            </button>
                            <button class="premium-bet-btn color-black" data-type="color" data-value="black" data-payout="1">
                                <div class="bet-icon">⚫</div>
                                <div class="bet-text">HITAM</div>
                                <div class="bet-payout">2:1</div>
                            </button>
                        </div>
                    </div>

                    <!-- Number Range Bets -->
                    <div class="bet-category">
                        <div class="category-title">📊 RANGE BETS</div>
                        <div class="bet-options-row">
                            <button class="premium-bet-btn range-low" data-type="range" data-value="low" data-payout="1">
                                <div class="bet-icon">📉</div>
                                <div class="bet-text">1-18</div>
                                <div class="bet-payout">2:1</div>
                            </button>
                            <button class="premium-bet-btn range-high" data-type="range" data-value="high" data-payout="1">
                                <div class="bet-icon">📈</div>
                                <div class="bet-text">19-36</div>
                                <div class="bet-payout">2:1</div>
                            </button>
                        </div>
                    </div>

                    <!-- Even/Odd Bets -->
                    <div class="bet-category">
                        <div class="category-title">🎯 PARITY BETS</div>
                        <div class="bet-options-row">
                            <button class="premium-bet-btn parity-even" data-type="parity" data-value="even" data-payout="1">
                                <div class="bet-icon">2️⃣</div>
                                <div class="bet-text">GENAP</div>
                                <div class="bet-payout">2:1</div>
                            </button>
                            <button class="premium-bet-btn parity-odd" data-type="parity" data-value="odd" data-payout="1">
                                <div class="bet-icon">1️⃣</div>
                                <div class="bet-text">GANJIL</div>
                                <div class="bet-payout">2:1</div>
                            </button>
                        </div>
                    </div>

                    <!-- Single Number Bet -->
                    <div class="bet-category">
                        <div class="category-title">🎰 SINGLE NUMBER (JACKPOT!)</div>
                        <div class="single-number-section">
                            <input type="number" id="singleNumber" min="0" max="36" placeholder="Enter 0-36" class="number-input">
                            <button class="premium-bet-btn single-number-btn" id="singleNumberBet" data-type="number" data-payout="35">
                                <div class="bet-icon">💰</div>
                                <div class="bet-text">SINGLE NUMBER</div>
                                <div class="bet-payout">36:1</div>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Current Bet Display -->
                <div class="current-bet-display" id="currentBet" style="display: none;">
                    <div class="bet-display-header">
                        <i class="fas fa-check-circle"></i> ACTIVE BET
                    </div>
                    <div id="betDetails" class="bet-details"></div>
                </div>

                <!-- Spin Button -->
                <div class="spin-section">
                    <button id="spinBtn" class="mega-spin-btn" disabled>
                        <div class="spin-icon"><i class="fas fa-dice-d20"></i></div>
                        <div class="spin-text">SPIN TO WIN!</div>
                        <div class="spin-subtitle">Let Fortune Decide</div>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Results -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="recent-results-container">
                <h5><i class="fas fa-history"></i> Hasil Terakhir</h5>
                <div class="recent-results" id="recentResults">
                    <!-- Results will be added dynamically -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Win Modal -->
<div class="modal fade" id="winModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content roulette-modal">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle"></h4>
            </div>
            <div class="modal-body text-center">
                <div id="modalContent"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
/* Hide ads specifically on roulette page */
.admin-clean #leftAds,
.admin-clean #rightAds,
.admin-clean #slotDemo,
.admin-clean #jackpotTicker,
.admin-clean #sidebarPromo {
    display: none !important;
}

/* Roulette Specific Styles - UPDATED FOR CENTERING */
.roulette-container {
    background: linear-gradient(135deg, #0a0a0a, #1a1a1a);
    min-height: 100vh;
    padding: 20px 0;
}

.roulette-title {
    color: #ffd700;
    font-size: 2.5rem;
    margin-bottom: 20px;
    text-shadow: 0 0 10px rgba(255, 215, 0, 0.8);
}

/* Center the wheel container */
.roulette-wheel-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    max-width: 500px;
    margin: 0 auto;
}

.wheel-container {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    /* PERBAIKAN: Sizing yang lebih tepat */
    width: min(85vw, 400px);
    height: min(85vw, 400px);
    max-width: 400px;
    max-height: 400px;
    margin: 0 auto;
}

/* PERBAIKAN: Roulette wheel structure yang benar */
.roulette-wheel {
    position: relative;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: #1a1a1a;
    border: 8px solid #ffd700;
    box-shadow: 
        0 0 30px rgba(255, 215, 0, 0.8),
        inset 0 0 30px rgba(0, 0, 0, 0.5);
    transform-origin: center center;
    will-change: transform;
}

/* PERBAIKAN: Wheel segments menggunakan pseudo-elements */
.roulette-wheel::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border-radius: 50%;
    background: conic-gradient(
        from 0deg,
        #00aa44 0deg 9.73deg,
        #ff0000 9.73deg 19.46deg,
        #000000 19.46deg 29.19deg,
        #ff0000 29.19deg 38.92deg,
        #000000 38.92deg 48.65deg,
        #ff0000 48.65deg 58.38deg,
        #000000 58.38deg 68.11deg,
        #ff0000 68.11deg 77.84deg,
        #000000 77.84deg 87.57deg,
        #ff0000 87.57deg 97.3deg,
        #000000 97.3deg 107.03deg,
        #ff0000 107.03deg 116.76deg,
        #000000 116.76deg 126.49deg,
        #ff0000 126.49deg 136.22deg,
        #000000 136.22deg 145.95deg,
        #ff0000 145.95deg 155.68deg,
        #000000 155.68deg 165.41deg,
        #ff0000 165.41deg 175.14deg,
        #000000 175.14deg 184.87deg,
        #ff0000 184.87deg 194.6deg,
        #000000 194.6deg 204.33deg,
        #ff0000 204.33deg 214.06deg,
        #000000 214.06deg 223.79deg,
        #ff0000 223.79deg 233.52deg,
        #000000 233.52deg 243.25deg,
        #ff0000 243.25deg 252.98deg,
        #000000 252.98deg 262.71deg,
        #ff0000 262.71deg 272.44deg,
        #000000 272.44deg 282.17deg,
        #ff0000 282.17deg 291.9deg,
        #000000 291.9deg 301.63deg,
        #ff0000 301.63deg 311.36deg,
        #000000 311.36deg 321.09deg,
        #ff0000 321.09deg 330.82deg,
        #000000 330.82deg 340.55deg,
        #ff0000 340.55deg 350.28deg,
        #000000 350.28deg 360deg
    );
}

/* PERBAIKAN: Wheel numbers yang tepat posisinya */
.wheel-number {
    position: absolute;
    top: 5%;
    left: 50%;
    width: 35px;
    height: 35px;
    margin-left: -17.5px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 16px;
    color: #fff;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    /* PERBAIKAN: Transform origin yang tepat untuk rotasi dari center wheel */
    transform-origin: 50% 190px; /* Sesuaikan dengan radius wheel */
    z-index: 15;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(5px);
}

/* PERBAIKAN: Counter-rotate text agar selalu tegak */
.wheel-number span {
    transform: rotate(calc(-1 * var(--angle)));
    display: inline-block;
    font-weight: bold;
}

/* PERBAIKAN: Winning number highlight */
.wheel-number.winning-highlight {
    animation: winningPulse 2s ease-in-out infinite;
    background: rgba(255, 255, 0, 0.3) !important;
    border-color: #ffff00 !important;
    box-shadow: 0 0 25px rgba(255, 255, 0, 0.9) !important;
    z-index: 25;
}

@keyframes winningPulse {
    0%, 100% { 
        transform: rotate(var(--angle)) scale(1);
        box-shadow: 0 0 25px rgba(255, 255, 0, 0.9);
    }
    50% { 
        transform: rotate(var(--angle)) scale(1.4);
        box-shadow: 0 0 35px rgba(255, 255, 0, 1);
    }
}

/* PERBAIKAN: Wheel pointer yang tepat di center top */
.wheel-pointer {
    position: absolute;
    top: -40px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 100;
    pointer-events: none;
}

.pointer-arrow {
    width: 0;
    height: 0;
    border-left: 25px solid transparent;
    border-right: 25px solid transparent;
    border-top: 50px solid #ff0000;
    margin: 0 auto;
    filter: drop-shadow(0 0 15px rgba(255, 0, 0, 0.8));
    position: relative;
}

.pointer-arrow::after {
    content: '';
    position: absolute;
    top: -50px;
    left: -20px;
    width: 0;
    height: 0;
    border-left: 20px solid transparent;
    border-right: 20px solid transparent;
    border-top: 25px solid #ffd700;
}

.pointer-base {
    width: 25px;
    height: 25px;
    background: #ff0000;
    border-radius: 50%;
    margin: -8px auto 0;
    border: 4px solid #ffd700;
    box-shadow: 0 0 20px rgba(255, 0, 0, 0.8);
}

/* PERBAIKAN: Wheel center yang tidak menghalangi */
.wheel-center {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #ffd700, #ffed4a);
    border: 5px solid #ff0000;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transform: translate(-50%, -50%);
    z-index: 30;
    box-shadow: 
        0 0 30px rgba(255, 215, 0, 0.8),
        inset 0 0 20px rgba(255, 255, 255, 0.3);
}

.wheel-center i {
    font-size: 1.8rem;
    color: #ff0000;
    animation: centerSpin 2s linear infinite;
}

@keyframes centerSpin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* PERBAIKAN: Responsive adjustments */
@media (max-width: 768px) {
    .wheel-container {
        width: min(80vw, 350px);
        height: min(80vw, 350px);
    }
    
    .wheel-number {
        transform-origin: 50% 140px;
        top: 8%;
        width: 28px;
        height: 28px;
        margin-left: -14px;
        font-size: 13px;
    }
    
    .wheel-center {
        width: 50px;
        height: 50px;
    }
    
    .wheel-center i {
        font-size: 1.5rem;
    }
}

@media (max-width: 576px) {
    .wheel-container {
        width: min(75vw, 300px);
        height: min(75vw, 300px);
    }
    
    .wheel-number {
        transform-origin: 50% 115px;
        top: 10%;
        width: 24px;
        height: 24px;
        margin-left: -12px;
        font-size: 11px;
    }
    
    .wheel-center {
        width: 40px;
        height: 40px;
    }
    
    .wheel-center i {
        font-size: 1.2rem;
    }
}

/* ADD THESE MISSING STYLES FOR BETTING ZONE */
.premium-betting-panel {
    background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
    border: 3px solid #ffd700;
    border-radius: 20px;
    padding: 30px;
    margin: 20px 0;
    box-shadow: 0 0 30px rgba(255, 215, 0, 0.3);
}

.panel-header {
    text-align: center;
    margin-bottom: 30px;
    color: #ffd700;
}

.panel-header h4 {
    font-size: 1.8rem;
    margin-bottom: 10px;
}

.panel-subtitle {
    color: #ccc;
    font-size: 1.1rem;
}

.bet-amount-section {
    margin-bottom: 30px;
}

.section-title {
    color: #ffd700;
    font-size: 1.3rem;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center;
}

.bet-amount-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.bet-amount-card {
    background: linear-gradient(135deg, #2d2d2d, #1a1a1a);
    border: 2px solid #555;
    border-radius: 15px;
    padding: 15px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #fff;
}

.bet-amount-card:hover {
    border-color: #ffd700;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
}

.bet-amount-card.active {
    border-color: #ffd700;
    background: linear-gradient(135deg, #ffd700, #ffed4a);
    color: #000;
    box-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
}

.amount-icon {
    font-size: 1.5rem;
    margin-bottom: 8px;
}

.amount-text {
    font-size: 1.1rem;
    font-weight: bold;
    margin-bottom: 5px;
}

.amount-label {
    font-size: 0.9rem;
    opacity: 0.8;
}

.bet-types-section {
    margin-bottom: 30px;
}

.bet-category {
    margin-bottom: 25px;
}

.category-title {
    color: #ff6b35;
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 15px;
    text-align: center;
}

.bet-options-row {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

.premium-bet-btn {
    background: linear-gradient(135deg, #2d2d2d, #1a1a1a);
    border: 2px solid #555;
    border-radius: 12px;
    padding: 15px 20px;
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    min-width: 120px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
}

.premium-bet-btn:hover {
    border-color: #ffd700;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
}

.premium-bet-btn.selected {
    border-color: #ffd700;
    background: linear-gradient(135deg, #ffd700, #ffed4a);
    color: #000;
    box-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
}

.bet-icon {
    font-size: 1.3rem;
}

.bet-text {
    font-size: 1rem;
    font-weight: bold;
}

.bet-payout {
    font-size: 0.9rem;
    color: #ff6b35;
    font-weight: bold;
}

.single-number-section {
    display: flex;
    gap: 15px;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
}

.number-input {
    background: #2d2d2d;
    border: 2px solid #555;
    border-radius: 8px;
    padding: 12px;
    color: #fff;
    font-size: 1rem;
    width: 150px;
    text-align: center;
}

.number-input:focus {
    border-color: #ffd700;
    outline: none;
    box-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
}

.current-bet-display {
    background: linear-gradient(135deg, #0a4a0a, #1a1a1a);
    border: 2px solid #00ff00;
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 20px;
    text-align: center;
}

.bet-display-header {
    color: #00ff00;
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 10px;
}

.bet-details {
    color: #fff;
}

.bet-details p {
    margin: 5px 0;
}

.spin-section {
    text-align: center;
    margin-top: 30px;
}

.mega-spin-btn {
    background: linear-gradient(135deg, #ff6b35, #ff0000);
    border: 3px solid #ffd700;
    border-radius: 20px;
    padding: 20px 40px;
    color: #fff;
    font-size: 1.2rem;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    min-width: 200px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    margin: 0 auto;
}

.mega-spin-btn:hover:not(:disabled) {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(255, 215, 0, 0.5);
}

.mega-spin-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.spin-icon {
    font-size: 1.5rem;
}

.spin-text {
    font-size: 1.2rem;
    font-weight: bold;
}

.spin-subtitle {
    font-size: 0.9rem;
    opacity: 0.8;
}

.recent-results-container {
    background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
    border: 2px solid #ffd700;
    border-radius: 15px;
    padding: 20px;
    margin-top: 20px;
}

.recent-results-container h5 {
    color: #ffd700;
    text-align: center;
    margin-bottom: 15px;
}

.recent-results {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    justify-content: center;
}

.result-item {
    background: #2d2d2d;
    border: 2px solid #555;
    border-radius: 10px;
    padding: 10px;
    text-align: center;
    min-width: 80px;
}

.result-number {
    font-size: 1.2rem;
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

.result-number.red {
    color: #ff0000;
}

.result-number.black {
    color: #000;
    background: #fff;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    line-height: 30px;
    margin: 0 auto 5px;
}

.result-number.green {
    color: #00ff00;
}

.result-info {
    font-size: 0.8rem;
    color: #ccc;
}

.stat-card {
    background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
    border: 2px solid #ffd700;
    border-radius: 15px;
    padding: 20px;
    text-align: center;
    color: #fff;
    margin-bottom: 20px;
}

.stat-card i {
    font-size: 2rem;
    color: #ffd700;
    margin-bottom: 10px;
}

.stat-card h5 {
    color: #ccc;
    margin-bottom: 10px;
}

.stat-card h3 {
    color: #fff;
    margin: 0;
}

.winning-number {
    background: linear-gradient(135deg, #ffd700, #ffed4a);
    border: 3px solid #ff0000;
    border-radius: 20px;
    padding: 20px;
    margin: 20px 0;
    text-align: center;
    color: #000;
}

.winning-number h3 {
    margin-bottom: 15px;
    font-size: 1.5rem;
}

.winning-number-display {
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 10px;
}

.winning-color {
    font-size: 1.2rem;
    font-weight: bold;
}

.roulette-modal {
    border: 3px solid #ffd700;
    border-radius: 20px;
    background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
    color: #fff;
}

.roulette-modal .modal-header {
    background: linear-gradient(135deg, #ffd700, #ffed4a);
    color: #000;
    border-bottom: 2px solid #ff0000;
}

.roulette-modal .modal-body {
    padding: 30px;
}

.result-message {
    font-size: 1.3rem;
    font-weight: bold;
    margin-bottom: 20px;
}

.win-message {
    font-size: 1.5rem;
    color: #00ff00;
    font-weight: bold;
    margin-bottom: 10px;
}

.bet-info {
    font-size: 1.1rem;
    color: #ccc;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .bet-amount-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .bet-options-row {
        flex-direction: column;
        align-items: center;
    }
    
    .premium-bet-btn {
        min-width: 150px;
    }
    
    .single-number-section {
        flex-direction: column;
    }
    
    .number-input {
        width: 100%;
        max-width: 200px;
    }
}

@media (max-width: 576px) {
    .bet-amount-grid {
        grid-template-columns: 1fr;
    }
    
    .premium-betting-panel {
        padding: 20px;
    }
    
    .panel-header h4 {
        font-size: 1.5rem;
    }
    
    .mega-spin-btn {
        padding: 15px 30px;
        font-size: 1.1rem;
    }
}

/* Existing wheel styles... */
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hide all ads on roulette page
    const adsElements = [
        '#leftAds',
        '#rightAds',
        '#slotDemo',
        '#jackpotTicker',
        '#sidebarPromo'
    ];
    
    adsElements.forEach(selector => {
        const element = document.querySelector(selector);
        if (element) {
            element.style.display = 'none';
        }
    });
    
    // Initialize variables
    let currentBet = null;
    let betAmount = 50000; // Default bet amount
    let isSpinning = false;
    
    // Roulette wheel number positions (European roulette order)
    const wheelNumbers = [0,32,15,19,4,21,2,25,17,34,6,27,13,36,11,30,8,23,10,5,24,16,33,1,20,14,31,9,22,18,29,7,28,12,35,3,26];
    
    // Color mapping for numbers
    const redNumbers = [1,3,5,7,9,12,14,16,18,19,21,23,25,27,30,32,34,36];
    
    function getNumberColor(number) {
        if (number === 0) return 'green';
        return redNumbers.includes(number) ? 'red' : 'black';
    }
    
    // Function to scroll to roulette wheel smoothly
    function scrollToRouletteWheel() {
        const rouletteWheel = document.getElementById('rouletteWheel');
        if (rouletteWheel) {
            rouletteWheel.scrollIntoView({ 
                behavior: 'smooth',
                block: 'center',
                inline: 'center'
            });
        }
    }
    
    // Function to calculate the correct rotation angle for winning number
    function calculateWheelRotation(winningNumber) {
        const numberIndex = wheelNumbers.indexOf(winningNumber);
        if (numberIndex === -1) {
            console.error('Number not found:', winningNumber);
            return 1800; // Default 5 rotations if number not found
        }
        
        console.log(`Winning number: ${winningNumber}, Index: ${numberIndex}`);
        
        // Each number segment is 360/37 = 9.729729... degrees
        const degreesPerSegment = 360 / 37;
        
        // Calculate the angle where this number is positioned on the wheel
        const numberAngle = numberIndex * degreesPerSegment;
        
        console.log(`Number angle: ${numberAngle} degrees`);
        
        // PERBAIKAN: Arrow berada di posisi top (0 degrees)
        // Kita perlu merotasi wheel sehingga winning number berada di posisi arrow
        let targetRotation = 360 - numberAngle;
        
        // Normalisasi ke 0-360 degrees
        while (targetRotation < 0) targetRotation += 360;
        targetRotation = targetRotation % 360;
        
        // Add multiple full rotations for spinning effect (minimum 5 rotations)
        const baseRotations = (5 + Math.random() * 3) * 360; // 5-8 rotations
        const finalRotation = baseRotations + targetRotation;
        
        console.log(`Target rotation: ${targetRotation}, Final rotation: ${finalRotation}`);
        
        return finalRotation;
    }
    
    // Enhanced showResult function with improved timing and slower animation
    window.rouletteShowResult = function(data) {
        const wheel = document.getElementById('rouletteWheel');
        
        if (wheel && data.winning_number !== undefined) {
            // Calculate the exact rotation needed for the arrow to point to winning number
            const finalRotation = calculateWheelRotation(data.winning_number);
            
            console.log(`Applying rotation: ${finalRotation}deg for winning number: ${data.winning_number}`);
            
            // Reset wheel to initial position
            wheel.style.transition = 'none';
            wheel.style.transform = 'rotate(0deg)';
            
            // Force reflow to ensure the reset takes effect
            wheel.offsetHeight;
            
            // Start the spin animation after a short delay
            setTimeout(() => {
                // Apply smooth spin animation with realistic deceleration
                wheel.style.transition = 'transform 4s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                wheel.style.transform = `rotate(${finalRotation}deg)`;
            }, 100);
            
            // After animation completes, add winning number highlight
            setTimeout(() => {
                highlightWinningNumber(data.winning_number);
                // Show winning number display with animation
                showWinningNumberDisplay(data);
            }, 4200); // Wait for animation to complete
            
            // Add to recent results after everything completes
            setTimeout(() => {
                addToRecentResults(data.winning_number, data.winning_color);
            }, 4500);
        }
    };
    
    // Function to show winning number display with smooth animation
    function showWinningNumberDisplay(data) {
        const winningNumber = document.getElementById('winningNumber');
        const numberDisplay = document.getElementById('numberDisplay');
        const colorDisplay = document.getElementById('colorDisplay');
        
        if (numberDisplay) numberDisplay.textContent = data.winning_number;
        if (colorDisplay) {
            let colorText = 'HIJAU';
            if (data.winning_color === 'red') colorText = 'MERAH';
            else if (data.winning_color === 'black') colorText = 'HITAM';
            colorDisplay.textContent = colorText;
        }
        
        if (winningNumber) {
            winningNumber.style.display = 'block';
            winningNumber.classList.add('animate__animated', 'animate__zoomIn');
            
            // Hide winning number after 8 seconds
            setTimeout(() => {
                winningNumber.style.display = 'none';
                winningNumber.classList.remove('animate__animated', 'animate__zoomIn');
            }, 8000);
        }
    }
    
    // Function to update game statistics - will be called after animation
    function updateGameStats(data) {
        if (document.getElementById('balance')) {
            // Add smooth number animation for balance update
            const balanceElement = document.getElementById('balance');
            balanceElement.style.transition = 'all 0.5s ease-in-out';
            balanceElement.style.transform = 'scale(1.1)';
            balanceElement.style.color = data.win ? '#00ff00' : '#ff0000';
            
            setTimeout(() => {
                balanceElement.textContent = 'Rp ' + data.new_balance.toLocaleString('id-ID');
                
                // Reset styling
                setTimeout(() => {
                    balanceElement.style.transform = 'scale(1)';
                    balanceElement.style.color = '';
                }, 500);
            }, 100);
        }
        
        if (document.getElementById('total-attempts')) {
            const attemptsElement = document.getElementById('total-attempts');
            attemptsElement.style.transition = 'all 0.3s ease-in-out';
            attemptsElement.style.transform = 'scale(1.1)';
            attemptsElement.style.color = '#ffd700';
            
            setTimeout(() => {
                attemptsElement.textContent = data.total_attempts;
                
                setTimeout(() => {
                    attemptsElement.style.transform = 'scale(1)';
                    attemptsElement.style.color = '';
                }, 300);
            }, 50);
        }
        
        if (document.getElementById('total-wins')) {
            const winsElement = document.getElementById('total-wins');
            winsElement.style.transition = 'all 0.3s ease-in-out';
            winsElement.style.transform = 'scale(1.1)';
            winsElement.style.color = '#00ff00';
            
            setTimeout(() => {
                winsElement.textContent = data.total_wins;
                
                setTimeout(() => {
                    winsElement.style.transform = 'scale(1)';
                    winsElement.style.color = '';
                }, 300);
            }, 100);
        }
    }
    
    // Function to highlight the winning number on the wheel
    function highlightWinningNumber(winningNumber) {
        // Remove any existing highlights
        document.querySelectorAll('.wheel-number').forEach(el => {
            el.classList.remove('winning-highlight');
        });
        
        // Find and highlight the winning number
        document.querySelectorAll('.wheel-number').forEach(element => {
            if (parseInt(element.getAttribute('data-number')) === winningNumber) {
                element.classList.add('winning-highlight');
                
                // Remove highlight after 6 seconds
                setTimeout(() => {
                    element.classList.remove('winning-highlight');
                }, 6000);
            }
        });
    }
    
    // Function to add results to recent results display
    function addToRecentResults(number, color) {
        const recentResults = document.getElementById('recentResults');
        if (!recentResults) return;
        
        const newResult = document.createElement('div');
        newResult.className = 'result-item animate__animated animate__fadeInRight';
        
        let colorText = 'HIJAU';
        if (color === 'red') colorText = 'MERAH';
        else if (color === 'black') colorText = 'HITAM';
        
        newResult.innerHTML = `
            <span class="result-number ${color}">${number}</span>
            <span class="result-info">${colorText}</span>
        `;
        
        recentResults.insertBefore(newResult, recentResults.firstChild);
        
        // Keep only last 8 results
        if (recentResults.children.length > 8) {
            recentResults.removeChild(recentResults.lastChild);
        }
    }
    
    // WAIT for DOM to be fully loaded before adding event listeners
    setTimeout(function() {
        console.log('Setting up bet amount cards...');
        
        // FIX 1: Add event listeners for bet amount selection
        document.querySelectorAll('.bet-amount-card').forEach((card, index) => {
            console.log(`Setting up bet amount card ${index}:`, card);
            
            card.addEventListener('click', function() {
                console.log('Bet amount card clicked:', this);
                
                // Remove active class from all cards
                document.querySelectorAll('.bet-amount-card').forEach(c => c.classList.remove('active'));
                
                // Add active class to clicked card
                this.classList.add('active');
                
                // Update bet amount
                betAmount = parseInt(this.getAttribute('data-amount'));
                
                console.log('Bet amount selected:', betAmount);
                
                // Update current bet amount if bet is already selected
                if (currentBet) {
                    currentBet.amount = betAmount;
                    updateBetDisplay();
                }
            });
        });
        
        // Add debugging to premium bet buttons
        document.querySelectorAll('.premium-bet-btn').forEach((btn, index) => {
            console.log(`Found premium bet button ${index}:`, btn);
            btn.addEventListener('click', function(e) {
                console.log('Premium bet button clicked:', this);
                e.preventDefault();
                e.stopPropagation();
                
                // Clear previous selections
                document.querySelectorAll('.premium-bet-btn').forEach(b => b.classList.remove('selected'));
                
                // Select current bet
                this.classList.add('selected');
                
                const type = this.getAttribute('data-type');
                const value = this.getAttribute('data-value');
                const payout = parseInt(this.getAttribute('data-payout'));
                
                console.log('Bet selected:', { type, value, payout });
                
                // Handle single number input
                if (type === 'number') {
                    const singleNumberInput = document.getElementById('singleNumber');
                    const numberValue = parseInt(singleNumberInput.value);
                    
                    if (isNaN(numberValue) || numberValue < 0 || numberValue > 36) {
                        alert('Masukkan nomor antara 0-36!');
                        this.classList.remove('selected');
                        return;
                    }
                    
                    currentBet = {
                        type: type,
                        value: numberValue.toString(),
                        payout: payout,
                        amount: betAmount
                    };
                } else {
                    currentBet = {
                        type: type,
                        value: value,
                        payout: payout,
                        amount: betAmount
                    };
                }
                
                console.log('Current bet set:', currentBet);
                updateBetDisplay();
                enableSpinButton();
            });
        });
        
        // Single number input handler
        const singleNumberInput = document.getElementById('singleNumber');
        if (singleNumberInput) {
            singleNumberInput.addEventListener('input', function() {
                const numberBet = document.getElementById('singleNumberBet');
                if (this.value && !isNaN(this.value)) {
                    numberBet.disabled = false;
                } else {
                    numberBet.disabled = true;
                }
            });
        }
        
        // Spin button handler with auto-scroll
        const spinBtn = document.getElementById('spinBtn');
        if (spinBtn) {
            console.log('Setting up spin button...');
            spinBtn.addEventListener('click', function() {
                
                if (!currentBet) {
                    alert('Pilih taruhan terlebih dahulu!');
                    return;
                }
                
                // Immediately scroll to roulette wheel
                scrollToRouletteWheel();
                
                // Set spinning state
                isSpinning = true;
                
                // Update bet amount from current selection
                currentBet.amount = betAmount;
                
                // Disable button and show loading
                this.disabled = true;
                this.innerHTML = '<div class="spin-icon"><i class="fas fa-spinner fa-spin"></i></div><div class="spin-text">SPINNING...</div><div class="spin-subtitle">Good Luck!</div>';
                
                // Make API call
                fetch('/gambling/roulette/play', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        bet_type: currentBet.type,
                        bet_value: currentBet.value,
                        bet_amount: currentBet.amount,
                        payout_ratio: currentBet.payout
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // PERBAIKAN: Langsung jalankan animasi tanpa delay
                        showResult(data);
                    } else {
                        alert(data.message);
                        resetSpinButton();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan!');
                    resetSpinButton();
                });
            });
        }
        
    }, 500); // Wait 500ms for DOM to settle
    
    function updateBetDisplay() {
        const currentBetDiv = document.getElementById('currentBet');
        const betDetails = document.getElementById('betDetails');
        
        if (currentBet && betDetails) {
            let description = '';
            switch (currentBet.type) {
                case 'number':
                    description = `Nomor: ${currentBet.value} (36:1)`;
                    break;
                case 'color':
                    description = `Warna: ${currentBet.value === 'red' ? 'MERAH' : 'HITAM'} (2:1)`;
                    break;
                case 'parity':
                    description = `${currentBet.value === 'even' ? 'GENAP' : 'GANJIL'} (2:1)`;
                    break;
                case 'range':
                    description = `${currentBet.value === 'low' ? '1-18' : '19-36'} (2:1)`;
                    break;
            }
            
            betDetails.innerHTML = `
                <p><strong>Taruhan:</strong> ${description}</p>
                <p><strong>Jumlah:</strong> Rp ${currentBet.amount.toLocaleString('id-ID')}</p>
                <p><strong>Potensi Menang:</strong> Rp ${(currentBet.amount * (currentBet.payout + 1)).toLocaleString('id-ID')}</p>
            `;
            
            currentBetDiv.style.display = 'block';
        }
    }
    
    function enableSpinButton() {
        const spinBtn = document.getElementById('spinBtn');
        if (spinBtn) {
            spinBtn.disabled = false;
        }
    }
    
    function resetSpinButton() {
        const spinBtn = document.getElementById('spinBtn');
        if (spinBtn) {
            spinBtn.disabled = false;
            spinBtn.innerHTML = '<div class="spin-icon"><i class="fas fa-dice-d20"></i></div><div class="spin-text">SPIN TO WIN!</div><div class="spin-subtitle">Let Fortune Decide</div>';
        }
        isSpinning = false;
    }
    
    function showResult(data) {
        if (typeof window.rouletteShowResult === 'function') {
            window.rouletteShowResult(data);
        }
        
        // Show result modal after wheel animation completes
        setTimeout(() => {
            showResultModal(data);
        }, 7000); 
        
        // Reset for next round
        setTimeout(() => {
            resetSpinButton();
        }, 8000); 
    }
    
    function showResultModal(data) {
        const modal = new bootstrap.Modal(document.getElementById('winModal'));
        const modalTitle = document.getElementById('modalTitle');
        const modalContent = document.getElementById('modalContent');
           
        if (data.win) {
            modalTitle.textContent = 'Selamat! Anda Menang!';
            modalTitle.style.color = '#00ff00';
            modalContent.innerHTML = `
                <p class="result-message">🎉 Nomor Pemenang: <strong>${data.winning_number}</strong> (${data.winning_color}) 🎉</p>
                <p class="win-message">🎊 Kemenangan: <strong>Rp ${data.payout.toLocaleString('id-ID')}</strong></p>
                <p class="bet-info">Taruhan: Rp ${data.bet_amount.toLocaleString('id-ID')}</p>
            `;
        } else {
            modalTitle.textContent = 'Sayang Sekali! Anda Kalah!';
            modalTitle.style.color = '#ff0000';
            modalContent.innerHTML = `
                <p class="result-message" style="color: #ff0000; font-size: 1.2rem; font-weight: bold;">
                    💀 Anda belum beruntung kali ini. Coba lagi! 💀
                </p>
                <p style="color: #ffd700; font-size: 1.1rem;">
                    🎯 Nomor Pemenang: <strong style="color: #ff6b35;">${data.winning_number}</strong> 
                    (<span style="color: ${data.winning_color === 'red' ? '#ff0000' : data.winning_color === 'black' ? '#000000' : '#00aa44'};">${data.winning_color}</span>)
                </p>
                <p style="color: #ff0000; font-size: 1.1rem; font-weight: bold;">
                    💰 Kehilangan: <strong>Rp ${data.bet_amount.toLocaleString('id-ID')}</strong>
                </p>
            `;
        }
        
        // Show the modal
        modal.show();
        
        // Update balance and stats AFTER modal is shown
        setTimeout(() => {
            updateGameStats(data);
        }, 500); // Update balance after modal appears
    }
});
</script>
@endsection