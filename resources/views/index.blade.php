@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4>🎰 Simulasi Judi Online - "House Always Wins"</h4>
                </div>
                <div class="card-body">
                    <!-- Educational Warning -->
                    <div class="alert alert-warning">
                        <h5>⚠️ Peringatan Edukasi</h5>
                        <p>Ini adalah simulasi untuk menunjukkan bagaimana sistem judi online dirancang agar "bandar selalu menang". Jangan pernah berjudi dengan uang asli!</p>
                    </div>

                    <!-- User Stats -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h5>Saldo</h5>
                                    <h3 id="balance">Rp {{ number_format($user->balance, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h5>Total Main</h5>
                                    <h3 id="total-attempts">{{ $user->total_attempts }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <h5>Menang</h5>
                                    <h3 id="total-wins">{{ $user->total_wins }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-danger text-white">
                                <div class="card-body text-center">
                                    <h5>Kalah</h5>
                                    <h3 id="total-losses">{{ $user->total_losses }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gambling Interface -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5>🎲 Permainan Tebak Angka</h5>
                                    <div class="form-group">
                                        <label>Jumlah Taruhan (Rp)</label>
                                        <input type="number" id="bet-amount" class="form-control" min="1000" max="50000" value="1000">
                                        <small class="text-muted">Minimal Rp 1.000, Maksimal Rp 50.000</small>
                                    </div>
                                    <button id="play-btn" class="btn btn-primary btn-lg btn-block">MAIN SEKARANG</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Game Result -->
                    <div id="game-result" class="mt-4" style="display: none;">
                        <div class="card">
                            <div class="card-body text-center">
                                <h4 id="result-text"></h4>
                                <p id="result-details"></p>
                                <p><small>Peluang Menang: <span id="win-probability"></span>%</small></p>
                            </div>
                        </div>
                    </div>

                    <!-- Educational Info -->
                    <div class="mt-4">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h5>📚 Fakta Tentang Judi Online</h5>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li><strong>User Baru:</strong> Diberikan winrate tinggi di awal untuk menarik minat</li>
                                    <li><strong>Taruhan Kecil:</strong> Peluang menang lebih tinggi untuk membangun kepercayaan</li>
                                    <li><strong>Taruhan Besar:</strong> Peluang menang dikurangi drastis</li>
                                    <li><strong>Algoritma:</strong> Sistem dirancang agar house selalu untung dalam jangka panjang</li>
                                    <li><strong>Winning Streak:</strong> Jika menang terus, sistem akan menurunkan peluang</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div> <!-- card-body -->
            </div> <!-- card -->
        </div> <!-- col -->
    </div> <!-- row -->
</div> <!-- container -->
@endsection

@section('scripts')
<script>
document.getElementById('play-btn').addEventListener('click', function() {
    const betAmount = document.getElementById('bet-amount').value;
    const playBtn = document.getElementById('play-btn');
    
    if (betAmount < 1000 || betAmount > 50000) {
        alert('Jumlah taruhan harus antara Rp 1.000 - Rp 50.000');
        return;
    }
    
    playBtn.disabled = true;
    playBtn.textContent = 'Memproses...';
    
    fetch('/gambling/play', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            bet_amount: parseInt(betAmount)
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update stats
            document.getElementById('balance').textContent = 'Rp ' + data.new_balance.toLocaleString('id-ID');
            document.getElementById('total-attempts').textContent = data.total_attempts;
            document.getElementById('total-wins').textContent = data.total_wins;
            document.getElementById('total-losses').textContent = data.total_losses;
            
            // Show result
            const resultDiv = document.getElementById('game-result');
            const resultText = document.getElementById('result-text');
            const resultDetails = document.getElementById('result-details');
            const winProbability = document.getElementById('win-probability');
            
            if (data.win) {
                resultText.textContent = '🎉 MENANG!';
                resultText.className = 'text-success';
                resultDetails.innerHTML = `Taruhan: Rp ${data.bet_amount.toLocaleString('id-ID')}<br>Kemenangan: Rp ${data.payout.toLocaleString('id-ID')}`;
            } else {
                resultText.textContent = '😞 KALAH!';
                resultText.className = 'text-danger';
                resultDetails.innerHTML = `Taruhan: Rp ${data.bet_amount.toLocaleString('id-ID')}<br>Kehilangan: Rp ${data.bet_amount.toLocaleString('id-ID')}`;
            }
            
            winProbability.textContent = data.win_probability;
            resultDiv.style.display = 'block';
            
            if (data.new_balance < 1000) {
                alert('Saldo Anda hampir habis! Ini membuktikan bahwa house selalu menang dalam jangka panjang.');
            }
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan!');
    })
    .finally(() => {
        playBtn.disabled = false;
        playBtn.textContent = 'MAIN SEKARANG';
    });
});
</script>
@endsection
