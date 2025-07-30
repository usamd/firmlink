<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>BizNest - Newsfeed</title>
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
			max-height: 100vh;
			overflow: hidden;
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
			max-height: 100vh;
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
			overflow-y: auto;
			overflow-x: hidden;
			padding-right: 5px;
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

		/* Custom Scrollbar for Sidebar */
		.nav-menu::-webkit-scrollbar {
			width: 6px;
		}

		.nav-menu::-webkit-scrollbar-track {
			background: rgba(255, 255, 255, 0.1);
			border-radius: 3px;
		}

		.nav-menu::-webkit-scrollbar-thumb {
			background: rgba(127, 176, 105, 0.5);
			border-radius: 3px;
			transition: background 0.3s ease;
		}

		.nav-menu::-webkit-scrollbar-thumb:hover {
			background: rgba(127, 176, 105, 0.8);
		}

		/* Firefox scrollbar */
		.nav-menu {
			scrollbar-width: thin;
			scrollbar-color: rgba(127, 176, 105, 0.5) rgba(255, 255, 255, 0.1);
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
			overflow-x: hidden;
			max-height: 100vh;
			position: relative;
		}

		/* Custom Scrollbar for Main Content */
		.main-content::-webkit-scrollbar {
			width: 8px;
		}

		.main-content::-webkit-scrollbar-track {
			background: rgba(255, 255, 255, 0.05);
			border-radius: 4px;
			margin: 10px 0;
		}

		.main-content::-webkit-scrollbar-thumb {
			background: linear-gradient(135deg, rgba(127, 176, 105, 0.6), rgba(127, 176, 105, 0.4));
			border-radius: 4px;
			transition: all 0.3s ease;
		}

		.main-content::-webkit-scrollbar-thumb:hover {
			background: linear-gradient(135deg, rgba(127, 176, 105, 0.8), rgba(127, 176, 105, 0.6));
			transform: scaleX(1.2);
		}

		/* Firefox scrollbar */
		.main-content {
			scrollbar-width: thin;
			scrollbar-color: rgba(127, 176, 105, 0.6) rgba(255, 255, 255, 0.05);
		}

		.header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 30px;
			padding-bottom: 20px;
			border-bottom: 1px solid rgba(255, 255, 255, 0.1);
			position: sticky;
			top: 0;
			background: rgba(26, 47, 26, 0.95);
			backdrop-filter: blur(20px);
			z-index: 10;
			margin: -25px -25px 30px -25px;
			padding: 25px;
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

		.post-card {
			background: rgba(255, 255, 255, 0.1);
			border-radius: 15px;
			padding: 20px;
			margin-bottom: 20px;
			backdrop-filter: blur(20px);
			border: 1px solid rgba(255, 255, 255, 0.2);
			transition: all 0.3s ease;
			scroll-margin-top: 150px;
		}

		.post-card:hover {
			transform: translateY(-2px);
			box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
			border-color: rgba(127, 176, 105, 0.3);
		}

		.post-header {
			display: flex;
			align-items: center;
			gap: 15px;
			margin-bottom: 15px;
		}

		.post-avatar {
			width: 45px;
			height: 45px;
			border-radius: 50%;
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			display: flex;
			align-items: center;
			justify-content: center;
			color: white;
			font-weight: 600;
		}

		.post-info h4 {
			color: white;
			font-weight: 600;
			margin-bottom: 2px;
		}

		.post-info p {
			color: rgba(255, 255, 255, 0.6);
			font-size: 13px;
		}

		.post-content {
			margin-bottom: 15px;
			line-height: 1.6;
			color: rgba(255, 255, 255, 0.9);
		}

		.post-images {
			margin: 15px 0;
			border-radius: 12px;
			overflow: hidden;
		}

		.post-image {
			width: 100%;
			max-height: 400px;
			object-fit: cover;
			display: block;
			cursor: pointer;
			transition: transform 0.3s ease;
		}

		.post-image:hover {
			transform: scale(1.02);
		}

		.post-images-grid {
			display: grid;
			gap: 8px;
			border-radius: 12px;
			overflow: hidden;
		}

		.post-images-grid.grid-2 {
			grid-template-columns: 1fr 1fr;
		}

		.post-images-grid.grid-3 {
			grid-template-columns: 1fr 1fr;
			grid-template-rows: 1fr 1fr;
		}

		.post-images-grid.grid-3 .post-image:first-child {
			grid-row: 1 / -1;
		}

		.post-images-grid.grid-4 {
			grid-template-columns: 1fr 1fr;
			grid-template-rows: 1fr 1fr;
		}

		.post-images-grid .post-image {
			height: 200px;
		}

		.post-images-grid.grid-3 .post-image:first-child {
			height: 100%;
		}

		.image-overlay {
			position: relative;
		}

		.image-overlay::after {
			content: '+' attr(data-count);
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background: rgba(0, 0, 0, 0.7);
			color: white;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 2rem;
			font-weight: bold;
		}

		.create-post {
			background: rgba(255, 255, 255, 0.1);
			border-radius: 15px;
			padding: 20px;
			margin-bottom: 25px;
			backdrop-filter: blur(20px);
			border: 1px solid rgba(255, 255, 255, 0.2);
			position: sticky;
			top: 120px;
			z-index: 5;
			box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
			transition: all 0.3s ease;
			transform: translateY(0);
			opacity: 1;
		}

		.create-post.hidden {
			transform: translateY(-100%);
			opacity: 0;
			pointer-events: none;
		}

		.create-post.collapsed {
			transform: translateY(-80px);
			opacity: 0.3;
		}

		.create-post-input {
			width: 100%;
			background: rgba(255, 255, 255, 0.1);
			border: 1px solid rgba(255, 255, 255, 0.2);
			border-radius: 10px;
			padding: 15px;
			color: white;
			font-size: 14px;
			outline: none;
			resize: vertical;
			min-height: 100px;
			margin-bottom: 15px;
		}

		.create-post-input::placeholder {
			color: rgba(255, 255, 255, 0.6);
		}

		.create-post-actions {
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.post-options {
			display: flex;
			gap: 15px;
		}

		.post-option {
			color: rgba(255, 255, 255, 0.6);
			cursor: pointer;
			padding: 8px;
			border-radius: 8px;
			transition: all 0.3s ease;
		}

		.post-option:hover {
			background: rgba(255, 255, 255, 0.1);
			color: #7fb069;
		}

		.post-actions {
			display: flex;
			gap: 20px;
			padding-top: 15px;
			border-top: 1px solid rgba(255, 255, 255, 0.1);
		}

		.post-action {
			display: flex;
			align-items: center;
			gap: 8px;
			color: rgba(255, 255, 255, 0.6);
			cursor: pointer;
			transition: all 0.3s ease;
			padding: 8px 12px;
			border-radius: 8px;
		}

		.post-action:hover {
			background: rgba(255, 255, 255, 0.1);
			color: #7fb069;
		}

		.posts-container {
			display: flex;
			flex-direction: column;
			gap: 20px;
		}

		/* Scroll to top button */
		.scroll-to-top {
			position: fixed;
			bottom: 30px;
			right: 30px;
			width: 50px;
			height: 50px;
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			color: white;
			border: none;
			border-radius: 50%;
			cursor: pointer;
			display: none;
			align-items: center;
			justify-content: center;
			font-size: 18px;
			box-shadow: 0 4px 15px rgba(127, 176, 105, 0.3);
			transition: all 0.3s ease;
			z-index: 100;
		}

		.scroll-to-top:hover {
			transform: translateY(-3px);
			box-shadow: 0 6px 20px rgba(127, 176, 105, 0.4);
		}

		.scroll-to-top.visible {
			display: flex;
			animation: fadeInUp 0.3s ease;
		}

		@keyframes fadeInUp {
			from {
				opacity: 0;
				transform: translateY(20px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		/* Loading indicator for infinite scroll */
		.loading-indicator {
			display: none;
			text-align: center;
			padding: 20px;
			color: rgba(255, 255, 255, 0.7);
		}

		.loading-indicator.active {
			display: block;
		}

		.loading-spinner {
			display: inline-block;
			width: 20px;
			height: 20px;
			border: 2px solid rgba(127, 176, 105, 0.3);
			border-radius: 50%;
			border-top-color: #7fb069;
			animation: spin 1s ease-in-out infinite;
		}

		@keyframes spin {
			to { transform: rotate(360deg); }
		}

		/* Smooth scroll behavior */
		html {
			scroll-behavior: smooth;
		}

		/* Mobile responsive scrolling */
		@media (max-width: 768px) {
			.dashboard-container {
				flex-direction: column;
				max-height: none;
				overflow: visible;
			}

			.sidebar {
				width: 100%;
				max-height: none;
				overflow: visible;
				padding: 15px;
			}

			.nav-menu {
				overflow: visible;
			}

			.main-content {
				max-height: none;
				overflow: visible;
			}

			.header {
				position: relative;
				margin: 0 0 20px 0;
			}

			.create-post {
				position: relative;
				top: 0;
			}

			.scroll-to-top {
				bottom: 20px;
				right: 20px;
				width: 45px;
				height: 45px;
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
					<a href="{{ url('/user/dashboard/newsfeed') }}" class="nav-link active">
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
					<h1>Newsfeed</h1>
					<p>Stay updated with the latest from your business network.</p>
				</div>
				<div class="header-actions">
					<a href="#" class="header-btn">
						<i class="fas fa-filter"></i>
						Filter Posts
					</a>
				</div>
			</div>

			<!-- Create Post Section -->
			<div class="create-post">
				<textarea class="create-post-input" placeholder="What's happening in your business today?"></textarea>
				
				<!-- Image Upload Area -->
				<div class="create-post-images" id="createPostImages">
					<div class="image-upload-area" id="imageUploadArea">
						<i class="fas fa-cloud-upload-alt" style="font-size: 2rem; color: #7fb069; margin-bottom: 10px;"></i>
						<p style="color: rgba(255, 255, 255, 0.8); margin-bottom: 5px;">Click to upload images or drag and drop</p>
						<p style="color: rgba(255, 255, 255, 0.6); font-size: 12px;">PNG, JPG, GIF up to 10MB each</p>
					</div>
					<input type="file" id="imageInput" multiple accept="image/*">
					<div class="image-preview-container" id="imagePreviewContainer"></div>
				</div>

				<div class="create-post-actions">
					<div class="post-options">
						<div class="post-option" id="imageOption" title="Add Photo">
							<i class="fas fa-image"></i>
						</div>
						<div class="post-option" title="Add Video">
							<i class="fas fa-video"></i>
						</div>
						<div class="post-option" title="Add Location">
							<i class="fas fa-map-marker-alt"></i>
						</div>
						<div class="post-option" title="Tag Business">
							<i class="fas fa-tag"></i>
						</div>
					</div>
					<button class="header-btn" id="postButton">
						<i class="fas fa-paper-plane"></i>
						Post
					</button>
				</div>
			</div>

			<!-- News Feed Posts -->
			<div class="posts-container">
				<div class="post-card">
					<div class="post-header">
						<div class="post-avatar">TM</div>
						<div class="post-info">
							<h4>Tech Mart Solutions</h4>
							<p>2 hours ago • Colombo</p>
						</div>
					</div>
					<div class="post-content">
						🚀 Exciting news! We've just launched our new e-commerce platform that helps small businesses go digital. Join over 500+ businesses already using our platform to boost their online presence!
						<br><br>
						#DigitalTransformation #SmallBusiness #Ecommerce #SriLanka
					</div>
					<div class="post-images">
						<img src="https://images.unsplash.com/photo-1460925895917-2526d30994b5?w=800&h=400&fit=crop" alt="E-commerce Platform" class="post-image">
					</div>
					<div class="post-actions">
						<div class="post-action">
							<i class="fas fa-thumbs-up"></i>
							<span>24 Likes</span>
						</div>
						<div class="post-action">
							<i class="fas fa-comment"></i>
							<span>8 Comments</span>
						</div>
						<div class="post-action">
							<i class="fas fa-share"></i>
							<span>Share</span>
						</div>
					</div>
				</div>

				<div class="post-card">
					<div class="post-header">
						<div class="post-avatar">GF</div>
						<div class="post-info">
							<h4>Green Foods Lanka</h4>
							<p>4 hours ago • Kandy</p>
						</div>
					</div>
					<div class="post-content">
						🌱 Fresh organic vegetables now available for delivery across Kandy district! We're committed to providing healthy, pesticide-free produce directly from our farms to your table.
						<br><br>
						Order now through our website or call us directly. Free delivery for orders above Rs. 2000!
					</div>
					<div class="post-images">
						<div class="post-images-grid grid-2">
							<img src="https://images.unsplash.com/photo-1540420773420-1a0aa0c1268c?w=400&h=200&fit=crop" alt="Fresh Vegetables" class="post-image">
							<img src="https://images.unsplash.com/photo-1566385101042-1a0aa0c1268c?w=400&h=200&fit=crop" alt="Organic Produce" class="post-image">
						</div>
					</div>
					<div class="post-actions">
						<div class="post-action">
							<i class="fas fa-thumbs-up"></i>
							<span>45 Likes</span>
						</div>
						<div class="post-action">
							<i class="fas fa-comment"></i>
							<span>12 Comments</span>
						</div>
						<div class="post-action">
							<i class="fas fa-share"></i>
							<span>Share</span>
						</div>
					</div>
				</div>

				<div class="post-card">
					<div class="post-header">
						<div class="post-avatar">CS</div>
						<div class="post-info">
							<h4>Creative Studios</h4>
							<p>6 hours ago • Galle</p>
						</div>
					</div>
					<div class="post-content">
						🎨 Looking for professional graphic design services? We've helped over 200+ businesses create stunning brand identities. From logos to complete marketing materials - we've got you covered!
						<br><br>
						Special offer: 30% off for new clients this month. Let's bring your vision to life!
					</div>
					<div class="post-images">
						<div class="post-images-grid grid-3">
							<img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?w=400&h=400&fit=crop" alt="Brand Design" class="post-image">
							<img src="https://images.unsplash.com/photo-1572044162444-ad60f128bdea?w=200&h=200&fit=crop" alt="Logo Design" class="post-image">
							<img src="https://images.unsplash.com/photo-1586717791821-3f44a563fa4c?w=200&h=200&fit=crop" alt="Marketing Materials" class="post-image">
						</div>
					</div>
					<div class="post-actions">
						<div class="post-action">
							<i class="fas fa-thumbs-up"></i>
							<span>67 Likes</span>
						</div>
						<div class="post-action">
							<i class="fas fa-comment"></i>
							<span>15 Comments</span>
						</div>
						<div class="post-action">
							<i class="fas fa-share"></i>
							<span>Share</span>
						</div>
					</div>
				</div>

				<div class="post-card">
					<div class="post-header">
						<div class="post-avatar">RS</div>
						<div class="post-info">
							<h4>Restaurant Supplies Co.</h4>
							<p>8 hours ago • Negombo</p>
						</div>
					</div>
					<div class="post-content">
						🍽️ New kitchen equipment arrived! Professional grade ovens, refrigerators, and cooking equipment now available. Perfect for restaurants, cafes, and catering businesses.
						<br><br>
						Visit our showroom or browse our online catalog. Financing options available!
					</div>
					<div class="post-images">
						<div class="post-images-grid grid-4">
							<img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=200&h=200&fit=crop" alt="Professional Oven" class="post-image">
							<img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=200&h=200&fit=crop" alt="Commercial Refrigerator" class="post-image">
							<img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=200&h=200&fit=crop" alt="Cooking Equipment" class="post-image">
							<div class="image-overlay" data-count="3">
								<img src="https://images.unsplash.com/photo-1574484284002-952d92456975?w=200&h=200&fit=crop" alt="More Equipment" class="post-image">
							</div>
						</div>
					</div>
					<div class="post-actions">
						<div class="post-action">
							<i class="fas fa-thumbs-up"></i>
							<span>32 Likes</span>
						</div>
						<div class="post-action">
							<i class="fas fa-comment"></i>
							<span>5 Comments</span>
						</div>
						<div class="post-action">
							<i class="fas fa-share"></i>
							<span>Share</span>
						</div>
					</div>
				</div>

				<!-- Loading indicator for infinite scroll -->
				<div class="loading-indicator" id="loadingIndicator">
					<div class="loading-spinner"></div>
					<p style="margin-top: 10px;">Loading more posts...</p>
				</div>
			</div>
		</div>
	</div>

	<!-- Scroll to top button -->
	<button class="scroll-to-top" id="scrollToTop">
		<i class="fas fa-chevron-up"></i>
	</button>

	<!-- Image Modal -->
	<div class="image-modal" id="imageModal">
		<div class="image-modal-content">
			<button class="image-modal-close" id="imageModalClose">&times;</button>
			<img id="modalImage" src="" alt="">
		</div>
	</div>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			let selectedImages = [];

			// Image upload functionality
			const imageOption = document.getElementById('imageOption');
			const imageInput = document.getElementById('imageInput');
			const createPostImages = document.getElementById('createPostImages');
			const imageUploadArea = document.getElementById('imageUploadArea');
			const imagePreviewContainer = document.getElementById('imagePreviewContainer');
			const postButton = document.getElementById('postButton');

			// Toggle image upload area
			imageOption.addEventListener('click', function() {
				createPostImages.classList.toggle('active');
				if (createPostImages.classList.contains('active')) {
					imageOption.style.background = 'rgba(127, 176, 105, 0.2)';
					imageOption.style.color = '#7fb069';
				} else {
					imageOption.style.background = '';
					imageOption.style.color = '';
				}
			});

			// Click to upload
			imageUploadArea.addEventListener('click', function() {
				imageInput.click();
			});

			// Drag and drop functionality
			imageUploadArea.addEventListener('dragover', function(e) {
				e.preventDefault();
				imageUploadArea.classList.add('dragover');
			});

			imageUploadArea.addEventListener('dragleave', function(e) {
				e.preventDefault();
				imageUploadArea.classList.remove('dragover');
			});

			imageUploadArea.addEventListener('drop', function(e) {
				e.preventDefault();
				imageUploadArea.classList.remove('dragover');
				const files = e.dataTransfer.files;
				handleFiles(files);
			});

			// File input change
			imageInput.addEventListener('change', function(e) {
				handleFiles(e.target.files);
			});

			function handleFiles(files) {
				for (let file of files) {
					if (file.type.startsWith('image/') && selectedImages.length < 10) {
						selectedImages.push(file);
						displayImagePreview(file);
					}
				}
				updateUploadArea();
			}

			function displayImagePreview(file) {
				const reader = new FileReader();
				reader.onload = function(e) {
					const previewDiv = document.createElement('div');
					previewDiv.className = 'image-preview';
					previewDiv.innerHTML = `
						<img src="${e.target.result}" alt="Preview">
						<button class="remove-image" onclick="removeImage(${selectedImages.length - 1})">&times;</button>
					`;
					imagePreviewContainer.appendChild(previewDiv);
				};
				reader.readAsDataURL(file);
			}

			window.removeImage = function(index) {
				selectedImages.splice(index, 1);
				imagePreviewContainer.innerHTML = '';
				selectedImages.forEach(file => displayImagePreview(file));
				updateUploadArea();
			};

			function updateUploadArea() {
				if (selectedImages.length > 0) {
					imageUploadArea.style.display = 'none';
				} else {
					imageUploadArea.style.display = 'block';
				}
			}

			// Post button functionality
			postButton.addEventListener('click', function() {
				const textarea = document.querySelector('.create-post-input');
				const content = textarea.value.trim();
				
				if (content || selectedImages.length > 0) {
					// Simulate posting
					postButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Posting...';
					postButton.disabled = true;
					
					setTimeout(() => {
						postButton.innerHTML = '<i class="fas fa-check"></i> Posted!';
						setTimeout(() => {
							postButton.innerHTML = '<i class="fas fa-paper-plane"></i> Post';
							postButton.disabled = false;
							textarea.value = '';
							selectedImages = [];
							imagePreviewContainer.innerHTML = '';
							createPostImages.classList.remove('active');
							imageOption.style.background = '';
							imageOption.style.color = '';
							updateUploadArea();
						}, 1500);
					}, 1000);
				}
			});

			// Image modal functionality
			const imageModal = document.getElementById('imageModal');
			const modalImage = document.getElementById('modalImage');
			const imageModalClose = document.getElementById('imageModalClose');

			// Add click listeners to all post images
			document.querySelectorAll('.post-image').forEach(img => {
				img.addEventListener('click', function() {
					if (!this.closest('.image-overlay')) {
						modalImage.src = this.src;
						imageModal.classList.add('active');
					}
				});
			});

			// Close modal
			imageModalClose.addEventListener('click', function() {
				imageModal.classList.remove('active');
			});

			imageModal.addEventListener('click', function(e) {
				if (e.target === imageModal) {
					imageModal.classList.remove('active');
				}
			});

			// Add interactivity to post actions
			document.querySelectorAll('.post-action').forEach(action => {
				action.addEventListener('click', function() {
					const icon = this.querySelector('i');
					const span = this.querySelector('span');
					
					if (icon.classList.contains('fa-thumbs-up')) {
						if (icon.style.color === 'rgb(127, 176, 105)') {
							icon.style.color = '';
							const count = parseInt(span.textContent.split(' ')[0]) - 1;
							span.textContent = count + ' Likes';
						} else {
							icon.style.color = '#7fb069';
							const count = parseInt(span.textContent.split(' ')[0]) + 1;
							span.textContent = count + ' Likes';
						}
					}
					
					this.style.transform = 'scale(0.95)';
					setTimeout(() => {
						this.style.transform = '';
					}, 150);
				});
			});

			// Scroll to top functionality and create post visibility
			const scrollToTopBtn = document.getElementById('scrollToTop');
			const mainContent = document.querySelector('.main-content');
			const createPost = document.querySelector('.create-post');
			let lastScrollTop = 0;
			let scrollDirection = 'up';

			mainContent.addEventListener('scroll', function() {
				const scrollTop = mainContent.scrollTop;
				
				// Determine scroll direction
				if (scrollTop > lastScrollTop) {
					scrollDirection = 'down';
				} else {
					scrollDirection = 'up';
				}
				lastScrollTop = scrollTop;

				// Show/hide scroll to top button
				if (scrollTop > 300) {
					scrollToTopBtn.classList.add('visible');
				} else {
					scrollToTopBtn.classList.remove('visible');
				}

				// Show/hide create post section based on scroll
				if (scrollTop > 200) {
					if (scrollDirection === 'down') {
						createPost.classList.add('hidden');
						createPost.classList.remove('collapsed');
					} else if (scrollDirection === 'up') {
						createPost.classList.remove('hidden');
						createPost.classList.add('collapsed');
					}
				} else {
					// Always show when near top
					createPost.classList.remove('hidden', 'collapsed');
				}

				// Fully show create post when scrolling up significantly
				if (scrollDirection === 'up' && scrollTop < 150) {
					createPost.classList.remove('hidden', 'collapsed');
				}
			});

			scrollToTopBtn.addEventListener('click', function() {
				mainContent.scrollTo({
					top: 0,
					behavior: 'smooth'
				});
			});

			// Infinite scroll simulation
			let isLoading = false;
			const loadingIndicator = document.getElementById('loadingIndicator');
			const postsContainer = document.querySelector('.posts-container');

			mainContent.addEventListener('scroll', function() {
				const scrollTop = mainContent.scrollTop;
				const scrollHeight = mainContent.scrollHeight;
				const clientHeight = mainContent.clientHeight;

				if (scrollTop + clientHeight >= scrollHeight - 100 && !isLoading) {
					loadMorePosts();
				}
			});

			function loadMorePosts() {
				if (isLoading) return;
				isLoading = true;
				loadingIndicator.classList.add('active');

				// Simulate loading delay
				setTimeout(() => {
					// Add more posts (simulation)
					const newPosts = createSamplePosts(3);
					newPosts.forEach(post => {
						postsContainer.insertBefore(post, loadingIndicator);
					});

					loadingIndicator.classList.remove('active');
					isLoading = false;
				}, 1500);
			}

			function createSamplePosts(count) {
				const posts = [];
				const sampleData = [
					{
						avatar: 'BT',
						name: 'Business Tech Solutions',
						time: '12 hours ago • Kandy',
						content: '💻 Upgrade your business with our latest IT solutions! From cloud services to cybersecurity, we\'ve got everything you need to stay competitive in the digital age.',
						image: 'https://images.unsplash.com/photo-1551434678-e076c223a692?w=800&h=400&fit=crop'
					},
					{
						avatar: 'FM',
						name: 'Fashion Mart',
						time: '1 day ago • Colombo',
						content: '👗 New collection just arrived! Trendy outfits for every occasion. Visit our store or shop online with free delivery island-wide.',
						images: [
							'https://images.unsplash.com/photo-1445205170230-ad60f128bdea?w=400&h=200&fit=crop',
							'https://images.unsplash.com/photo-1434389677669-e08b4cac3105?w=400&h=200&fit=crop'
						]
					},
					{
						avatar: 'HS',
						name: 'Health & Wellness Spa',
						time: '2 days ago • Galle',
						content: '🧘‍♀️ Relax and rejuvenate with our premium spa services. Book your appointment today and experience the ultimate wellness journey.',
						image: 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800&h=400&fit=crop'
					}
				];

				for (let i = 0; i < count; i++) {
					const data = sampleData[i % sampleData.length];
					const postCard = document.createElement('div');
					postCard.className = 'post-card';
					
					let imagesHtml = '';
					if (data.images) {
						imagesHtml = `
							<div class="post-images">
								<div class="post-images-grid grid-2">
									${data.images.map(img => `<img src="${img}" alt="Post Image" class="post-image">`).join('')}
								</div>
							</div>
						`;
					} else if (data.image) {
						imagesHtml = `
							<div class="post-images">
								<img src="${data.image}" alt="Post Image" class="post-image">
							</div>
						`;
					}

					postCard.innerHTML = `
						<div class="post-header">
							<div class="post-avatar">${data.avatar}</div>
							<div class="post-info">
								<h4>${data.name}</h4>
								<p>${data.time}</p>
							</div>
						</div>
						<div class="post-content">
							${data.content}
						</div>
						${imagesHtml}
						<div class="post-actions">
							<div class="post-action">
								<i class="fas fa-thumbs-up"></i>
								<span>${Math.floor(Math.random() * 100)} Likes</span>
							</div>
							<div class="post-action">
								<i class="fas fa-comment"></i>
								<span>${Math.floor(Math.random() * 20)} Comments</span>
							</div>
							<div class="post-action">
								<i class="fas fa-share"></i>
								<span>Share</span>
							</div>
						</div>
					`;

					// Add event listeners to new post actions
					postCard.querySelectorAll('.post-action').forEach(action => {
						action.addEventListener('click', handlePostAction);
					});

					// Add event listeners to new post images
					postCard.querySelectorAll('.post-image').forEach(img => {
						img.addEventListener('click', function() {
							if (!this.closest('.image-overlay')) {
								modalImage.src = this.src;
								imageModal.classList.add('active');
							}
						});
					});

					posts.push(postCard);
				}

				return posts;
			}

			function handlePostAction() {
				const icon = this.querySelector('i');
				const span = this.querySelector('span');
				
				if (icon.classList.contains('fa-thumbs-up')) {
					if (icon.style.color === 'rgb(127, 176, 105)') {
						icon.style.color = '';
						const count = parseInt(span.textContent.split(' ')[0]) - 1;
						span.textContent = count + ' Likes';
					} else {
						icon.style.color = '#7fb069';
						const count = parseInt(span.textContent.split(' ')[0]) + 1;
						span.textContent = count + ' Likes';
					}
				}
				
				this.style.transform = 'scale(0.95)';
				setTimeout(() => {
					this.style.transform = '';
				}, 150);
			}
		});
	</script>
</body>
</html>
