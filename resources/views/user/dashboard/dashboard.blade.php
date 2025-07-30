<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>BizNest Dashboard</title>
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

		/* Sidebar Styles */
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

		.header-actions {
			display: flex;
			gap: 15px;
		}

		.header-btn {
			padding: 12px 20px;
			border: none;
			border-radius: 10px;
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			color: white;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.3s ease;
			text-decoration: none;
			display: inline-flex;
			align-items: center;
			gap: 8px;
		}

		.header-btn:hover {
			transform: translateY(-2px);
			box-shadow: 0 8px 25px rgba(127, 176, 105, 0.3);
		}

		.stats-grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
			gap: 20px;
			margin-bottom: 30px;
		}

		.stat-card {
			background: rgba(255, 255, 255, 0.1);
			border-radius: 15px;
			padding: 25px;
			backdrop-filter: blur(20px);
			border: 1px solid rgba(255, 255, 255, 0.2);
			transition: all 0.3s ease;
			position: relative;
			overflow: hidden;
		}

		.stat-card:hover {
			transform: translateY(-5px);
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
		}

		.stat-card::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 3px;
			background: linear-gradient(90deg, #7fb069, #5a8a4a);
		}

		.stat-icon {
			width: 50px;
			height: 50px;
			border-radius: 12px;
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			display: flex;
			align-items: center;
			justify-content: center;
			margin-bottom: 15px;
			color: white;
			font-size: 20px;
		}

		.stat-value {
			font-size: 2rem;
			font-weight: 700;
			color: white;
			margin-bottom: 5px;
		}

		.stat-label {
			color: rgba(255, 255, 255, 0.7);
			font-size: 14px;
		}

		.content-section {
			background: rgba(255, 255, 255, 0.05);
			border-radius: 15px;
			padding: 25px;
			backdrop-filter: blur(20px);
			border: 1px solid rgba(255, 255, 255, 0.1);
			margin-bottom: 25px;
		}

		.section-header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 20px;
		}

		.section-title {
			font-size: 1.3rem;
			font-weight: 600;
			color: white;
		}

		.products-table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 15px;
		}

		.products-table th,
		.products-table td {
			padding: 15px;
			text-align: left;
			border-bottom: 1px solid rgba(255, 255, 255, 0.1);
		}

		.products-table th {
			background: rgba(255, 255, 255, 0.05);
			color: #7fb069;
			font-weight: 600;
			font-size: 14px;
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}

		.products-table td {
			color: white;
		}

		.products-table tr:hover {
			background: rgba(255, 255, 255, 0.05);
		}

		/* Responsive Design */
		@media (max-width: 768px) {
			.dashboard-container {
				flex-direction: column;
			}

			.sidebar {
				width: 100%;
				height: auto;
				padding: 15px;
			}

			.stats-grid {
				grid-template-columns: 1fr;
			}

			.header {
				flex-direction: column;
				align-items: flex-start;
				gap: 15px;
			}

			.header-actions {
				width: 100%;
				justify-content: flex-start;
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
					<a href="{{ url('/user/dashboard/dashboard') }}" class="nav-link active">
						<i class="fas fa-home"></i>
						<span>Dashboard</span>
					</a>
				</div>
				<div class="nav-item">
					<a href="{{ url('/user/dashboard/explore') }}" class="nav-link">
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
					<h1>Welcome back, {{ $users->name }}!</h1>
					<p>Here's what's happening with your business today.</p>
				</div>
				<div class="header-actions">
					<a href="#" class="header-btn">
						<i class="fas fa-plus"></i>
						Create Post
					</a>
					<a href="{{ url('/') }}" class="header-btn">
						<i class="fas fa-home"></i>
						Home Page
					</a>
				</div>
			</div>

			<!-- Stats Grid -->
			<div class="stats-grid">
				<div class="stat-card">
					<div class="stat-icon">
						<i class="fas fa-box"></i>
					</div>
					<div class="stat-value">{{ $products->count() }}</div>
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

			<!-- Products Section -->
			<div class="content-section">
				<div class="section-header">
					<h2 class="section-title">Your Products</h2>
					<a href="#" class="header-btn">
						<i class="fas fa-plus"></i>
						Add Product
					</a>
				</div>
				@if($products->count() > 0)
					<table class="products-table">
						<thead>
							<tr>
								<th>Product Name</th>
								<th>Location</th>
								<th>Quantity</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($products as $product)
								<tr>
									<td>{{ $product->product_name }}</td>
									<td>{{ $product->location }}</td>
									<td>{{ $product->quantity }}</td>
									<td>
										<a href="#" class="action-btn" style="margin-right: 8px;">Edit</a>
										<a href="#" class="action-btn logout-btn">Delete</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					<div style="text-align: center; padding: 40px; color: rgba(255, 255, 255, 0.7);">
						<i class="fas fa-box" style="font-size: 3rem; margin-bottom: 15px; opacity: 0.5;"></i>
						<h3>No products yet</h3>
						<p>Start by adding your first product to showcase your business.</p>
					</div>
				@endif
			</div>
		</div>
	</div>

	<script>
		// Add some interactivity
		document.addEventListener('DOMContentLoaded', function() {
			// Animate stat cards on load
			const statCards = document.querySelectorAll('.stat-card');
			statCards.forEach((card, index) => {
				setTimeout(() => {
					card.style.opacity = '0';
					card.style.transform = 'translateY(20px)';
					card.style.transition = 'all 0.5s ease';
					
					setTimeout(() => {
						card.style.opacity = '1';
						card.style.transform = 'translateY(0)';
					}, 100);
				}, index * 150);
			});
		});
	</script>
</body>
</html>
