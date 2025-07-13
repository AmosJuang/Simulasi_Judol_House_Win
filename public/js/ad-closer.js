// Ad closer functionality - Make functions global

// Function to close left ads
window.closeLeftAds = function() {
    const leftAds = document.getElementById('leftAds');
    if (leftAds) {
        leftAds.style.transform = 'translateX(-100%)';
        setTimeout(() => {
            leftAds.style.display = 'none';
        }, 300);
        localStorage.setItem('leftAdsClosed', 'true');
    }
}

// Function to close right ads
window.closeRightAds = function() {
    const rightAds = document.getElementById('rightAds');
    if (rightAds) {
        rightAds.style.transform = 'translateX(100%)';
        setTimeout(() => {
            rightAds.style.display = 'none';
        }, 300);
        localStorage.setItem('rightAdsClosed', 'true');
    }
}

// Function to close slot demo
window.closeSlotDemo = function() {
    const slotDemo = document.getElementById('slotDemo');
    if (slotDemo) {
        slotDemo.style.transform = 'scale(0)';
        setTimeout(() => {
            slotDemo.style.display = 'none';
        }, 300);
        localStorage.setItem('slotDemoClosed', 'true');
    }
}

// Function to close jackpot ticker
window.closeJackpotTicker = function() {
    const ticker = document.getElementById('jackpotTicker');
    if (ticker) {
        ticker.style.transform = 'translateY(-100%)';
        setTimeout(() => {
            ticker.style.display = 'none';
        }, 300);
        localStorage.setItem('jackpotTickerClosed', 'true');
    }
}

// Function to close sidebar promo
window.closeSidebarPromo = function() {
    const sidebar = document.getElementById('sidebarPromo');
    if (sidebar) {
        sidebar.style.transform = 'translateX(100%)';
        setTimeout(() => {
            sidebar.style.display = 'none';
        }, 300);
        // Save preference to localStorage
        localStorage.setItem('sidebarPromoClosed', 'true');
    }
}

// Check for closed ads on page load
window.checkClosedAds = function() {
    if (localStorage.getItem('leftAdsClosed') === 'true') {
        const leftAds = document.getElementById('leftAds');
        if (leftAds) leftAds.style.display = 'none';
    }
    
    if (localStorage.getItem('rightAdsClosed') === 'true') {
        const rightAds = document.getElementById('rightAds');
        if (rightAds) rightAds.style.display = 'none';
    }
    
    if (localStorage.getItem('slotDemoClosed') === 'true') {
        const slotDemo = document.getElementById('slotDemo');
        if (slotDemo) slotDemo.style.display = 'none';
    }
    
    if (localStorage.getItem('jackpotTickerClosed') === 'true') {
        const ticker = document.getElementById('jackpotTicker');
        if (ticker) ticker.style.display = 'none';
    }
    
    if (localStorage.getItem('sidebarPromoClosed') === 'true') {
        const sidebar = document.getElementById('sidebarPromo');
        if (sidebar) sidebar.style.display = 'none';
    }
}

// Auto-run on page load
document.addEventListener('DOMContentLoaded', function() {
    checkClosedAds();
    
    // Add resize handler to prevent overflow
    window.addEventListener('resize', function() {
        // Hide ads on mobile screens
        if (window.innerWidth <= 1200) {
            const leftAds = document.getElementById('leftAds');
            const rightAds = document.getElementById('rightAds');
            if (leftAds) leftAds.style.display = 'none';
            if (rightAds) rightAds.style.display = 'none';
        }
        
        // Hide sidebar on mobile
        if (window.innerWidth <= 768) {
            const sidebar = document.getElementById('sidebarPromo');
            if (sidebar) sidebar.style.display = 'none';
        }
    });
    
    // Initial check on page load
    if (window.innerWidth <= 1200) {
        const leftAds = document.getElementById('leftAds');
        const rightAds = document.getElementById('rightAds');
        if (leftAds) leftAds.style.display = 'none';
        if (rightAds) rightAds.style.display = 'none';
    }
    
    if (window.innerWidth <= 768) {
        const sidebar = document.getElementById('sidebarPromo');
        if (sidebar) sidebar.style.display = 'none';
    }
});