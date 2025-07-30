<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>BizNest - Explore</title>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
	
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: 'Inter', sans-serif;
			background: linear-gradient(135deg, #1a2f1a 0%, #0d4f0d 50%, #1a2f1a 100%);
			min-height: 100vh;
			color: white;
			overflow-x: hidden;
		}

		.dashboard-container {
			display: flex;
			min-height: 100vh;
		}

		/* Sidebar Styles - Same as dashboard */
		.sidebar {
			width: 280px;
			background: rgba(255, 255, 255, 0.1);
			backdrop-filter: blur(20px);
			border-right: 1px solid rgba(255, 255, 255, 0.2);
			padding: 25px 20px;
			display: flex;
			flex-direction: column;
			position: relative;
			overflow: hidden;
		}

		.sidebar::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 2px;
			background: linear-gradient(90deg, transparent, #7fb069, transparent);
			animation: shimmer 3s infinite;
		}

		@keyframes shimmer {
			0% { transform: translateX(-100%); }
			100% { transform: translateX(100%); }
		}

		.logo-section {
			display: flex;
			align-items: center;
			gap: 15px;
			margin-bottom: 30px;
			padding-bottom: 20px;
			border-bottom: 1px solid rgba(255, 255, 255, 0.1);
		}

		.logo {
			width: 45px;
			height: 45px;
			border-radius: 12px;
		}

		.logo-text {
			font-size: 1.5rem;
			font-weight: 700;
			color: #7fb069;
			text-shadow: 0 0 20px rgba(127, 176, 105, 0.3);
		}

		.nav-menu {
			flex: 1;
			margin-bottom: 20px;
		}

		.nav-item {
			margin-bottom: 8px;
		}

		.nav-link {
			display: flex;
			align-items: center;
			gap: 15px;
			padding: 15px 18px;
			border-radius: 12px;
			color: rgba(255, 255, 255, 0.8);
			text-decoration: none;
			transition: all 0.3s ease;
			font-weight: 500;
		}

		.nav-link:hover {
			background: rgba(255, 255, 255, 0.1);
			color: white;
			transform: translateX(5px);
		}

		.nav-link.active {
			background: linear-gradient(135deg, rgba(127, 176, 105, 0.2), rgba(127, 176, 105, 0.1));
			border: 1px solid rgba(127, 176, 105, 0.3);
			color: #7fb069;
		}

		.nav-link i {
			width: 20px;
			text-align: center;
			font-size: 16px;
		}

		.user-profile {
			padding: 20px;
			background: rgba(255, 255, 255, 0.05);
			border-radius: 15px;
			border: 1px solid rgba(255, 255, 255, 0.1);
			margin-bottom: 20px;
		}

		.profile-info {
			display: flex;
			align-items: center;
			gap: 15px;
			margin-bottom: 15px;
		}

		.profile-avatar {
			width: 50px;
			height: 50px;
			border-radius: 50%;
			border: 2px solid #7fb069;
			position: relative;
			overflow: hidden;
		}

		.profile-avatar::before {
			content: '';
			position: absolute;
			top: -50%;
			left: -50%;
			width: 200%;
			height: 200%;
			background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
			transform: rotate(45deg);
			animation: avatarShine 3s infinite;
		}

		@keyframes avatarShine {
			0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
			100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
		}

		.profile-details h4 {
			color: white;
			font-weight: 600;
			margin-bottom: 4px;
		}

		.profile-details p {
			color: rgba(255, 255, 255, 0.7);
			font-size: 13px;
		}

		.action-buttons {
			display: flex;
			flex-direction: column;
			gap: 8px;
		}

		.action-btn {
			padding: 8px 15px;
			border: none;
			border-radius: 8px;
			background: rgba(255, 255, 255, 0.1);
			color: white;
			font-size: 13px;
			cursor: pointer;
			transition: all 0.3s ease;
			text-decoration: none;
			display: inline-block;
			text-align: center;
		}

		.action-btn:hover {
			background: rgba(127, 176, 105, 0.2);
			color: #7fb069;
			transform: translateY(-2px);
		}

		.logout-btn:hover {
			background: rgba(220, 53, 69, 0.2);
			color: #dc3545;
		}

		/* Main Content Styles */
		.main-content {
			flex: 1;
			padding: 25px;
			overflow-y: auto;
		}

		.header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 30px;
			padding-bottom: 20px;
			border-bottom: 1px solid rgba(255, 255, 255, 0.1);
		}

		.header h1 {
			font-size: 2rem;
			font-weight: 700;
			color: white;
			margin-bottom: 5px;
		}

		.header p {
			color: rgba(255, 255, 255, 0.7);
		}

		.search-section {
			background: rgba(255, 255, 255, 0.1);
			border-radius: 15px;
			padding: 25px;
			margin-bottom: 30px;
			backdrop-filter: blur(20px);
			border: 1px solid rgba(255, 255, 255, 0.2);
		}

		.search-bar {
			display: flex;
			gap: 15px;
			margin-bottom: 20px;
		}

		.search-input {
			flex: 1;
			background: rgba(255, 255, 255, 0.1);
			border: 1px solid rgba(255, 255, 255, 0.2);
			border-radius: 10px;
			padding: 15px 20px;
			color: white;
			font-size: 16px;
			outline: none;
		}

		.search-input::placeholder {
			color: rgba(255, 255, 255, 0.6);
		}

		.search-btn {
			padding: 15px 25px;
			border: none;
			border-radius: 10px;
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			color: white;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.3s ease;
			display: flex;
			align-items: center;
			gap: 8px;
		}

		.search-btn:hover {
			transform: translateY(-2px);
			box-shadow: 0 8px 25px rgba(127, 176, 105, 0.3);
		}

		.filter-tabs {
			display: flex;
			gap: 10px;
			flex-wrap: wrap;
		}

		.filter-tab {
			padding: 10px 20px;
			border: 1px solid rgba(255, 255, 255, 0.2);
			border-radius: 25px;
			background: rgba(255, 255, 255, 0.05);
			color: rgba(255, 255, 255, 0.8);
			cursor: pointer;
			transition: all 0.3s ease;
			font-size: 14px;
		}

		.filter-tab:hover,
		.filter-tab.active {
			background: rgba(127, 176, 105, 0.2);
			border-color: #7fb069;
			color: #7fb069;
		}

		.results-section {
			display: grid;
			grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
			gap: 25px;
			margin-bottom: 30px;
		}

		.business-card {
			background: rgba(255, 255, 255, 0.1);
			border-radius: 15px;
			padding: 20px;
			backdrop-filter: blur(20px);
			border: 1px solid rgba(255, 255, 255, 0.2);
			transition: all 0.3s ease;
			cursor: pointer;
		}

		.business-card:hover {
			transform: translateY(-5px);
			box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
			border-color: rgba(127, 176, 105, 0.5);
		}

		.business-header {
			display: flex;
			align-items: center;
			gap: 15px;
			margin-bottom: 15px;
		}

		.business-logo {
			width: 50px;
			height: 50px;
			border-radius: 10px;
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			display: flex;
			align-items: center;
			justify-content: center;
			color: white;
			font-weight: 600;
			font-size: 18px;
		}

		.business-info h3 {
			color: white;
			font-weight: 600;
			margin-bottom: 5px;
		}

		.business-info p {
			color: rgba(255, 255, 255, 0.6);
			font-size: 13px;
		}

		.business-description {
			color: rgba(255, 255, 255, 0.8);
			line-height: 1.5;
			margin-bottom: 15px;
			font-size: 14px;
		}

		.business-tags {
			display: flex;
			flex-wrap: wrap;
			gap: 8px;
			margin-bottom: 15px;
		}

		.business-tag {
			background: rgba(127, 176, 105, 0.2);
			color: #7fb069;
			padding: 4px 10px;
			border-radius: 12px;
			font-size: 12px;
			font-weight: 500;
		}

		.business-actions {
			display: flex;
			gap: 10px;
		}

		.action-btn-small {
			flex: 1;
			padding: 8px 12px;
			border: none;
			border-radius: 8px;
			background: rgba(255, 255, 255, 0.1);
			color: white;
			font-size: 12px;
			cursor: pointer;
			transition: all 0.3s ease;
			text-align: center;
		}

		.action-btn-small:hover {
			background: rgba(127, 176, 105, 0.2);
			color: #7fb069;
		}

		.trending-section {
			background: rgba(255, 255, 255, 0.05);
			border-radius: 15px;
			padding: 25px;
			backdrop-filter: blur(20px);
			border: 1px solid rgba(255, 255, 255, 0.1);
		}

		.trending-section h2 {
			color: white;
			font-size: 1.5rem;
			font-weight: 600;
			margin-bottom: 20px;
		}

		.trending-list {
			display: flex;
			flex-direction: column;
			gap: 15px;
		}

		.trending-item {
			display: flex;
			align-items: center;
			gap: 15px;
			padding: 15px;
			background: rgba(255, 255, 255, 0.05);
			border-radius: 10px;
			transition: all 0.3s ease;
		}

		.trending-item:hover {
			background: rgba(255, 255, 255, 0.1);
		}

		.trending-number {
			width: 30px;
			height: 30px;
			border-radius: 50%;
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			display: flex;
			align-items: center;
			justify-content: center;
			color: white;
			font-weight: 600;
			font-size: 14px;
		}

		.trending-info h4 {
			color: white;
			font-weight: 500;
			margin-bottom: 2px;
		}

		.trending-info p {
			color: rgba(255, 255, 255, 0.6);
			font-size: 12px;
		}

		@media (max-width: 768px) {
			.dashboard-container {
				flex-direction: column;
			}

			.sidebar {
				width: 100%;
				height: auto;
				padding: 15px;
			}

			.results-section {
				grid-template-columns: 1fr;
			}

			.search-bar {
				flex-direction: column;
			}

			.filter-tabs {
				justify-content: center;
			}
		}
	</style>
