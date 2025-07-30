<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign In - BizNest</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Sign in to BizNest - Professional Business Listings Platform">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<style>
		/* Reset and Base Styles */
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: 'Inter', sans-serif;
			line-height: 1.6;
			color: #1a2e1a;
			background: linear-gradient(135deg, #1e3932 0%, #2c5530 100%);
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			position: relative;
			overflow: hidden;
		}

		body::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
			opacity: 0.3;
		}

		.auth-container {
			position: relative;
			z-index: 2;
			width: 100%;
			max-width: 1000px;
			margin: 0 auto;
			padding: 20px;
		}

		.auth-card {
			background: rgba(255, 255, 255, 0.1);
			backdrop-filter: blur(10px);
			border: 1px solid rgba(255, 255, 255, 0.2);
			border-radius: 20px;
			box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
			display: grid;
			grid-template-columns: 1fr 1fr;
			min-height: 600px;
			overflow: hidden;
			position: relative;
		}

		.auth-card::before {
			content: '';
			position: absolute;
			top: 0;
			left: -100%;
			width: 100%;
			height: 100%;
			background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
			transition: left 0.8s ease;
		}

		.auth-card:hover::before {
			left: 100%;
		}

		.auth-left {
			padding: 60px 50px;
			display: flex;
			flex-direction: column;
			justify-content: center;
			color: white;
		}

		.auth-right {
			background: linear-gradient(135deg, #0f4c3a 0%, #1a5d4a 100%);
			padding: 60px 50px;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			position: relative;
			overflow: hidden;
		}

		.auth-right::after {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
			animation: mirror-sweep 4s ease-in-out infinite;
		}

		@keyframes mirror-sweep {
			0% { transform: translateX(-100%) skewX(-15deg); }
			50% { transform: translateX(100%) skewX(-15deg); }
			100% { transform: translateX(100%) skewX(-15deg); }
		}

		.logo-section {
			display: flex;
			align-items: center;
			gap: 15px;
			margin-bottom: 30px;
		}

		.logo {
			width: 50px;
			height: 50px;
			border-radius: 50%;
		}

		.logo-text {
			font-size: 28px;
			font-weight: 700;
			background: linear-gradient(135deg, #7fb069, #588157);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			background-clip: text;
		}

		.auth-title {
			font-size: 2.5rem;
			font-weight: 700;
			margin-bottom: 15px;
			color: white;
		}

		.auth-subtitle {
			font-size: 1.1rem;
			opacity: 0.9;
			margin-bottom: 40px;
			line-height: 1.6;
		}

		.form-container {
			width: 100%;
			max-width: 400px;
			position: relative;
			z-index: 3;
		}

		.form-group {
			margin-bottom: 25px;
		}

		.form-label {
			display: block;
			margin-bottom: 8px;
			font-weight: 500;
			color: white;
			font-size: 0.95rem;
		}

		.form-input {
			width: 100%;
			padding: 15px 20px;
			border: 2px solid rgba(255, 255, 255, 0.2);
			background: rgba(255, 255, 255, 0.1);
			border-radius: 10px;
			font-size: 16px;
			color: white;
			outline: none;
			transition: all 0.3s ease;
			backdrop-filter: blur(5px);
		}

		.form-input::placeholder {
			color: rgba(255, 255, 255, 0.6);
		}

		.form-input:focus {
			border-color: #7fb069;
			box-shadow: 0 0 0 3px rgba(127, 176, 105, 0.2);
			background: rgba(255, 255, 255, 0.15);
		}

		.btn-auth {
			width: 100%;
			padding: 15px;
			background: linear-gradient(135deg, #7fb069, #588157);
			color: #1a2e1a;
			border: none;
			border-radius: 10px;
			font-weight: 600;
			font-size: 1.1rem;
			cursor: pointer;
			transition: all 0.3s ease;
			margin-bottom: 20px;
		}

		.btn-auth:hover {
			transform: translateY(-2px);
			box-shadow: 0 10px 25px rgba(127, 176, 105, 0.4);
		}

		.auth-links {
			text-align: center;
			margin-top: 20px;
		}

		.auth-link {
			color: #7fb069;
			text-decoration: none;
			font-weight: 500;
			transition: color 0.3s ease;
		}

		.auth-link:hover {
			color: #588157;
		}

		.divider {
			display: flex;
			align-items: center;
			margin: 25px 0;
			color: rgba(255, 255, 255, 0.6);
		}

		.divider::before,
		.divider::after {
			content: '';
			flex: 1;
			height: 1px;
			background: rgba(255, 255, 255, 0.2);
		}

		.divider span {
			padding: 0 15px;
			font-size: 0.9rem;
		}

		.hero-image {
			position: relative;
			margin-bottom: 30px;
		}

		.image-container {
			position: relative;
			border-radius: 15px;
			overflow: hidden;
			max-width: 300px;
			margin: 0 auto;
		}

		.hero-img {
			width: 100%;
			height: 250px;
			object-fit: cover;
			border-radius: 15px;
		}

		.mirror-effect {
			position: relative;
		}

		.mirror-effect::after {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
			animation: mirror-sweep 3s ease-in-out infinite;
			border-radius: 15px;
		}

		.welcome-text {
			text-align: center;
			color: white;
			margin-bottom: 20px;
		}

		.welcome-text h3 {
			font-size: 1.5rem;
			font-weight: 600;
			margin-bottom: 10px;
		}

		.welcome-text p {
			opacity: 0.9;
			line-height: 1.6;
		}

		/* Responsive Design */
		@media (max-width: 768px) {
			.auth-card {
				grid-template-columns: 1fr;
				min-height: auto;
			}

			.auth-left,
			.auth-right {
				padding: 40px 30px;
			}

			.auth-title {
				font-size: 2rem;
			}

			.auth-container {
				padding: 15px;
			}
		}

		@media (max-width: 480px) {
			.auth-left,
			.auth-right {
				padding: 30px 20px;
			}

			.auth-title {
				font-size: 1.8rem;
			}

			.form-container {
				max-width: 100%;
			}
		}
	</style>
</head>
<body>

	<div class="auth-container">
		<div class="auth-card">
			<!-- Left Side - Login Form -->
			<div class="auth-left">
				<div class="logo-section">
					<img src="{{ asset('assest/Biz.png') }}" alt="BizNest Logo" class="logo">
					<span class="logo-text">BizNest</span>
				</div>
				
				<h1 class="auth-title">Welcome Back</h1>
				<p class="auth-subtitle">Sign in to access your business directory account and connect with Sri Lanka's premier business community.</p>
				
				<div class="form-container">
					<form method="POST" action="{{ route('login') }}">
						@csrf
						
						<div class="form-group">
							<label for="email" class="form-label">
								<i class="fas fa-envelope"></i> Email Address
							</label>
							<input id="email" type="email" class="form-input @error('email') is-invalid @enderror" 
								   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus 
								   placeholder="Enter your email address">
							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						
						<div class="form-group">
							<label for="password" class="form-label">
								<i class="fas fa-lock"></i> Password
							</label>
							<input id="password" type="password" class="form-input @error('password') is-invalid @enderror" 
								   name="password" required autocomplete="current-password" 
								   placeholder="Enter your password">
							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						
						<div class="form-group">
							<label class="form-label" style="display: flex; align-items: center; gap: 8px;">
								<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
								{{ __('Remember Me') }}
							</label>
						</div>
						
						<button type="submit" class="btn-auth">
							<i class="fas fa-sign-in-alt"></i> Sign In
						</button>
					</form>
					
					<div class="auth-links">
						@if (Route::has('password.request'))
							<a href="{{ route('password.request') }}" class="auth-link">
								<i class="fas fa-key"></i> Forgot Your Password?
							</a>
						@endif
					</div>
					
					<div class="divider">
						<span>or</span>
					</div>
					
					<div class="auth-links">
						<p style="color: rgba(255, 255, 255, 0.8); margin-bottom: 10px;">Don't have an account?</p>
						<a href="{{ route('register_user') }}" class="auth-link">
							<i class="fas fa-user-plus"></i> Create Account
						</a>
					</div>
				</div>
			</div>
			
			<!-- Right Side - Welcome Image -->
			<div class="auth-right">
				<div class="hero-image">
					<div class="image-container mirror-effect">
						<img src="{{ asset('assest/IMG-20240607-WA0014 .jpg') }}" alt="Business professionals" class="hero-img">
					</div>
				</div>
				
				<div class="welcome-text">
					<h3>Sri Lanka's Premier Business Directory</h3>
					<p>Connect with thousands of businesses and discover amazing opportunities in your local community. Join our growing network of entrepreneurs and business professionals.</p>
				</div>
			</div>
		</div>
	</div>

	<!-- Back to Home Link -->
	<div style="position: fixed; top: 20px; left: 20px; z-index: 1000;">
		<a href="{{ url('/') }}" style="color: #7fb069; text-decoration: none; font-weight: 500; display: flex; align-items: center; gap: 8px; background: rgba(255, 255, 255, 0.1); padding: 10px 15px; border-radius: 25px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s ease;" 
		   onmouseover="this.style.background='rgba(127, 176, 105, 0.2)'" 
		   onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'">
			<i class="fas fa-arrow-left"></i> Back to Home
		</a>
	</div>

</body>
</html>
