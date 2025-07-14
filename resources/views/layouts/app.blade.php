<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'W568 - Situs Judi Online Terpercaya') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    
    <!-- Animated CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #0a0a0a;
            color: #ffffff;
            font-family: 'Roboto', sans-serif;
            overflow-x: hidden;
            position: relative;
            min-height: 100vh;
        }

        /* Fix container overflow */
        .container, .container-fluid {
            max-width: 100%;
            overflow-x: hidden;
            padding-left: 15px;
            padding-right: 15px;
        }

        /* Ensure all content stays within viewport */
        * {
            box-sizing: border-box;
        }

        /* Fix row overflow */
        .row {
            margin-left: -15px;
            margin-right: -15px;
            overflow-x: hidden;
        }

        .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, 
        .col-7, .col-8, .col-9, .col-10, .col-11, .col-12,
        .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6,
        .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12,
        .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6,
        .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12,
        .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6,
        .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12 {
            padding-left: 15px;
            padding-right: 15px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* Mobile-first responsive adjustments */
        @media (max-width: 768px) {
            .container, .container-fluid {
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
            
            /* Fix sidebar on mobile */
            .sidebar-promo {
                display: none !important;
            }
            
            /* Adjust navbar for mobile */
            .navbar-brand {
                font-size: 1.5rem;
                padding: 0.5rem 0;
            }
            
            .nav-link {
                padding: 8px 12px !important;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            .container, .container-fluid {
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
            
            /* Hide ads on very small screens */
            .left-ads, .right-ads {
                display: none !important;
            }
            
            /* Stack elements vertically on small screens */
            .d-flex {
                flex-direction: column !important;
            }
            
            .d-flex > * {
                margin-bottom: 10px !important;
            }
        }

        /* Animated Background */
        .casino-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #1a0000, #330000, #1a0000);
            background-size: 400% 400%;
            animation: gradientShift 10s ease infinite;
            z-index: -2;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Floating casino elements */
        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: -1;
            overflow: hidden;
        }

        .floating-coin {
            position: absolute;
            color: #ffd700;
            font-size: 24px;
            animation: float 6s ease-in-out infinite;
            opacity: 0.3;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Header with promotional banners */
        .promo-header {
            background: linear-gradient(90deg, #ff6b35, #ff0000, #ff6b35);
            background-size: 200% 100%;
            animation: slideGradient 3s ease infinite;
            padding: 8px 15px;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            box-shadow: 0 2px 10px rgba(255, 0, 0, 0.5);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        @keyframes slideGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .blink {
            animation: blink 1s linear infinite;
        }

        @keyframes blink {
            0%, 50% { opacity: 1; }
            51%, 100% { opacity: 0; }
        }

        /* Main Navigation */
        .main-navbar {
            background: linear-gradient(135deg, #000000, #1a1a1a, #000000);
            border-bottom: 3px solid #ffd700;
            box-shadow: 0 4px 20px rgba(255, 215, 0, 0.4);
            position: sticky;
            top: 0;
            z-index: 1050;
        }

        .navbar-brand {
            color: #ffd700 !important;
            font-weight: 900;
            font-size: 2.2rem;
            text-shadow: 2px 2px 4px rgba(255, 0, 0, 0.8);
            filter: drop-shadow(0 0 10px #ffd700);
        }

        .nav-link {
            color: #ffffff !important;
            font-weight: 500;
            padding: 10px 15px !important;
            margin: 0 5px;
            border-radius: 20px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            background: linear-gradient(45deg, #ffd700, #ffed4a);
            color: #000000 !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.5);
        }

        /* Sidebar promotions */
        .sidebar-promo {
            position: fixed;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 200px;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .promo-close-btn {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #ff0000;
            color: #ffffff;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
            z-index: 1001;
            transition: all 0.3s ease;
            border: 2px solid #ffd700;
        }

        .promo-close-btn:hover {
            background: #cc0000;
            transform: scale(1.1);
        }

        .promo-card {
            background: linear-gradient(135deg, #ff6b35, #ff0000);
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 15px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(255, 0, 0, 0.4);
            animation: pulse 2s infinite;
            cursor: pointer;
            border: 2px solid #ffd700;
            position: relative;
        }

        @keyframes pulse {
            0% { box-shadow: 0 8px 25px rgba(255, 0, 0, 0.4); }
            50% { box-shadow: 0 8px 35px rgba(255, 0, 0, 0.8); }
            100% { box-shadow: 0 8px 25px rgba(255, 0, 0, 0.4); }
        }

        .promo-card h6 {
            color: #ffd700;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .promo-card p {
            font-size: 12px;
            margin: 0;
        }

        /* Game Cards */
        .game-card {
            background: linear-gradient(145deg, #1a1a1a, #2d2d2d);
            border: 2px solid #ffd700;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
            transition: all 0.3s ease;
            position: relative;
        }

        .game-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(255, 215, 0, 0.5);
        }

        .game-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .game-card:hover::before {
            left: 100%;
        }

        /* Slot machine style */
        .slot-container {
            background: linear-gradient(45deg, #2d2d2d, #1a1a1a);
            border: 5px solid #ffd700;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 
                inset 0 0 20px rgba(255, 215, 0, 0.3),
                0 0 30px rgba(255, 215, 0, 0.5);
            position: relative;
        }

        .slot-container::before {
            content: '🎰';
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 40px;
            background: #000;
            padding: 10px;
            border-radius: 50%;
            border: 3px solid #ffd700;
        }

        /* Jackpot Display */
        .jackpot-display {
            background: linear-gradient(45deg, #ff0000, #ff6b35);
            color: #ffd700;
            text-align: center;
            padding: 15px;
            border-radius: 15px;
            margin: 20px 0;
            border: 3px solid #ffd700;
            position: relative;
            overflow: hidden;
            word-wrap: break-word;
        }

        .jackpot-display::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: shine 3s linear infinite;
        }

        @keyframes shine {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .jackpot-amount {
            font-size: 2rem;
            font-weight: 900;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
            animation: countUp 2s ease infinite;
            word-break: break-all;
        }

        @keyframes countUp {
            0%, 90% { transform: scale(1); }
            95% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @media (max-width: 768px) {
            .jackpot-amount {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .jackpot-amount {
                font-size: 1.2rem;
            }
        }

        /* Buttons */
        .btn-casino {
            background: linear-gradient(45deg, #ffd700, #ffed4a);
            border: none;
            color: #000000;
            font-weight: bold;
            padding: 15px 30px;
            border-radius: 30px;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-casino:hover {
            background: linear-gradient(45deg, #ffed4a, #ffd700);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.6);
            color: #000000;
        }

        .btn-casino::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s;
        }

        .btn-casino:hover::before {
            left: 100%;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .sidebar-promo {
                display: none;
            }
            
            .navbar-brand {
                font-size: 1.5rem;
            }
            
            .jackpot-amount {
                font-size: 1.8rem;
            }
        }

        /* Footer promotions */
        .footer-promo {
            background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
            border-top: 3px solid #ffd700;
            padding: 30px 0;
            margin-top: 50px;
        }

        .promo-ticker {
            background: #ff0000;
            color: #ffffff;
            padding: 10px 0;
            overflow: hidden;
            white-space: nowrap;
            width: 100%;
        }

        .ticker-content {
            display: inline-block;
            animation: scroll 30s linear infinite;
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .ticker-content {
                animation: scroll 20s linear infinite;
            }
        }

        /* Falling Gold Animation */
        .falling-gold {
            position: fixed;
            width: 30px;
            height: 30px;
            background-image: url('{{ asset("public/Images/Big_Gold_Pile.png") }}');
            background-size: cover;
            z-index: 1000;
            pointer-events: none;
            opacity: 0.9;
            animation: fallGold 3s linear infinite;
        }

        @keyframes fallGold {
            0% {
                transform: translateY(-100vh) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* Big Win Animation */
        .big-win-animation {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2000;
            text-align: center;
            pointer-events: none;
            display: none;
        }

        .big-win-text {
            font-size: 4rem;
            font-weight: bold;
            color: #ffd700;
            text-shadow: 0 0 20px rgba(255, 215, 0, 0.8);
            animation: bigWinPulse 2s ease-in-out infinite;
        }

        @keyframes bigWinPulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.2);
            }
        }

        .big-win-amount {
            font-size: 2.5rem;
            color: #00ff00;
            font-weight: bold;
            margin-top: 20px;
            animation: amountGlow 1.5s ease-in-out infinite alternate;
        }

        @keyframes amountGlow {
            0% {
                text-shadow: 0 0 10px rgba(0, 255, 0, 0.5);
            }
            100% {
                text-shadow: 0 0 20px rgba(0, 255, 0, 1);
            }
        }

        /* Enhanced Welcome Section */
        .welcome-header {
            position: relative;
            overflow: hidden;
        }

        .welcome-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 215, 0, 0.1) 50%, transparent 70%);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100%);
            }
        }

        /* Flashy Advertisement Banners */
        .left-ads, .right-ads {
            position: fixed;
            width: 150px;
            height: 100vh;
            top: 0;
            z-index: 999;
            pointer-events: none;
            overflow: hidden;
        }

        .left-ads {
            left: 0;
        }

        .right-ads {
            right: 0;
        }

        .ad-banner {
            position: absolute;
            width: 140px;
            height: 200px;
            background: linear-gradient(135deg, #ff0000, #ffd700, #ff6b35);
            border: 3px solid #ffd700;
            border-radius: 15px;
            margin: 10px 5px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 10px;
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.8);
            animation: flashyPulse 2s infinite alternate;
            cursor: pointer;
            pointer-events: auto;
        }

        @keyframes flashyPulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 20px rgba(255, 215, 0, 0.8);
            }
            100% {
                transform: scale(1.05);
                box-shadow: 0 0 30px rgba(255, 0, 0, 1);
            }
        }

        .ad-banner h6 {
            color: #fff;
            font-weight: bold;
            font-size: 12px;
            margin: 5px 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        }

        .ad-banner .big-text {
            font-size: 16px;
            color: #ffd700;
            font-weight: 900;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
            animation: textBounce 1s infinite;
        }

        @keyframes textBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-3px); }
        }

        .ad-banner .emoji {
            font-size: 20px;
            animation: spinEmoji 2s linear infinite;
        }

        @keyframes spinEmoji {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Floating Win Notifications */
        .floating-win {
            position: fixed;
            top: 20%;
            right: 20px;
            width: 200px;
            background: linear-gradient(45deg, #00ff00, #32cd32);
            border: 3px solid #ffd700;
            border-radius: 15px;
            padding: 15px;
            color: #000;
            font-weight: bold;
            text-align: center;
            z-index: 1001;
            animation: slideInRight 0.5s ease-out, fadeOutDelay 4s ease-in;
            animation-fill-mode: forwards;
        }

        @keyframes slideInRight {
            0% {
                transform: translateX(100%);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOutDelay {
            0%, 75% {
                opacity: 1;
                transform: translateX(0);
            }
            100% {
                opacity: 0;
                transform: translateX(100%);
            }
        }

        /* Slot Machine Win Animation */
        .slot-win-demo {
            position: fixed;
            bottom: 20px;
            left: 20px;
            width: 180px;
            height: 120px;
            background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
            border: 3px solid #ffd700;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            animation: demoSlotPulse 3s infinite;
        }

        @keyframes demoSlotPulse {
            0%, 50% {
                box-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
            }
            25%, 75% {
                box-shadow: 0 0 30px rgba(255, 0, 0, 0.8);
            }
        }

        .slot-symbols {
            display: flex;
            gap: 10px;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .slot-symbol {
            animation: slotSpin 0.5s ease-in-out infinite;
        }

        .slot-symbol:nth-child(1) { animation-delay: 0s; }
        .slot-symbol:nth-child(2) { animation-delay: 0.1s; }
        .slot-symbol:nth-child(3) { animation-delay: 0.2s; }

        @keyframes slotSpin {
            0%, 80% { transform: rotateY(0deg); }
            40% { transform: rotateY(180deg); }
            100% { transform: rotateY(360deg); }
        }

        .demo-win-text {
            color: #ffd700;
            font-weight: bold;
            font-size: 12px;
            text-align: center;
        }

        /* Jackpot Ticker */
        .jackpot-ticker {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: linear-gradient(90deg, #ff0000, #ffd700, #ff0000);
            color: #fff;
            padding: 5px 0;
            font-weight: bold;
            font-size: 14px;
            text-align: center;
            z-index: 1100;
            animation: tickerGlow 2s infinite alternate;
        }

        @keyframes tickerGlow {
            0% {
                box-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
            }
            100% {
                box-shadow: 0 0 20px rgba(255, 215, 0, 0.8);
            }
        }

        /* Mobile hide ads */
        @media (max-width: 1200px) {
            .left-ads, .right-ads {
                display: none;
            }
        }

        /* Blinking effects */
        .blink-fast {
            animation: blinkFast 0.5s linear infinite;
        }

        @keyframes blinkFast {
            0%, 50% { opacity: 1; }
            51%, 100% { opacity: 0.3; }
        }

        /* Enhanced Close Buttons for Ads */
        .ads-close-btn {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #ff0000;
            color: #ffffff;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
            z-index: 1002;
            transition: all 0.3s ease;
            border: 2px solid #ffd700;
            box-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
        }

        .ads-close-btn:hover {
            background: #cc0000;
            transform: scale(1.2);
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.8);
        }

        .demo-close-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff0000;
            color: #ffffff;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 10px;
            z-index: 1002;
            transition: all 0.3s ease;
            border: 1px solid #ffd700;
        }

        .demo-close-btn:hover {
            background: #cc0000;
            transform: scale(1.2);
        }

        /* Jackpot Ticker Close Button */
        .jackpot-ticker {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: linear-gradient(90deg, #ff0000, #ffd700, #ff0000);
            color: #fff;
            padding: 5px 0;
            font-weight: bold;
            font-size: 14px;
            text-align: center;
            z-index: 1100;
            animation: tickerGlow 2s infinite alternate;
        }

        .ticker-close-btn {
            position: absolute;
            top: 2px;
            right: 10px;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
            border: 1px solid #ffd700;
            transition: all 0.3s ease;
        }

        .ticker-close-btn:hover {
            background: rgba(255, 0, 0, 0.8);
            transform: scale(1.1);
        }

        /* Winning number highlight effect */
        .winning-highlight {
            background: linear-gradient(45deg, #ffd700, #ffed4a) !important;
            color: #000 !important;
            transform: scale(1.3) !important;
            box-shadow: 0 0 20px rgba(255, 215, 0, 1) !important;
            border: 2px solid #ff0000 !important;
            animation: winningPulse 0.5s ease-in-out infinite alternate !important;
            z-index: 15 !important;
        }
        
        @keyframes winningPulse {
            0% { 
                box-shadow: 0 0 20px rgba(255, 215, 0, 1);
                transform: scale(1.3);
            }
            100% { 
                box-shadow: 0 0 30px rgba(255, 0, 0, 1);
                transform: scale(1.4);
            }
        }

    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Left Ads - Hidden on admin and roulette pages -->
    @if(!request()->routeIs('gambling.admin') && !request()->routeIs('gambling.forceResult') && !request()->routeIs('gambling.roulette'))
    <div id="leftAds" class="floating-ads left-ads">
        <div class="ads-close-btn" onclick="closeLeftAds()">
            <i class="fas fa-times"></i>
        </div>
        <div class="ad-banner" style="top: 100px;">
            <div class="emoji">🎰</div>
            <h6>MEGA SLOT</h6>
            <div class="big-text blink-fast">777</div>
            <h6>MAXWIN!</h6>
            <small style="color: #ffd700;">WIN UP TO 1000x!</small>
        </div>

        <div class="ad-banner" style="top: 320px; animation-delay: 0.5s;">
            <div class="emoji">💎</div>
            <h6>DIAMOND</h6>
            <div class="big-text">RUSH</div>
            <h6 class="blink">GACOR!</h6>
            <small style="color: #00ff00;">RTP 98%</small>
        </div>

        <div class="ad-banner" style="top: 540px; animation-delay: 1s;">
            <div class="emoji">🔥</div>
            <h6>HOT SLOT</h6>
            <div class="big-text blink">BONUS</div>
            <h6>FREE SPIN</h6>
            <small style="color: #ffd700;">25x MULTIPLIER</small>
        </div>
    </div>
    @endif

    <!-- Right Ads - Hidden on admin and roulette pages -->
    @if(!request()->routeIs('gambling.admin') && !request()->routeIs('gambling.forceResult') && !request()->routeIs('gambling.roulette'))
    <div id="rightAds" class="floating-ads right-ads">
        <div class="ads-close-btn" onclick="closeRightAds()">
            <i class="fas fa-times"></i>
        </div>
        <div class="ad-banner" style="top: 80px;">
            <div class="emoji">💰</div>
            <h6 class="blink-fast">JACKPOT</h6>
            <div class="big-text">1.2B</div>
            <h6>RUPIAH!</h6>
            <small style="color: #00ff00;">GROWING NOW!</small>
        </div>

        <div class="ad-banner" style="top: 300px; animation-delay: 0.7s;">
            <div class="emoji">⚡</div>
            <h6>LIGHTNING</h6>
            <div class="big-text blink">FAST</div>
            <h6>WITHDRAW</h6>
            <small style="color: #ffd700;">1-3 MINUTES</small>
        </div>

        <div class="ad-banner" style="top: 520px; animation-delay: 1.2s;">
            <div class="emoji">🏆</div>
            <h6>VIP BONUS</h6>
            <div class="big-text">100K</div>
            <h6 class="blink">GRATIS</h6>
            <small style="color: #00ff00;">NEW MEMBER</small>
        </div>

        <div class="ad-banner" style="top: 740px; animation-delay: 1.5s;">
            <div class="emoji">🎯</div>
            <h6>LUCKY SPIN</h6>
            <div class="big-text blink-fast">WIN</div>
            <h6>EVERYDAY</h6>
            <small style="color: #ffd700;">FREE BONUS</small>
        </div>
    </div>
    @endif

    <!-- Slot Demo Popup - Hidden on admin and roulette pages -->
    @if(!request()->routeIs('gambling.admin') && !request()->routeIs('gambling.forceResult') && !request()->routeIs('gambling.roulette'))
    <div id="slotDemo" class="floating-popup slot-demo-popup">
        <div class="demo-close-btn" onclick="closeSlotDemo()">
            <i class="fas fa-times"></i>
        </div>
        <div class="slot-symbols">
            <span class="slot-symbol">🔥</span>
            <span class="slot-symbol">🔥</span>
            <span class="slot-symbol">🔥</span>
        </div>
        <div class="demo-win-text blink">
            MEGA WIN!<br>
            <span style="color: #00ff00;">Rp 50.000.000</span>
        </div>
    </div>
    @endif

    <!-- Jackpot Ticker - Hidden on admin and roulette pages -->
    @if(!request()->routeIs('gambling.admin') && !request()->routeIs('gambling.forceResult') && !request()->routeIs('gambling.roulette'))
    <div id="jackpotTicker" class="jackpot-ticker">
        <div class="ticker-close-btn" onclick="closeJackpotTicker()">
            <i class="fas fa-times"></i>
        </div>
        <span class="blink">🚨 JACKPOT ALERT! 🚨</span>
        &nbsp;&nbsp;
        <span>Player "Ahmad****" meraih Rp 500.000.000!</span>
        &nbsp;&nbsp;
        <span class="blink">🔥 GILIRAN ANDA SELANJUTNYA! 🔥</span>
    </div>
    @endif

    <!-- Sidebar Promo - Hidden on admin and roulette pages -->
    @if(!request()->routeIs('gambling.admin') && !request()->routeIs('gambling.forceResult') && !request()->routeIs('gambling.roulette'))
    <div class="sidebar-promo" id="sidebarPromo">
        <div class="promo-close-btn" onclick="closeSidebarPromo()">
            <i class="fas fa-times"></i>
        </div>
        <div class="promo-card animate__animated animate__bounceIn">
            <h6>🎁 BONUS HARIAN</h6>
            <p>Dapatkan bonus hingga 50% setiap hari!</p>
        </div>
        <div class="promo-card animate__animated animate__bounceIn" style="animation-delay: 0.5s;">
            <h6>⚡ CASHBACK</h6>
            <p>Cashback hingga 10% untuk semua permainan!</p>
        </div>
        <div class="promo-card animate__animated animate__bounceIn" style="animation-delay: 1s;">
            <h6>🏆 TURNOVER</h6>
            <p>Bonus turnover 0.5% tanpa batas!</p>
        </div>
    </div>
    @endif

    <div id="app">
        <!-- Promotional Header -->
        <div class="promo-header">
            <div class="container">
                <span class="blink">🔥 MEGA JACKPOT 🔥</span>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <span>💰 BONUS 100% UNTUK MEMBER BARU! 💰</span>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <span class="blink">⚡ WITHDRAW INSTAN! ⚡</span>
            </div>
        </div>

        <!-- Main Navigation -->
        <nav class="navbar navbar-expand-lg main-navbar">
            <div class="container">
                <a class="navbar-brand animate__animated animate__pulse animate__infinite" href="{{ url('/') }}">
                    <i class="fas fa-crown"></i> W568
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="navbar-nav ms-auto">
                        @guest
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> MASUK
                            </a>
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i> DAFTAR
                            </a>
                        @else
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-tachometer-alt"></i> DASHBOARD
                            </a>
                            <a class="nav-link" href="{{ route('gambling.index') }}">
                                <i class="fas fa-dice"></i> MAIN SEKARANG
                            </a>
                            <a class="nav-link" href="{{ route('gambling.statistics') }}">
                                <i class="fas fa-chart-bar"></i> STATISTIK
                            </a>
                            @if(Auth::user()->is_admin ?? false)
                                <a class="nav-link" href="{{ route('gambling.admin') }}">
                                    <i class="fas fa-crown"></i> ADMIN
                                </a>
                            @endif
                            <a class="nav-link" href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> KELUAR
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar Promotions -->
        <div class="sidebar-promo" id="sidebarPromo">
            <div class="promo-close-btn" onclick="closeSidebarPromo()">
                <i class="fas fa-times"></i>
            </div>
            <div class="promo-card animate__animated animate__bounceIn">
                <h6>🎁 BONUS HARIAN</h6>
                <p>Dapatkan bonus hingga 50% setiap hari!</p>
            </div>
            <div class="promo-card animate__animated animate__bounceIn" style="animation-delay: 0.5s;">
                <h6>⚡ CASHBACK</h6>
                <p>Cashback hingga 10% untuk semua permainan!</p>
            </div>
            <div class="promo-card animate__animated animate__bounceIn" style="animation-delay: 1s;">
                <h6>🏆 TURNOVER</h6>
                <p>Bonus turnover 0.5% tanpa batas!</p>
            </div>
        </div>

        <!-- Jackpot Display -->
        <div class="container mt-3">
            <div class="jackpot-display animate__animated animate__zoomIn">
                <h4>💎 MEGA JACKPOT HARI INI 💎</h4>
                <div class="jackpot-amount" id="jackpotAmount">Rp 2.847.391.205</div>
                <small>Jackpot terus bertambah setiap detik!</small>
            </div>
        </div>

        <!-- Promotional Ticker -->
        <div class="promo-ticker">
            <div class="ticker-content">
                🎰 SELAMAT! Ahmad dari Jakarta menang Rp 50.000.000 di Slot Gacor! 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                🎯 MEMBER BARU! Dapatkan bonus deposit 100% hingga Rp 1.000.000! 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                💰 WITHDRAW TERCEPAT! Proses hanya 1-3 menit! 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                🔥 SLOT GACOR HARI INI! Win Rate hingga 98%! 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
        </div>

        <!-- Main Content -->
        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer Promotions -->
        <footer class="footer-promo">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 text-center mb-3">
                        <h5><i class="fas fa-shield-alt text-warning"></i> AMAN & TERPERCAYA</h5>
                        <p>Berlisensi resmi dan menggunakan sistem keamanan tingkat tinggi</p>
                    </div>
                    <div class="col-md-4 text-center mb-3">
                        <h5><i class="fas fa-clock text-warning"></i> LAYANAN 24/7</h5>
                        <p>Customer service siap membantu Anda kapan saja</p>
                    </div>
                    <div class="col-md-4 text-center mb-3">
                        <h5><i class="fas fa-mobile-alt text-warning"></i> MOBILE FRIENDLY</h5>
                        <p>Mainkan di smartphone dengan tampilan yang responsif</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Jackpot Counter Script -->
    <script>
        // Animate jackpot counter
        function animateJackpot() {
            const jackpotElement = document.getElementById('jackpotAmount');
            if (jackpotElement) {
                let currentAmount = 2847391205;
                
                setInterval(() => {
                    currentAmount += Math.floor(Math.random() * 10000) + 1000;
                    jackpotElement.textContent = 'Rp ' + currentAmount.toLocaleString('id-ID');
                }, 3000);
            }
        }
        
        // Start falling gold animation
        function startFallingGold() {
            const goldCount = 15;
            const duration = 3000;
            
            for (let i = 0; i < goldCount; i++) {
                setTimeout(() => {
                    createFallingGold();
                }, i * 200);
            }
        }
        
        // Create individual falling gold element
        function createFallingGold() {
            const gold = document.createElement('div');
            gold.className = 'falling-gold';
            gold.innerHTML = '🪙';
            gold.style.left = Math.random() * 100 + 'vw';
            gold.style.animationDuration = (Math.random() * 2 + 2) + 's';
            gold.style.fontSize = (Math.random() * 20 + 20) + 'px';
            gold.style.color = '#ffd700';
            gold.style.position = 'fixed';
            gold.style.top = '-50px';
            gold.style.zIndex = '1000';
            gold.style.pointerEvents = 'none';
            
            document.body.appendChild(gold);
            
            // Remove element after animation
            setTimeout(() => {
                if (gold.parentNode) {
                    gold.parentNode.removeChild(gold);
                }
            }, 4000);
        }
        
        // Show big win animation
        function showBigWinAnimation(amount) {
            const bigWinAnimation = document.getElementById('bigWinAnimation');
            const bigWinAmount = document.getElementById('bigWinAmount');
            
            if (bigWinAnimation && bigWinAmount) {
                bigWinAmount.textContent = 'Rp ' + amount.toLocaleString('id-ID');
                bigWinAnimation.style.display = 'block';
                
                // Hide after 5 seconds
                setTimeout(() => {
                    bigWinAnimation.style.display = 'none';
                }, 5000);
            }
        }
        
        // Close sidebar promo
        function closeSidebarPromo() {
            const sidebar = document.getElementById('sidebarPromo');
            sidebar.style.transform = 'translateX(100%)';
            setTimeout(() => {
                sidebar.style.display = 'none';
            }, 300);
            
            // Save preference to localStorage
            localStorage.setItem('sidebarPromoClosed', 'true');
        }
        
        // Check if sidebar should be hidden
        function checkSidebarPromo() {
            const sidebarClosed = localStorage.getItem('sidebarPromoClosed');
            if (sidebarClosed === 'true') {
                const sidebar = document.getElementById('sidebarPromo');
                if (sidebar) {
                    sidebar.style.display = 'none';
                }
            }
        }
        
        // Create floating win notifications
        function createWinNotification() {
            const winners = [
                { name: 'Budi****', amount: 'Rp 25.000.000', game: 'Mega Slot' },
                { name: 'Sari****', amount: 'Rp 15.750.000', game: 'Diamond Rush' },
                { name: 'Andi****', amount: 'Rp 8.500.000', game: 'Lightning Strike' },
                { name: 'Dina****', amount: 'Rp 12.250.000', game: 'Golden Trophy' },
                { name: 'Rizki****', amount: 'Rp 45.000.000', game: 'Fire Slot' }
            ];
            
            const randomWinner = winners[Math.floor(Math.random() * winners.length)];
            
            const notification = document.createElement('div');
            notification.className = 'floating-win';
            notification.innerHTML = `
                <div style="font-size: 12px; color: #000;">🎉 PLAYER WIN! 🎉</div>
                <div style="font-size: 14px; font-weight: bold; color: #000;">${randomWinner.name}</div>
                <div style="font-size: 16px; color: #ff0000; font-weight: bold;">${randomWinner.amount}</div>
                <div style="font-size: 11px; color: #000;">${randomWinner.game}</div>
            `;
            
            document.body.appendChild(notification);
            
            // Remove after animation
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 4500);
        }
        
        // Create demo slot win animation
        function animateDemoSlot() {
            const symbols = ['🍒', '🍋', '🍊', '⭐', '💎', '👑', '🔥'];
            const demoSlot = document.querySelector('.slot-win-demo .slot-symbols');
            
            if (demoSlot) {
                const symbolElements = demoSlot.querySelectorAll('.slot-symbol');
                
                // Random symbols for few seconds
                let spinCount = 0;
                const spinInterval = setInterval(() => {
                    symbolElements.forEach(symbol => {
                        symbol.textContent = symbols[Math.floor(Math.random() * symbols.length)];
                    });
                    spinCount++;
                    
                    if (spinCount >= 10) {
                        clearInterval(spinInterval);
                        // Show winning combination
                        const winSymbol = symbols[Math.floor(Math.random() * symbols.length)];
                        symbolElements.forEach(symbol => {
                            symbol.textContent = winSymbol;
                        });
                        
                        // Update win text
                        const winText = document.querySelector('.demo-win-text');
                        const amounts = ['Rp 5.000.000', 'Rp 10.000.000', 'Rp 25.000.000', 'Rp 50.000.000'];
                        const randomAmount = amounts[Math.floor(Math.random() * amounts.length)];
                        winText.innerHTML = `MEGA WIN!<br><span style="color: #00ff00;">${randomAmount}</span>`;
                    }
                }, 200);
            }
        }
        
        // Update jackpot ticker
        function updateJackpotTicker() {
            const ticker = document.querySelector('.jackpot-ticker');
            const players = ['Ahmad****', 'Budi****', 'Sari****', 'Rizki****', 'Dina****'];
            const amounts = ['250.000.000', '500.000.000', '750.000.000', '1.000.000.000'];
            
            if (ticker) {
                const randomPlayer = players[Math.floor(Math.random() * players.length)];
                const randomAmount = amounts[Math.floor(Math.random() * amounts.length)];
                
                ticker.innerHTML = `
                    <div class="ticker-close-btn" onclick="closeJackpotTicker()">
                        <i class="fas fa-times"></i>
                    </div>
                    <span class="blink">🚨 JACKPOT ALERT! 🚨</span>
                    &nbsp;&nbsp;
                    <span>Player "${randomPlayer}" just won Rp ${randomAmount}!</span>
                    &nbsp;&nbsp;
                    <span class="blink">🔥 YOUR TURN NEXT! 🔥</span>
                `;
            }
        }

        // Function to close sidebar promo
        function closeSidebarPromo() {
            const sidebar = document.getElementById('sidebarPromo');
            sidebar.style.transform = 'translateX(100%)';
            setTimeout(() => {
                sidebar.style.display = 'none';
            }, 300);
            localStorage.setItem('sidebarPromoClosed', 'true');
        }

        // Function to close demo slot
        function closeSlotDemo() {
            const slotDemo = document.getElementById('slotDemo');
            slotDemo.style.transform = 'translateY(100%)';
            setTimeout(() => {
                slotDemo.style.display = 'none';
            }, 300);
            localStorage.setItem('slotDemoClosed', 'true');
        }

        // Function to close jackpot ticker
        function closeJackpotTicker() {
            const ticker = document.getElementById('jackpotTicker');
            ticker.style.transform = 'translateY(-100%)';
            setTimeout(() => {
                ticker.style.display = 'none';
            }, 300);
            localStorage.setItem('jackpotTickerClosed', 'true');
        }

        // Check for closed ads on page load
        function checkClosedAds() {
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
        }

        document.addEventListener('DOMContentLoaded', function() {
            animateJackpot();
            checkSidebarPromo();
            checkClosedAds(); // This function is now in ad-closer.js
            
            // Start win notifications every 8 seconds
            setInterval(createWinNotification, 8000);
            
            // Animate demo slot every 15 seconds
            setInterval(animateDemoSlot, 15000);
            animateDemoSlot(); // Initial animation
            
            // Update ticker every 12 seconds
            setInterval(updateJackpotTicker, 12000);
        });
    </script>
    
    @yield('scripts')
    <!-- Load JavaScript files in correct order -->
    <script src="{{ asset('js/roulette.js') }}"></script>
    <script src="{{ asset('js/ad-closer.js') }}"></script>
</body>
</html>