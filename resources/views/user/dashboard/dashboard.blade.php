<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BizNest - Business Media Hub</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #0a0f0a 0%, #1a2f1a 50%, #0f1f0f 100%);
            color: white;
            overflow-x: hidden;
            position: relative;
        }

		/* Animated Background Particles */
		.bg-particles {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			pointer-events: none;
			z-index: 0;
		}

		.particle {
			position: absolute;
			background: rgba(127, 176, 105, 0.1);
			border-radius: 50%;
			animation: float 6s ease-in-out infinite;
		}

		@keyframes float {
			0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.3; }
			50% { transform: translateY(-20px) rotate(180deg); opacity: 0.8; }
		}

		/* Pulse Animation for Engagement */
		@keyframes pulse {
			0% { transform: scale(1); }
			50% { transform: scale(1.05); }
			100% { transform: scale(1); }
		}

		@keyframes slideInUp {
			from {
				opacity: 0;
				transform: translateY(30px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		@keyframes bounceIn {
			0% {
				opacity: 0;
				transform: scale(0.3);
			}
			50% {
				opacity: 1;
				transform: scale(1.05);
			}
			70% {
				transform: scale(0.9);
			}
			100% {
				opacity: 1;
				transform: scale(1);
			}
		}

		@keyframes shimmer {
			0% { background-position: -200px 0; }
			100% { background-position: calc(200px + 100%) 0; }
		}

		.container {
			display: flex;
			min-height: 100vh;
			position: relative;
			z-index: 1;
		}

		/* Modern Redesigned Sidebar */
		.sidebar {
			width: 280px;
			height: 100vh;
			background: linear-gradient(180deg, 
				rgba(20, 25, 30, 0.95) 0%,
				rgba(15, 20, 25, 0.98) 50%,
				rgba(10, 15, 20, 0.99) 100%
			);
			backdrop-filter: blur(40px);
			border-right: 1px solid rgba(127, 176, 105, 0.2);
			position: fixed;
			left: 0;
			top: 0;
			z-index: 1000;
			overflow-y: auto;
			overflow-x: hidden;
			transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
			display: flex;
			flex-direction: column;
			box-shadow: 
				0 0 50px rgba(127, 176, 105, 0.1),
				inset 1px 0 0 rgba(127, 176, 105, 0.1);
		}

		/* Hide Scrollbar */
		.sidebar::-webkit-scrollbar {
			width: 0px;
			background: transparent;
		}

		.sidebar::-webkit-scrollbar-track {
			background: transparent;
		}

		.sidebar::-webkit-scrollbar-thumb {
			background: transparent;
		}

		/* For Firefox */
		.sidebar {
			scrollbar-width: none;
		}

		/* Modern Sidebar Profile Section */
		.sidebar-profile {
			padding: 30px 20px;
			border-bottom: 1px solid rgba(127, 176, 105, 0.15);
			position: relative;
			background: linear-gradient(135deg, 
				rgba(127, 176, 105, 0.08) 0%,
				rgba(127, 176, 105, 0.03) 100%
			);
		}

		.sidebar-profile::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background: linear-gradient(
				45deg,
				transparent 30%,
				rgba(127, 176, 105, 0.05) 50%,
				transparent 70%
			);
			background-size: 200% 200%;
			animation: profileShimmer 8s ease-in-out infinite;
			pointer-events: none;
		}

		@keyframes profileShimmer {
			0%, 100% {
				background-position: -100% -100%;
				opacity: 0.3;
			}
			50% {
				background-position: 100% 100%;
				opacity: 0.7;
			}
		}

		.profile-header {
			display: flex;
			flex-direction: column;
			align-items: center;
			gap: 15px;
			margin-bottom: 20px;
			position: relative;
			z-index: 2;
		}

		.user-avatar.large {
			width: 70px;
			height: 70px;
			border-radius: 50%;
			overflow: hidden;
			border: 3px solid rgba(127, 176, 105, 0.6);
			transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
			position: relative;
			box-shadow: 
				0 8px 25px rgba(127, 176, 105, 0.3),
				inset 0 2px 0 rgba(255, 255, 255, 0.2);
		}

		.user-avatar.large::before {
			content: '';
			position: absolute;
			top: -3px;
			left: -3px;
			right: -3px;
			bottom: -3px;
			border-radius: 50%;
			background: linear-gradient(
				45deg,
				rgba(127, 176, 105, 0.8),
				rgba(255, 255, 255, 0.3),
				rgba(127, 176, 105, 0.8)
			);
			background-size: 200% 200%;
			animation: avatarPulse 4s ease-in-out infinite;
			z-index: -1;
		}

		@keyframes avatarPulse {
			0%, 100% {
				background-position: 0% 0%;
				opacity: 0.6;
				transform: scale(1);
			}
			50% {
				background-position: 100% 100%;
				opacity: 1;
				transform: scale(1.05);
			}
		}

		.user-avatar.large:hover {
			border-color: #7fb069;
			transform: scale(1.1);
			box-shadow: 
				0 12px 35px rgba(127, 176, 105, 0.5),
				inset 0 2px 0 rgba(255, 255, 255, 0.3);
		}

		.profile-info {
			text-align: center;
		}

		.profile-info h3 {
			color: white;
			font-size: 18px;
			font-weight: 700;
			margin: 0 0 8px 0;
			text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
		}

		.user-role {
			color: rgba(127, 176, 105, 0.9);
			font-size: 14px;
			margin: 0 0 15px 0;
			font-weight: 500;
		}

		.profile-stats {
			display: flex;
			justify-content: center;
			gap: 20px;
		}

		.stat-item {
			display: flex;
			flex-direction: column;
			align-items: center;
			gap: 5px;
			color: rgba(255, 255, 255, 0.9);
			font-size: 12px;
			font-weight: 600;
			transition: all 0.3s ease;
		}

		.stat-item:hover {
			color: #7fb069;
			transform: translateY(-2px);
		}

		.stat-item .stat-number {
			font-size: 16px;
			font-weight: 700;
			color: #7fb069;
		}

		/* Modern Navigation Design */
		.sidebar-nav {
			flex: 1;
			padding: 20px 0;
		}

		.nav-section {
			margin-bottom: 35px;
		}

		.nav-section-title {
			color: rgba(127, 176, 105, 0.7);
			font-size: 11px;
			font-weight: 800;
			text-transform: uppercase;
			letter-spacing: 2px;
			margin: 0 0 20px 25px;
			position: relative;
		}

		.nav-section-title::after {
			content: '';
			position: absolute;
			bottom: -8px;
			left: 0;
			width: 30px;
			height: 2px;
			background: linear-gradient(90deg, #7fb069, transparent);
			border-radius: 1px;
		}

		.nav-menu {
			list-style: none;
			padding: 0;
			margin: 0;
		}

		.nav-item {
			position: relative;
			margin-bottom: 8px;
		}

		.nav-link {
			display: flex;
			align-items: center;
			padding: 15px 25px;
			color: rgba(255, 255, 255, 0.7);
			text-decoration: none;
			transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
			position: relative;
			overflow: hidden;
			border-radius: 0 25px 25px 0;
			margin-right: 15px;
		}

		.nav-link::before {
			content: '';
			position: absolute;
			left: 0;
			top: 0;
			bottom: 0;
			width: 0;
			background: linear-gradient(135deg, 
				rgba(127, 176, 105, 0.2) 0%,
				rgba(127, 176, 105, 0.1) 100%
			);
			transition: width 0.4s ease;
			z-index: 0;
		}

		.nav-link::after {
			content: '';
			position: absolute;
			left: 0;
			top: 50%;
			transform: translateY(-50%);
			width: 0;
			height: 0;
			background: #7fb069;
			border-radius: 0 2px 2px 0;
			transition: all 0.4s ease;
		}

		.nav-link:hover::before,
		.nav-item.active .nav-link::before {
			width: 100%;
		}

		.nav-link:hover::after,
		.nav-item.active .nav-link::after {
			width: 4px;
			height: 60%;
		}

		.nav-link:hover,
		.nav-item.active .nav-link {
			color: white;
			background: rgba(127, 176, 105, 0.1);
			transform: translateX(8px);
			box-shadow: 0 8px 25px rgba(127, 176, 105, 0.2);
		}

		.nav-icon {
			width: 24px;
			height: 24px;
			display: flex;
			align-items: center;
			justify-content: center;
			margin-right: 18px;
			position: relative;
			z-index: 1;
		}

		.nav-icon i {
			font-size: 18px;
			transition: all 0.4s ease;
			filter: drop-shadow(0 0 8px rgba(127, 176, 105, 0.3));
		}

		.nav-item.active .nav-icon i,
		.nav-link:hover .nav-icon i {
			color: #7fb069;
			transform: scale(1.2);
			filter: drop-shadow(0 0 15px rgba(127, 176, 105, 0.6));
		}

		.nav-text {
			flex: 1;
			font-size: 15px;
			font-weight: 600;
			position: relative;
			z-index: 1;
			text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
		}

		/* Enhanced Navigation Badges */
		.nav-badge {
			background: linear-gradient(135deg, #ef4444, #dc2626);
			color: white;
			font-size: 10px;
			font-weight: 700;
			padding: 4px 8px;
			border-radius: 12px;
			min-width: 20px;
			text-align: center;
			position: relative;
			z-index: 1;
			box-shadow: 
				0 2px 8px rgba(239, 68, 68, 0.4),
				0 0 15px rgba(239, 68, 68, 0.3);
			border: 1px solid rgba(255, 255, 255, 0.2);
		}

		.nav-badge.urgent {
			animation: badgePulse 2s ease-in-out infinite;
		}

		.nav-badge.new {
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			box-shadow: 
				0 2px 8px rgba(127, 176, 105, 0.4),
				0 0 15px rgba(127, 176, 105, 0.3);
		}

		@keyframes badgePulse {
			0%, 100% {
				transform: scale(1);
				box-shadow: 
					0 2px 8px rgba(239, 68, 68, 0.4),
					0 0 15px rgba(239, 68, 68, 0.3);
			}
			50% {
				transform: scale(1.1);
				box-shadow: 
					0 4px 12px rgba(239, 68, 68, 0.6),
					0 0 25px rgba(239, 68, 68, 0.5);
			}
		}

		/* Sidebar Toggle */
		.sidebar-toggle {
			position: absolute;
			right: -15px;
			top: 50%;
			transform: translateY(-50%);
			width: 30px;
			height: 30px;
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			border: none;
			border-radius: 50%;
			color: white;
			cursor: pointer;
			transition: all 0.3s ease;
			display: flex;
			align-items: center;
			justify-content: center;
			box-shadow: 0 4px 12px rgba(127, 176, 105, 0.3);
		}

		.sidebar-toggle:hover {
			transform: translateY(-50%) scale(1.1);
			box-shadow: 0 6px 20px rgba(127, 176, 105, 0.4);
		}

		.sidebar-toggle i {
			font-size: 12px;
			transition: transform 0.3s ease;
		}

		/* Sidebar Collapsed State */
		.sidebar.collapsed {
			width: 80px;
		}

		.sidebar.collapsed .profile-info,
		.sidebar.collapsed .nav-text,
		.sidebar.collapsed .nav-badge,
		.sidebar.collapsed .section-title,
		.sidebar.collapsed .quick-actions-grid,
		.sidebar.collapsed .sidebar-recent,
		.sidebar.collapsed .sidebar-footer {
			display: none;
		}

		.sidebar.collapsed .profile-header {
			justify-content: center;
		}

		.sidebar.collapsed .nav-link {
			justify-content: center;
			padding: 12px 0;
		}

		.sidebar.collapsed .nav-icon {
			margin-right: 0;
		}

		.sidebar.collapsed .sidebar-toggle i {
			transform: rotate(180deg);
		}

		/* Pulse Animation */
		@keyframes pulse {
			0% {
				box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
			}
			70% {
				box-shadow: 0 0 0 10px rgba(239, 68, 68, 0);
			}
			100% {
				box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
			}
		}

		/* Responsive Design */
		@media (max-width: 1024px) {
			.sidebar {
				width: 280px;
			}
		}

		@media (max-width: 768px) {
			.sidebar {
				width: 100%;
				transform: translateX(-100%);
			}

			.sidebar.open {
				transform: translateX(0);
			}

			.sidebar-toggle {
				display: none;
			}
		}

		/* Enhanced User Profile Section */
		.user-profile {
			background: linear-gradient(135deg, rgba(127, 176, 105, 0.15), rgba(90, 138, 74, 0.15));
			border-radius: 20px;
			padding: 20px;
			margin-bottom: 30px;
			border: 1px solid rgba(127, 176, 105, 0.2);
			position: relative;
			overflow: hidden;
		}

		.user-profile::before {
			content: '';
			position: absolute;
			top: 0;
			left: -100%;
			width: 100%;
			height: 100%;
			background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
			animation: shimmer 2s infinite;
		}

		.user-avatar {
			width: 50px;
			height: 50px;
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 20px;
			font-weight: bold;
			color: white;
			margin-bottom: 15px;
			border: 3px solid rgba(255, 255, 255, 0.2);
			transition: all 0.3s ease;
			cursor: pointer;
		}

		.user-avatar:hover {
			transform: scale(1.1);
			box-shadow: 0 0 20px rgba(127, 176, 105, 0.5);
		}

		.user-info h3 {
			margin-bottom: 5px;
			font-size: 18px;
			font-weight: 600;
		}

		.user-status {
			color: rgba(255, 255, 255, 0.7);
			font-size: 14px;
			display: flex;
			align-items: center;
			gap: 8px;
		}

		.online-indicator {
			width: 8px;
			height: 8px;
			background: #10b981;
			border-radius: 50%;
			animation: pulse 1.5s infinite;
		}

		/* Enhanced Navigation */
		.nav-tabs {
			margin-bottom: 30px;
		}

		.nav-tab {
			display: flex;
			align-items: center;
			gap: 15px;
			padding: 15px 20px;
			margin-bottom: 8px;
			background: rgba(255, 255, 255, 0.05);
			border: 1px solid rgba(255, 255, 255, 0.1);
			border-radius: 15px;
			color: rgba(255, 255, 255, 0.8);
			text-decoration: none;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			cursor: pointer;
			position: relative;
			overflow: hidden;
		}

		.nav-tab::before {
			content: '';
			position: absolute;
			top: 0;
			left: -100%;
			width: 100%;
			height: 100%;
			background: linear-gradient(90deg, transparent, rgba(127, 176, 105, 0.1), transparent);
			transition: left 0.5s ease;
		}

		.nav-tab:hover::before {
			left: 100%;
		}

		.nav-tab:hover {
			background: rgba(127, 176, 105, 0.15);
			border-color: rgba(127, 176, 105, 0.3);
			transform: translateX(5px);
			box-shadow: 0 5px 15px rgba(127, 176, 105, 0.2);
		}

		.nav-tab.active {
			background: linear-gradient(135deg, rgba(127, 176, 105, 0.25), rgba(90, 138, 74, 0.25));
			border-color: #7fb069;
			color: #7fb069;
			transform: translateX(8px);
			box-shadow: 0 8px 25px rgba(127, 176, 105, 0.3);
		}

		.nav-tab i {
			font-size: 18px;
			width: 20px;
			transition: all 0.3s ease;
		}

		.nav-tab:hover i {
			transform: scale(1.2);
		}

		.nav-tab.active i {
			color: #7fb069;
			animation: bounceIn 0.6s ease;
		}

		/* Notification Badge */
		.notification-badge {
			position: absolute;
			top: -5px;
			right: -5px;
			background: linear-gradient(135deg, #ef4444, #dc2626);
			color: white;
			border-radius: 50%;
			width: 20px;
			height: 20px;
			font-size: 11px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-weight: bold;
			animation: pulse 1.5s infinite;
		}

		/* Quick Actions */
		.quick-actions {
			margin-bottom: 30px;
		}

		.quick-actions h4 {
			margin-bottom: 15px;
			color: rgba(255, 255, 255, 0.9);
			font-size: 16px;
			font-weight: 600;
		}

		.action-grid {
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 10px;
		}

		.action-btn {
			padding: 12px;
			background: linear-gradient(135deg, rgba(127, 176, 105, 0.1), rgba(90, 138, 74, 0.1));
			border: 1px solid rgba(127, 176, 105, 0.2);
			border-radius: 12px;
			color: rgba(255, 255, 255, 0.8);
			cursor: pointer;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			text-align: center;
			font-size: 12px;
			position: relative;
			overflow: hidden;
		}

		.action-btn::before {
			content: '';
			position: absolute;
			top: 50%;
			left: 50%;
			width: 0;
			height: 0;
			background: rgba(127, 176, 105, 0.2);
			border-radius: 50%;
			transform: translate(-50%, -50%);
			transition: all 0.4s ease;
		}

		.action-btn:hover::before {
			width: 200px;
			height: 200px;
		}

		.action-btn:hover {
			transform: translateY(-3px);
			box-shadow: 0 8px 25px rgba(127, 176, 105, 0.3);
		}

		.action-btn i {
			display: block;
			font-size: 16px;
			margin-bottom: 5px;
			position: relative;
			z-index: 1;
		}

		.action-btn span {
			position: relative;
			z-index: 1;
		}

		/* Main Content Area */
		.main-content {
			flex: 1;
			margin-left: 280px;
			padding: 30px;
			position: relative;
		}

		.tab-content {
			display: none;
			animation: slideInUp 0.5s ease-out;
		}

		.tab-content.active {
			display: block;
		}

		/* Enhanced Content Header */
		.content-header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 30px;
			padding: 25px;
			background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
			border-radius: 20px;
			backdrop-filter: blur(25px);
			border: 1px solid rgba(255, 255, 255, 0.15);
			position: relative;
			overflow: hidden;
		}

		.content-header::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 2px;
			background: linear-gradient(90deg, #7fb069, #5a8a4a, #7fb069);
			animation: shimmer 2s infinite;
		}

		.content-header h1 {
			font-size: 32px;
			font-weight: 700;
			margin: 0 0 8px 0;
			background: linear-gradient(135deg, #ffffff, #7fb069);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			background-clip: text;
		}

		.content-header p {
			color: rgba(255, 255, 255, 0.7);
			font-size: 16px;
		}

		/* Enhanced Search Section */
		.search-section {
			margin-bottom: 30px;
			position: relative;
		}

		.search-container {
			position: relative;
			max-width: 600px;
		}

		.search-input {
			width: 100%;
			padding: 18px 25px 18px 55px;
			background: rgba(255, 255, 255, 0.1);
			border: 2px solid rgba(255, 255, 255, 0.15);
			border-radius: 25px;
			color: white;
			font-size: 16px;
			outline: none;
			transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
			backdrop-filter: blur(20px);
		}

		.search-input:focus {
			border-color: #7fb069;
			box-shadow: 0 0 0 4px rgba(127, 176, 105, 0.15);
			transform: translateY(-2px);
		}

		.search-input::placeholder {
			color: rgba(255, 255, 255, 0.5);
		}

		.search-icon {
			position: absolute;
			left: 20px;
			top: 50%;
			transform: translateY(-50%);
			color: rgba(255, 255, 255, 0.6);
			font-size: 18px;
			transition: all 0.3s ease;
		}

		.search-input:focus + .search-icon {
			color: #7fb069;
			transform: translateY(-50%) scale(1.1);
		}

		/* Category Filters */
		.category-filters {
			display: flex;
			gap: 12px;
			margin-top: 20px;
			flex-wrap: wrap;
		}

		.category-btn {
			padding: 10px 20px;
			background: rgba(255, 255, 255, 0.08);
			border: 1px solid rgba(255, 255, 255, 0.15);
			border-radius: 25px;
			color: rgba(255, 255, 255, 0.8);
			cursor: pointer;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			font-size: 14px;
			font-weight: 500;
			position: relative;
			overflow: hidden;
		}

		.category-btn::before {
			content: '';
			position: absolute;
			top: 0;
			left: -100%;
			width: 100%;
			height: 100%;
			background: linear-gradient(90deg, transparent, rgba(127, 176, 105, 0.2), transparent);
			transition: left 0.5s ease;
		}

		.category-btn:hover::before {
			left: 100%;
		}

		.category-btn:hover {
			background: rgba(127, 176, 105, 0.15);
			border-color: rgba(127, 176, 105, 0.3);
			transform: translateY(-2px);
			box-shadow: 0 5px 15px rgba(127, 176, 105, 0.2);
		}

		.category-btn.active {
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			border-color: #7fb069;
			color: white;
			transform: translateY(-2px);
			box-shadow: 0 8px 25px rgba(127, 176, 105, 0.4);
		}

		.share-btn:hover {
			transform: translateY(-2px);
			box-shadow: 0 5px 15px rgba(127, 176, 105, 0.3);
		}

		/* Enhanced Notification Styles */
		.notification-filters {
			display: flex;
			gap: 12px;
			margin-bottom: 25px;
			align-items: center;
			flex-wrap: wrap;
		}

		.filter-btn {
			padding: 10px 20px;
			background: rgba(255, 255, 255, 0.08);
			border: 1px solid rgba(255, 255, 255, 0.15);
			border-radius: 25px;
			color: rgba(255, 255, 255, 0.8);
			cursor: pointer;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			font-size: 14px;
			font-weight: 500;
			position: relative;
			overflow: hidden;
		}

		.filter-btn::before {
			content: '';
			position: absolute;
			top: 0;
			left: -100%;
			width: 100%;
			height: 100%;
			background: linear-gradient(90deg, transparent, rgba(127, 176, 105, 0.2), transparent);
			transition: left 0.5s ease;
		}

		.filter-btn:hover::before {
			left: 100%;
		}

		.filter-btn.active {
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			color: white;
			border-color: #7fb069;
			transform: translateY(-2px);
			box-shadow: 0 8px 25px rgba(127, 176, 105, 0.4);
		}

		.filter-btn:hover {
			background: rgba(127, 176, 105, 0.15);
			border-color: rgba(127, 176, 105, 0.3);
			transform: translateY(-2px);
		}

		.mark-all-read-btn {
			padding: 10px 20px;
			background: rgba(255, 255, 255, 0.08);
			border: 1px solid rgba(255, 255, 255, 0.15);
			border-radius: 25px;
			color: rgba(255, 255, 255, 0.8);
			cursor: pointer;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			font-size: 14px;
			font-weight: 500;
			margin-left: auto;
		}

		.mark-all-read-btn:hover {
			background: rgba(127, 176, 105, 0.15);
			border-color: rgba(127, 176, 105, 0.3);
			transform: translateY(-2px);
		}

		.notifications-list {
			display: flex;
			flex-direction: column;
			gap: 20px;
		}

		.notification-card {
			background: linear-gradient(135deg, rgba(255, 255, 255, 0.12), rgba(255, 255, 255, 0.08));
			border-radius: 20px;
			padding: 25px;
			backdrop-filter: blur(25px);
			border: 1px solid rgba(255, 255, 255, 0.15);
			display: flex;
			align-items: flex-start;
			gap: 20px;
			position: relative;
			transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
			overflow: hidden;
		}

		.notification-card::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 2px;
			background: linear-gradient(90deg, transparent, #7fb069, transparent);
			transform: scaleX(0);
			transition: transform 0.4s ease;
		}

		.notification-card.unread {
			border-left: 4px solid #7fb069;
			background: linear-gradient(135deg, rgba(127, 176, 105, 0.15), rgba(127, 176, 105, 0.08));
			animation: notificationPulse 2s infinite;
		}

		@keyframes notificationPulse {
			0%, 100% { box-shadow: 0 0 0 0 rgba(127, 176, 105, 0.4); }
			50% { box-shadow: 0 0 0 10px rgba(127, 176, 105, 0); }
		}

		.notification-card:hover::before {
			transform: scaleX(1);
		}

		.notification-card:hover {
			transform: translateY(-5px) scale(1.02);
			box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
			border-color: rgba(127, 176, 105, 0.4);
		}

		.mark-read-btn {
			position: absolute;
			top: 15px;
			right: 15px;
			background: rgba(255, 255, 255, 0.1);
			border: none;
			border-radius: 50%;
			width: 30px;
			height: 30px;
			cursor: pointer;
			color: rgba(255, 255, 255, 0.6);
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.mark-read-btn:hover {
			background: #ef4444;
			color: white;
			transform: scale(1.1);
		}

		.notification-icon {
			width: 50px;
			height: 50px;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 20px;
			position: relative;
			overflow: hidden;
		}

		.notification-icon::after {
			content: '';
			position: absolute;
			top: -50%;
			left: -50%;
			width: 200%;
			height: 200%;
			background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
			animation: iconShine 3s infinite;
		}

		@keyframes iconShine {
			0% { transform: translateX(-100%) skewX(-45deg); }
			100% { transform: translateX(200%) skewX(-45deg); }
		}

		.notification-icon.message {
			background: linear-gradient(135deg, #3b82f6, #1e40af);
		}

		.notification-icon.business {
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
		}

		.notification-icon.system {
			background: linear-gradient(135deg, #f59e0b, #d97706);
		}

		.notification-content {
			flex: 1;
		}

		.notification-title {
			font-weight: 700;
			margin-bottom: 8px;
			color: white;
			font-size: 16px;
		}

		.notification-text {
			color: rgba(255, 255, 255, 0.8);
			font-size: 14px;
			line-height: 1.5;
			margin-bottom: 8px;
		}

		.notification-time {
			color: rgba(255, 255, 255, 0.6);
			font-size: 12px;
			font-weight: 500;
		}

		/* Enhanced Profile Styles */
		.profile-content {
			display: flex;
			flex-direction: column;
			gap: 25px;
		}

		.profile-overview-card {
			background: linear-gradient(135deg, rgba(255, 255, 255, 0.12), rgba(255, 255, 255, 0.08));
			border-radius: 25px;
			backdrop-filter: blur(25px);
			border: 1px solid rgba(255, 255, 255, 0.15);
			overflow: hidden;
			position: relative;
		}

		.profile-cover {
			height: 200px;
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			position: relative;
			display: flex;
			align-items: center;
			justify-content: center;
			overflow: hidden;
		}

		.profile-cover::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
			animation: coverShine 4s infinite;
		}

		@keyframes coverShine {
			0% { transform: translateX(-100%) skewX(-45deg); }
			100% { transform: translateX(200%) skewX(-45deg); }
		}

		.edit-cover-btn {
			background: rgba(0, 0, 0, 0.6);
			border: none;
			color: white;
			padding: 12px 20px;
			border-radius: 25px;
			cursor: pointer;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			font-weight: 500;
			backdrop-filter: blur(10px);
		}

		.edit-cover-btn:hover {
			background: rgba(0, 0, 0, 0.8);
			transform: translateY(-2px);
		}

		.profile-info {
			padding: 30px;
			display: flex;
			gap: 25px;
			align-items: flex-start;
		}

		.profile-avatar-section {
			position: relative;
		}

		.profile-avatar.large {
			width: 100px;
			height: 100px;
			font-size: 40px;
			margin-top: -50px;
			border: 4px solid rgba(255, 255, 255, 0.2);
			position: relative;
			overflow: hidden;
		}

		.profile-avatar.large::after {
			content: '';
			position: absolute;
			top: -50%;
			left: -50%;
			width: 200%;
			height: 200%;
			background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
			transform: rotate(45deg);
			animation: avatarShine 3s infinite;
		}

		@keyframes avatarShine {
			0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
			50% { transform: translateX(100%) translateY(100%) rotate(45deg); }
			100% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
		}

		.edit-avatar-btn {
			position: absolute;
			bottom: 5px;
			right: 5px;
			background: #7fb069;
			border: none;
			color: white;
			width: 32px;
			height: 32px;
			border-radius: 50%;
			cursor: pointer;
			font-size: 14px;
			transition: all 0.3s ease;
		}

		.edit-avatar-btn:hover {
			transform: scale(1.1);
			box-shadow: 0 5px 15px rgba(127, 176, 105, 0.4);
		}

		.profile-details h2 {
			margin: 0 0 8px 0;
			color: white;
			font-size: 28px;
			font-weight: 700;
		}

		.profile-title {
			color: rgba(255, 255, 255, 0.8);
			margin: 0 0 12px 0;
			font-size: 16px;
			font-weight: 500;
		}

		.profile-location {
			color: rgba(255, 255, 255, 0.6);
			margin: 0 0 20px 0;
			font-size: 14px;
			display: flex;
			align-items: center;
			gap: 8px;
		}

		.profile-stats {
			display: flex;
			gap: 40px;
		}

		.stat {
			text-align: center;
			cursor: pointer;
			transition: all 0.3s ease;
		}

		.stat:hover {
			transform: translateY(-2px);
		}

		.stat-number {
			display: block;
			font-size: 24px;
			font-weight: 700;
			color: white;
			margin-bottom: 4px;
		}

		.stat-label {
			font-size: 12px;
			color: rgba(255, 255, 255, 0.6);
			font-weight: 500;
		}

		.profile-sections {
			display: flex;
			flex-direction: column;
			gap: 25px;
		}

		.profile-section {
			background: linear-gradient(135deg, rgba(255, 255, 255, 0.12), rgba(255, 255, 255, 0.08));
			border-radius: 20px;
			padding: 25px;
			backdrop-filter: blur(25px);
			border: 1px solid rgba(255, 255, 255, 0.15);
			position: relative;
			overflow: hidden;
		}

		.profile-section::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 2px;
			background: linear-gradient(90deg, transparent, #7fb069, transparent);
			transform: scaleX(0);
			transition: transform 0.4s ease;
		}

		.profile-section:hover::before {
			transform: scaleX(1);
		}

		.section-header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 25px;
		}

		.section-header h3 {
			margin: 0;
			color: white;
			font-size: 20px;
			font-weight: 700;
		}

		.edit-section-btn {
			background: rgba(255, 255, 255, 0.1);
			border: 1px solid rgba(255, 255, 255, 0.2);
			color: rgba(255, 255, 255, 0.8);
			padding: 8px 16px;
			border-radius: 10px;
			cursor: pointer;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			font-size: 14px;
			font-weight: 500;
		}

		.edit-section-btn:hover {
			background: rgba(127, 176, 105, 0.2);
			border-color: rgba(127, 176, 105, 0.4);
			transform: translateY(-2px);
		}

		.info-grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
			gap: 20px;
		}

		.info-item {
			display: flex;
			flex-direction: column;
			gap: 8px;
		}

		.info-item.full-width {
			grid-column: 1 / -1;
		}

		.info-item label {
			font-size: 12px;
			color: rgba(255, 255, 255, 0.6);
			font-weight: 600;
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}

		.info-item span,
		.info-item p {
			color: white;
			margin: 0;
			font-size: 15px;
			font-weight: 500;
		}

		.settings-grid {
			display: flex;
			flex-direction: column;
			gap: 20px;
		}

		.setting-item {
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding: 20px 0;
			border-bottom: 1px solid rgba(255, 255, 255, 0.1);
			transition: all 0.3s ease;
		}

		.setting-item:hover {
			transform: translateX(5px);
		}

		.setting-item:last-child {
			border-bottom: none;
		}

		.setting-info label {
			display: block;
			color: white;
			font-weight: 600;
			margin-bottom: 4px;
			font-size: 16px;
		}

		.setting-info span {
			color: rgba(255, 255, 255, 0.6);
			font-size: 14px;
		}

		.toggle-switch {
			position: relative;
			display: inline-block;
			width: 60px;
			height: 30px;
		}

		.toggle-switch input {
			opacity: 0;
			width: 0;
			height: 0;
		}

		.slider {
			position: absolute;
			cursor: pointer;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: rgba(255, 255, 255, 0.2);
			transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
			border-radius: 30px;
		}

		.slider:before {
			position: absolute;
			content: "";
			height: 24px;
			width: 24px;
			left: 3px;
			bottom: 3px;
			background-color: white;
			transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
			border-radius: 50%;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
		}

		input:checked + .slider {
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
		}

		input:checked + .slider:before {
			transform: translateX(30px);
		}

		.security-actions {
			display: flex;
			flex-direction: column;
			gap: 15px;
		}

		.security-btn {
			display: flex;
			align-items: center;
			gap: 20px;
			padding: 20px;
			background: rgba(255, 255, 255, 0.05);
			border: 1px solid rgba(255, 255, 255, 0.1);
			border-radius: 15px;
			color: white;
			cursor: pointer;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			text-align: left;
			position: relative;
			overflow: hidden;
		}

		.security-btn::before {
			content: '';
			position: absolute;
			top: 0;
			left: -100%;
			width: 100%;
			height: 100%;
			background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
			transition: left 0.5s ease;
		}

		.security-btn:hover::before {
			left: 100%;
		}

		.security-btn:hover {
			background: rgba(255, 255, 255, 0.1);
			border-color: rgba(255, 255, 255, 0.2);
			transform: translateY(-2px);
		}

		.security-btn.danger:hover {
			background: rgba(239, 68, 68, 0.1);
			border-color: #ef4444;
			color: #ef4444;
		}

		.security-btn i {
			font-size: 20px;
			width: 24px;
		}

		.security-btn div span {
			display: block;
			font-weight: 600;
			margin-bottom: 4px;
			font-size: 16px;
		}

		.security-btn div small {
			color: rgba(255, 255, 255, 0.6);
			font-size: 14px;
		}

		/* Responsive Design */
		@media (max-width: 1200px) {
			.main-content {
				margin-left: 280px;
				padding: 20px;
			}
		}

		@media (max-width: 768px) {
			.sidebar {
				width: 100%;
				height: auto;
				position: relative;
				padding: 15px;
			}

			.main-content {
				margin-left: 0;
				padding: 15px;
			}

			.container {
				flex-direction: column;
			}

			.nav-tabs {
				display: flex;
				flex-direction: row;
				overflow-x: auto;
				gap: 10px;
			}

			.nav-tab {
				min-width: 120px;
				text-align: center;
			}

			.business-grid {
				grid-template-columns: 1fr;
			}

			.category-filters {
				justify-content: center;
			}

			.profile-info {
				flex-direction: column;
				text-align: center;
			}

			.profile-stats {
				justify-content: center;
			}

			.info-grid {
				grid-template-columns: 1fr;
			}
		}

		/* Loading Animation */
		.loading {
			display: inline-block;
			width: 20px;
			height: 20px;
			border: 3px solid rgba(255, 255, 255, 0.3);
			border-radius: 50%;
			border-top-color: #7fb069;
			animation: spin 1s ease-in-out infinite;
		}

		@keyframes spin {
			to { transform: rotate(360deg); }
		}

		/* Scroll to Top Button */
		.scroll-to-top {
			position: fixed;
			bottom: 30px;
			right: 30px;
			width: 50px;
			height: 50px;
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			border: none;
			border-radius: 50%;
			color: white;
			cursor: pointer;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			z-index: 1000;
			opacity: 0;
			transform: translateY(100px);
		}

		.scroll-to-top.visible {
			opacity: 1;
			transform: translateY(0);
		}

		.scroll-to-top:hover {
			transform: translateY(-5px);
			box-shadow: 0 10px 25px rgba(127, 176, 105, 0.4);
		}

		/* Facebook-style Newsfeed Styles */
		.facebook-newsfeed {
			max-width: 900px;
			margin: 0 auto;
			padding: 20px 0;
		}

		/* Stories Section */
		.stories-container {
			margin-bottom: 20px;
			background: linear-gradient(135deg, rgba(255, 255, 255, 0.12), rgba(255, 255, 255, 0.08));
			border-radius: 15px;
			padding: 15px;
			backdrop-filter: blur(25px);
			border: 1px solid rgba(255, 255, 255, 0.15);
		}

		.stories-scroll {
			display: flex;
			gap: 12px;
			overflow-x: auto;
			padding-bottom: 5px;
		}

		.stories-scroll::-webkit-scrollbar {
			height: 6px;
		}

		.stories-scroll::-webkit-scrollbar-track {
			background: rgba(255, 255, 255, 0.1);
			border-radius: 3px;
		}

		.stories-scroll::-webkit-scrollbar-thumb {
			background: rgba(127, 176, 105, 0.6);
			border-radius: 3px;
		}

		.story-card {
			min-width: 110px;
			height: 160px;
			border-radius: 15px;
			overflow: hidden;
			cursor: pointer;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			position: relative;
		}

		.story-card:hover {
			transform: translateY(-5px) scale(1.02);
			box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
		}

		.story-image {
			width: 100%;
			height: 100%;
			position: relative;
			display: flex;
			align-items: center;
			justify-content: center;
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
		}

		.create-story .story-image {
			background: rgba(255, 255, 255, 0.1);
			border: 2px dashed rgba(255, 255, 255, 0.3);
		}

		.story-avatar {
			width: 40px;
			height: 40px;
			border-radius: 50%;
			background: rgba(255, 255, 255, 0.2);
			display: flex;
			align-items: center;
			justify-content: center;
			color: white;
			font-weight: bold;
			font-size: 16px;
			border: 3px solid #7fb069;
			position: absolute;
			top: 10px;
			left: 10px;
		}

		.story-overlay {
			position: absolute;
			bottom: 0;
			left: 0;
			right: 0;
			background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
			padding: 15px 10px 10px;
			display: flex;
			flex-direction: column;
			align-items: center;
			gap: 5px;
		}

		.story-overlay i {
			background: #7fb069;
			width: 30px;
			height: 30px;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 14px;
		}

		.story-name {
			position: absolute;
			bottom: 8px;
			left: 8px;
			right: 8px;
			color: white;
			font-size: 12px;
			font-weight: 600;
			text-align: center;
			text-shadow: 0 1px 3px rgba(0, 0, 0, 0.8);
		}

		/* Post Creation Box */
		.post-creation-box {
			background: linear-gradient(135deg, rgba(255, 255, 255, 0.12), rgba(255, 255, 255, 0.08));
			border-radius: 15px;
			padding: 20px;
			margin-bottom: 20px;
			backdrop-filter: blur(25px);
			border: 1px solid rgba(255, 255, 255, 0.15);
		}

		.post-creation-header {
			display: flex;
			align-items: center;
			gap: 15px;
			margin-bottom: 15px;
		}

		.post-input {
			flex: 1;
			background: rgba(255, 255, 255, 0.1);
			border: 1px solid rgba(255, 255, 255, 0.2);
			border-radius: 25px;
			padding: 12px 20px;
			color: white;
			font-size: 16px;
			transition: all 0.3s ease;
		}

		.post-input::placeholder {
			color: rgba(255, 255, 255, 0.6);
		}

		.post-input:focus {
			outline: none;
			border-color: #7fb069;
			background: rgba(255, 255, 255, 0.15);
			transform: scale(1.01);
		}

		.post-creation-actions {
			display: flex;
			justify-content: space-between;
			gap: 10px;
		}

		.creation-action-btn {
			flex: 1;
			background: rgba(255, 255, 255, 0.05);
			border: 1px solid rgba(255, 255, 255, 0.1);
			border-radius: 10px;
			padding: 12px 8px;
			color: rgba(255, 255, 255, 0.8);
			cursor: pointer;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 8px;
			font-size: 14px;
			font-weight: 500;
		}

		.creation-action-btn:hover {
			background: rgba(255, 255, 255, 0.1);
			border-color: rgba(255, 255, 255, 0.2);
			transform: translateY(-2px);
		}

		/* Facebook Posts */
		.posts-feed {
			display: flex;
			flex-direction: column;
			gap: 20px;
		}

		.facebook-post {
			background: linear-gradient(135deg, rgba(255, 255, 255, 0.12), rgba(255, 255, 255, 0.08));
			border-radius: 15px;
			backdrop-filter: blur(25px);
			border: 1px solid rgba(255, 255, 255, 0.15);
			overflow: hidden;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
		}

		.facebook-post:hover {
			transform: translateY(-2px);
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
		}

		.facebook-post.sponsored {
			border: 1px solid rgba(127, 176, 105, 0.3);
		}

		.sponsored-label {
			background: rgba(127, 176, 105, 0.2);
			padding: 8px 15px;
			font-size: 12px;
			color: rgba(255, 255, 255, 0.8);
			display: flex;
			align-items: center;
			gap: 5px;
		}

		.post-header {
			padding: 15px 20px;
			display: flex;
			justify-content: space-between;
			align-items: flex-start;
		}

		.post-user-info {
			display: flex;
			align-items: center;
			gap: 12px;
		}

		.user-details h4 {
			margin: 0;
			color: white;
			font-size: 16px;
			font-weight: 600;
			display: flex;
			align-items: center;
			gap: 5px;
		}

		.verified-badge {
			color: #1877f2;
			font-size: 14px;
		}

		.post-meta {
			color: rgba(255, 255, 255, 0.6);
			font-size: 13px;
			margin-top: 2px;
			display: flex;
			align-items: center;
			gap: 5px;
		}

		.post-options {
			display: flex;
			align-items: center;
		}

		.post-menu-btn {
			background: none;
			border: none;
			color: rgba(255, 255, 255, 0.6);
			cursor: pointer;
			padding: 8px;
			border-radius: 50%;
			transition: all 0.3s ease;
		}

		.post-menu-btn:hover {
			background: rgba(255, 255, 255, 0.1);
			color: white;
		}

		.post-content {
			padding: 0 20px 15px;
		}

		.post-content p {
			margin: 0 0 15px 0;
			color: white;
			line-height: 1.5;
			font-size: 15px;
		}

		.post-media {
			margin: 0 -20px;
			border-radius: 0;
			overflow: hidden;
		}

		.post-media img {
			width: 100%;
			height: auto;
			display: block;
			max-height: 500px;
			object-fit: cover;
		}

		.post-media-grid {
			display: flex;
			gap: 3px;
			margin: 0 -20px;
			height: 400px;
		}

		.media-grid-main {
			flex: 2;
			position: relative;
			overflow: hidden;
		}

		.media-grid-main img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			border-radius: 0;
		}

		.media-grid-side {
			flex: 1;
			display: flex;
			flex-direction: column;
			gap: 3px;
		}

		.media-grid-side img {
			width: 100%;
			height: calc(50% - 1.5px);
			object-fit: cover;
			border-radius: 0;
		}

		.media-more {
			position: relative;
			overflow: hidden;
		}

		.media-overlay {
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background: rgba(0, 0, 0, 0.7);
			display: flex;
			align-items: center;
			justify-content: center;
			color: white;
			font-size: 28px;
			font-weight: bold;
			cursor: pointer;
			transition: all 0.3s ease;
		}

		.media-overlay:hover {
			background: rgba(0, 0, 0, 0.8);
		}

		.post-link-preview {
			border: 1px solid rgba(255, 255, 255, 0.2);
			border-radius: 10px;
			overflow: hidden;
			margin: 0 -20px;
		}

		.link-preview-image img {
			width: 100%;
			height: 250px;
			object-fit: cover;
		}

		.link-preview-content {
			padding: 15px;
		}

		.link-preview-content h4 {
			margin: 0 0 8px 0;
			color: white;
			font-size: 16px;
		}

		.link-preview-content p {
			margin: 0 0 8px 0;
			color: rgba(255, 255, 255, 0.8);
			font-size: 14px;
		}

		.link-domain {
			color: rgba(255, 255, 255, 0.6);
			font-size: 12px;
			text-transform: uppercase;
		}

		.post-reactions {
			padding: 10px 20px;
			display: flex;
			justify-content: space-between;
			align-items: center;
			border-bottom: 1px solid rgba(255, 255, 255, 0.1);
		}

		.reactions-summary {
			display: flex;
			align-items: center;
			gap: 8px;
		}

		.reaction-icons {
			display: flex;
			gap: -2px;
		}

		.reaction-icon {
			width: 20px;
			height: 20px;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 12px;
			border: 2px solid rgba(255, 255, 255, 0.1);
			margin-left: -2px;
		}

		.reaction-count {
			color: rgba(255, 255, 255, 0.8);
			font-size: 14px;
			font-weight: 500;
		}

		.post-stats {
			color: rgba(255, 255, 255, 0.6);
			font-size: 14px;
			display: flex;
			gap: 15px;
		}

		.post-actions {
			padding: 8px 20px;
			display: flex;
			justify-content: space-around;
		}

		.facebook-action-btn {
			flex: 1;
			background: none;
			border: none;
			color: rgba(255, 255, 255, 0.7);
			cursor: pointer;
			padding: 10px;
			border-radius: 8px;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 8px;
			font-size: 15px;
			font-weight: 500;
		}

		.facebook-action-btn:hover {
			background: rgba(255, 255, 255, 0.1);
			color: white;
		}

		.facebook-action-btn.liked {
			color: #1877f2;
		}

		.facebook-action-btn.liked:hover {
			background: rgba(24, 119, 242, 0.1);
		}

		/* Comments Section */
		.comments-section {
			padding: 15px 20px 20px;
			border-top: 1px solid rgba(255, 255, 255, 0.1);
		}

		.comment-input-container {
			display: flex;
			align-items: flex-start;
			gap: 10px;
			margin-bottom: 15px;
		}

		.user-avatar.small {
			width: 32px;
			height: 32px;
			font-size: 14px;
		}

		.comment-input-wrapper {
			flex: 1;
			position: relative;
		}

		.comment-input {
			width: 100%;
			background: rgba(255, 255, 255, 0.1);
			border: 1px solid rgba(255, 255, 255, 0.2);
			border-radius: 20px;
			padding: 10px 50px 10px 15px;
			color: white;
			font-size: 14px;
			resize: none;
		}

		.comment-input::placeholder {
			color: rgba(255, 255, 255, 0.6);
		}

		.comment-input:focus {
			outline: none;
			border-color: #7fb069;
			background: rgba(255, 255, 255, 0.15);
		}

		.comment-actions {
			position: absolute;
			right: 10px;
			top: 50%;
			transform: translateY(-50%);
			display: flex;
			gap: 5px;
		}

		.comment-action {
			background: none;
			border: none;
			color: rgba(255, 255, 255, 0.6);
			cursor: pointer;
			padding: 5px;
			border-radius: 50%;
			transition: all 0.3s ease;
		}

		.comment-action:hover {
			background: rgba(255, 255, 255, 0.1);
			color: white;
		}

		.comments-list {
			display: flex;
			flex-direction: column;
			gap: 12px;
		}

		.comment {
			display: flex;
			align-items: flex-start;
			gap: 10px;
		}

		.comment-content {
			flex: 1;
		}

		.comment-bubble {
			background: rgba(255, 255, 255, 0.1);
			border-radius: 18px;
			padding: 10px 15px;
			margin-bottom: 5px;
		}

		.comment-bubble strong {
			color: white;
			font-size: 13px;
			font-weight: 600;
		}

		.comment-bubble p {
			margin: 2px 0 0 0;
			color: white;
			font-size: 14px;
			line-height: 1.4;
		}

		.comment-meta {
			display: flex;
			align-items: center;
			gap: 15px;
			font-size: 12px;
			color: rgba(255, 255, 255, 0.6);
			margin-left: 15px;
		}

		.comment-time {
			font-weight: 500;
		}

		.comment-like, .comment-reply {
			background: none;
			border: none;
			color: rgba(255, 255, 255, 0.6);
			cursor: pointer;
			font-size: 12px;
			font-weight: 600;
			transition: color 0.3s ease;
		}

		.comment-like:hover, .comment-reply:hover {
			color: white;
		}

		.comment-likes {
			font-size: 12px;
		}

		/* Sponsored Content */
		.sponsored-cta {
			padding: 15px 20px;
			border-top: 1px solid rgba(255, 255, 255, 0.1);
			display: flex;
			gap: 10px;
		}

		.cta-button {
			flex: 1;
			background: #7fb069;
			border: none;
			color: white;
			padding: 12px 20px;
			border-radius: 8px;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
		}

		.cta-button:hover {
			background: #5a8a4a;
			transform: translateY(-2px);
		}

		.cta-button.secondary {
			background: rgba(255, 255, 255, 0.1);
			border: 1px solid rgba(255, 255, 255, 0.3);
		}

		.cta-button.secondary:hover {
			background: rgba(255, 255, 255, 0.2);
		}

		/* Load More */
		.load-more-container {
			text-align: center;
			padding: 20px;
		}

		.load-more-btn {
			background: rgba(255, 255, 255, 0.1);
			border: 1px solid rgba(255, 255, 255, 0.2);
			color: white;
			padding: 15px 30px;
			border-radius: 25px;
			cursor: pointer;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			display: flex;
			align-items: center;
			gap: 10px;
			margin: 0 auto;
			font-weight: 500;
		}

		.load-more-btn:hover {
			background: rgba(127, 176, 105, 0.2);
			border-color: rgba(127, 176, 105, 0.4);
			transform: translateY(-2px);
		}

		.load-more-btn i {
			animation: spin 2s linear infinite;
		}

		/* Responsive Design for Facebook Newsfeed */
		@media (max-width: 768px) {
			.facebook-newsfeed {
				padding: 10px;
			}

			.stories-scroll {
				gap: 8px;
			}

			.story-card {
				min-width: 90px;
				height: 140px;
			}

			.post-creation-actions {
				flex-wrap: wrap;
				gap: 8px;
			}

			.creation-action-btn {
				font-size: 12px;
				padding: 10px 6px;
			}

			.creation-action-btn span {
				display: none;
			}

			.post-media-grid {
				flex-direction: column;
			}

			.media-grid-side {
				flex-direction: row;
			}
		}

		/* Professional Explore Section Styles */
		.professional-explore {
			max-width: 1200px;
			margin: 0 auto;
			padding: 20px;
		}

		/* Advanced Search Container */
		.advanced-search-container {
			background: linear-gradient(135deg, rgba(255, 255, 255, 0.12), rgba(255, 255, 255, 0.08));
			border-radius: 20px;
			padding: 30px;
			margin-bottom: 30px;
			backdrop-filter: blur(25px);
			border: 1px solid rgba(255, 255, 255, 0.15);
			box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
		}

		.search-header {
			text-align: center;
			margin-bottom: 30px;
		}

		.search-header h2 {
			color: white;
			font-size: 28px;
			font-weight: 700;
			margin: 0 0 10px 0;
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 15px;
		}

		.search-header h2 i {
			color: #7fb069;
			font-size: 24px;
		}

		.search-header p {
			color: rgba(255, 255, 255, 0.8);
			font-size: 16px;
			margin: 0;
		}

		/* Main Search Bar */
		.main-search-bar {
			display: flex;
			gap: 15px;
			margin-bottom: 25px;
		}

		.search-input-wrapper {
			flex: 1;
			position: relative;
			display: flex;
			align-items: center;
		}

		.search-icon {
			position: absolute;
			left: 20px;
			color: rgba(255, 255, 255, 0.6);
			font-size: 18px;
			z-index: 2;
		}

		.advanced-search-input {
			width: 100%;
			background: rgba(255, 255, 255, 0.1);
			border: 2px solid rgba(255, 255, 255, 0.2);
			border-radius: 50px;
			padding: 18px 60px 18px 55px;
			color: white;
			font-size: 16px;
		}

		.advanced-search-input::placeholder {
			color: rgba(255, 255, 255, 0.6);
		}

		.advanced-search-input:focus {
			outline: none;
			border-color: #7fb069;
			background: rgba(255, 255, 255, 0.15);
			transform: scale(1.01);
			box-shadow: 0 0 20px rgba(127, 176, 105, 0.3);
		}

		.voice-search-btn {
			position: absolute;
			right: 15px;
			background: rgba(127, 176, 105, 0.2);
			border: none;
			color: #7fb069;
			width: 40px;
			height: 40px;
			border-radius: 50%;
			cursor: pointer;
			transition: all 0.3s ease;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.voice-search-btn:hover {
			background: rgba(127, 176, 105, 0.3);
			transform: scale(1.1);
		}

		.search-btn {
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			border: none;
			color: white;
			padding: 18px 35px;
			border-radius: 50px;
			font-size: 16px;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			display: flex;
			align-items: center;
			gap: 10px;
			box-shadow: 0 5px 15px rgba(127, 176, 105, 0.3);
		}

		.search-btn:hover {
			transform: translateY(-3px);
			box-shadow: 0 10px 25px rgba(127, 176, 105, 0.4);
		}

		/* Search Filters */
		.search-filters {
			background: rgba(255, 255, 255, 0.05);
			border-radius: 15px;
			padding: 25px;
			border: 1px solid rgba(255, 255, 255, 0.1);
		}

		.filter-row {
			display: flex;
			gap: 20px;
			margin-bottom: 20px;
			flex-wrap: wrap;
		}

		.filter-row:last-child {
			margin-bottom: 0;
		}

		.filter-group {
			flex: 1;
			min-width: 200px;
		}

		.filter-group label {
			display: block;
			color: rgba(255, 255, 255, 0.9);
			font-size: 14px;
			font-weight: 600;
			margin-bottom: 8px;
		}

		.filter-select {
			width: 100%;
			background: rgba(255, 255, 255, 0.1);
			border: 1px solid rgba(255, 255, 255, 0.2);
			border-radius: 10px;
			padding: 12px 15px;
			color: white;
			font-size: 14px;
		}

		.filter-select:focus {
			outline: none;
			border-color: #7fb069;
			background: rgba(255, 255, 255, 0.15);
		}

		.filter-select option {
			background: #2d3748;
			color: white;
		}

		.filter-actions {
			display: flex;
			gap: 15px;
			align-items: flex-end;
		}

		.clear-filters-btn, .save-search-btn {
			background: rgba(255, 255, 255, 0.1);
			border: 1px solid rgba(255, 255, 255, 0.2);
			color: white;
			padding: 12px 20px;
			border-radius: 10px;
			cursor: pointer;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			display: flex;
			align-items: center;
			gap: 8px;
			font-size: 14px;
			font-weight: 500;
			white-space: nowrap;
		}

		.clear-filters-btn:hover {
			background: rgba(239, 68, 68, 0.2);
			border-color: rgba(239, 68, 68, 0.4);
		}

		.save-search-btn:hover {
			background: rgba(127, 176, 105, 0.2);
			border-color: rgba(127, 176, 105, 0.4);
		}

		/* Search Results Summary */
		.search-results-summary {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 25px;
			padding: 20px;
			background: rgba(255, 255, 255, 0.05);
			border-radius: 15px;
			border: 1px solid rgba(255, 255, 255, 0.1);
		}

		.results-info {
			display: flex;
			flex-direction: column;
			gap: 5px;
		}

		.results-count {
			color: white;
			font-size: 18px;
			font-weight: 600;
		}

		.results-filters {
			color: rgba(255, 255, 255, 0.7);
			font-size: 14px;
		}

		.sort-options {
			width: 100%;
			justify-content: space-between;
		}

		.sort-options label {
			color: rgba(255, 255, 255, 0.8);
			font-size: 14px;
			font-weight: 500;
		}

		.sort-select {
			background: rgba(255, 255, 255, 0.1);
			border: 1px solid rgba(255, 255, 255, 0.2);
			border-radius: 8px;
			padding: 8px 12px;
			color: white;
			font-size: 14px;
		}

		.sort-select option {
			background: #2d3748;
			color: white;
		}

		.view-toggle {
			display: flex;
			gap: 5px;
		}

		.view-btn {
			background: rgba(255, 255, 255, 0.1);
			border: 1px solid rgba(255, 255, 255, 0.2);
			color: rgba(255, 255, 255, 0.7);
			width: 40px;
			height: 40px;
			border-radius: 8px;
			cursor: pointer;
			transition: all 0.3s ease;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.view-btn:hover, .view-btn.active {
			background: rgba(127, 176, 105, 0.2);
			border-color: rgba(127, 176, 105, 0.4);
			color: #7fb069;
		}

		/* Business Listings Grid */
		.business-listings-grid {
			display: grid;
			grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
			gap: 25px;
			margin-bottom: 30px;
		}

		.business-listing-card {
			background: linear-gradient(135deg, rgba(255, 255, 255, 0.12), rgba(255, 255, 255, 0.08));
			border-radius: 20px;
			padding: 25px;
			backdrop-filter: blur(25px);
			border: 1px solid rgba(255, 255, 255, 0.15);
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			position: relative;
			overflow: hidden;
		}

		.business-listing-card:hover {
			transform: translateY(-5px);
			box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
		}

		.business-listing-card::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 4px;
			background: linear-gradient(90deg, #7fb069, #5a8a4a);
			opacity: 0;
			transition: opacity 0.3s ease;
		}

		.business-listing-card:hover::before {
			opacity: 1;
		}

		/* Registration Status Styling */
		.business-listing-card.registered {
			border-color: rgba(127, 176, 105, 0.3);
		}

		.business-listing-card.unregistered {
			border-color: rgba(239, 68, 68, 0.3);
		}

		.business-listing-card.pending {
			border-color: rgba(251, 191, 36, 0.3);
		}

		.business-card-header {
			display: flex;
			justify-content: space-between;
			align-items: flex-start;
			margin-bottom: 20px;
		}

		.business-logo {
			width: 60px;
			height: 60px;
			border-radius: 15px;
			overflow: hidden;
			display: flex;
			align-items: center;
			justify-content: center;
			background: rgba(255, 255, 255, 0.1);
		}

		.business-logo img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}

		/* Registration Badges */
		.registration-badge {
			padding: 8px 12px;
			border-radius: 20px;
			font-size: 12px;
			font-weight: 600;
			display: flex;
			align-items: center;
			gap: 6px;
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}

		.registration-badge.registered {
			background: rgba(127, 176, 105, 0.2);
			color: #7fb069;
			border: 1px solid rgba(127, 176, 105, 0.3);
		}

		.registration-badge.unregistered {
			background: rgba(239, 68, 68, 0.2);
			color: #ef4444;
			border: 1px solid rgba(239, 68, 68, 0.3);
		}

		.registration-badge.pending {
			background: rgba(251, 191, 36, 0.2);
			color: #fbbf24;
			border: 1px solid rgba(251, 191, 36, 0.3);
		}

		.registration-badge i {
			font-size: 10px;
		}

		/* Business Info */
		.business-info h3 {
			color: white;
			font-size: 20px;
			font-weight: 700;
			margin: 0 0 8px 0;
		}

		.business-category {
			color: #7fb069;
			font-size: 14px;
			font-weight: 600;
			margin: 0 0 12px 0;
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}

		.business-description {
			color: rgba(255, 255, 255, 0.8);
			font-size: 14px;
			line-height: 1.5;
			margin: 0 0 20px 0;
		}

		.business-details {
			display: flex;
			flex-direction: column;
			gap: 8px;
			margin-bottom: 15px;
		}

		.detail-item {
			display: flex;
			align-items: center;
			gap: 10px;
			color: rgba(255, 255, 255, 0.7);
			font-size: 13px;
		}

		.detail-item i {
			color: #7fb069;
			width: 16px;
			text-align: center;
		}

		.business-rating {
			display: flex;
			align-items: center;
			gap: 10px;
			margin-bottom: 15px;
		}

		.stars {
			display: flex;
			gap: 2px;
		}

		.stars i {
			color: #fbbf24;
			font-size: 14px;
		}

		.rating-text {
			color: rgba(255, 255, 255, 0.8);
			font-size: 13px;
			font-weight: 500;
		}

		.business-tags {
			display: flex;
			flex-wrap: wrap;
			gap: 8px;
			margin-bottom: 20px;
		}

		.business-tags .tag {
			background: rgba(127, 176, 105, 0.2);
			color: #7fb069;
			padding: 4px 10px;
			border-radius: 12px;
			font-size: 11px;
			font-weight: 600;
			text-transform: uppercase;
			letter-spacing: 0.3px;
		}

		/* Business Actions */
		.business-actions {
			display: flex;
			gap: 10px;
			align-items: center;
		}

		.contact-btn, .partner-btn {
			flex: 1;
			padding: 12px 16px;
			border-radius: 10px;
			font-size: 14px;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 8px;
			border: none;
		}

		.contact-btn.primary {
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			color: white;
		}

		.contact-btn.primary:hover {
			transform: translateY(-2px);
			box-shadow: 0 8px 20px rgba(127, 176, 105, 0.3);
		}

		.partner-btn {
			background: rgba(255, 255, 255, 0.1);
			color: white;
			border: 1px solid rgba(255, 255, 255, 0.2);
		}

		.partner-btn:hover {
			background: rgba(255, 255, 255, 0.2);
			transform: translateY(-2px);
		}

		.save-btn {
			width: 45px;
			height: 45px;
			background: rgba(255, 255, 255, 0.1);
			border: 1px solid rgba(255, 255, 255, 0.2);
			color: rgba(255, 255, 255, 0.7);
			border-radius: 10px;
			cursor: pointer;
			transition: all 0.3s ease;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.save-btn:hover {
			background: rgba(127, 176, 105, 0.2);
			border-color: rgba(127, 176, 105, 0.4);
			color: #7fb069;
			transform: translateY(-2px);
		}

		/* Load More Section */
		.load-more-section {
			text-align: center;
			padding: 30px 20px;
		}

		.load-more-businesses-btn {
			background: linear-gradient(135deg, rgba(255, 255, 255, 0.12), rgba(255, 255, 255, 0.08));
			border: 2px solid rgba(255, 255, 255, 0.2);
			color: white;
			padding: 18px 40px;
			border-radius: 50px;
			font-size: 16px;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			display: flex;
			align-items: center;
			gap: 12px;
			margin: 0 auto 15px auto;
			backdrop-filter: blur(25px);
		}

		.load-more-businesses-btn:hover {
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			border-color: #7fb069;
			transform: translateY(-3px);
			box-shadow: 0 10px 25px rgba(127, 176, 105, 0.3);
		}

		.load-info {
			color: rgba(255, 255, 255, 0.6);
			font-size: 14px;
			margin: 0;
		}

		/* Responsive Design for Explore Section */
		@media (max-width: 768px) {
			.professional-explore {
				padding: 15px;
			}

			.advanced-search-container {
				padding: 20px;
			}

			.search-header h2 {
				font-size: 24px;
			}

			.main-search-bar {
				flex-direction: column;
				gap: 15px;
			}

			.search-btn {
				width: 100%;
				justify-content: center;
			}

			.filter-row {
				flex-direction: column;
				gap: 15px;
			}

			.filter-actions {
				flex-direction: column;
				gap: 10px;
			}

			.clear-filters-btn, .save-search-btn {
				width: 100%;
				justify-content: center;
			}

			.search-results-summary {
				flex-direction: column;
				gap: 15px;
				align-items: flex-start;
			}

			.sort-options {
				width: 100%;
				justify-content: space-between;
			}

			.business-listings-grid {
				grid-template-columns: 1fr;
				gap: 20px;
			}

			.business-actions {
				flex-direction: column;
				gap: 10px;
			}

			.contact-btn, .partner-btn {
				width: 100%;
			}

			.save-btn {
				width: 100%;
				height: 45px;
			}
		}
	</style>
</head>
<body>
	<div class="bg-particles">
		<div class="particle" style="top: 10%; left: 20%; width: 10px; height: 10px; animation-delay: 0s;"></div>
		<div class="particle" style="top: 20%; left: 40%; width: 15px; height: 15px; animation-delay: 1s;"></div>
		<div class="particle" style="top: 30%; left: 60%; width: 20px; height: 20px; animation-delay: 2s;"></div>
		<div class="particle" style="top: 40%; left: 80%; width: 25px; height: 25px; animation-delay: 3s;"></div>
		<div class="particle" style="top: 50%; left: 20%; width: 30px; height: 30px; animation-delay: 4s;"></div>
		<div class="particle" style="top: 60%; left: 40%; width: 35px; height: 35px; animation-delay: 5s;"></div>
		<div class="particle" style="top: 70%; left: 60%; width: 40px; height: 40px; animation-delay: 6s;"></div>
		<div class="particle" style="top: 80%; left: 80%; width: 45px; height: 45px; animation-delay: 7s;"></div>
	</div>
	<div class="container">
		<!-- Sidebar -->
		<div class="sidebar" id="sidebar">
			<!-- User Profile Section -->
			<div class="sidebar-profile">
				<div class="profile-header">
					<div class="user-avatar large">
						<img src="https://via.placeholder.com/50x50/7fb069/ffffff?text={{ substr($user->name ?? 'U', 0, 1) }}" alt="User Avatar">
					</div>
					<div class="profile-info">
						<h3>{{ $user->name ?? 'User Name' }}</h3>
						<p class="user-role">Business Owner</p>
						<div class="profile-stats">
							<span class="stat-item">
								<i class="fas fa-star"></i>
								<span>4.8</span>
							</span>
							<span class="stat-item">
								<i class="fas fa-users"></i>
								<span>1.2K</span>
							</span>
						</div>
					</div>
				</div>
				<div class="nav-buttons">
                    <button type="button" class="btn btn-danger btn-logout" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            title="Logout">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                <style>
                    .btn-logout {
                        background-color: #dc3545;
                        color: white;
                        border: none;
                        padding: 8px 15px;
                        border-radius: 4px;
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                        gap: 5px;
                        transition: background-color 0.3s;
                    }
                    .btn-logout:hover {
                        background-color: #bb2d3b;
                    }
                </style>
				<div class="profile-actions">
					<button class="profile-btn primary">
						<i class="fas fa-edit"></i>
						Edit Profile
					</button>
					<button class="profile-btn secondary">
						<i class="fas fa-cog"></i>
						Settings
					</button>
				</div>
			</div>

			<!-- Navigation Menu -->
			<nav class="sidebar-nav">
				<!-- Main Navigation -->
				<div class="nav-section">
					<h4 class="nav-section-title">Main</h4>
					<ul class="nav-menu">
						<li class="nav-item active" data-tab="dashboard">
							<a href="#" class="nav-link">
								<div class="nav-icon">
									<i class="fas fa-home"></i>
								</div>
								<span class="nav-text">Dashboard</span>
								<div class="nav-indicator"></div>
							</a>
						</li>
						<li class="nav-item" data-tab="newsfeed">
							<a href="#" class="nav-link">
								<div class="nav-icon">
									<i class="fas fa-newspaper"></i>
								</div>
								<span class="nav-text">Newsfeed</span>
								<span class="nav-badge">12</span>
							</a>
						</li>
						<li class="nav-item" data-tab="explore">
							<a href="#" class="nav-link">
								<div class="nav-icon">
									<i class="fas fa-search"></i>
								</div>
								<span class="nav-text">Explore</span>
							</a>
						</li>
						<li class="nav-item" data-tab="notifications">
							<a href="#" class="nav-link">
								<div class="nav-icon">
									<i class="fas fa-bell"></i>
								</div>
								<span class="nav-text">Notifications</span>
								<span class="nav-badge urgent">5</span>
							</a>
						</li>
					</ul>
				</div>

				<!-- Business Tools -->
				<div class="nav-section">
					<h4 class="nav-section-title">Business Tools</h4>
					<ul class="nav-menu">
						<li class="nav-item">
							<a href="{{ route('user.dashboard.analytics') }}" class="nav-link">
								<div class="nav-icon">
									<i class="fas fa-chart-line"></i>
								</div>
								<span class="nav-text">Analytics</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('user.dashboard.promotions') }}" class="nav-link">
								<div class="nav-icon">
									<i class="fas fa-bullhorn"></i>
								</div>
								<span class="nav-text">Promotions</span>
								<span class="nav-badge new">New</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('user.dashboard.partnerships') }}" class="nav-link">
								<div class="nav-icon">
									<i class="fas fa-handshake"></i>
								</div>
								<span class="nav-text">Partnerships</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('user.dashboard.events') }}" class="nav-link">
								<div class="nav-icon">
									<i class="fas fa-calendar-alt"></i>
								</div>
								<span class="nav-text">Events</span>
							</a>
						</li>
					</ul>
				</div>

				<!-- Communication -->
				<div class="nav-section">
					<h4 class="nav-section-title">Business</h4>
					<ul class="nav-menu">
						<li class="nav-item">
							<a href="#" class="nav-link">
								<div class="nav-icon">
									<i class="fas fa-store"></i>
								</div>
								<span class="nav-text">My Business</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">
								<div class="nav-icon">
									<i class="fas fa-chart-bar"></i>
								</div>
								<span class="nav-text">Analytics</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('chat.index') }}" class="nav-link">
								<div class="nav-icon">
									<i class="fas fa-comments"></i>
								</div>
								<span class="nav-text">Messages</span>
								<span class="nav-badge new">3</span>
							</a>
						</li>
					</ul>
				</div>

				<!-- Account -->
				<div class="nav-section">
					<h4 class="nav-section-title">Account</h4>
					<ul class="nav-menu">
						<li class="nav-item">
							<a href="{{ route('user.dashboard.profile') }}" class="nav-link">
								<div class="nav-icon">
									<i class="fas fa-user"></i>
								</div>
								<span class="nav-text">Profile</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('user.dashboard.settings') }}" class="nav-link">
								<div class="nav-icon">
									<i class="fas fa-cog"></i>
								</div>
								<span class="nav-text">Settings</span>
							</a>
						</li>
					</ul>
				</div>
			</nav>

			<!-- Quick Actions -->
			<div class="sidebar-quick-actions">
				<h4 class="section-title">Quick Actions</h4>
				<div class="quick-actions-grid">
					<button class="quick-action-btn" onclick="showTab('newsfeed')" title="Create Post">
						<i class="fas fa-plus"></i>
						<span>Post</span>
					</button>
					<button class="quick-action-btn" title="Add Business">
						<i class="fas fa-building"></i>
						<span>Business</span>
					</button>
				</div>
			</div>
		</div>

		<!-- Main Content -->
		<div class="main-content">
			<!-- Overview Tab -->
			<div id="overview" class="tab-content active">
				<!-- Content Header -->
				<div class="content-header">
					<div>
						<h1>Business Media Hub</h1>
						<p>Discover, connect, and grow your business network</p>
					</div>
					<div class="header-actions">
						<button class="header-btn" onclick="showTab('newsfeed')">
							<i class="fas fa-plus"></i>
							Create Post
						</button>
						<button class="header-btn">
							<i class="fas fa-video"></i>
							Upload Short
						</button>
					</div>
				</div>

				<!-- Stats Grid -->
				<div class="stats-grid">
					<div class="stat-card">
						<div class="stat-icon">
							<i class="fas fa-box"></i>
						</div>
						<div class="stat-value">{{ $products->count() ?? '0' }}</div>
						<div class="stat-label">Total Products</div>
					</div>
					<div class="stat-card">
						<div class="stat-icon">
							<i class="fas fa-eye"></i>
						</div>
						<div class="stat-value">1,234</div>
						<div class="stat-label">Profile Views</div>
					</div>
					<div class="stat-card">
						<div class="stat-icon">
							<i class="fas fa-users"></i>
						</div>
						<div class="stat-value">567</div>
						<div class="stat-label">Connections</div>
					</div>
					<div class="stat-card">
						<div class="stat-icon">
							<i class="fas fa-chart-line"></i>
						</div>
						<div class="stat-value">89%</div>
						<div class="stat-label">Growth Rate</div>
					</div>
				</div>

				<!-- Featured Businesses -->
				<div class="business-grid">
					<div class="business-card">
						<div class="business-header">
							<div class="business-logo">GR</div>
							<div class="business-info">
								<h3>Green Restaurant</h3>
								<p>Organic Food • Colombo</p>
							</div>
						</div>
						<div class="business-description">
							Serving fresh, organic meals made from locally sourced ingredients.
						</div>
						<div class="business-tags">
							<span class="business-tag">Organic</span>
							<span class="business-tag">Healthy</span>
						</div>
						<div class="business-actions">
							<button class="business-btn primary">View Profile</button>
							<button class="business-btn secondary">Message</button>
						</div>
					</div>
					<div class="business-card">
						<div class="business-header">
							<div class="business-logo">TS</div>
							<div class="business-info">
								<h3>Tech Solutions Pro</h3>
								<p>IT Services • Kandy</p>
							</div>
						</div>
						<div class="business-description">
							Complete IT solutions for businesses. Web development to cloud services.
						</div>
						<div class="business-tags">
							<span class="business-tag">Web Dev</span>
							<span class="business-tag">Cloud</span>
						</div>
						<div class="business-actions">
							<button class="business-btn primary">View Profile</button>
							<button class="business-btn secondary">Message</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Explore Tab -->
			<div id="explore" class="tab-content">
				<!-- Professional Explore Section -->
				<div class="professional-explore">
					<!-- Advanced Search Section -->
					<div class="advanced-search-container">
						<div class="search-header">
							<h2><i class="fas fa-search"></i> Advanced Business Search</h2>
							<p>Find services, products, and business partners with precision</p>
						</div>
						
						<div class="search-form">
							<div class="main-search-bar">
								<div class="search-input-wrapper">
									<i class="fas fa-search search-icon"></i>
									<input type="text" id="advancedSearch" class="advanced-search-input" placeholder="Search for businesses, services, products...">
									<button class="voice-search-btn" title="Voice Search">
										<i class="fas fa-microphone"></i>
									</button>
								</div>
								<button class="search-btn" onclick="performAdvancedSearch()">
									<i class="fas fa-search"></i>
									Search
								</button>
							</div>
							
							<!-- Search Filters -->
							<div class="search-filters">
								<div class="filter-row">
									<div class="filter-group">
										<label>Category</label>
										<select id="categoryFilter" class="filter-select">
											<option value="">All Categories</option>
											<option value="technology">Technology & IT</option>
											<option value="healthcare">Healthcare & Medical</option>
											<option value="finance">Finance & Banking</option>
											<option value="retail">Retail & E-commerce</option>
											<option value="food">Food & Beverage</option>
											<option value="construction">Construction & Real Estate</option>
											<option value="education">Education & Training</option>
											<option value="automotive">Automotive</option>
											<option value="manufacturing">Manufacturing</option>
											<option value="consulting">Consulting & Services</option>
										</select>
									</div>
									
									<div class="filter-group">
										<label>Location</label>
										<select id="locationFilter" class="filter-select">
											<option value="">All Locations</option>
											<option value="mumbai">Mumbai</option>
											<option value="delhi">Delhi</option>
											<option value="bangalore">Bangalore</option>
											<option value="chennai">Chennai</option>
											<option value="kolkata">Kolkata</option>
											<option value="hyderabad">Hyderabad</option>
											<option value="pune">Pune</option>
											<option value="ahmedabad">Ahmedabad</option>
										</select>
									</div>
									
									<div class="filter-group">
										<label>Business Size</label>
										<select id="sizeFilter" class="filter-select">
											<option value="">All Sizes</option>
											<option value="startup">Startup (1-10 employees)</option>
											<option value="small">Small (11-50 employees)</option>
											<option value="medium">Medium (51-200 employees)</option>
											<option value="large">Large (200+ employees)</option>
										</select>
									</div>
									
									<div class="filter-group">
										<label>Registration Status</label>
										<select id="registrationFilter" class="filter-select">
											<option value="">All Businesses</option>
											<option value="registered">Government Registered</option>
											<option value="unregistered">Not Registered</option>
											<option value="pending">Registration Pending</option>
										</select>
									</div>
								</div>
								
								<div class="filter-row">
									<div class="filter-group">
										<label>Rating</label>
										<select id="ratingFilter" class="filter-select">
											<option value="">All Ratings</option>
											<option value="5">5 Stars</option>
											<option value="4">4+ Stars</option>
											<option value="3">3+ Stars</option>
											<option value="2">2+ Stars</option>
										</select>
									</div>
									
									<div class="filter-group">
										<label>Established</label>
										<select id="establishedFilter" class="filter-select">
											<option value="">Any Time</option>
											<option value="2024">This Year (2024)</option>
											<option value="2023">Last Year (2023)</option>
											<option value="5years">Last 5 Years</option>
											<option value="10years">Last 10 Years</option>
											<option value="older">More than 10 Years</option>
										</select>
									</div>
									
									<div class="filter-group">
										<label>Services Offered</label>
										<select id="servicesFilter" class="filter-select">
											<option value="">All Services</option>
											<option value="b2b">B2B Services</option>
											<option value="b2c">B2C Services</option>
											<option value="wholesale">Wholesale</option>
											<option value="retail">Retail</option>
											<option value="consulting">Consulting</option>
											<option value="manufacturing">Manufacturing</option>
										</select>
									</div>
									
									<div class="filter-actions">
										<button class="clear-filters-btn" onclick="clearAllFilters()">
											<i class="fas fa-times"></i>
											Clear Filters
										</button>
										<button class="save-search-btn" onclick="saveSearch()">
											<i class="fas fa-bookmark"></i>
											Save Search
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<!-- Search Results Summary -->
					<div class="search-results-summary">
						<div class="results-info">
							<span class="results-count">Showing <strong>156</strong> businesses</span>
							<span class="results-filters" id="activeFilters">All Categories • All Locations</span>
						</div>
						<div class="sort-options">
							<label>Sort by:</label>
							<select id="sortBy" class="sort-select">
								<option value="relevance">Relevance</option>
								<option value="rating">Highest Rated</option>
								<option value="newest">Newest First</option>
								<option value="name">Name (A-Z)</option>
								<option value="location">Location</option>
							</select>
							<div class="view-toggle">
								<button class="view-btn active" data-view="grid" title="Grid View">
									<i class="fas fa-th"></i>
								</button>
								<button class="view-btn" data-view="list" title="List View">
									<i class="fas fa-list"></i>
								</button>
							</div>
						</div>
					</div>
					
					<!-- Business Listings Grid -->
					<div class="business-listings-grid" id="businessGrid">
						<!-- Registered Business Card -->
						<div class="business-listing-card registered" data-category="technology" data-location="mumbai">
							<div class="business-card-header">
								<div class="business-logo">
									<img src="https://via.placeholder.com/60x60/7fb069/ffffff?text=TI" alt="TechInnovate">
								</div>
								<div class="registration-badge registered">
									<i class="fas fa-certificate"></i>
									<span>Gov. Registered</span>
								</div>
							</div>
							<div class="business-info">
								<h3>TechInnovate Solutions</h3>
								<p class="business-category">Technology & IT Services</p>
								<p class="business-description">Leading software development company specializing in AI, ML, and cloud solutions for enterprises.</p>
								<div class="business-details">
									<div class="detail-item">
										<i class="fas fa-map-marker-alt"></i>
										<span>Mumbai, Maharashtra</span>
									</div>
									<div class="detail-item">
										<i class="fas fa-users"></i>
										<span>150+ Employees</span>
									</div>
									<div class="detail-item">
										<i class="fas fa-calendar"></i>
										<span>Est. 2018</span>
									</div>
								</div>
								<div class="business-rating">
									<div class="stars">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
									</div>
									<span class="rating-text">4.9 (127 reviews)</span>
								</div>
								<div class="business-tags">
									<span class="tag">Software Development</span>
									<span class="tag">AI/ML</span>
									<span class="tag">Cloud Services</span>
								</div>
							</div>
							<div class="business-actions">
								<button class="contact-btn primary">
									<i class="fas fa-phone"></i>
									Contact
								</button>
								<button class="partner-btn">
									<i class="fas fa-handshake"></i>
									Partner Request
								</button>
								<button class="save-btn">
									<i class="fas fa-bookmark"></i>
								</button>
							</div>
						</div>
						
						<!-- Unregistered Business Card -->
						<div class="business-listing-card unregistered" data-category="food" data-location="delhi">
							<div class="business-card-header">
								<div class="business-logo">
									<img src="https://via.placeholder.com/60x60/ff6b6b/ffffff?text=FD" alt="FoodDelight">
								</div>
								<div class="registration-badge unregistered">
									<i class="fas fa-exclamation-triangle"></i>
									<span>Not Registered</span>
								</div>
							</div>
							<div class="business-info">
								<h3>FoodDelight Catering</h3>
								<p class="business-category">Food & Beverage</p>
								<p class="business-description">Premium catering services for corporate events, weddings, and private parties.</p>
								<div class="business-details">
									<div class="detail-item">
										<i class="fas fa-map-marker-alt"></i>
										<span>Delhi, India</span>
									</div>
									<div class="detail-item">
										<i class="fas fa-users"></i>
										<span>25 Employees</span>
									</div>
									<div class="detail-item">
										<i class="fas fa-calendar"></i>
										<span>Est. 2022</span>
									</div>
								</div>
								<div class="business-rating">
									<div class="stars">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="far fa-star"></i>
									</div>
									<span class="rating-text">4.2 (43 reviews)</span>
								</div>
								<div class="business-tags">
									<span class="tag">Catering</span>
									<span class="tag">Event Planning</span>
									<span class="tag">Corporate Events</span>
								</div>
							</div>
							<div class="business-actions">
								<button class="contact-btn primary">
									<i class="fas fa-phone"></i>
									Contact
								</button>
								<button class="partner-btn">
									<i class="fas fa-handshake"></i>
									Partner Request
								</button>
								<button class="save-btn">
									<i class="fas fa-bookmark"></i>
								</button>
							</div>
						</div>
						
						<!-- Pending Registration Business Card -->
						<div class="business-listing-card pending" data-category="healthcare" data-location="bangalore">
							<div class="business-card-header">
								<div class="business-logo">
									<img src="https://via.placeholder.com/60x60/3498db/ffffff?text=HC" alt="HealthCare Plus">
								</div>
								<div class="registration-badge pending">
									<i class="fas fa-clock"></i>
									<span>Registration Pending</span>
								</div>
							</div>
							<div class="business-info">
								<h3>HealthCare Plus Clinic</h3>
								<p class="business-category">Healthcare & Medical</p>
								<p class="business-description">Multi-specialty clinic providing comprehensive healthcare services with modern facilities.</p>
								<div class="business-details">
									<div class="detail-item">
										<i class="fas fa-map-marker-alt"></i>
										<span>Bangalore, Karnataka</span>
									</div>
									<div class="detail-item">
										<i class="fas fa-users"></i>
										<span>80 Employees</span>
									</div>
									<div class="detail-item">
										<i class="fas fa-calendar"></i>
										<span>Est. 2020</span>
									</div>
								</div>
								<div class="business-rating">
									<div class="stars">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star-half-alt"></i>
									</div>
									<span class="rating-text">4.7 (89 reviews)</span>
								</div>
								<div class="business-tags">
									<span class="tag">Multi-specialty</span>
									<span class="tag">Diagnostics</span>
									<span class="tag">Emergency Care</span>
								</div>
							</div>
							<div class="business-actions">
								<button class="contact-btn primary">
									<i class="fas fa-phone"></i>
									Contact
								</button>
								<button class="partner-btn">
									<i class="fas fa-handshake"></i>
									Partner Request
								</button>
								<button class="save-btn">
									<i class="fas fa-bookmark"></i>
								</button>
							</div>
						</div>
						
						<!-- More Business Cards -->
						<div class="business-listing-card registered" data-category="finance" data-location="mumbai">
							<div class="business-card-header">
								<div class="business-logo">
									<img src="https://via.placeholder.com/60x60/2ecc71/ffffff?text=FS" alt="FinServ">
								</div>
								<div class="registration-badge registered">
									<i class="fas fa-certificate"></i>
									<span>Gov. Registered</span>
								</div>
							</div>
							<div class="business-info">
								<h3>FinServ Consultancy</h3>
								<p class="business-category">Finance & Banking</p>
								<p class="business-description">Expert financial advisory services for businesses and individuals with 15+ years experience.</p>
								<div class="business-details">
									<div class="detail-item">
										<i class="fas fa-map-marker-alt"></i>
										<span>Mumbai, Maharashtra</span>
									</div>
									<div class="detail-item">
										<i class="fas fa-users"></i>
										<span>45 Employees</span>
									</div>
									<div class="detail-item">
										<i class="fas fa-calendar"></i>
										<span>Est. 2009</span>
									</div>
								</div>
								<div class="business-rating">
									<div class="stars">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
									</div>
									<span class="rating-text">4.8 (156 reviews)</span>
								</div>
								<div class="business-tags">
									<span class="tag">Financial Planning</span>
									<span class="tag">Investment Advisory</span>
									<span class="tag">Tax Consulting</span>
								</div>
							</div>
							<div class="business-actions">
								<button class="contact-btn primary">
									<i class="fas fa-phone"></i>
									Contact
								</button>
								<button class="partner-btn">
									<i class="fas fa-handshake"></i>
									Partner Request
								</button>
								<button class="save-btn">
									<i class="fas fa-bookmark"></i>
								</button>
							</div>
						</div>
						
						<div class="business-listing-card registered" data-category="retail" data-location="chennai">
							<div class="business-card-header">
								<div class="business-logo">
									<img src="https://via.placeholder.com/60x60/e74c3c/ffffff?text=EB" alt="EcoBrand">
								</div>
								<div class="registration-badge registered">
									<i class="fas fa-certificate"></i>
									<span>Gov. Registered</span>
								</div>
							</div>
							<div class="business-info">
								<h3>EcoBrand Retail</h3>
								<p class="business-category">Retail & E-commerce</p>
								<p class="business-description">Sustainable fashion and eco-friendly products with online and offline presence.</p>
								<div class="business-details">
									<div class="detail-item">
										<i class="fas fa-map-marker-alt"></i>
										<span>Chennai, Tamil Nadu</span>
									</div>
									<div class="detail-item">
										<i class="fas fa-users"></i>
										<span>120 Employees</span>
									</div>
									<div class="detail-item">
										<i class="fas fa-calendar"></i>
										<span>Est. 2016</span>
									</div>
								</div>
								<div class="business-rating">
									<div class="stars">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="far fa-star"></i>
									</div>
									<span class="rating-text">4.3 (92 reviews)</span>
								</div>
								<div class="business-tags">
									<span class="tag">Sustainable Fashion</span>
									<span class="tag">E-commerce</span>
									<span class="tag">Eco-friendly</span>
								</div>
							</div>
							<div class="business-actions">
								<button class="contact-btn primary">
									<i class="fas fa-phone"></i>
									Contact
								</button>
								<button class="partner-btn">
									<i class="fas fa-handshake"></i>
									Partner Request
								</button>
								<button class="save-btn">
									<i class="fas fa-bookmark"></i>
								</button>
							</div>
						</div>
						
						<div class="business-listing-card unregistered" data-category="construction" data-location="pune">
							<div class="business-card-header">
								<div class="business-logo">
									<img src="https://via.placeholder.com/60x60/f39c12/ffffff?text=BC" alt="BuildCorp">
								</div>
								<div class="registration-badge unregistered">
									<i class="fas fa-exclamation-triangle"></i>
									<span>Not Registered</span>
								</div>
							</div>
							<div class="business-info">
								<h3>BuildCorp Construction</h3>
								<p class="business-category">Construction & Real Estate</p>
								<p class="business-description">Residential and commercial construction services with quality craftsmanship.</p>
								<div class="business-details">
									<div class="detail-item">
										<i class="fas fa-map-marker-alt"></i>
										<span>Pune, Maharashtra</span>
									</div>
									<div class="detail-item">
										<i class="fas fa-users"></i>
										<span>60 Employees</span>
									</div>
									<div class="detail-item">
										<i class="fas fa-calendar"></i>
										<span>Est. 2021</span>
									</div>
								</div>
								<div class="business-rating">
									<div class="stars">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="far fa-star"></i>
									</div>
									<span class="rating-text">4.1 (34 reviews)</span>
								</div>
								<div class="business-tags">
									<span class="tag">Residential</span>
									<span class="tag">Commercial</span>
									<span class="tag">Interior Design</span>
								</div>
							</div>
							<div class="business-actions">
								<button class="contact-btn primary">
									<i class="fas fa-phone"></i>
									Contact
								</button>
								<button class="partner-btn">
									<i class="fas fa-handshake"></i>
									Partner Request
								</button>
								<button class="save-btn">
									<i class="fas fa-bookmark"></i>
								</button>
							</div>
						</div>
					</div>
					
					<!-- Load More Section -->
					<div class="load-more-section">
						<button class="load-more-businesses-btn" onclick="loadMoreBusinesses()">
							<i class="fas fa-plus"></i>
							Load More Businesses
						</button>
						<p class="load-info">Showing 6 of 156 businesses</p>
					</div>
				</div>
			</div>

			<!-- Newsfeed Tab -->
			<div id="newsfeed" class="tab-content">
				<!-- Facebook-style Newsfeed Layout -->
				<div class="facebook-newsfeed">
					<!-- Stories Section -->
					<div class="stories-container">
						<div class="stories-scroll">
							<!-- Create Story -->
							<div class="story-card create-story">
								<div class="story-image">
									<div class="user-avatar large">{{ substr($user->name ?? 'U', 0, 1) }}</div>
								</div>
								<div class="story-overlay">
									<i class="fas fa-plus"></i>
									<span>Create Story</span>
								</div>
							</div>
							
							<!-- Sample Stories -->
							<div class="story-card">
								<div class="story-image" style="background: linear-gradient(45deg, #ff6b6b, #feca57);">
									<div class="story-avatar">GR</div>
								</div>
								<div class="story-name">Green Restaurant</div>
							</div>
							
							<div class="story-card">
								<div class="story-image" style="background: linear-gradient(45deg, #48dbfb, #0abde3);">
									<div class="story-avatar">TS</div>
								</div>
								<div class="story-name">Tech Solutions</div>
							</div>
							
							<div class="story-card">
								<div class="story-image" style="background: linear-gradient(45deg, #ff9ff3, #f368e0);">
									<div class="story-avatar">FB</div>
								</div>
								<div class="story-name">Fashion Boutique</div>
							</div>
							
							<div class="story-card">
								<div class="story-image" style="background: linear-gradient(45deg, #54a0ff, #2e86de);">
									<div class="story-avatar">CF</div>
								</div>
								<div class="story-name">Coffee House</div>
							</div>
							
							<div class="story-card">
								<div class="story-image" style="background: linear-gradient(45deg, #5f27cd, #341f97);">
									<div class="story-avatar">GS</div>
								</div>
								<div class="story-name">Gym & Spa</div>
							</div>
						</div>
					</div>

					<!-- Post Creation Box -->
					<div class="post-creation-box">
						<div class="post-creation-header">
							<div class="user-avatar">{{ substr($user->name ?? 'U', 0, 1) }}</div>
							<input type="text" class="post-input" placeholder="What's on your mind, {{ $user->name ?? 'User' }}?">
						</div>
						<div class="post-creation-actions">
							<button class="creation-action-btn" onclick="triggerImageUpload()">
								<i class="fas fa-image" style="color: #45bd62;"></i>
								<span>Photo/Video</span>
							</button>
							<button class="creation-action-btn">
								<i class="fas fa-smile" style="color: #f7b928;"></i>
								<span>Feeling/Activity</span>
							</button>
							<button class="creation-action-btn">
								<i class="fas fa-map-marker-alt" style="color: #f33e58;"></i>
								<span>Check In</span>
							</button>
							<button class="creation-action-btn">
								<i class="fas fa-calendar" style="color: #1877f2;"></i>
								<span>Event</span>
							</button>
						</div>
						<input type="file" id="hiddenImageUpload" accept="image/*,video/*" style="display: none;">
					</div>

					<!-- Posts Feed -->
					<div class="posts-feed">
						<!-- Post 1 -->
						<div class="facebook-post">
							<div class="post-header">
								<div class="post-user-info">
									<div class="user-avatar">GR</div>
									<div class="user-details">
										<h4>Green Restaurant <span class="verified-badge"><i class="fas fa-check-circle"></i></span></h4>
										<div class="post-meta">
											<span class="post-time">2 hours ago</span> • 
											<i class="fas fa-globe-americas"></i>
										</div>
									</div>
								</div>
								<div class="post-options">
									<button class="post-menu-btn">
										<i class="fas fa-ellipsis-h"></i>
									</button>
								</div>
							</div>
							
							<div class="post-content">
								<p>🌱 Fresh organic salads now available! Made with locally sourced ingredients and love. Perfect for a healthy lunch break. What's your favorite salad combination? Let us know in the comments! 🥗✨</p>
								<div class="post-media">
									<img src="https://via.placeholder.com/600x400/7fb069/ffffff?text=Fresh+Organic+Salads" alt="Fresh Organic Salads">
								</div>
							</div>
							
							<div class="post-reactions">
								<div class="reactions-summary">
									<div class="reaction-icons">
										<span class="reaction-icon like">👍</span>
										<span class="reaction-icon love">❤️</span>
										<span class="reaction-icon wow">😮</span>
									</div>
									<span class="reaction-count">47</span>
								</div>
								<div class="post-stats">
									<span>12 comments</span>
									<span>5 shares</span>
								</div>
							</div>
							
							<div class="post-actions">
								<button class="facebook-action-btn like-btn" data-post="1">
									<i class="far fa-thumbs-up"></i>
									<span>Like</span>
								</button>
								<button class="facebook-action-btn comment-btn">
									<i class="far fa-comment"></i>
									<span>Comment</span>
								</button>
								<button class="facebook-action-btn share-btn">
									<i class="fas fa-share"></i>
									<span>Share</span>
								</button>
							</div>
							
							<div class="comments-section">
								<div class="comment-input-container">
									<div class="user-avatar small">{{ substr($user->name ?? 'U', 0, 1) }}</div>
									<div class="comment-input-wrapper">
										<input type="text" class="comment-input" placeholder="Write a comment...">
										<div class="comment-actions">
											<button class="comment-action"><i class="far fa-smile"></i></button>
											<button class="comment-action"><i class="fas fa-camera"></i></button>
											<button class="comment-action"><i class="fas fa-image"></i></button>
										</div>
									</div>
								</div>
								
								<div class="comments-list">
									<div class="comment">
										<div class="user-avatar small">SC</div>
										<div class="comment-content">
											<div class="comment-bubble">
												<strong>Sarah Chen</strong>
												<p>Looks absolutely delicious! Do you have vegan options available?</p>
											</div>
											<div class="comment-meta">
												<span class="comment-time">1h</span>
												<button class="comment-like">Like</button>
												<button class="comment-reply">Reply</button>
												<span class="comment-likes">👍 3</span>
											</div>
										</div>
									</div>
									
									<div class="comment">
										<div class="user-avatar small">MJ</div>
										<div class="comment-content">
											<div class="comment-bubble">
												<strong>Mike Johnson</strong>
												<p>Just ordered! Can't wait to try it 🙌</p>
											</div>
											<div class="comment-meta">
												<span class="comment-time">45m</span>
												<button class="comment-like">Like</button>
												<button class="comment-reply">Reply</button>
												<span class="comment-likes">👍 1</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Post 2 -->
						<div class="facebook-post">
							<div class="post-header">
								<div class="post-user-info">
									<div class="user-avatar">TS</div>
									<div class="user-details">
										<h4>Tech Solutions Pro <span class="verified-badge"><i class="fas fa-check-circle"></i></span></h4>
										<div class="post-meta">
											<span class="post-time">5 hours ago</span> • 
											<i class="fas fa-globe-americas"></i>
										</div>
									</div>
								</div>
								<div class="post-options">
									<button class="post-menu-btn">
										<i class="fas fa-ellipsis-h"></i>
									</button>
								</div>
							</div>
							
							<div class="post-content">
								<p>🚀 Just completed a major system upgrade for one of our clients! Improved performance by 40% and enhanced security features. Ready to transform your business? Contact us today!</p>
								<div class="post-link-preview">
									<div class="link-preview-image">
										<img src="https://via.placeholder.com/400x200/1877f2/ffffff?text=System+Upgrade" alt="System Upgrade">
									</div>
									<div class="link-preview-content">
										<h4>Business System Upgrade Services</h4>
										<p>Transform your business with our cutting-edge technology solutions.</p>
										<span class="link-domain">techsolutionspro.com</span>
									</div>
								</div>
							</div>
							
							<div class="post-reactions">
								<div class="reactions-summary">
									<div class="reaction-icons">
										<span class="reaction-icon like">👍</span>
										<span class="reaction-icon love">❤️</span>
									</div>
									<span class="reaction-count">23</span>
								</div>
								<div class="post-stats">
									<span>8 comments</span>
									<span>3 shares</span>
								</div>
							</div>
							
							<div class="post-actions">
								<button class="facebook-action-btn like-btn" data-post="2">
									<i class="far fa-thumbs-up"></i>
									<span>Like</span>
								</button>
								<button class="facebook-action-btn comment-btn">
									<i class="far fa-comment"></i>
									<span>Comment</span>
								</button>
								<button class="facebook-action-btn share-btn">
									<i class="fas fa-share"></i>
									<span>Share</span>
								</button>
							</div>
						</div>

						<!-- Post 3 -->
						<div class="facebook-post">
							<div class="post-header">
								<div class="post-user-info">
									<div class="user-avatar">FB</div>
									<div class="user-details">
										<h4>Fashion Boutique</h4>
										<div class="post-meta">
											<span class="post-time">1 day ago</span> • 
											<i class="fas fa-globe-americas"></i>
										</div>
									</div>
								</div>
								<div class="post-options">
									<button class="post-menu-btn">
										<i class="fas fa-ellipsis-h"></i>
									</button>
								</div>
							</div>
							
							<div class="post-content">
								<p>✨ New spring collection is here! Trendy, comfortable, and sustainable fashion for the modern professional. Swipe to see more styles! 👗</p>
								<div class="post-media-grid">
									<div class="media-grid-main">
										<img src="https://via.placeholder.com/400x500/ff6b9d/ffffff?text=Spring+Collection" alt="Spring Collection">
									</div>
									<div class="media-grid-side">
										<img src="https://via.placeholder.com/200x245/feca57/ffffff?text=Style+1" alt="Style 1">
										<div class="media-more">
											<img src="https://via.placeholder.com/200x245/48dbfb/ffffff?text=Style+2" alt="Style 2">
											<div class="media-overlay">+3</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="post-reactions">
								<div class="reactions-summary">
									<div class="reaction-icons">
										<span class="reaction-icon like">👍</span>
										<span class="reaction-icon love">❤️</span>
										<span class="reaction-icon wow">😮</span>
									</div>
									<span class="reaction-count">89</span>
								</div>
								<div class="post-stats">
									<span>24 comments</span>
									<span>12 shares</span>
								</div>
							</div>
							
							<div class="post-actions">
								<button class="facebook-action-btn like-btn liked" data-post="3">
									<i class="fas fa-thumbs-up"></i>
									<span>Like</span>
								</button>
								<button class="facebook-action-btn comment-btn">
									<i class="far fa-comment"></i>
									<span>Comment</span>
								</button>
								<button class="facebook-action-btn share-btn">
									<i class="fas fa-share"></i>
									<span>Share</span>
								</button>
							</div>
						</div>

						<!-- Sponsored Post -->
						<div class="facebook-post sponsored">
							<div class="sponsored-label">
								<i class="fas fa-ad"></i>
								<span>Sponsored</span>
							</div>
							<div class="post-header">
								<div class="post-user-info">
									<div class="user-avatar">CF</div>
									<div class="user-details">
										<h4>Coffee House Premium</h4>
										<div class="post-meta">
											<span class="post-time">Sponsored</span> • 
											<i class="fas fa-globe-americas"></i>
										</div>
									</div>
								</div>
								<div class="post-options">
									<button class="post-menu-btn">
										<i class="fas fa-ellipsis-h"></i>
									</button>
								</div>
							</div>
							
							<div class="post-content">
								<p>☕ Start your morning right with our premium coffee blends! Now offering 20% off for new customers. Visit us today!</p>
								<div class="post-media">
									<img src="https://via.placeholder.com/600x300/8b4513/ffffff?text=Premium+Coffee" alt="Premium Coffee">
								</div>
								<div class="sponsored-cta">
									<button class="cta-button">Learn More</button>
									<button class="cta-button secondary">Shop Now</button>
								</div>
							</div>
						</div>

						<!-- Load More -->
						<div class="load-more-container">
							<button class="load-more-btn">
								<i class="fas fa-spinner"></i>
								Load More Posts
							</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Notifications Tab -->
			<div id="notifications" class="tab-content">
				<!-- Content Header -->
				<div class="content-header">
					<div>
						<h1>Notifications</h1>
						<p>Stay updated with your business activities</p>
					</div>
				</div>

				<!-- Notification Filters -->
				<div class="notification-filters">
					<button class="filter-btn active" data-filter="all">All</button>
					<button class="filter-btn" data-filter="message">Messages</button>
					<button class="filter-btn" data-filter="business">Business</button>
					<button class="filter-btn" data-filter="system">System</button>
					<button class="mark-all-read-btn" onclick="markAllAsRead()">
						<i class="fas fa-check-double"></i> Mark All Read
					</button>
				</div>

				<!-- Notifications List -->
				<div class="notifications-list">
					<div class="notification-card unread" data-type="message">
						<button class="mark-read-btn" onclick="markAsRead(this)">
							<i class="fas fa-times"></i>
						</button>
						<div class="notification-icon message">
							<i class="fas fa-envelope"></i>
						</div>
						<div class="notification-content">
							<div class="notification-title">New message from Sarah Johnson</div>
							<div class="notification-text">Hi! I'm interested in your catering services for our corporate event...</div>
							<div class="notification-time">5 minutes ago</div>
						</div>
					</div>

					<div class="notification-card unread" data-type="business">
						<button class="mark-read-btn" onclick="markAsRead(this)">
							<i class="fas fa-times"></i>
						</button>
						<div class="notification-icon business">
							<i class="fas fa-store"></i>
						</div>
						<div class="notification-content">
							<div class="notification-title">New business review</div>
							<div class="notification-text">Mike Chen left a 5-star review for your restaurant</div>
							<div class="notification-time">2 hours ago</div>
						</div>
					</div>

					<div class="notification-card" data-type="system">
						<button class="mark-read-btn" onclick="markAsRead(this)">
							<i class="fas fa-times"></i>
						</button>
						<div class="notification-icon system">
							<i class="fas fa-cog"></i>
						</div>
						<div class="notification-content">
							<div class="notification-title">Profile updated successfully</div>
							<div class="notification-text">Your business profile has been updated with new information</div>
							<div class="notification-time">1 day ago</div>
						</div>
					</div>

					<div class="notification-card" data-type="business">
						<button class="mark-read-btn" onclick="markAsRead(this)">
							<i class="fas fa-times"></i>
						</button>
						<div class="notification-icon business">
							<i class="fas fa-heart"></i>
						</div>
						<div class="notification-content">
							<div class="notification-title">Someone liked your post</div>
							<div class="notification-text">Alex Thompson and 12 others liked your recent business update</div>
							<div class="notification-time">2 days ago</div>
						</div>
					</div>

					<div class="notification-card unread" data-type="message">
						<button class="mark-read-btn" onclick="markAsRead(this)">
							<i class="fas fa-times"></i>
						</button>
						<div class="notification-icon message">
							<i class="fas fa-comment"></i>
						</div>
						<div class="notification-content">
							<div class="notification-title">New comment on your post</div>
							<div class="notification-text">Emma Wilson commented: "Great service! Will definitely recommend..."</div>
							<div class="notification-time">3 days ago</div>
						</div>
					</div>

					<div class="notification-card" data-type="system">
						<button class="mark-read-btn" onclick="markAsRead(this)">
							<i class="fas fa-times"></i>
						</button>
						<div class="notification-icon system">
							<i class="fas fa-shield-alt"></i>
						</div>
						<div class="notification-content">
							<div class="notification-title">Security update</div>
							<div class="notification-text">Your account security settings have been updated</div>
							<div class="notification-time">1 week ago</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Profile Tab -->
			<div id="profile" class="tab-content">
				<!-- Content Header -->
				<div class="content-header">
					<div>
						<h1>Profile Management</h1>
						<p>Manage your business profile and settings</p>
					</div>
				</div>
				<!-- Content will be added in next part -->
			</div>
		</div>
	</div>

	<script>
		// Tab switching functionality
		function showTab(tabName) {
			// Hide all tab contents
			document.querySelectorAll('.tab-content').forEach(tab => {
				tab.classList.remove('active');
			});
			
			// Remove active class from all nav tabs
			document.querySelectorAll('.nav-tab').forEach(navTab => {
				navTab.classList.remove('active');
			});
			
			// Show selected tab content
			document.getElementById(tabName).classList.add('active');
			
			// Add active class to selected nav tab
			document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
		}

		// Add click event listeners to nav tabs
		document.addEventListener('DOMContentLoaded', function() {
			// Tab switching
			document.querySelectorAll('.nav-tab[data-tab]').forEach(tab => {
				tab.addEventListener('click', function() {
					const tabName = this.getAttribute('data-tab');
					showTab(tabName);
				});
			});
			
			// Notification filter buttons
			document.querySelectorAll('.filter-btn[data-filter]').forEach(btn => {
				btn.addEventListener('click', function() {
					const filterType = this.getAttribute('data-filter');
					filterNotifications(filterType);
				});
			});
			
			// Business card interactions
			document.querySelectorAll('.business-card').forEach(card => {
				card.addEventListener('click', function() {
					// Add click animation
					this.style.transform = 'scale(0.98)';
					setTimeout(() => {
						this.style.transform = '';
					}, 150);
				});
			});
			
			// Like button interactions
			document.querySelectorAll('.like-btn').forEach(btn => {
				btn.addEventListener('click', function() {
					this.classList.toggle('liked');
					const icon = this.querySelector('i');
					if (this.classList.contains('liked')) {
						icon.className = 'fas fa-heart';
					} else {
						icon.className = 'far fa-heart';
					}
				});
			});
			
			// Search functionality
			const searchInputs = document.querySelectorAll('.search-input');
			searchInputs.forEach(input => {
				input.addEventListener('input', function() {
					const searchTerm = this.value.toLowerCase();
					const businessCards = document.querySelectorAll('.business-card');
					
					businessCards.forEach(card => {
						const businessName = card.querySelector('h3').textContent.toLowerCase();
						const businessDescription = card.querySelector('.business-description')?.textContent.toLowerCase() || '';
						
						if (businessName.includes(searchTerm) || businessDescription.includes(searchTerm)) {
							card.style.display = 'block';
						} else {
							card.style.display = searchTerm === '' ? 'block' : 'none';
						}
					});
				});
			});
			
			// Category filter functionality
			document.querySelectorAll('.category-btn').forEach(btn => {
				btn.addEventListener('click', function() {
					const category = this.getAttribute('data-category');
					const businessCards = document.querySelectorAll('.business-card');
					const categoryBtns = document.querySelectorAll('.category-btn');
					
					// Update active category button
					categoryBtns.forEach(b => b.classList.remove('active'));
					this.classList.add('active');
					
					// Filter business cards
					businessCards.forEach(card => {
						if (category === 'all') {
							card.style.display = 'block';
						} else {
							const cardCategory = card.getAttribute('data-category');
							card.style.display = cardCategory === category ? 'block' : 'none';
						}
					});
				});
			});
			
			// SIDEBAR NAVIGATION FIX - Add event listeners for sidebar navigation
			document.querySelectorAll('.nav-item[data-tab] .nav-link').forEach(link => {
				link.addEventListener('click', function(e) {
					e.preventDefault();
					const navItem = this.closest('.nav-item');
					const tabName = navItem.getAttribute('data-tab');
					
					// Handle special cases for tab names
					let targetTab = tabName;
					if (tabName === 'dashboard') {
						targetTab = 'overview'; // Map dashboard to overview tab
					}
					
					// Remove active from all nav items
					document.querySelectorAll('.nav-item').forEach(item => {
						item.classList.remove('active');
					});
					
					// Add active to clicked nav item
					navItem.classList.add('active');
					
					// Switch to the target tab
					showTab(targetTab);
				});
			});
			
			// Set default active sidebar item
			const defaultNavItem = document.querySelector('.nav-item[data-tab="dashboard"]');
			if (defaultNavItem) {
				defaultNavItem.classList.add('active');
			}
			
			// Notification filtering functionality
			function filterNotifications(filterType) {
				const notifications = document.querySelectorAll('.notification-card');
				const filterBtns = document.querySelectorAll('.filter-btn');
				
				// Update active filter button
				filterBtns.forEach(btn => btn.classList.remove('active'));
				document.querySelector(`[data-filter="${filterType}"]`).classList.add('active');
				
				// Show/hide notifications based on filter
				notifications.forEach(notification => {
					if (filterType === 'all') {
						notification.style.display = 'flex';
					} else {
						const notificationType = notification.getAttribute('data-type');
						notification.style.display = notificationType === filterType ? 'flex' : 'none';
					}
				});
			}
			
			// Mark notification as read
			function markAsRead(button) {
				const notificationCard = button.closest('.notification-card');
				notificationCard.classList.remove('unread');
				button.style.display = 'none';
			}
			
			// Mark all notifications as read
			function markAllAsRead() {
				const unreadNotifications = document.querySelectorAll('.notification-card.unread');
				const markReadBtns = document.querySelectorAll('.mark-read-btn');
				
				unreadNotifications.forEach(notification => {
					notification.classList.remove('unread');
				});
				
				markReadBtns.forEach(btn => {
					btn.style.display = 'none';
				});
			}
		});
		
		// Image upload functionality
		function triggerImageUpload() {
			document.getElementById('imageUpload').click();
		}
		
		function previewImage(input) {
			const preview = document.getElementById('imagePreview');
			const previewImg = document.getElementById('previewImg');
			const file = input.files[0];
			const reader = new FileReader();
			
			reader.onload = function(e) {
				previewImg.src = e.target.result;
				preview.style.display = 'block';
			};
			
			reader.readAsDataURL(file);
		}
		
		function removeImage() {
			const preview = document.getElementById('imagePreview');
			const previewImg = document.getElementById('previewImg');
			const imageUpload = document.getElementById('imageUpload');
			
			preview.style.display = 'none';
			previewImg.src = '';
			imageUpload.value = '';
		}
		
		// Notification filtering functionality
		function filterNotifications(filterType) {
			const notifications = document.querySelectorAll('.notification-card');
			const filterBtns = document.querySelectorAll('.filter-btn');
			
			// Update active filter button
			filterBtns.forEach(btn => btn.classList.remove('active'));
			document.querySelector(`[data-filter="${filterType}"]`).classList.add('active');
			
			// Show/hide notifications based on filter
			notifications.forEach(notification => {
				if (filterType === 'all') {
					notification.style.display = 'flex';
				} else {
					const notificationType = notification.getAttribute('data-type');
					notification.style.display = notificationType === filterType ? 'flex' : 'none';
				}
			});
		}
		
		// Mark notification as read
		function markAsRead(button) {
			const notificationCard = button.closest('.notification-card');
			notificationCard.classList.remove('unread');
			button.style.display = 'none';
		}
		
		// Mark all notifications as read
		function markAllAsRead() {
			const unreadNotifications = document.querySelectorAll('.notification-card.unread');
			const markReadBtns = document.querySelectorAll('.mark-read-btn');
			
			unreadNotifications.forEach(notification => {
				notification.classList.remove('unread');
			});
			
			markReadBtns.forEach(btn => {
				btn.style.display = 'none';
			});
		}
	</script>
</body>
</html>
```
```
