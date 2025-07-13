// Buat file ini jika belum ada

document.addEventListener('DOMContentLoaded', function() {
    // Only run roulette code if we're on the roulette page
    if (!document.getElementById('rouletteWheel')) {
        return; // Exit if not on roulette page
    }
    
    // Roulette wheel number positions (same order as in Blade template)
    const wheelNumbers = [0,32,15,19,4,21,2,25,17,34,6,27,13,36,11,30,8,23,10,5,24,16,33,1,20,14,31,9,22,18,29,7,28,12,35,3,26];
    
    // Find the original spin button and its event handler
    const spinBtn = document.getElementById('spin-btn');
    
    if (spinBtn && document.querySelector('.roulette-table')) {
        // Only override if we're on roulette page (has roulette table)
        // Remove existing event listeners
        const newSpinBtn = spinBtn.cloneNode(true);
        spinBtn.parentNode.replaceChild(newSpinBtn, spinBtn);
        
        // Add new event handler for roulette
        newSpinBtn.addEventListener('click', function() {
            // Get current bet type and amount
            const selectedBetElement = document.querySelector('.number-btn.selected, .outside-bet-btn.selected');
            
            if (!selectedBetElement) {
                alert('Silakan pilih taruhan terlebih dahulu!');
                return;
            }
            
            // Get bet amount
            let betAmount = 25000; // Default
            const customBetInput = document.getElementById('customBetAmount');
            
            if (customBetInput && customBetInput.value && parseInt(customBetInput.value) >= 15000) {
                betAmount = parseInt(customBetInput.value);
            } else {
                // Check if a preset amount is selected
                const activeBetBtn = document.querySelector('.bet-amount-btn.active');
                if (activeBetBtn) {
                    betAmount = parseInt(activeBetBtn.getAttribute('data-amount'));
                }
            }
            
            // Validate bet amount
            if (betAmount < 15000) {
                alert('Minimal taruhan Rp 15.000!');
                return;
            }
            
            // Get bet details
            const betType = selectedBetElement.getAttribute('data-bet');
            const betValue = selectedBetElement.getAttribute('data-value');
            const payoutRatio = parseInt(selectedBetElement.getAttribute('data-payout'));
            
            // Disable spin button and show loading state
            this.disabled = true;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> MEMUTAR...';
            
            // Start the wheel animation - only the wheel spins, pointer stays fixed
            const wheel = document.getElementById('rouletteWheel');
            if (wheel) {
                // Reset any previous animation
                wheel.classList.remove('spinning');
                wheel.style.transform = 'rotate(0deg)';
                // Force reflow
                void wheel.offsetHeight;
                // Add spinning class
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
                    bet_type: betType,
                    bet_value: betValue,
                    bet_amount: betAmount,
                    payout_ratio: payoutRatio
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Calculate the final position for the winning number
                    const winningNumberIndex = wheelNumbers.indexOf(data.winning_number);
                    if (winningNumberIndex !== -1) {
                        // Calculate the angle for this number position
                        const anglePerNumber = 360 / 37;
                        const targetAngle = winningNumberIndex * anglePerNumber;
                        
                        // Add multiple rotations + final position
                        // We want the arrow to point to the winning number
                        const finalRotation = 1800 - targetAngle; // 5 full rotations minus the target angle
                        
                        // Remove spinning animation and set final position
                        setTimeout(() => {
                            wheel.classList.remove('spinning');
                            wheel.style.transform = `rotate(${finalRotation}deg)`;
                        }, 3800); // Slightly before animation ends
                    }
                    
                    // Show winning number after animation completes
                    setTimeout(() => {
                        showResult(data);
                    }, 4000);
                } else {
                    alert(data.message);
                    // Reset wheel animation
                    if (wheel) {
                        wheel.classList.remove('spinning');
                        wheel.style.transform = 'rotate(0deg)';
                    }
                    this.disabled = false;
                    this.innerHTML = '<i class="fas fa-play"></i> PUTAR RODA!';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan!');
                
                // Reset wheel animation
                if (wheel) {
                    wheel.classList.remove('spinning');
                    wheel.style.transform = 'rotate(0deg)';
                }
                this.disabled = false;
                this.innerHTML = '<i class="fas fa-play"></i> PUTAR RODA!';
            });
        });
    }
    
    // Function to show result after wheel animation
    function showResult(data) {
        // Update balance and stats
        document.getElementById('balance').textContent = 'Rp ' + data.new_balance.toLocaleString('id-ID');
        document.getElementById('total-attempts').textContent = data.total_attempts;
        document.getElementById('total-wins').textContent = data.total_wins;
        
        // Show winning number
        const winningNumber = document.getElementById('winningNumber');
        const numberDisplay = document.getElementById('numberDisplay');
        const colorDisplay = document.getElementById('colorDisplay');
        
        numberDisplay.textContent = data.winning_number;
        
        let colorText = 'HIJAU';
        if (data.winning_color === 'red') colorText = 'MERAH';
        else if (data.winning_color === 'black') colorText = 'HITAM';
        
        colorDisplay.textContent = colorText;
        winningNumber.style.display = 'block';
        
        // Show result
        const resultDiv = document.getElementById('gameResult');
        const resultText = document.getElementById('resultText');
        const resultDetails = document.getElementById('resultDetails');
        
        if (data.win) {
            resultText.textContent = '🎉 SELAMAT! ANDA MENANG!';
            resultText.className = 'text-success mb-3';
            resultDetails.innerHTML = `
                <div class="win-result">
                    <div class="mb-2">Angka Pemenang: <span class="fw-bold">${data.winning_number}</span></div>
                    <div class="mb-2">Warna: <span class="fw-bold" style="color: ${data.winning_color === 'red' ? '#ff0000' : data.winning_color === 'black' ? '#000000' : '#00aa44'}">${colorText}</span></div>
                    <h4 class="text-success">MENANG: Rp ${data.payout.toLocaleString('id-ID')}</h4>
                    <p class="text-muted">Taruhan: Rp ${data.bet_amount.toLocaleString('id-ID')} | Pembayaran: ${data.payout_ratio + 1}:1</p>
                </div>
            `;
            
            // Start falling gold animation if available
            if (typeof startFallingGold === 'function') {
                startFallingGold();
            }
        } else {
            resultText.textContent = '💸 TIDAK BERUNTUNG KALI INI';
            resultText.className = 'text-danger mb-3';
            resultDetails.innerHTML = `
                <div class="lose-result">
                    <div class="mb-2">Angka Pemenang: <span class="fw-bold">${data.winning_number}</span></div>
                    <div class="mb-2">Warna: <span class="fw-bold" style="color: ${data.winning_color === 'red' ? '#ff0000' : data.winning_color === 'black' ? '#000000' : '#00aa44'}">${colorText}</span></div>
                    <h4 class="text-danger">KALAH: Rp ${data.bet_amount.toLocaleString('id-ID')}</h4>
                    <p class="text-muted">Coba lagi untuk keberuntungan yang lebih baik!</p>
                </div>
            `;
        }
        
        resultDiv.style.display = 'block';
        resultDiv.classList.add('animate__animated', 'animate__fadeInUp');
        
        // Add to recent results
        addToRecentResults(data.winning_number, data.winning_color);
        
        // Reset spin button
        const spinBtn = document.getElementById('spin-btn');
        spinBtn.disabled = false;
        spinBtn.innerHTML = '<i class="fas fa-play"></i> PUTAR RODA!';
        
        // Clear current bet after some time
        setTimeout(() => {
            winningNumber.style.display = 'none';
        }, 8000);
    }
    
    // Function to add results to recent results display
    function addToRecentResults(number, color) {
        const recentResults = document.getElementById('recentResults');
        if (!recentResults) return;
        
        const newResult = document.createElement('div');
        newResult.className = 'result-item';
        
        let parity = '';
        let colorText = 'HIJAU';
        
        if (number === 0) {
            parity = '';
        } else {
            parity = number % 2 === 0 ? ', GENAP' : ', GANJIL';
        }
        
        if (color === 'red') colorText = 'MERAH';
        else if (color === 'black') colorText = 'HITAM';
        
        newResult.innerHTML = `
            <span class="result-number ${color}">${number}</span>
            <span class="result-info">${colorText}${parity}</span>
        `;
        
        recentResults.insertBefore(newResult, recentResults.firstChild);
        
        // Keep only last 5 results
        if (recentResults.children.length > 5) {
            recentResults.removeChild(recentResults.lastChild);
        }
    }
});