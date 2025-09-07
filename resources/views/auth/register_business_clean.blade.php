<!DOCTYPE html>
<html lang="en">
<head>
    <title>Business Registration - BizNest</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Register your business on BizNest - Professional Business Listings Platform">
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
            padding: 20px 0;
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
            max-width: 1200px;
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
            padding: 30px 40px;
            display: flex;
            flex-direction: column;
            color: white;
            max-height: 95vh;
            overflow-y: auto;
            position: relative;
            z-index: 10;
            box-sizing: border-box;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.3) transparent;
        }
        
        /* Custom scrollbar for WebKit browsers */
        .auth-left::-webkit-scrollbar {
            width: 6px;
        }
        
        .auth-left::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .auth-left::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }
        
        .auth-left::-webkit-scrollbar-thumb:hover {
            background-color: rgba(255, 255, 255, 0.5);
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
        .logo-section {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px 0;
            position: relative;
            z-index: 10;
            opacity: 1 !important;
            visibility: visible !important;
        }

        .logo-section img {
            height: 60px;
            margin-bottom: 10px;
            transition: transform 0.3s ease;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .logo-section img:hover {
            transform: scale(1.05);
        }

        .logo-text {
            font-size: 28px;
            font-weight: 700;
            color: #fff;
            display: block;
            margin-top: 10px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .form-title {
            font-size: 32px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 10px;
            text-align: center;
            margin-bottom: 10px;
            text-align: center;
        }

        .form-subtitle {
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 30px;
            font-size: 16px;
            text-align: center;
            font-weight: 400;
            font-size: 15px;
        }

        .form-container {
            max-width: 100%;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-row .form-group {
            flex: 1;
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 14px 45px 14px 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #ffffff;
            color: #000000;
        }
        
        select.form-control {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 16px;
            padding-right: 40px;
        }
        
        select.form-control option {
            color: #000000;
            background: #ffffff;
            padding: 10px;
        }

        .form-control:focus {
            outline: none;
            border-color: #7fb069;
            box-shadow: 0 0 0 3px rgba(127, 176, 105, 0.2);
            background: #ffffff;
        }

        .form-control::placeholder {
            color: #999999;
            opacity: 1; /* Firefox */
        }

        .input-group {
            position: relative;
        }

        .input-group .form-control {
            padding-right: 40px;
        }

        .input-group-append {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.6);
            transition: color 0.3s ease;
        }

        .input-group-append:hover {
            color: #7fb069;
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-check-input {
            margin-right: 10px;
            width: 18px;
            height: 18px;
            accent-color: #7fb069;
        }

        .form-check-label {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
        }

        .form-check-label a {
            color: #7fb069;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .form-check-label a:hover {
            color: #8bc34a;
            text-decoration: underline;
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 14px;
            background: #7fb069;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn:hover {
            background: #8bc34a;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 25px 0;
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.2);
        }

        .divider::before {
            margin-right: 15px;
        }

        .divider::after {
            margin-left: 15px;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 15px;
        }

        .login-link a {
            color: #7fb069;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #8bc34a;
            text-decoration: underline;
        }

        .hero-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 30px;
            opacity: 0.9;
            transition: transform 0.5s ease, opacity 0.5s ease;
        }

        .hero-image:hover {
            transform: scale(1.03);
            opacity: 1;
        }

        .welcome-text {
            text-align: center;
            color: white;
            margin-bottom: 30px;
        }

        .welcome-text h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #fff;
        }

        .welcome-text p {
            font-size: 16px;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.8);
            max-width: 80%;
            margin: 0 auto;
        }

        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 15s infinite linear;
        }

        .shape:nth-child(1) {
            width: 100px;
            height: 100px;
            top: 20%;
            left: 10%;
            animation-duration: 20s;
        }

        .shape:nth-child(2) {
            width: 150px;
            height: 150px;
            bottom: 15%;
            right: 10%;
            animation-duration: 25s;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 70px;
            height: 70px;
            top: 60%;
            left: 25%;
            animation-duration: 18s;
            animation-delay: 4s;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
                opacity: 0.5;
            }
            50% {
                transform: translate(20px, 20px) rotate(180deg);
                opacity: 0.8;
            }
            100% {
                transform: translate(0, 0) rotate(360deg);
                opacity: 0.5;
            }
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .auth-card {
                grid-template-columns: 1fr;
                max-width: 600px;
                margin: 0 auto;
            }

            .auth-right {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .auth-left {
                padding: 30px 20px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .form-row .form-group {
                margin-bottom: 15px;
            }

            .form-title {
                font-size: 24px;
            }

            .welcome-text h2 {
                font-size: 26px;
            }

            .welcome-text p {
                font-size: 14px;
            }
        }
t        }

        .form-control:focus {
            border-color: #7fb069;
            outline: none;
            box-shadow: 0 0 0 3px rgba(127, 176, 105, 0.2);
        }

        .btn-primary {
            background: #7fb069;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: #6a9a56;
        }

        /* Section Titles */
        .section-title {
            color: #fff;
            font-size: 1.1rem;
            font-weight: 600;
            margin: 25px 0 15px;
            padding-bottom: 8px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Form Groups */
        .form-group {
            margin-bottom: 1.25rem;
        }
        
        /* Form Labels */
        .form-label {
            display: block;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 0.5rem;
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        .form-label i {
            margin-right: 8px;
            color: #7fb069;
            width: 18px;
            text-align: center;
        }
        
        /* Form Controls */
        .form-control {
            width: 100%;
            padding: 10px 15px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: #fff;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #7fb069;
            box-shadow: 0 0 0 2px rgba(127, 176, 105, 0.2);
            background: rgba(255, 255, 255, 0.08);
        }
        
        /* Select Dropdown */
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%237fb069' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 12px;
            padding-right: 35px;
        }
        
        /* Textarea */
        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }
        
        /* Form Rows */
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        
        .form-row > .form-group {
            flex: 1;
            min-width: 200px;
            padding: 0 10px;
        }
        
        /* Terms and Conditions */
        .terms-container {
            background: rgba(0, 0, 0, 0.1);
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        
        .form-check {
            display: flex;
            align-items: flex-start;
        }
        
        .form-check-input {
            margin-top: 0.25rem;
        }
        
        .form-check-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            line-height: 1.4;
        }
        
        .form-check-label a {
            color: #7fb069;
            text-decoration: none;
            font-weight: 500;
        }
        
        .form-check-label a:hover {
            text-decoration: underline;
        }
        
        /* Error Messages */
        .invalid-feedback {
            display: block;
            color: #ff6b6b;
            font-size: 0.8rem;
            margin-top: 5px;
        }
        
        .is-invalid {
            border-color: #ff6b6b !important;
        }

        .auth-footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        .auth-footer a {
            color: #7fb069;
            text-decoration: none;
            font-weight: 500;
        }

        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            margin: 20px 0;
        }

        .terms-checkbox input {
            margin-right: 10px;
            margin-top: 3px;
        }

        .terms-text {
            font-size: 14px;
            color: #666;
        }

        .terms-text a {
            color: #7fb069;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
            }
            
            .auth-left, .auth-right {
                width: 100%;
            }
            
            .auth-right {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <!-- Left Side - Signup Form -->
            <div class="auth-left">
                <!-- <div class="logo-section">
                    <img src="{{ asset('assest/Biz.png') }}" alt="BizNest Logo" class="logo">
                    <span class="logo-text">BizNest</span>
                </div> -->
                
                <h1 class="form-title">Create Business Account</h1>
                <p class="form-subtitle">Register your business to get started with BizNest</p>
                
                <div class="form-container">
                    <form method="POST" action="{{ route('register.business.submit') }}" id="business-registration-form">
                        @csrf
                        
                        <!-- Business Information Section -->
                        <h3 class="section-title">Business Information</h3>
                        
                        <!-- Display validation errors at the top of the form -->
                        @if($errors->any())
                            <div class="alert alert-danger mb-4">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="business_name" class="form-label">
                                <i class="fas fa-building"></i> Business Name *
                            </label>
                            <input type="text" id="business_name" name="business_name" class="form-control @error('business_name') is-invalid @enderror" required 
                                   placeholder="Enter your business name" value="{{ old('business_name') }}">
                            @error('business_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="business_type" class="form-label">
                                    <i class="fas fa-store"></i> Business Type *
                                </label>
                                <select id="business_type" name="business_type" class="form-control @error('business_type') is-invalid @enderror" required>
                                    <option value="">Select business type</option>
                                    <option value="wholesale" {{ old('business_type') == 'wholesale' ? 'selected' : '' }}>Wholesale</option>
                                    <option value="retail" {{ old('business_type') == 'retail' ? 'selected' : '' }}>Retail</option>
                                    <option value="both" {{ old('business_type') == 'both' ? 'selected' : '' }}>Both</option>
                                </select>
                                @error('business_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="category" class="form-label">
                                    <i class="fas fa-tag"></i> Business Category *
                                </label>
                                <select id="category" name="category" class="form-control @error('category') is-invalid @enderror" required>
                                    <option value="">Select category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Contact Information Section -->
                        <h3 class="section-title">Contact Information</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="business_email" class="form-label">
                                    <i class="fas fa-envelope"></i> Business Email *
                                </label>
                                <input type="email" id="business_email" name="business_email" class="form-control @error('business_email') is-invalid @enderror" required 
                                   placeholder="business@example.com" value="{{ old('business_email') }}">
                            @error('business_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="phone" class="form-label">
                                    <i class="fas fa-phone"></i> Phone Number *
                                </label>
                                <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" required
                                   placeholder="+94 XX XXX XXXX" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        
                        <!-- Location Information Section -->
                        <h3 class="section-title">Location Information</h3>
                        
                        <div class="form-group">
                            <label for="business_address" class="form-label">
                                <i class="fas fa-map-marker-alt"></i> Business Address *
                            </label>
                            <textarea id="business_address" name="business_address" class="form-control @error('business_address') is-invalid @enderror" required
                                      placeholder="Full business address">{{ old('business_address') }}</textarea>
                            @error('business_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="district" class="form-label">
                                    <i class="fas fa-map"></i> District *
                                </label>
                                <input type="text" id="district" name="district" class="form-control @error('district') is-invalid @enderror" required
                                       placeholder="e.g., Colombo" value="{{ old('district') }}">
                                @error('district')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="postal_code" class="form-label">
                                    <i class="fas fa-map-marker-alt"></i> Postal Code *
                                </label>
                                <input type="text" id="postal_code" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" required
                                       placeholder="e.g., 00100" value="{{ old('postal_code') }}">
                                @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror maxlength="10">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="province" class="form-label">
                                <i class="fas fa-map-pin"></i> Province *
                            </label>
                            <select id="province" name="province" class="form-control @error('province') is-invalid @enderror" required>
                                <option value="">Select Province</option>
                                <option value="Western" {{ old('province') == 'Western' ? 'selected' : '' }}>Western</option>
                                <option value="Central" {{ old('province') == 'Central' ? 'selected' : '' }}>Central</option>
                                <option value="Southern" {{ old('province') == 'Southern' ? 'selected' : '' }}>Southern</option>
                                <option value="Northern" {{ old('province') == 'Northern' ? 'selected' : '' }}>Northern</option>
                                <option value="Eastern" {{ old('province') == 'Eastern' ? 'selected' : '' }}>Eastern</option>
                                <option value="North Western" {{ old('province') == 'North Western' ? 'selected' : '' }}>North Western</option>
                                <option value="North Central" {{ old('province') == 'North Central' ? 'selected' : '' }}>North Central</option>
                                <option value="Uva" {{ old('province') == 'Uva' ? 'selected' : '' }}>Uva</option>
                                <option value="Sabaragamuwa" {{ old('province') == 'Sabaragamuwa' ? 'selected' : '' }}>Sabaragamuwa</option>
                            </select>
                            @error('province')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Business Owner Information -->
                        <h3 class="section-title">Business Owner Information</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="owner_name" class="form-label">
                                    <i class="fas fa-user"></i> Owner Full Name *
                                </label>
                                <input type="text" id="owner_name" name="owner_name" class="form-control @error('owner_name') is-invalid @enderror" required 
                                       placeholder="Owner's full name" value="{{ old('owner_name') }}">
                                @error('owner_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="owner_email" class="form-label">
                                    <i class="fas fa-envelope"></i> Owner Email *
                                </label>
                                <input type="email" id="owner_email" name="owner_email" class="form-control @error('owner_email') is-invalid @enderror" required 
                                       placeholder="owner@email.com" value="{{ old('owner_email') }}">
                                @error('owner_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="owner_phone" class="form-label">
                                    <i class="fas fa-phone"></i> Owner Phone *
                                </label>
                                <input type="tel" id="owner_phone" name="owner_phone" class="form-control @error('owner_phone') is-invalid @enderror" required
                                       placeholder="+94 XX XXX XXXX" value="{{ old('owner_phone') }}">
                                @error('owner_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="business_reg_no" class="form-label">
                                    <i class="fas fa-file-alt"></i> Business Registration Number *
                                </label>
                                <input type="text" id="business_reg_no" name="business_reg_no" class="form-control @error('business_reg_no') is-invalid @enderror" required
                                       placeholder="Business registration number" value="{{ old('business_reg_no') }}">
                                @error('business_reg_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Account Information Section -->
                        <h3 class="section-title">Account Information</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock"></i> Password *
                                </label>
                                <div class="input-group">
                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required 
                                       placeholder="Create a password" autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                    <button type="button" class="input-group-append" id="togglePassword">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">
                                    <i class="fas fa-check-circle"></i> Confirm Password *
                                </label>
                                <div class="input-group">
                                    <input type="password" id="password_confirmation" name="password_confirmation" 
                                           class="form-control" required placeholder="Confirm your password">
                                    <button type="button" class="input-group-append" id="toggleConfirmPassword">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Terms and Conditions -->
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" id="terms" name="terms" class="form-check-input" required>
                                <label for="terms" class="form-check-label">
                                    I agree to the <a href="{{ route('terms') }}" target="_blank">Terms of Service</a> and 
                                    <a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a> *
                                </label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn">
                            <i class="fas fa-building"></i> Register Business
                        </button>
                    </form>
                    
                    <div class="divider">
                        <span>or</span>
                    </div>
                    
                    <div class="social-login">
                        <button type="button" class="social-btn">
                            <i class="fab fa-google"></i>
                        </button>
                        <button type="button" class="social-btn">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                        <button type="button" class="social-btn">
                            <i class="fab fa-linkedin-in"></i>
                        </button>
                    </div>
                    
                    <div class="login-link">
                        Already have an account? <a href="{{ route('login') }}">Sign In</a>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Welcome Image -->
            <div class="auth-right">
                <img src="{{ asset('assest/Grow1.png') }}" alt="Business Registration" class="hero-image">
                <div class="welcome-text">
                    <h2>Grow Your Business with BizNest</h2>
                    <p>Join thousands of businesses reaching new customers and growing their presence online. Get discovered by potential clients and showcase your products and services.</p>
                </div>
                <div class="floating-shapes">
                    <div class="shape"></div>
                    <div class="shape"></div>
                    <div class="shape"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Back to Home Link -->
    <div style="position: fixed; top: 20px; left: 20px; z-index: 1000;">
        <a href="{{ url('/') }}" style="color: #7fb069; text-decoration: none; font-weight: 500; display: flex; align-items: center; gap: 8px; background: rgba(255, 255, 255, 0.1); padding: 10px 15px; border-radius: 25px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s ease;" 
           onmouseover="this.style.background='rgba(255, 255, 255, 0.2)'; this.style.color='#8bc34a';" 
           onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'; this.style.color='#7fb069';">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Toggle password visibility
            $('#togglePassword').click(function() {
                const passwordInput = $('#password');
                const icon = $(this).find('i');
                
                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    icon.removeClass('eye-slash').addClass('fa-eye');
                }
                
                // Trigger focus to maintain cursor position
                passwordInput.focus();
            });
            
            // Toggle confirm password visibility
            $('#toggleConfirmPassword').click(function() {
                const confirmPasswordInput = $('#password_confirmation');
                const icon = $(this).find('i');
                
                if (confirmPasswordInput.attr('type') === 'password') {
                    confirmPasswordInput.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('eye-slash');
                } else {
                    confirmPasswordInput.attr('type', 'password');
                    icon.removeClass('eye-slash').addClass('fa-eye');
                }
                
                // Trigger focus to maintain cursor position
                confirmPasswordInput.focus();
            });
            
            // Form validation
            $('#business-registration-form').on('submit', function(e) {
                const password = $('#password').val();
                const confirmPassword = $('#password_confirmation').val();
                
                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Passwords do not match. Please try again.');
                    return false;
                }
                
                if (password.length < 8) {
                    e.preventDefault();
                    alert('Password must be at least 8 characters long.');
                    return false;
                }
                
                if (!$('#terms').is(':checked')) {
                    e.preventDefault();
                    alert('You must agree to the Terms of Service and Privacy Policy.');
                    return false;
                }
                
                return true;
            });
            
            // Add animation on form load
            $('.auth-card').addClass('loaded');
        });
    </script>
</body>
</html>