</head>
<body>
	<div class="dashboard-container">
		<!-- Sidebar -->
		<div class="sidebar">
			<div class="logo-section">
				<img src="{{ asset('assest/Biz.png') }}" alt="BizNest Logo" class="logo">
				<span class="logo-text">BizNest</span>
			</div>

			<nav class="nav-menu">
				<div class="nav-item">
					<a href="{{ url('/user/dashboard/dashboard') }}" class="nav-link">
						<i class="fas fa-home"></i>
						<span>Dashboard</span>
					</a>
				</div>
				<div class="nav-item">
					<a href="{{ url('/user/dashboard/explore') }}" class="nav-link active">
						<i class="fas fa-search"></i>
						<span>Explore</span>
					</a>
				</div>
				<div class="nav-item">
					<a href="{{ url('/user/dashboard/notification') }}" class="nav-link">
						<i class="fas fa-bell"></i>
						<span>Notifications</span>
					</a>
				</div>
				<div class="nav-item">
					<a href="{{ url('/user/dashboard/newsfeed') }}" class="nav-link">
						<i class="fas fa-newspaper"></i>
						<span>Newsfeed</span>
					</a>
				</div>
				<div class="nav-item">
					<a href="{{ url('/user/dashboard/profile') }}" class="nav-link">
						<i class="fas fa-user"></i>
						<span>Profile</span>
					</a>
				</div>
				<div class="nav-item">
					<a href="{{ url('/chat') }}" class="nav-link">
						<i class="fas fa-comments"></i>
						<span>Messages</span>
					</a>
				</div>
			</nav>

			<div class="user-profile">
				<div class="profile-info">
					<img src="{{ asset('assest/'. $users->avatar) }}" alt="Profile Picture" class="profile-avatar">
					<div class="profile-details">
						<h4>{{ $users->name }}</h4>
						<p>{{ $users->email }}</p>
					</div>
				</div>
				<div class="action-buttons">
					<a href="#" class="action-btn">Analysis</a>
					<a href="#" class="action-btn">Contact Us</a>
					<a href="#" class="action-btn">Settings</a>
					<form method="POST" action="{{ route('logout') }}" style="display: inline;">
						@csrf
						<button type="submit" class="action-btn logout-btn">Logout</button>
					</form>
				</div>
			</div>
		</div>

		<!-- Main Content -->
		<div class="main-content">
			<div class="header">
				<div>
					<h1>Explore Businesses</h1>
					<p>Discover new businesses and opportunities in your network.</p>
				</div>
			</div>

			<!-- Search Section -->
			<div class="search-section">
				<div class="search-bar">
					<input type="text" class="search-input" placeholder="Search businesses, services, or locations...">
					<button class="search-btn">
						<i class="fas fa-search"></i>
						Search
					</button>
				</div>
				<div class="filter-tabs">
					<div class="filter-tab active">All</div>
					<div class="filter-tab">Technology</div>
					<div class="filter-tab">Food & Dining</div>
					<div class="filter-tab">Retail</div>
					<div class="filter-tab">Services</div>
					<div class="filter-tab">Healthcare</div>
					<div class="filter-tab">Education</div>
				</div>
			</div>

			<!-- Results Section -->
			<div class="results-section">
				<div class="business-card">
					<div class="business-header">
						<div class="business-logo">TM</div>
						<div class="business-info">
							<h3>Tech Mart Solutions</h3>
							<p>Colombo • Technology</p>
						</div>
					</div>
					<div class="business-description">
						Leading e-commerce platform provider helping small businesses establish their online presence with cutting-edge technology solutions.
					</div>
					<div class="business-tags">
						<span class="business-tag">E-commerce</span>
						<span class="business-tag">Web Development</span>
						<span class="business-tag">Digital Marketing</span>
					</div>
					<div class="business-actions">
						<button class="action-btn-small">View Profile</button>
						<button class="action-btn-small">Contact</button>
					</div>
				</div>

				<div class="business-card">
					<div class="business-header">
						<div class="business-logo">GF</div>
						<div class="business-info">
							<h3>Green Foods Lanka</h3>
							<p>Kandy • Food & Agriculture</p>
						</div>
					</div>
					<div class="business-description">
						Organic vegetable supplier committed to providing fresh, pesticide-free produce directly from farms to consumers across Sri Lanka.
					</div>
					<div class="business-tags">
						<span class="business-tag">Organic</span>
						<span class="business-tag">Delivery</span>
						<span class="business-tag">Fresh Produce</span>
					</div>
					<div class="business-actions">
						<button class="action-btn-small">View Profile</button>
						<button class="action-btn-small">Contact</button>
					</div>
				</div>

				<div class="business-card">
					<div class="business-header">
						<div class="business-logo">CS</div>
						<div class="business-info">
							<h3>Creative Studios</h3>
							<p>Galle • Design & Marketing</p>
						</div>
					</div>
					<div class="business-description">
						Professional graphic design agency specializing in brand identity, marketing materials, and creative solutions for businesses of all sizes.
					</div>
					<div class="business-tags">
						<span class="business-tag">Graphic Design</span>
						<span class="business-tag">Branding</span>
						<span class="business-tag">Marketing</span>
					</div>
					<div class="business-actions">
						<button class="action-btn-small">View Profile</button>
						<button class="action-btn-small">Contact</button>
					</div>
				</div>

				<div class="business-card">
					<div class="business-header">
						<div class="business-logo">MS</div>
						<div class="business-info">
							<h3>Mobile Solutions Hub</h3>
							<p>Negombo • Technology</p>
						</div>
					</div>
					<div class="business-description">
						Mobile app development company creating innovative solutions for businesses looking to expand their digital footprint.
					</div>
					<div class="business-tags">
						<span class="business-tag">Mobile Apps</span>
						<span class="business-tag">iOS</span>
						<span class="business-tag">Android</span>
					</div>
					<div class="business-actions">
						<button class="action-btn-small">View Profile</button>
						<button class="action-btn-small">Contact</button>
					</div>
				</div>

				<div class="business-card">
					<div class="business-header">
						<div class="business-logo">EL</div>
						<div class="business-info">
							<h3>EcoLife Products</h3>
							<p>Matara • Retail</p>
						</div>
					</div>
					<div class="business-description">
						Sustainable lifestyle products retailer offering eco-friendly alternatives for everyday items with island-wide delivery.
					</div>
					<div class="business-tags">
						<span class="business-tag">Eco-Friendly</span>
						<span class="business-tag">Sustainable</span>
						<span class="business-tag">Retail</span>
					</div>
					<div class="business-actions">
						<button class="action-btn-small">View Profile</button>
						<button class="action-btn-small">Contact</button>
					</div>
				</div>

				<div class="business-card">
					<div class="business-header">
						<div class="business-logo">FC</div>
						<div class="business-info">
							<h3>Fitness Central</h3>
							<p>Colombo • Health & Fitness</p>
						</div>
					</div>
					<div class="business-description">
						Modern fitness center offering personal training, group classes, and wellness programs for a healthier lifestyle.
					</div>
					<div class="business-tags">
						<span class="business-tag">Fitness</span>
						<span class="business-tag">Personal Training</span>
						<span class="business-tag">Wellness</span>
					</div>
					<div class="business-actions">
						<button class="action-btn-small">View Profile</button>
						<button class="action-btn-small">Contact</button>
					</div>
				</div>
			</div>

			<!-- Trending Section -->
			<div class="trending-section">
				<h2>Trending Searches</h2>
				<div class="trending-list">
					<div class="trending-item">
						<div class="trending-number">1</div>
						<div class="trending-info">
							<h4>Digital Marketing Services</h4>
							<p>+45% increase in searches this week</p>
						</div>
					</div>
					<div class="trending-item">
						<div class="trending-number">2</div>
						<div class="trending-info">
							<h4>Organic Food Delivery</h4>
							<p>+32% increase in searches this week</p>
						</div>
					</div>
					<div class="trending-item">
						<div class="trending-number">3</div>
						<div class="trending-info">
							<h4>Mobile App Development</h4>
							<p>+28% increase in searches this week</p>
						</div>
					</div>
					<div class="trending-item">
						<div class="trending-number">4</div>
						<div class="trending-info">
							<h4>Eco-Friendly Products</h4>
							<p>+25% increase in searches this week</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Filter tabs functionality
			const filterTabs = document.querySelectorAll('.filter-tab');
			filterTabs.forEach(tab => {
				tab.addEventListener('click', function() {
					filterTabs.forEach(t => t.classList.remove('active'));
					this.classList.add('active');
				});
			});

			// Search functionality
			const searchBtn = document.querySelector('.search-btn');
			const searchInput = document.querySelector('.search-input');
			
			searchBtn.addEventListener('click', function() {
				const query = searchInput.value.trim();
				if (query) {
					console.log('Searching for:', query);
					// Add search logic here
				}
			});

			// Business card interactions
			const businessCards = document.querySelectorAll('.business-card');
			businessCards.forEach(card => {
				card.addEventListener('click', function(e) {
					if (!e.target.classList.contains('action-btn-small')) {
						console.log('Viewing business profile');
						// Add navigation to business profile
					}
				});
			});

			// Action button interactions
			const actionBtns = document.querySelectorAll('.action-btn-small');
			actionBtns.forEach(btn => {
				btn.addEventListener('click', function(e) {
					e.stopPropagation();
					const action = this.textContent.trim();
					console.log('Action:', action);
					// Add specific action logic here
				});
			});
		});
	</script>
</body>
</html>
