@extends('layouts.app')

@section('title', 'Roulette Indonesia - Putar Roda Keberuntungan')

@section('content')
<div class="container-fluid">
    <!-- Header Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="game-card text-center p-3 animate__animated animate__fadeInUp">
                <i class="fas fa-wallet text-primary" style="font-size: 2rem;"></i>
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
                <h5 class="mt-2">TINGKAT MENANG</h5>
                <h3 class="text-success">
                    {{ $user->total_attempts > 0 ? number_format(($user->total_wins / $user->total_attempts) * 100, 1) : 0 }}%
                </h3>
            </div>
        </div>
    </div>

    <!-- Main Roulette Interface -->
    <div class="row justify-content-center">
        <!-- Roulette Wheel -->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="roulette-container animate__animated animate__zoomIn">
                <div class="text-center mb-4">
                    <h3 class="text-warning mb-3">
                        <i class="fas fa-circle-notch"></i> RODA ROULETTE <i class="fas fa-circle-notch"></i>
                    </h3>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Pasang taruhan Anda!</strong> 
                        Pilih angka, warna, atau taruhan khusus. Pembayaran maksimal 35:1!
                    </div>
                </div>

                <!-- Enhanced Roulette Wheel Display -->
                <div class="wheel-container">
                    <!-- Fixed pointer outside spinning wheel -->
                    <div class="wheel-pointer">
                        <div class="pointer-arrow"></div>
                        <div class="pointer-base"></div>
                    </div>
                    
                    <div class="roulette-wheel" id="rouletteWheel">
                        <!-- Numbers on wheel -->
                        <div class="wheel-numbers">
                            @foreach([0,32,15,19,4,21,2,25,17,34,6,27,13,36,11,30,8,23,10,5,24,16,33,1,20,14,31,9,22,18,29,7,28,12,35,3,26] as $index => $number)
                                @php
                                    $angle = $index * (360/37);
                                    $color = 'green';
                                    if($number != 0) {
                                        $redNumbers = [1,3,5,7,9,12,14,16,18,19,21,23,25,27,30,32,34,36];
                                        $color = in_array($number, $redNumbers) ? 'red' : 'black';
                                    }
                                @endphp
                                <div class="wheel-number {{ $color }}" 
                                     style="transform: rotate({{ $angle }}deg) translateY(-140px) rotate(-{{ $angle }}deg);"
                                     data-number="{{ $number }}">
                                    {{ $number }}
                                </div>
                            @endforeach
                        </div>
                        <div class="wheel-center">
                            <i class="fas fa-circle-notch fa-2x text-warning"></i>
                        </div>
                    </div>
                    
                    <div class="winning-number" id="winningNumber" style="display: none;">
                        <div class="number-display" id="numberDisplay">0</div>
                        <div class="color-display" id="colorDisplay">HIJAU</div>
                    </div>
                </div>

                <!-- Spin Button -->
                <div class="text-center mt-4">
                    <button id="spin-btn" class="btn btn-casino btn-lg roulette-spin-btn animate__animated animate__pulse animate__infinite">
                        <i class="fas fa-play"></i> PUTAR RODA!
                    </button>
                </div>
            </div>
        </div>

        <!-- Betting Interface -->
        <div class="col-lg-6 col-md-12">
            <div class="betting-container">
                <h4 class="text-warning text-center mb-4">
                    <i class="fas fa-coins"></i> PASANG TARUHAN ANDA 
                </h4>

                <!-- Bet Amount Selection -->
                <div class="mb-4">
                    <label class="form-label text-warning fw-bold">
                        <i class="fas fa-money-bill-wave"></i> JUMLAH TARUHAN 
                    </label>
                    <div class="bet-amount-buttons">
                        <button class="bet-amount-btn" data-amount="15000">15K</button>
                        <button class="bet-amount-btn active" data-amount="25000">25K</button>
                        <button class="bet-amount-btn" data-amount="50000">50K</button>
                        <button class="bet-amount-btn" data-amount="100000">100K</button>
                        <button class="bet-amount-btn" data-amount="250000">250K</button> 
                        <button class="bet-amount-btn" data-amount="500000">500K</button>
                    </div>
                    <div class="mt-3">
                        <input type="number" 
                               id="customBetAmount" 
                               class="form-control custom-bet-input" 
                               placeholder="Jumlah Khusus (minimal Rp 15.000)" 
                               min="15000"
                               step="1000"/>
                        <div class="invalid-feedback" id="betError" style="display: none;">
                            Minimal taruhan Rp 15.000
                        </div>
                    </div>
                </div>

                <!-- Numbers Grid -->
                <div class="roulette-table">
                    <div class="table-header">
                        <div class="zero-section">
                            <button class="number-btn zero" data-bet="number" data-value="0" data-payout="35">0</button>
                        </div>
                    </div>
                    
                    <div class="numbers-grid">
                        @for($i = 1; $i <= 36; $i++)
                            @php
                                $color = 'red';
                                $redNumbers = [1,3,5,7,9,12,14,16,18,19,21,23,25,27,30,32,34,36];
                                if (!in_array($i, $redNumbers)) {
                                    $color = 'black';
                                }
                            @endphp
                            <button class="number-btn {{ $color }}" data-bet="number" data-value="{{ $i }}" data-payout="35">
                                {{ $i }}
                            </button>
                        @endfor
                    </div>

                    <!-- Outside Bets -->
                    <div class="outside-bets">
                        <div class="bet-row">
                            <button class="outside-bet-btn" data-bet="color" data-value="red" data-payout="1">
                                <span style="color: #ff0000;">MERAH</span>
                            </button>
                            <button class="outside-bet-btn" data-bet="color" data-value="black" data-payout="1">
                                <span style="color: #000;">HITAM</span>
                            </button>
                        </div>
                        <div class="bet-row">
                            <button class="outside-bet-btn" data-bet="parity" data-value="even" data-payout="1">GENAP</button>
                            <button class="outside-bet-btn" data-bet="parity" data-value="odd" data-payout="1">GANJIL</button>
                        </div>
                        <div class="bet-row">
                            <button class="outside-bet-btn" data-bet="range" data-value="low" data-payout="1">1-18</button>
                            <button class="outside-bet-btn" data-bet="range" data-value="high" data-payout="1">19-36</button>
                        </div>
                    </div>
                </div>

                <!-- Current Bet Display -->
                <div class="current-bet mt-4" id="currentBet" style="display: none;">
                    <div class="bet-info">
                        <h5 class="text-warning">Taruhan Saat Ini:</h5>
                        <p id="betDetails"></p>
                        <p class="text-success">Jumlah: Rp <span id="betAmount">0</span></p>
                        <p class="text-info">Potensi Menang: Rp <span id="potentialWin">0</span></p>
                    </div>
                    <button class="btn btn-danger btn-sm" id="clearBet">
                        <i class="fas fa-times"></i> Hapus Taruhan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Game Result -->
    <div class="row mt-4" id="gameResult" style="display: none;">
        <div class="col-12">
            <div class="game-card p-4 text-center">
                <h4 id="resultText" class="mb-3"></h4>
                <div id="resultDetails" class="mb-3"></div>
            </div>
        </div>
    </div>

    <!-- Recent Results -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="game-card p-4">
                <h5 class="text-warning text-center mb-3">
                    <i class="fas fa-history"></i> HASIL TERBARU
                </h5>
                <div class="recent-results" id="recentResults">
                    <!-- Results will be added here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
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

