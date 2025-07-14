// Enhanced Ad closer functionality - Backup functions if inline doesn't work

// Backup functions (in case inline doesn't work)
if (!window.closeLeftAds) {
    window.closeLeftAds = function() {
        const leftAds = document.getElementById('leftAds');
        if (leftAds) {
            leftAds.style.transform = 'translateX(-100%)';
            leftAds.style.opacity = '0';
            setTimeout(() => {
                leftAds.style.display = 'none';
            }, 300);
            localStorage.setItem('leftAdsClosed', 'true');
        }
    };
}

if (!window.closeRightAds) {
    window.closeRightAds = function() {
        const rightAds = document.getElementById('rightAds');
        if (rightAds) {
            rightAds.style.transform = 'translateX(100%)';
            rightAds.style.opacity = '0';
            setTimeout(() => {
                rightAds.style.display = 'none';
            }, 300);
            localStorage.setItem('rightAdsClosed', 'true');
        }
    };
}

if (!window.closeSlotDemo) {
    window.closeSlotDemo = function() {
        const slotDemo = document.getElementById('slotDemo');
        if (slotDemo) {
            slotDemo.style.transform = 'scale(0)';
            slotDemo.style.opacity = '0';
            setTimeout(() => {
                slotDemo.style.display = 'none';
            }, 300);
            localStorage.setItem('slotDemoClosed', 'true');
        }
    };
}

if (!window.closeJackpotTicker) {
    window.closeJackpotTicker = function() {
        const ticker = document.getElementById('jackpotTicker');
        if (ticker) {
            ticker.style.transform = 'translateY(-100%)';
            ticker.style.opacity = '0';
            setTimeout(() => {
                ticker.style.display = 'none';
            }, 300);
            localStorage.setItem('jackpotTickerClosed', 'true');
        }
    };
}

if (!window.closeSidebarPromo) {
    window.closeSidebarPromo = function() {
        const sidebar = document.getElementById('sidebarPromo');
        if (sidebar) {
            sidebar.style.transform = 'translateX(100%)';
            sidebar.style.opacity = '0';
            setTimeout(() => {
                sidebar.style.display = 'none';
            }, 300);
            localStorage.setItem('sidebarPromoClosed', 'true');
        }
    };
}

// Enhanced check function
if (!window.checkClosedAds) {
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
    };
}

// Auto-run check when this file loads
document.addEventListener('DOMContentLoaded', function() {
    if (typeof checkClosedAds === 'function') {
        checkClosedAds();
    }
    
    // Ensure close buttons work by adding event listeners as backup
    const closeButtons = [
        { selector: '#leftAds .ads-close-btn', action: 'closeLeftAds' },
        { selector: '#rightAds .ads-close-btn', action: 'closeRightAds' },
        { selector: '#slotDemo .demo-close-btn', action: 'closeSlotDemo' },
        { selector: '#jackpotTicker .ticker-close-btn', action: 'closeJackpotTicker' },
        { selector: '#sidebarPromo .promo-close-btn', action: 'closeSidebarPromo' }
    ];
    
    closeButtons.forEach(({ selector, action }) => {
        const button = document.querySelector(selector);
        if (button && !button.onclick && window[action]) {
            button.addEventListener('click', window[action]);
        }
    });
    
    // Additional responsive handling
    function handleResponsive() {
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
    }
    
    window.addEventListener('resize', handleResponsive);
    handleResponsive(); // Initial check
});