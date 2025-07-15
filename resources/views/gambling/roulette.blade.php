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
                        <!-- Roulette numbers positioned around the wheel - CORRECTED ANGLES -->
                        <div class="wheel-number" style="--angle: 0deg;">0</div>
                        <div class="wheel-number" style="--angle: 9.73deg;">32</div>
                        <div class="wheel-number" style="--angle: 19.46deg;">15</div>
                        <div class="wheel-number" style="--angle: 29.19deg;">19</div>
                        <div class="wheel-number" style="--angle: 38.92deg;">4</div>
                        <div class="wheel-number" style="--angle: 48.65deg;">21</div>
                        <div class="wheel-number" style="--angle: 58.38deg;">2</div>
                        <div class="wheel-number" style="--angle: 68.11deg;">25</div>
                        <div class="wheel-number" style="--angle: 77.84deg;">17</div>
                        <div class="wheel-number" style="--angle: 87.57deg;">34</div>
                        <div class="wheel-number" style="--angle: 97.3deg;">6</div>
                        <div class="wheel-number" style="--angle: 107.03deg;">27</div>
                        <div class="wheel-number" style="--angle: 116.76deg;">13</div>
                        <div class="wheel-number" style="--angle: 126.49deg;">36</div>
                        <div class="wheel-number" style="--angle: 136.22deg;">11</div>
                        <div class="wheel-number" style="--angle: 145.95deg;">30</div>
                        <div class="wheel-number" style="--angle: 155.68deg;">8</div>
                        <div class="wheel-number" style="--angle: 165.41deg;">23</div>
                        <div class="wheel-number" style="--angle: 175.14deg;">10</div>
                        <div class="wheel-number" style="--angle: 184.87deg;">5</div>
                        <div class="wheel-number" style="--angle: 194.6deg;">24</div>
                        <div class="wheel-number" style="--angle: 204.33deg;">16</div>
                        <div class="wheel-number" style="--angle: 214.06deg;">33</div>
                        <div class="wheel-number" style="--angle: 223.79deg;">1</div>
                        <div class="wheel-number" style="--angle: 233.52deg;">20</div>
                        <div class="wheel-number" style="--angle: 243.25deg;">14</div>
                        <div class="wheel-number" style="--angle: 252.98deg;">31</div>
                        <div class="wheel-number" style="--angle: 262.71deg;">9</div>
                        <div class="wheel-number" style="--angle: 272.44deg;">22</div>
                        <div class="wheel-number" style="--angle: 282.17deg;">18</div>
                        <div class="wheel-number" style="--angle: 291.9deg;">29</div>
                        <div class="wheel-number" style="--angle: 301.63deg;">7</div>
                        <div class="wheel-number" style="--angle: 311.36deg;">28</div>
                        <div class="wheel-number" style="--angle: 321.09deg;">12</div>
                        <div class="wheel-number" style="--angle: 330.82deg;">35</div>
                        <div class="wheel-number" style="--angle: 340.55deg;">3</div>
                        <div class="wheel-number" style="--angle: 350.28deg;">26</div>
                        
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
    /* Dynamic sizing based on screen - smaller for better centering */
    width: min(80vw, 400px);
    height: min(80vw, 400px);
    max-width: 400px;
    max-height: 400px;
    margin: 0 auto;
}

