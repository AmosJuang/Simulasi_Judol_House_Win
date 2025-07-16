// Buat file ini jika belum ada

// Roulette wheel number positions (European roulette order) - CORRECTED ORDER
const wheelNumbers = [0,32,15,19,4,21,2,25,17,34,6,27,13,36,11,30,8,23,10,5,24,16,33,1,20,14,31,9,22,18,29,7,28,12,35,3,26];

// Only run roulette code if we're on the roulette page
if (document.getElementById('rouletteWheel')) {
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Roulette wheel initialized');
        
        // Color mapping for numbers
        const redNumbers = [1,3,5,7,9,12,14,16,18,19,21,23,25,27,30,32,34,36];
        
        function getNumberColor(number) {
            if (number === 0) return 'green';
            return redNumbers.includes(number) ? 'red' : 'black';
        }
        
        // Apply correct colors to wheel numbers
        document.querySelectorAll('.wheel-number').forEach((element, index) => {
            const number = wheelNumbers[index];
            const color = getNumberColor(number);
            element.style.backgroundColor = color === 'red' ? '#cc0000' : color === 'black' ? '#000000' : '#00aa44';
            element.style.color = '#ffffff';
        });
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Hide ads on roulette page
    const adsElements = ['#leftAds', '#rightAds', '#slotDemo', '#jackpotTicker', '#sidebarPromo'];
    adsElements.forEach(selector => {
        const element = document.querySelector(selector);
        if (element) {
            element.style.display = 'none';
        }
    });

    // Roulette game variables
    let currentBet = null;
    let betAmount = 50000;
    let isSpinning = false;

    // Initialize game elements
    const spinBtn = document.getElementById('spinBtn');
    const rouletteWheel = document.getElementById('rouletteWheel');

    // Add spin button effects
    function addSpinButtonEffects() {
        if (spinBtn) {
            spinBtn.style.boxShadow = '0 10px 30px rgba(255, 215, 0, 0.4)';
            
            spinBtn.addEventListener('mouseenter', function() {
                if (!this.disabled) {
                    this.style.transform = 'translateY(-3px) scale(1.02)';
                    this.style.boxShadow = '0 15px 40px rgba(255, 215, 0, 0.7)';
                }
            });
            
            spinBtn.addEventListener('mouseleave', function() {
                if (!this.disabled) {
                    this.style.transform = 'translateY(0) scale(1)';
                    this.style.boxShadow = '0 10px 30px rgba(255, 215, 0, 0.4)';
                }
            });
        } else {
            console.error('Spin button element not found in the DOM.');
        }
    }

    // Only run roulette code if we're on the roulette page
    if (!document.getElementById('rouletteWheel')) {
        return; // Exit if not on roulette page
    }
    
    // Function to calculate the correct rotation angle for winning number
    function calculateWheelRotation(winningNumber) {
        const numberIndex = wheelNumbers.indexOf(winningNumber);
        if (numberIndex === -1) {
            console.error('Number not found:', winningNumber);
            return 1800; // Default 5 rotations if number not found
        }
        
        console.log(`Winning number: ${winningNumber}, Index: ${numberIndex}`);
        
        // Each number segment is 360/37 = 9.729... degrees
        const degreesPerSegment = 360 / 37;
        
        // Calculate the angle where this number is positioned on the wheel
        const numberAngle = numberIndex * degreesPerSegment;
        
        console.log(`Number angle: ${numberAngle} degrees`);
        
        // The arrow points to the top of the wheel (12 o'clock position)
        // We need to rotate the wheel so the winning number aligns with the arrow
        // Since the wheel rotates clockwise, we need to calculate the opposite rotation
        let targetRotation = (360 - numberAngle) % 360;
        
        // Add multiple full rotations for spinning effect (minimum 5 rotations = 1800 degrees)
        // Add some randomness to the base rotations (5-8 rotations)
        const baseRotations = (5 + Math.random() * 3) * 360;
        const finalRotation = baseRotations + targetRotation;
        
        console.log(`Target rotation: ${targetRotation}, Final rotation: ${finalRotation}`);
        
        return finalRotation;
    }
    
    // Enhanced showResult function with smooth wheel animation
    window.rouletteShowResult = function(data) {
        const wheel = document.getElementById('rouletteWheel');
        
        if (wheel && data.winning_number !== undefined) {
            // Calculate the exact rotation needed for the arrow to point to winning number
            const finalRotation = calculateWheelRotation(data.winning_number);
            
            console.log(`Applying rotation: ${finalRotation}deg for winning number: ${data.winning_number}`);
            
            // Remove any existing transform and add smooth spinning animation
            wheel.style.transform = 'rotate(0deg)';
            wheel.style.transition = 'transform 4s cubic-bezier(0.25, 0.1, 0.25, 1)';
            
            // Start the spin animation immediately
            setTimeout(() => {
                wheel.style.transform = `rotate(${finalRotation}deg)`;
            }, 100);
            
            // After animation completes, add winning number highlight
            setTimeout(() => {
                highlightWinningNumber(data.winning_number);
                // Show winning number display with animation
                showWinningNumberDisplay(data);
            }, 4200);
        }
        
        // Update balance and stats
        updateGameStats(data);
        
        // Add to recent results after wheel stops
        setTimeout(() => {
            addToRecentResults(data.winning_number, data.winning_color);
        }, 4500);
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
    
    // Function to update game statistics
    function updateGameStats(data) {
        if (document.getElementById('balance')) {
            document.getElementById('balance').textContent = 'Rp ' + data.new_balance.toLocaleString('id-ID');
        }
        if (document.getElementById('total-attempts')) {
            document.getElementById('total-attempts').textContent = data.total_attempts;
        }
        if (document.getElementById('total-wins')) {
            document.getElementById('total-wins').textContent = data.total_wins;
        }
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
    
    // Function to highlight the winning number on the wheel
    function highlightWinningNumber(winningNumber) {
        // Remove any existing highlights
        document.querySelectorAll('.wheel-number').forEach(el => {
            el.classList.remove('winning-highlight');
        });
        
        // Find and highlight the winning number
        document.querySelectorAll('.wheel-number').forEach(element => {
            if (parseInt(element.textContent) === winningNumber) {
                element.classList.add('winning-highlight');
                
                // Remove highlight after 5 seconds
                setTimeout(() => {
                    element.classList.remove('winning-highlight');
                }, 5000);
            }
        });
    }
    
    // Function to update wheel responsiveness
    function updateWheelResponsiveness() {
        const wheelContainer = document.querySelector('.wheel-container');
        const wheelNumbers = document.querySelectorAll('.wheel-number');
        
        if (!wheelContainer || wheelNumbers.length === 0) return;
        
        const containerSize = wheelContainer.offsetWidth;
        const isMobile = window.innerWidth <= 768;
        const isSmallMobile = window.innerWidth <= 576;
        
        // Calculate radius based on container size
        let radius;
        if (isSmallMobile) {
            radius = (containerSize / 2) - 25;
        } else if (isMobile) {
            radius = (containerSize / 2) - 30;
        } else {
            radius = (containerSize / 2) - 35;
        }
        
        // Update transform-origin for each number
        wheelNumbers.forEach(number => {
            number.style.transformOrigin = `50% ${radius}px`;
        });
    }
    
    // Responsive wheel sizing on window resize
    window.addEventListener('resize', function() {
        updateWheelResponsiveness();
    });
    
    // Initialize everything
    addSpinButtonEffects();
    updateWheelResponsiveness();
});