.wheel-container {
    position: relative;
    width: 100%;
    max-width: 350px;
    height: 350px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
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

@media (max-width: 576px) {
    .recent-results {
        gap: 5px;
    }
    
    .result-item {
        min-width: 50px;
        padding: 6px;
    }
    
    .result-number {
        width: 35px;
        height: 35px;
        font-size: 1.1rem;
    }
    
    .result-info {
        font-size: 0.7rem;
    }
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
    border-color: #ffed4a !important;
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

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .wheel-container {
        width: 280px;
        height: 280px;
    }
    
    .roulette-wheel {
        width: 260px;
        height: 260px;
    }
    
    .wheel-number {
        width: 20px;
        height: 20px;
        font-size: 10px;
        margin-left: -10px;
        margin-top: -10px;
    }
    
    .wheel-center {
        width: 60px;
        height: 60px;
    }
    
    .wheel-pointer {
        top: -20px;
    }
    
    .pointer-arrow {
        border-left-width: 15px;
        border-right-width: 15px;
        border-top-width: 30px;
    }
    
    .pointer-arrow::after {
        top: -25px;
        left: -12px;
        border-left-width: 12px;
        border-right-width: 12px;
        border-top-width: 25px;
    }
    
    .pointer-base {
        width: 20px;
        height: 12px;
    }
    
    .winning-number {
        top: 70%;
    }
}

@media (max-width: 576px) {
    .wheel-container {
        width: 240px;
        height: 240px;
    }
    
    .roulette-wheel {
        width: 220px;
        height: 220px;
    }
    
    .numbers-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .bet-amount-buttons {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .bet-row {
        grid-template-columns: 1fr;
    }
    
    .wheel-pointer {
        top: -15px;
    }
    
    .pointer-arrow {
        border-left-width: 12px;
        border-right-width: 12px;
        border-top-width: 25px;
    }
    
    .pointer-arrow::after {
        top: -20px;
        left: -10px;
        border-left-width: 10px;
        border-right-width: 10px;
        border-top-width: 20px;
    }
    
    .pointer-base {
        width: 16px;
        height: 10px;
    }
    
    .winning-number {
        top: 75%;
    }
}
</style>
@endsection

@section('scripts')
<script src="{{ asset('js/roulette.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentBet = null;
    let betAmount = 25000;
    
    // Bet amount selection
    document.querySelectorAll('.bet-amount-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.bet-amount-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            betAmount = parseInt(this.getAttribute('data-amount'));
            document.getElementById('customBetAmount').value = '';
            hideCustomBetError();
        });
    });
    
    // Custom bet amount
    document.getElementById('customBetAmount').addEventListener('input', function() {
        document.querySelectorAll('.bet-amount-btn').forEach(btn => btn.classList.remove('active'));
        const val = parseInt(this.value);
        
        if (!isNaN(val)) {
            if (val >= 15000) {
                betAmount = val;
                hideCustomBetError();
            } else {
                showCustomBetError();
            }
        }
    });
    
    function showCustomBetError() {
        const input = document.getElementById('customBetAmount');
        const error = document.getElementById('betError');
        input.classList.add('is-invalid');
        error.style.display = 'block';
    }
    
    function hideCustomBetError() {
        const input = document.getElementById('customBetAmount');
        const error = document.getElementById('betError');
        input.classList.remove('is-invalid');
        error.style.display = 'none';
    }
    
    // Number and outside bet selection
    document.querySelectorAll('.number-btn, .outside-bet-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Clear previous selections
            document.querySelectorAll('.number-btn, .outside-bet-btn').forEach(b => b.classList.remove('selected'));
            
            // Select current bet
            this.classList.add('selected');
            
            currentBet = {
                type: this.getAttribute('data-bet'),
                value: this.getAttribute('data-value'),
                payout: parseInt(this.getAttribute('data-payout')),
                amount: betAmount
            };
            
            updateBetDisplay();
        });
    });
    
    // Clear bet
    document.getElementById('clearBet').addEventListener('click', function() {
        currentBet = null;
        document.querySelectorAll('.number-btn, .outside-bet-btn').forEach(b => b.classList.remove('selected'));
        document.getElementById('currentBet').style.display = 'none';
    });
    
    function updateBetDisplay() {
        if (!currentBet) return;
        
        const betDetails = document.getElementById('betDetails');
        const betAmountDisplay = document.getElementById('betAmount');
        const potentialWin = document.getElementById('potentialWin');
        
        let betDescription = '';
        switch (currentBet.type) {
            case 'number':
                betDescription = `Angka ${currentBet.value}`;
                break;
            case 'color':
                betDescription = `Warna: ${currentBet.value === 'red' ? 'MERAH' : 'HITAM'}`;
                break;
            case 'parity':
                betDescription = `${currentBet.value === 'even' ? 'GENAP' : 'GANJIL'}`;
                break;
            case 'range':
                betDescription = currentBet.value === 'low' ? '1-18' : '19-36';
                break;
        }
        
        betDetails.textContent = betDescription;
        betAmountDisplay.textContent = currentBet.amount.toLocaleString('id-ID');
        potentialWin.textContent = (currentBet.amount * (currentBet.payout + 1)).toLocaleString('id-ID');
        
        document.getElementById('currentBet').style.display = 'block';
    }
});
</script>
@endsection