/* Centered bet display */
.current-bet-display {
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

/* Bet amount section with better spacing */
.bet-amount-section {
    padding: 25px 20px;
    border-bottom: 1px solid rgba(255, 215, 0, 0.2);
    max-width: 800px;
    margin: 0 auto;
}

.stat-card {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid #ffd700;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 15px;
    transition: transform 0.3s;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.stat-card i {
    font-size: 2rem;
    margin-bottom: 10px;
    color: #ffd700;
}

/* Enhanced Premium Betting Panel */
.premium-betting-panel {
    background: linear-gradient(135deg, rgba(26, 26, 26, 0.95), rgba(45, 45, 45, 0.95));
    border: 3px solid #ffd700;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 
        0 20px 60px rgba(255, 215, 0, 0.3),
        inset 0 0 30px rgba(255, 215, 0, 0.1);
    backdrop-filter: blur(10px);
    margin-top: 20px;
}

.panel-header {
    background: linear-gradient(135deg, #ff6b35, #ff0000);
    padding: 20px;
    text-align: center;
    color: #fff;
    border-bottom: 2px solid #ffd700;
}

.panel-header h4 {
    margin: 0 0 5px 0;
    font-weight: 900;
    font-size: 1.4rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.panel-subtitle {
    font-size: 0.9rem;
    opacity: 0.9;
    margin: 0;
}

/* Bet Amount Section */
.bet-amount-section {
    padding: 25px 20px;
    border-bottom: 1px solid rgba(255, 215, 0, 0.2);
    max-width: 800px;
    margin: 0 auto;
}

.section-title {
    color: #ffd700;
    font-size: 1.1rem;
    font-weight: bold;
    text-align: center;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.bet-amount-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
}

.bet-amount-card {
    background: linear-gradient(145deg, #2d2d2d, #1a1a1a);
    border: 2px solid rgba(255, 215, 0, 0.3);
    border-radius: 12px;
    padding: 15px 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    color: #fff;
}

.bet-amount-card:hover {
    border-color: #ffd700;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
}

.bet-amount-card.active {
    background: linear-gradient(145deg, #ffd700, #ffed4a);
    color: #000;
    border-color: #ffd700;
    box-shadow: 0 0 20px rgba(255, 215, 0, 0.6);
}

.amount-icon {
    font-size: 1.5rem;
    margin-bottom: 5px;
}

.amount-text {
    font-size: 1rem;
    font-weight: bold;
    margin-bottom: 3px;
}

.amount-label {
    font-size: 0.7rem;
    opacity: 0.8;
}

/* Bet Types Section */
.bet-types-section {
    padding: 25px 20px;
}

.bet-category {
    margin-bottom: 25px;
}

.category-title {
    color: #ffd700;
    font-size: 0.9rem;
    font-weight: bold;
    margin-bottom: 12px;
    text-align: center;
    background: rgba(255, 215, 0, 0.1);
    padding: 8px 12px;
    border-radius: 20px;
    border: 1px solid rgba(255, 215, 0, 0.3);
}

.bet-options-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.premium-bet-btn {
    background: linear-gradient(145deg, #2d2d2d, #1a1a1a);
    border: 2px solid rgba(255, 215, 0, 0.3);
    border-radius: 12px;
    padding: 15px 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    color: #fff;
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
    background: linear-gradient(145deg, #ffd700, #ffed4a);
    color: #000;
    border-color: #ffd700;
    box-shadow: 0 0 20px rgba(255, 215, 0, 0.8);
    transform: scale(1.05);
}

.bet-icon {
    font-size: 1.2rem;
}

.bet-text {
    font-size: 0.85rem;
    font-weight: bold;
}

.bet-payout {
    font-size: 0.7rem;
    color: #00ff00;
    font-weight: bold;
}

/* Color-specific styling */
.color-red {
    border-color: #ff0000 !important;
}

.color-red:hover {
    border-color: #ff6666 !important;
    box-shadow: 0 5px 15px rgba(255, 0, 0, 0.3) !important;
}

.color-black {
    border-color: #666 !important;
}

.color-black:hover {
    border-color: #999 !important;
    box-shadow: 0 5px 15px rgba(102, 102, 102, 0.3) !important;
}

/* Single Number Section */
.single-number-section {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.number-input {
    background: linear-gradient(145deg, #1a1a1a, #2d2d2d);
    border: 2px solid #ffd700;
    border-radius: 10px;
    padding: 12px 15px;
    color: #ffd700;
    font-size: 1rem;
    font-weight: bold;
    text-align: center;
    transition: all 0.3s ease;
}

.number-input:focus {
    outline: none;
    border-color: #ffed4a;
    box-shadow: 0 0 15px rgba(255, 215, 0, 0.5);
}

.number-input::placeholder {
    color: rgba(255, 215, 0, 0.5);
}

.single-number-btn {
    background: linear-gradient(135deg, #ff6b35, #ff0000) !important;
    border: 2px solid #ffd700 !important;
}

.single-number-btn:hover {
    box-shadow: 0 5px 15px rgba(255, 107, 53, 0.5) !important;
}

/* Current Bet Display */
.current-bet-display {
    background: linear-gradient(135deg, rgba(0, 255, 0, 0.15), rgba(0, 150, 0, 0.1));
    border: 2px solid #00ff00;
    border-radius: 15px;
    padding: 20px;
    margin: 20px;
    box-shadow: 0 0 25px rgba(0, 255, 0, 0.4);
    animation: betDisplayGlow 2s ease-in-out infinite alternate;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

@keyframes betDisplayGlow {
    0% { box-shadow: 0 0 25px rgba(0, 255, 0, 0.4); }
    100% { box-shadow: 0 0 35px rgba(0, 255, 0, 0.8); }
}

.bet-display-header {
    color: #00ff00;
    font-size: 1rem;
    font-weight: bold;
    text-align: center;
    margin-bottom: 15px;
    text-transform: uppercase;
}

.bet-details p {
    margin: 8px 0;
    color: #fff;
    font-size: 0.9rem;
    text-align: center;
    background: rgba(0, 0, 0, 0.3);
    padding: 8px 12px;
    border-radius: 8px;
    border-left: 3px solid #00ff00;
}

/* Mega Spin Button */
.spin-section {
    padding: 25px 20px;
    text-align: center;
}

.mega-spin-btn {
    background: linear-gradient(135deg, #ffd700, #ffed4a, #ff6b35);
    border: 3px solid #ff0000;
    border-radius: 20px;
    padding: 20px 30px;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #000;
    font-weight: bold;
    width: 100%;
    position: relative;
    overflow: hidden;
    box-shadow: 
        0 10px 30px rgba(255, 215, 0, 0.5),
        inset 0 0 20px rgba(255, 255, 255, 0.2);
}

.mega-spin-btn:hover:not(:disabled) {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 
        0 15px 40px rgba(255, 215, 0, 0.7),
        inset 0 0 30px rgba(255, 255, 255, 0.3);
}

.mega-spin-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

.spin-icon {
    font-size: 2rem;
    margin-bottom: 8px;
    animation: spinIcon 2s linear infinite;
}

@keyframes spinIcon {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.spin-text {
    font-size: 1.2rem;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 5px;
}

.spin-subtitle {
    font-size: 0.8rem;
    opacity: 0.8;
}

/* Roulette Wheel Styles - FIXED POSITIONING */
.wheel-container {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    /* Dynamic sizing based on screen */
    width: min(90vw, 400px);
    height: min(90vw, 400px);
    max-width: 400px;
    max-height: 400px;
}

.roulette-wheel {
    width: 100%;
    height: 100%;
    border: 5px solid #ffd700;
    border-radius: 50%;
    position: relative;
    background: conic-gradient(
        #00aa44 0deg, #00aa44 9.73deg,
        #ff0000 9.73deg, #ff0000 19.46deg,
        #000000 19.46deg, #000000 29.19deg,
        #ff0000 29.19deg, #ff0000 38.92deg,
        #000000 38.92deg, #000000 48.65deg,
        #ff0000 48.65deg, #ff0000 58.38deg,
        #000000 58.38deg, #000000 68.11deg,
        #ff0000 68.11deg, #ff0000 77.84deg,
        #000000 77.84deg, #000000 87.57deg,
        #ff0000 87.57deg, #ff0000 97.3deg,
        #000000 97.3deg, #000000 107.03deg,
        #ff0000 107.03deg, #ff0000 116.76deg,
        #000000 116.76deg, #000000 126.49deg,
        #ff0000 126.49deg, #ff0000 136.22deg,
        #000000 136.22deg, #000000 145.95deg,
        #ff0000 145.95deg, #ff0000 155.68deg,
        #000000 155.68deg, #000000 165.41deg,
        #ff0000 165.41deg, #ff0000 175.14deg,
        #000000 175.14deg, #000000 184.87deg,
        #ff0000 184.87deg, #ff0000 194.6deg,
        #000000 194.6deg, #000000 204.33deg,
        #ff0000 204.33deg, #ff0000 214.06deg,
        #000000 214.06deg, #000000 223.79deg,
        #ff0000 223.79deg, #ff0000 233.52deg,
        #000000 233.52deg, #000000 243.25deg,
        #ff0000 243.25deg, #ff0000 252.98deg,
        #000000 252.98deg, #000000 262.71deg,
        #ff0000 262.71deg, #ff0000 272.44deg,
        #000000 272.44deg, #000000 282.17deg,
        #ff0000 282.17deg, #ff0000 291.9deg,
        #000000 291.9deg, #000000 301.63deg,
        #ff0000 301.63deg, #ff0000 311.36deg,
        #000000 311.36deg, #000000 321.09deg,
        #ff0000 321.09deg, #ff0000 330.82deg,
        #000000 330.82deg, #000000 340.55deg,
        #ff0000 340.55deg, #ff0000 350.28deg,
        #00aa44 350.28deg, #00aa44 360deg
    );
    box-shadow: 
        inset 0 0 30px rgba(0, 0, 0, 0.5),
        0 0 50px rgba(255, 215, 0, 0.6);
    transition: transform 4s cubic-bezier(0.25, 0.1, 0.25, 1);
}

.roulette-wheel.spinning {
    animation: wheelSpin 4s cubic-bezier(0.25, 0.1, 0.25, 1) forwards;
}

@keyframes wheelSpin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(1800deg); }
}

.wheel-number {
    position: absolute;
    /* FIXED: More precise positioning for perfect arrow alignment */
    top: 5%;
    left: 50%;
    width: min(3.5vw, 25px);
    height: min(3.5vw, 25px);
    margin-left: calc(min(3.5vw, 25px) / -2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: min(1.8vw, 12px);
    color: #fff;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
    /* CRITICAL FIX: Exact transform-origin for perfect alignment */
    transform-origin: 50% calc(min(45vw, 200px));
    transform: rotate(var(--angle));
    z-index: 10;
    border: 2px solid #ffd700;
}

.wheel-center {
    position: absolute;
    top: 50%;
    left: 50%;
    width: min(8vw, 60px);
    height: min(8vw, 60px);
    background: radial-gradient(circle, #ffd700, #ffed4a);
    border: 4px solid #ff0000;
    border-radius: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: min(2.5vw, 1.5rem);
    color: #000;
    box-shadow: 0 0 20px rgba(255, 215, 0, 0.8);
    z-index: 20;
}

.wheel-pointer {
    position: absolute;
    top: -5%;
    left: 50%;
    transform: translateX(-50%);
    z-index: 30;
}

.pointer-arrow {
    width: 0;
    height: 0;
    border-left: min(3vw, 20px) solid transparent;
    border-right: min(3vw, 20px) solid transparent;
    border-top: min(6vw, 40px) solid #ffd700;
    position: relative;
    filter: drop-shadow(0 0 10px rgba(255, 215, 0, 0.8));
}

.pointer-arrow::after {
    content: '';
    position: absolute;
    top: calc(min(6vw, 40px) * -0.8);
    left: calc(min(3vw, 20px) * -0.6);
    width: 0;
    height: 0;
    border-left: calc(min(3vw, 20px) * 0.6) solid transparent;
    border-right: calc(min(3vw, 20px) * 0.6) solid transparent;
    border-top: calc(min(6vw, 40px) * 0.6) solid #ff0000;
}

.pointer-base {
    width: min(4vw, 25px);
    height: min(2.5vw, 15px);
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    border-radius: 0 0 12px 12px;
    margin: 0 auto;
    border: 2px solid #ff0000;
    position: relative;
    top: -2px;
}

/* Mobile responsive adjustments for precise arrow positioning */
@media (max-width: 768px) {
    .wheel-number {
        transform-origin: 50% calc(min(40vw, 140px));
        top: 7%;
        width: min(4vw, 22px);
        height: min(4vw, 22px);
        margin-left: calc(min(4vw, 22px) / -2);
    }
    
    .wheel-pointer {
        top: -7%;
    }
    
    .wheel-center {
        width: min(10vw, 50px);
        height: min(10vw, 50px);
    }
}

@media (max-width: 576px) {
    .wheel-number {
        transform-origin: 50% calc(min(38vw, 110px));
        top: 8%;
        width: min(5vw, 20px);
        height: min(5vw, 20px);
        margin-left: calc(min(5vw, 20px) / -2);
        font-size: min(2.2vw, 11px);
    }
    
    .wheel-pointer {
        top: -8%;
    }
    
    .wheel-center {
        width: min(12vw, 45px);
        height: min(12vw, 45px);
    }
}

/* Recent Results */
.recent-results-container {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.1), rgba(255, 107, 53, 0.1));
    border: 2px solid #ffd700;
    border-radius: 15px;
    padding: 20px;
    backdrop-filter: blur(10px);
}

.recent-results-container h5 {
    color: #ffd700;
    margin-bottom: 15px;
    font-weight: bold;
}

.recent-results {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    color: #fff;
    margin-bottom: 10px;
}

.winning-color {
    font-size: 1.1rem;
    font-weight: bold;
    color: #ffd700;
}

/* Recent Results */
.recent-results-container {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.1), rgba(255, 107, 53, 0.1));
    border: 2px solid #ffd700;
    border-radius: 15px;
    padding: 20px;
    backdrop-filter: blur(10px);
}

.recent-results-container h5 {
    color: #ffd700;
    margin-bottom: 15px;
    font-weight: bold;
}

.recent-results {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    padding: 10px 0;
}

.result-item {
    text-align: center;
    padding: 8px;
    background: rgba(255, 215, 0, 0.1);
    border-radius: 8px;
    min-width: 60px;
    flex-shrink: 0;
}

.result-number {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.3rem;
    margin: 0 auto 8px;
    border: 2px solid #ffd700;
}

.result-number.red {
    background: #cc0000;
    color: #fff;
}

.result-number.black {
    background: #000000;
    color: #fff;
}

.result-number.green {
    background: #00aa44;
    color: #fff;
}

.result-info {
    font-size: 0.8rem;
    color: #ccc;
}

/* Enhanced Mobile-First Design */
.container-fluid {
    overflow-x: hidden;
    max-width: 100%;
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

.roulette-container {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.1), rgba(255, 107, 53, 0.1));
    border-radius: 20px;
    padding: 20px;
    border: 2px solid #ffd700;
    backdrop-filter: blur(10px);
    overflow: hidden;
    max-width: 100%;
}

/* Better mobile handling for roulette */
@media (max-width: 768px) {
    .container-fluid {
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
    
    .wheel-container {
        width: 280px;
        height: 280px;
    }
    
    .roulette-wheel {
        width: 260px;
        height: 260px;
    }
    
    /* Fix betting interface on mobile */
    .betting-container {
        margin-top: 20px;
    }
    
    .bet-amount-buttons {
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
    }
    
    .roulette-table {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
}

@media (max-width: 576px) {
    .container-fluid {
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
    
    .wheel-container {
        width: 240px;
        height: 240px;
    }
    
    .roulette-wheel {
        width: 220px;
        height: 220px;
    }
    
    /* Stack betting interface */
    .numbers-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 4px;
    }
    
    .bet-amount-buttons {
        grid-template-columns: repeat(2, 1fr);
        gap: 5px;
    }
    
    .bet-row {
        grid-template-columns: 1fr;
        gap: 8px;
    }
    
    /* Fix table overflow on very small screens */
    .roulette-table {
        font-size: 0.8rem;
    }
    
    .number-btn {
        padding: 8px;
        font-size: 0.9rem;
        min-height: 35px;
    }
    
    .outside-bet-btn {
        padding: 8px 10px;
        font-size: 0.8rem;
    }
}

/* Fix current bet display */
.current-bet {
    background: rgba(0, 50, 0, 0.3);
    border: 2px solid #00ff00;
    border-radius: 10px;
    padding: 15px;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.current-bet p {
    word-break: break-word;
}

/* Fix recent results overflow */
.recent-results {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    justify-content: center;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    padding: 10px 0;
}

.result-item {
    text-align: center;
    padding: 8px;
    background: rgba(255, 215, 0, 0.1);
    border-radius: 8px;
    min-width: 60px;
    flex-shrink: 0;
}

.result-number {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.3rem;
    margin: 0 auto 8px;
    border: 2px solid #ffd700;
}

.result-number.red {
    background: #cc0000;
    color: #fff;
}

.result-number.black {
    background: #000000;
    color: #fff;
}

.result-number.green {
    background: #00aa44;
    color: #fff;
}

.result-info {
    font-size: 0.8rem;
    color: #ccc;
}

/* Enhanced winning number display - positioned below pointer */
.winning-number {
    position: absolute;
    top: 65%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    z-index: 25;
    background: rgba(0,0,0,0.9);
    padding: 25px;
    border-radius: 20px;
    border: 4px solid #ffd700;
    box-shadow: 0 0 40px rgba(255, 215, 0, 0.8);
}

/* Betting Interface */
.betting-container {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.1), rgba(255, 107, 53, 0.1));
    border: 2px solid #ffd700;
    border-radius: 15px;
    padding: 25px;
    backdrop-filter: blur(10px);
}

.bet-amount-buttons {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    margin-bottom: 15px;
}

.bet-amount-btn {
    background: linear-gradient(145deg, #2d2d2d, #1a1a1a);
    border: 2px solid #ffd700;
    color: #ffd700;
    padding: 12px 15px;
    border-radius: 10px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.bet-amount-btn:hover, .bet-amount-btn.active {
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    color: #000;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 215, 0, 0.5);
}

.custom-bet-input {
    background: rgba(0,0,0,0.7) !important;
    border: 2px solid #ffd700 !important;
    color: #fff !important;
    padding: 12px 15px !important;
    border-radius: 10px !important;
    font-size: 1rem !important;
}

.custom-bet-input:focus {
    box-shadow: 0 0 20px rgba(255, 215, 0, 0.6) !important;
    border-color: #ffed
}

.custom-bet-input::placeholder {
    color: #aaa !important;
}

.roulette-table {
    background: #0a5d2c;
    border: 3px solid #ffd700;
    border-radius: 15px;
    padding: 20px;
    margin: 20px 0;
}

.table-header {
    text-align: center;
    margin-bottom: 15px;
}

.zero-section .number-btn {
    background: #00aa44;
    color: #fff;
    font-size: 1.5rem;
    padding: 15px 20px;
    width: 100%;
    max-width: 80px;
}

.numbers-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
    margin-bottom: 15px;
}

.number-btn {
    padding: 12px;
    border: 2px solid #ffd700;
    border-radius: 8px;
    font-weight: bold;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    min-height: 45px;
}

.number-btn.red {
    background: #cc0000;
    color: #fff;
}

.number-btn.black {
    background: #000000;
    color: #fff;
}

.number-btn.green {
    background: #00aa44;
    color: #fff;
}

.number-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 0 20px rgba(255, 215, 0, 0.8);
}

.number-btn.selected {
    box-shadow: 0 0 25px rgba(255, 215, 0, 1);
    border-color: #ffed4a;
    transform: scale(1.1);
}

.outside-bets {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.bet-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.outside-bet-btn {
    background: linear-gradient(145deg, #2d2d2d, #1a1a1a);
    border: 2px solid #ffd700;
    color: #ffd700;
    padding: 12px 15px;
    border-radius: 10px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.outside-bet-btn:hover, .outside-bet-btn.selected {
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    color: #000;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 215, 0, 0.5);
}

.current-bet {
    background: rgba(0, 50, 0, 0.3);
    border: 2px solid #00ff00;
    border-radius: 10px;
    padding: 15px;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.bet-info h5 {
    margin-bottom: 10px;
}

.bet-info p {
    margin-bottom: 5px;
    font-size: 0.95rem;
}

.recent-results {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    padding: 10px 0;
}

.result-item {
    text-align: center;
    padding: 8px;
    background: rgba(255, 215, 0, 0.1);
    border-radius: 8px;
    min-width: 60px;
    flex-shrink: 0;
}

.result-number {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.3rem;
    margin: 0 auto 8px;
    border: 2px solid #ffd700;
}

.result-number.red {
    background: #cc0000;
    color: #fff;
}

.result-number.black {
    background: #000000;
    color: #fff;
}

.result-number.green {
    background: #00aa44;
    color: #fff;
}

.result-info {
    font-size: 0.8rem;
    color: #ccc;
}

/* Enhanced Mobile Responsiveness for Centered Layout */
@media (max-width: 768px) {
    .wheel-container {
        width: min(90vw, 300px);
        height: min(90vw, 300px);
    }
    
    .roulette-wheel {
        width: 100%;
        height: 100%;
    }
}

@media (max-width: 576px) {
    .wheel-container {
        width: min(95vw, 280px);
        height: min(95vw, 280px);
    }
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hide all ads on roulette page
    const adsElements = [
        '#leftAds',
        '#rightAds',
        '#topAds',
        '#bottomAds'
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
    
    // FIX 1: Add event listeners for bet amount selection
    document.querySelectorAll('.bet-amount-card').forEach(card => {
        card.addEventListener('click', function() {
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
    
    // Existing bet selection code
    document.querySelectorAll('.premium-bet-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Clear previous selections
            document.querySelectorAll('.premium-bet-btn').forEach(b => b.classList.remove('selected'));
            
            // Select current bet
            this.classList.add('selected');
            
            const type = this.getAttribute('data-type');
            const value = this.getAttribute('data-value');
            const payout = parseInt(this.getAttribute('data-payout'));
            
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
    
    // Spin button handler
    const spinBtn = document.getElementById('spinBtn');
    if (spinBtn) {
        spinBtn.addEventListener('click', function() {
            if (!currentBet) {
                alert('Pilih taruhan terlebih dahulu!');
                return;
            }
            
            // Update bet amount from current selection
            currentBet.amount = betAmount;
            
            // Disable button and show loading
            this.disabled = true;
            this.innerHTML = '<div class="spin-icon"><i class="fas fa-spinner fa-spin"></i></div><div class="spin-text">SPINNING...</div><div class="spin-subtitle">Good Luck!</div>';
            
            // Start wheel animation
            const wheel = document.getElementById('rouletteWheel');
            if (wheel) {
                wheel.classList.add('spinning');
            }
            
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
                    setTimeout(() => {
                        showResult(data);
                    }, 4000);
                } else {
                    alert(data.message);
                    resetSpinButton();
                    if (wheel) wheel.classList.remove('spinning');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan!');
                resetSpinButton();
                if (wheel) wheel.classList.remove('spinning');
            });
        });
    }
    
    function resetSpinButton() {
        const spinBtn = document.getElementById('spinBtn');
        if (spinBtn) {
            spinBtn.disabled = false;
            spinBtn.innerHTML = '<div class="spin-icon"><i class="fas fa-dice-d20"></i></div><div class="spin-text">SPIN TO WIN!</div><div class="spin-subtitle">Let Fortune Decide</div>';
        }
    }
    
    function showResult(data) {
        // Stop wheel animation with precise rotation to winning number
        const wheel = document.getElementById('rouletteWheel');
        if (wheel) {
            wheel.classList.remove('spinning');
            
            // Calculate exact angle for winning number
            const numberAngles = {
                0: 0, 32: 9.73, 15: 19.46, 19: 29.19, 4: 38.92, 21: 48.65, 2: 58.38, 25: 68.11,
                17: 77.84, 34: 87.57, 6: 97.3, 27: 107.03, 13: 116.76, 36: 126.49, 11: 136.22,
                30: 145.95, 8: 155.68, 23: 165.41, 10: 175.14, 5: 184.87, 24: 194.6, 16: 204.33,
                33: 214.06, 1: 223.79, 20: 233.52, 14: 243.25, 31: 252.98, 9: 262.71, 22: 272.44,
                18: 282.17, 29: 291.9, 7: 301.63, 28: 311.36, 12: 321.09, 35: 330.82, 3: 340.55, 26: 350.28
            };
            
            const winningAngle = numberAngles[data.winning_number];
            // Rotate wheel so winning number aligns with pointer (subtract angle to bring number to top)
            const finalRotation = 1800 - winningAngle; // 1800 is base spin + adjustment
            wheel.style.transform = `rotate(${finalRotation}deg)`;
        }
        
        // Update stats
        document.getElementById('balance').textContent = 'Rp ' + data.new_balance.toLocaleString('id-ID');
        document.getElementById('total-attempts').textContent = data.total_attempts;
        document.getElementById('total-wins').textContent = data.total_wins;
        
        // Show winning number
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
        if (winningNumber) winningNumber.style.display = 'block';
        
        // Show result modal
        showResultModal(data);
        
        // Add to recent results
        addToRecentResults(data.winning_number, data.winning_color);
        
        // Reset for next round
        resetSpinButton();
        
        // Hide winning number after 8 seconds
        setTimeout(() => {
            if (winningNumber) winningNumber.style.display = 'none';
        }, 8000);
    }
    
    function showResultModal(data) {
        const modal = new bootstrap.Modal(document.getElementById('winModal'));
        const modalTitle = document.getElementById('modalTitle');
        const modalContent = document.getElementById('modalContent');
           
        if (data.win) {
            modalTitle.innerHTML = '<i class="fas fa-trophy"></i> SELAMAT! ANDA MENANG!';
            modalTitle.className = 'modal-title text-success';
            modalContent.innerHTML = `
                <div class="text-center">
                    <h2 class="text-success">Nomor ${data.winning_number}</h2>
                    <h3 class="text-warning">Warna: ${data.winning_color}</h3>
                    <h4 class="text-success">Kemenangan: Rp ${data.payout.toLocaleString('id-ID')}</h4>
                    <p>Multiplier: ${data.payout_ratio + 1}x</p>
                </div>
            `;
        } else {
            modalTitle.innerHTML = '<i class="fas fa-times-circle"></i> ANDA KALAH!';
            modalTitle.className = 'modal-title text-danger';
            modalContent.innerHTML = `
                <div class="text-center">
                    <h2 class="text-warning">Nomor ${data.winning_number}</h2>
                    <h3 class="text-warning">Warna: ${data.winning_color}</h3>
                    <h4 class="text-danger">Kehilangan: Rp ${data.bet_amount.toLocaleString('id-ID')}</h4>
                    <p>Coba lagi di putaran berikutnya!</p>
                </div>
            `;
        }
        
        modal.show();
    }
    
    function addToRecentResults(number, color) {
        const recentResults = document.getElementById('recentResults');
        if (!recentResults) return;
        
        const newResult = document.createElement('div');
        newResult.className = 'result-item';
        
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
});
</script>
@endsection