<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>BizNest - Profile</title>
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

		.profile-content {
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 30px;
			margin-bottom: 30px;
		}

		.profile-card {
			background: rgba(255, 255, 255, 0.1);
			border-radius: 15px;
			padding: 25px;
			backdrop-filter: blur(20px);
			border: 1px solid rgba(255, 255, 255, 0.2);
		}

		.profile-header-card {
			grid-column: 1 / -1;
			display: flex;
			align-items: center;
			gap: 30px;
		}

		.main-avatar {
			width: 120px;
			height: 120px;
			border-radius: 50%;
			border: 4px solid #7fb069;
			position: relative;
			overflow: hidden;
		}

		.main-avatar::before {
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

		.profile-main-info h2 {
			font-size: 2rem;
			font-weight: 700;
			color: white;
			margin-bottom: 10px;
		}

		.profile-main-info p {
			color: rgba(255, 255, 255, 0.7);
			font-size: 16px;
			margin-bottom: 8px;
		}

		.profile-badges {
			display: flex;
			gap: 10px;
			margin-top: 15px;
		}

		.badge {
			background: rgba(127, 176, 105, 0.2);
			color: #7fb069;
			padding: 6px 12px;
			border-radius: 15px;
			font-size: 12px;
			font-weight: 500;
		}

		.card-title {
			font-size: 1.2rem;
			font-weight: 600;
			color: white;
			margin-bottom: 20px;
			display: flex;
			align-items: center;
			gap: 10px;
		}

		.card-title i {
			color: #7fb069;
		}

		.form-group {
			margin-bottom: 20px;
		}

		.form-label {
			display: block;
			color: rgba(255, 255, 255, 0.8);
			font-size: 14px;
			font-weight: 500;
			margin-bottom: 8px;
		}

		.form-input {
			width: 100%;
			background: rgba(255, 255, 255, 0.1);
			border: 1px solid rgba(255, 255, 255, 0.2);
			border-radius: 10px;
			padding: 12px 15px;
			color: white;
			font-size: 14px;
			outline: none;
			transition: all 0.3s ease;
		}

		.form-input:focus {
			border-color: #7fb069;
			box-shadow: 0 0 0 3px rgba(127, 176, 105, 0.1);
		}

		.form-input::placeholder {
			color: rgba(255, 255, 255, 0.5);
		}

		.form-textarea {
			min-height: 100px;
			resize: vertical;
		}

		.stats-grid {
			display: grid;
			grid-template-columns: repeat(2, 1fr);
			gap: 15px;
		}

		.stat-item {
			background: rgba(255, 255, 255, 0.05);
			border-radius: 10px;
			padding: 15px;
			text-align: center;
		}

		.stat-number {
			font-size: 1.5rem;
			font-weight: 700;
			color: #7fb069;
			margin-bottom: 5px;
		}

		.stat-label {
			color: rgba(255, 255, 255, 0.7);
			font-size: 12px;
		}

		.activity-item {
			display: flex;
			align-items: center;
			gap: 15px;
			padding: 15px 0;
			border-bottom: 1px solid rgba(255, 255, 255, 0.1);
		}

		.activity-item:last-child {
			border-bottom: none;
		}

		.activity-icon {
			width: 35px;
			height: 35px;
			border-radius: 50%;
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			display: flex;
			align-items: center;
			justify-content: center;
			color: white;
			font-size: 14px;
		}

		.activity-info h4 {
			color: white;
			font-weight: 500;
			margin-bottom: 3px;
		}

		.activity-info p {
			color: rgba(255, 255, 255, 0.6);
			font-size: 12px;
		}

		.save-btn {
			width: 100%;
			padding: 12px;
			border: none;
			border-radius: 10px;
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			color: white;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.3s ease;
			margin-top: 20px;
		}

		.save-btn:hover {
			transform: translateY(-2px);
			box-shadow: 0 8px 25px rgba(127, 176, 105, 0.3);
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

			.profile-content {
				grid-template-columns: 1fr;
			}

			.profile-header-card {
				flex-direction: column;
				text-align: center;
			}

			.stats-grid {
				grid-template-columns: 1fr;
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
					<a href="{{ url('/user/dashboard/profile') }}" class="nav-link active">
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
					<h1>Profile</h1>
					<p>Manage your business profile and account settings.</p>
				</div>
				<div class="header-actions">
					<button class="header-btn">
						<i class="fas fa-camera"></i>
						Change Photo
					</button>
				</div>
			</div>

			<!-- Profile Content -->
			<div class="profile-content">
				<!-- Profile Header -->
				<div class="profile-card profile-header-card">
					<img src="{{ asset('assest/'. $users->avatar) }}" alt="Profile Picture" class="main-avatar">
					<div class="profile-main-info">
						<h2>{{ $users->name }}</h2>
						<p><i class="fas fa-envelope"></i> {{ $users->email }}</p>
						<p><i class="fas fa-calendar"></i> Member since March 2024</p>
						<p><i class="fas fa-map-marker-alt"></i> Colombo, Sri Lanka</p>
						<div class="profile-badges">
							<span class="badge">Verified Business</span>
							<span class="badge">Premium Member</span>
							<span class="badge">Active Seller</span>
						</div>
					</div>
				</div>

				<!-- Personal Information -->
				<div class="profile-card">
					<h3 class="card-title">
						<i class="fas fa-user"></i>
						Personal Information
					</h3>
					<form>
						<div class="form-group">
							<label class="form-label">Full Name</label>
							<input type="text" class="form-input" value="{{ $users->name }}" placeholder="Enter your full name">
						</div>
						<div class="form-group">
							<label class="form-label">Email Address</label>
							<input type="email" class="form-input" value="{{ $users->email }}" placeholder="Enter your email">
						</div>
						<div class="form-group">
							<label class="form-label">Phone Number</label>
							<input type="tel" class="form-input" placeholder="Enter your phone number">
						</div>
						<div class="form-group">
							<label class="form-label">Location</label>
							<input type="text" class="form-input" placeholder="Enter your location">
						</div>
						<button type="submit" class="save-btn">Save Changes</button>
					</form>
				</div>

				<!-- Business Information -->
				<div class="profile-card">
					<h3 class="card-title">
						<i class="fas fa-building"></i>
						Business Information
					</h3>
					<form>
						<div class="form-group">
							<label class="form-label">Business Name</label>
							<input type="text" class="form-input" placeholder="Enter your business name">
						</div>
						<div class="form-group">
							<label class="form-label">Industry</label>
							<input type="text" class="form-input" placeholder="e.g., Technology, Food & Beverage">
						</div>
						<div class="form-group">
							<label class="form-label">Business Description</label>
							<textarea class="form-input form-textarea" placeholder="Describe your business..."></textarea>
						</div>
						<div class="form-group">
							<label class="form-label">Website</label>
							<input type="url" class="form-input" placeholder="https://yourwebsite.com">
						</div>
						<button type="submit" class="save-btn">Update Business Info</button>
					</form>
				</div>

				<!-- Account Statistics -->
				<div class="profile-card">
					<h3 class="card-title">
						<i class="fas fa-chart-bar"></i>
						Account Statistics
					</h3>
					<div class="stats-grid">
						<div class="stat-item">
							<div class="stat-number">156</div>
							<div class="stat-label">Profile Views</div>
						</div>
						<div class="stat-item">
							<div class="stat-number">23</div>
							<div class="stat-label">Connections</div>
						</div>
						<div class="stat-item">
							<div class="stat-number">8</div>
							<div class="stat-label">Posts Created</div>
						</div>
						<div class="stat-item">
							<div class="stat-number">4.8</div>
							<div class="stat-label">Average Rating</div>
						</div>
					</div>
				</div>

				<!-- Recent Activity -->
				<div class="profile-card">
					<h3 class="card-title">
						<i class="fas fa-clock"></i>
						Recent Activity
					</h3>
					<div class="activity-list">
						<div class="activity-item">
							<div class="activity-icon">
								<i class="fas fa-plus"></i>
							</div>
							<div class="activity-info">
								<h4>Created a new post</h4>
								<p>2 hours ago</p>
							</div>
						</div>
						<div class="activity-item">
							<div class="activity-icon">
								<i class="fas fa-handshake"></i>
							</div>
							<div class="activity-info">
								<h4>Connected with Tech Mart Solutions</h4>
								<p>1 day ago</p>
							</div>
						</div>
						<div class="activity-item">
							<div class="activity-icon">
								<i class="fas fa-star"></i>
							</div>
							<div class="activity-info">
								<h4>Received a 5-star review</h4>
								<p>3 days ago</p>
							</div>
						</div>
						<div class="activity-item">
							<div class="activity-icon">
								<i class="fas fa-edit"></i>
							</div>
							<div class="activity-info">
								<h4>Updated business information</h4>
								<p>1 week ago</p>
							</div>
						</div>
					</div>
				</div>

				<!-- Security Settings -->
				<div class="profile-card">
					<h3 class="card-title">
						<i class="fas fa-shield-alt"></i>
						Security Settings
					</h3>
					<form>
						<div class="form-group">
							<label class="form-label">Current Password</label>
							<input type="password" class="form-input" placeholder="Enter current password">
						</div>
						<div class="form-group">
							<label class="form-label">New Password</label>
							<input type="password" class="form-input" placeholder="Enter new password">
						</div>
						<div class="form-group">
							<label class="form-label">Confirm New Password</label>
							<input type="password" class="form-input" placeholder="Confirm new password">
						</div>
						<button type="submit" class="save-btn">Update Password</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Form submission handlers
			const forms = document.querySelectorAll('form');
			forms.forEach(form => {
				form.addEventListener('submit', function(e) {
					e.preventDefault();
					const submitBtn = this.querySelector('.save-btn');
					const originalText = submitBtn.textContent;
					
					submitBtn.textContent = 'Saving...';
					submitBtn.disabled = true;
					
					// Simulate API call
					setTimeout(() => {
						submitBtn.textContent = 'Saved!';
						setTimeout(() => {
							submitBtn.textContent = originalText;
							submitBtn.disabled = false;
						}, 1500);
					}, 1000);
				});
			});

			// Photo change handler
			const changePhotoBtn = document.querySelector('.header-btn');
			changePhotoBtn.addEventListener('click', function() {
				// Create file input
				const fileInput = document.createElement('input');
				fileInput.type = 'file';
				fileInput.accept = 'image/*';
				fileInput.style.display = 'none';
				
				fileInput.addEventListener('change', function(e) {
					if (e.target.files[0]) {
						console.log('Photo selected:', e.target.files[0].name);
						// Add photo upload logic here
					}
				});
				
				document.body.appendChild(fileInput);
				fileInput.click();
				document.body.removeChild(fileInput);
			});
		});
	</script>
</body>
</html>
