<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>BizNest - Notifications</title>
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

		.notification-filters {
			display: flex;
			gap: 10px;
			margin-bottom: 25px;
			flex-wrap: wrap;
		}

		.filter-btn {
			padding: 10px 20px;
			border: 1px solid rgba(255, 255, 255, 0.2);
			border-radius: 25px;
			background: rgba(255, 255, 255, 0.05);
			color: rgba(255, 255, 255, 0.8);
			cursor: pointer;
			transition: all 0.3s ease;
			font-size: 14px;
		}

		.filter-btn:hover,
		.filter-btn.active {
			background: rgba(127, 176, 105, 0.2);
			border-color: #7fb069;
			color: #7fb069;
		}

		.notification-card {
			background: rgba(255, 255, 255, 0.1);
			border-radius: 15px;
			padding: 20px;
			margin-bottom: 15px;
			backdrop-filter: blur(20px);
			border: 1px solid rgba(255, 255, 255, 0.2);
			transition: all 0.3s ease;
			position: relative;
		}

		.notification-card:hover {
			transform: translateY(-2px);
			box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
		}

		.notification-card.unread {
			border-left: 4px solid #7fb069;
		}

		.notification-header {
			display: flex;
			align-items: center;
			gap: 15px;
			margin-bottom: 10px;
		}

		.notification-icon {
			width: 40px;
			height: 40px;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			color: white;
			font-size: 16px;
		}

		.notification-icon.message {
			background: linear-gradient(135deg, #4285f4, #2563eb);
		}

		.notification-icon.business {
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
		}

		.notification-icon.system {
			background: linear-gradient(135deg, #f59e0b, #d97706);
		}

		.notification-icon.warning {
			background: linear-gradient(135deg, #ef4444, #dc2626);
		}

		.notification-info {
			flex: 1;
		}

		.notification-title {
			color: white;
			font-weight: 600;
			margin-bottom: 5px;
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
		}

		.notification-actions {
			display: flex;
			gap: 10px;
			margin-top: 15px;
		}

		.notification-action {
			padding: 6px 12px;
			border: none;
			border-radius: 6px;
			background: rgba(255, 255, 255, 0.1);
			color: white;
			font-size: 12px;
			cursor: pointer;
			transition: all 0.3s ease;
		}

		.notification-action:hover {
			background: rgba(127, 176, 105, 0.2);
			color: #7fb069;
		}

		.notification-action.primary {
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
		}

		.notification-action.primary:hover {
			transform: translateY(-1px);
			box-shadow: 0 4px 15px rgba(127, 176, 105, 0.3);
		}

		.mark-read-btn {
			position: absolute;
			top: 15px;
			right: 15px;
			width: 8px;
			height: 8px;
			border-radius: 50%;
			background: #7fb069;
			border: none;
			cursor: pointer;
			transition: all 0.3s ease;
		}

		.mark-read-btn:hover {
			transform: scale(1.2);
		}

		.notification-card.read .mark-read-btn {
			background: rgba(255, 255, 255, 0.3);
		}

		.empty-state {
			text-align: center;
			padding: 60px 20px;
			color: rgba(255, 255, 255, 0.6);
		}

		.empty-state i {
			font-size: 4rem;
			margin-bottom: 20px;
			color: rgba(255, 255, 255, 0.3);
		}

		.empty-state h3 {
			font-size: 1.5rem;
			margin-bottom: 10px;
			color: rgba(255, 255, 255, 0.8);
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

			.header {
				flex-direction: column;
				align-items: flex-start;
				gap: 15px;
			}

			.header-actions {
				width: 100%;
				justify-content: flex-start;
			}

			.notification-filters {
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
					<a href="{{ url('/user/dashboard/explore') }}" class="nav-link">
						<i class="fas fa-search"></i>
						<span>Explore</span>
					</a>
				</div>
				<div class="nav-item">
					<a href="{{ url('/user/dashboard/notification') }}" class="nav-link active">
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
					<h1>Notifications</h1>
					<p>Stay updated with your business activities and messages.</p>
				</div>
				<div class="header-actions">
					<button class="header-btn" onclick="markAllAsRead()">
						<i class="fas fa-check-double"></i>
						Mark All Read
					</button>
				</div>
			</div>

			<!-- Notification Filters -->
			<div class="notification-filters">
				<div class="filter-btn active" data-filter="all">All</div>
				<div class="filter-btn" data-filter="unread">Unread</div>
				<div class="filter-btn" data-filter="messages">Messages</div>
				<div class="filter-btn" data-filter="business">Business</div>
				<div class="filter-btn" data-filter="system">System</div>
			</div>

			<!-- Notifications List -->
			<div class="notifications-list">
				<div class="notification-card unread" data-type="message">
					<button class="mark-read-btn" onclick="markAsRead(this)"></button>
					<div class="notification-header">
						<div class="notification-icon message">
							<i class="fas fa-envelope"></i>
						</div>
						<div class="notification-info">
							<div class="notification-title">New Message from Tech Mart Solutions</div>
							<div class="notification-text">
								"Hi! We'd love to discuss a potential partnership opportunity. Are you available for a quick call this week?"
							</div>
							<div class="notification-time">2 minutes ago</div>
						</div>
					</div>
					<div class="notification-actions">
						<button class="notification-action primary">Reply</button>
						<button class="notification-action">View Profile</button>
					</div>
				</div>

				<div class="notification-card unread" data-type="business">
					<button class="mark-read-btn" onclick="markAsRead(this)"></button>
					<div class="notification-header">
						<div class="notification-icon business">
							<i class="fas fa-handshake"></i>
						</div>
						<div class="notification-info">
							<div class="notification-title">New Business Connection Request</div>
							<div class="notification-text">
								Green Foods Lanka wants to connect with you. They're interested in your organic packaging solutions.
							</div>
							<div class="notification-time">15 minutes ago</div>
						</div>
					</div>
					<div class="notification-actions">
						<button class="notification-action primary">Accept</button>
						<button class="notification-action">View Request</button>
					</div>
				</div>

				<div class="notification-card" data-type="system">
					<button class="mark-read-btn" onclick="markAsRead(this)"></button>
					<div class="notification-header">
						<div class="notification-icon system">
							<i class="fas fa-cog"></i>
						</div>
						<div class="notification-info">
							<div class="notification-title">Profile Update Successful</div>
							<div class="notification-text">
								Your business profile has been successfully updated with new contact information and services.
							</div>
							<div class="notification-time">1 hour ago</div>
						</div>
					</div>
				</div>

				<div class="notification-card unread" data-type="business">
					<button class="mark-read-btn" onclick="markAsRead(this)"></button>
					<div class="notification-header">
						<div class="notification-icon business">
							<i class="fas fa-star"></i>
						</div>
						<div class="notification-info">
							<div class="notification-title">New Review Received</div>
							<div class="notification-text">
								Creative Studios left a 5-star review: "Excellent service and professional team. Highly recommended for graphic design work!"
							</div>
							<div class="notification-time">3 hours ago</div>
						</div>
					</div>
					<div class="notification-actions">
						<button class="notification-action primary">View Review</button>
						<button class="notification-action">Respond</button>
					</div>
				</div>

				<div class="notification-card" data-type="message">
					<button class="mark-read-btn" onclick="markAsRead(this)"></button>
					<div class="notification-header">
						<div class="notification-icon message">
							<i class="fas fa-comment"></i>
						</div>
						<div class="notification-info">
							<div class="notification-title">Comment on Your Post</div>
							<div class="notification-text">
								Mobile Solutions Hub commented on your post about sustainable business practices: "Great insights! We'd love to collaborate."
							</div>
							<div class="notification-time">5 hours ago</div>
						</div>
					</div>
					<div class="notification-actions">
						<button class="notification-action primary">View Post</button>
						<button class="notification-action">Reply</button>
					</div>
				</div>

				<div class="notification-card" data-type="system">
					<button class="mark-read-btn" onclick="markAsRead(this)"></button>
					<div class="notification-header">
						<div class="notification-icon system">
							<i class="fas fa-chart-line"></i>
						</div>
						<div class="notification-info">
							<div class="notification-title">Weekly Analytics Report</div>
							<div class="notification-text">
								Your business profile received 45 views this week, up 23% from last week. 8 new connection requests pending.
							</div>
							<div class="notification-time">1 day ago</div>
						</div>
					</div>
					<div class="notification-actions">
						<button class="notification-action primary">View Report</button>
					</div>
				</div>

				<div class="notification-card" data-type="business">
					<button class="mark-read-btn" onclick="markAsRead(this)"></button>
					<div class="notification-header">
						<div class="notification-icon business">
							<i class="fas fa-calendar"></i>
						</div>
						<div class="notification-info">
							<div class="notification-title">Meeting Reminder</div>
							<div class="notification-text">
								You have a scheduled meeting with EcoLife Products tomorrow at 2:00 PM to discuss partnership opportunities.
							</div>
							<div class="notification-time">1 day ago</div>
						</div>
					</div>
					<div class="notification-actions">
						<button class="notification-action primary">View Details</button>
						<button class="notification-action">Reschedule</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Filter functionality
			const filterBtns = document.querySelectorAll('.filter-btn');
			const notifications = document.querySelectorAll('.notification-card');

			filterBtns.forEach(btn => {
				btn.addEventListener('click', function() {
					filterBtns.forEach(b => b.classList.remove('active'));
					this.classList.add('active');

					const filter = this.getAttribute('data-filter');
					
					notifications.forEach(notification => {
						if (filter === 'all') {
							notification.style.display = 'block';
						} else if (filter === 'unread') {
							notification.style.display = notification.classList.contains('unread') ? 'block' : 'none';
						} else {
							const type = notification.getAttribute('data-type');
							notification.style.display = type === filter || (filter === 'messages' && type === 'message') ? 'block' : 'none';
						}
					});
				});
			});

			// Notification action buttons
			const actionBtns = document.querySelectorAll('.notification-action');
			actionBtns.forEach(btn => {
				btn.addEventListener('click', function(e) {
					e.stopPropagation();
					const action = this.textContent.trim();
					console.log('Notification action:', action);
					// Add specific action logic here
				});
			});
		});

		function markAsRead(button) {
			const notification = button.closest('.notification-card');
			notification.classList.remove('unread');
			notification.classList.add('read');
		}

		function markAllAsRead() {
			const unreadNotifications = document.querySelectorAll('.notification-card.unread');
			unreadNotifications.forEach(notification => {
				notification.classList.remove('unread');
				notification.classList.add('read');
			});
		}
	</script>
</body>
</html>
