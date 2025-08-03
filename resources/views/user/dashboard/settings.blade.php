<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings - BizNest</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #0f1419 0%, #1a2332 50%, #0f1419 100%);
            color: white;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .settings-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .settings-header h1 {
            font-size: 42px;
            font-weight: 800;
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 15px;
        }

        .settings-header p {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.7);
            max-width: 600px;
            margin: 0 auto;
        }

        .settings-grid {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 40px;
            align-items: start;
        }

        .settings-sidebar {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(127, 176, 105, 0.2);
            position: sticky;
            top: 40px;
        }

        .settings-nav {
            list-style: none;
        }

        .settings-nav li {
            margin-bottom: 15px;
        }

        .settings-nav a {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .settings-nav a:hover,
        .settings-nav a.active {
            background: rgba(127, 176, 105, 0.1);
            color: #7fb069;
            transform: translateX(5px);
        }

        .settings-nav i {
            margin-right: 15px;
            width: 20px;
            font-size: 16px;
        }

        .settings-content {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 40px;
            border: 1px solid rgba(127, 176, 105, 0.2);
        }

        .settings-section {
            display: none;
        }

        .settings-section.active {
            display: block;
        }

        .section-title {
            font-size: 28px;
            font-weight: 700;
            color: #7fb069;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(127, 176, 105, 0.2);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: white;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #7fb069;
            box-shadow: 0 0 20px rgba(127, 176, 105, 0.3);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .avatar-upload {
            display: flex;
            align-items: center;
            gap: 25px;
            margin-bottom: 30px;
        }

        .avatar-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: white;
            font-weight: 700;
            border: 3px solid rgba(127, 176, 105, 0.3);
        }

        .upload-btn {
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .upload-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(127, 176, 105, 0.4);
        }

        .settings-actions {
            display: flex;
            gap: 15px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(127, 176, 105, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 15px 30px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
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
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #7fb069;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        .notification-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-info h4 {
            color: white;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .notification-info p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            color: #7fb069;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            color: white;
            transform: translateX(-5px);
        }

        .back-btn i {
            margin-right: 10px;
        }

        @media (max-width: 768px) {
            .settings-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .settings-sidebar {
                position: static;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('dashboard') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Dashboard
        </a>

        <div class="settings-header">
            <h1>Profile Settings</h1>
            <p>Manage your account settings and preferences</p>
        </div>

        <div class="settings-grid">
            <div class="settings-sidebar">
                <ul class="settings-nav">
                    <li><a href="#" class="settings-nav-link active" data-section="profile">
                        <i class="fas fa-user"></i>Profile Information
                    </a></li>
                    <li><a href="#" class="settings-nav-link" data-section="account">
                        <i class="fas fa-cog"></i>Account Settings
                    </a></li>
                    <li><a href="#" class="settings-nav-link" data-section="notifications">
                        <i class="fas fa-bell"></i>Notifications
                    </a></li>
                    <li><a href="#" class="settings-nav-link" data-section="privacy">
                        <i class="fas fa-shield-alt"></i>Privacy & Security
                    </a></li>
                    <li><a href="#" class="settings-nav-link" data-section="business">
                        <i class="fas fa-building"></i>Business Settings
                    </a></li>
                </ul>
            </div>

            <div class="settings-content">
                <!-- Profile Information Section -->
                <div class="settings-section active" id="profile">
                    <h2 class="section-title">Profile Information</h2>
                    
                    <div class="avatar-upload">
                        <div class="avatar-preview">
                            {{ strtoupper(substr($users->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <button class="upload-btn">
                                <i class="fas fa-camera"></i> Change Photo
                            </button>
                            <p style="color: rgba(255,255,255,0.6); font-size: 14px; margin-top: 8px;">
                                JPG, PNG or GIF. Max size 2MB.
                            </p>
                        </div>
                    </div>

                    <form>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-input" value="{{ explode(' ', $users->name ?? '')[0] ?? '' }}" placeholder="Enter first name">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-input" value="{{ explode(' ', $users->name ?? '', 2)[1] ?? '' }}" placeholder="Enter last name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-input" value="{{ $users->email ?? '' }}" placeholder="Enter email address">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" class="form-input" value="{{ $users->phone ?? '' }}" placeholder="Enter phone number">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-input" value="{{ $users->location ?? '' }}" placeholder="Enter location">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Bio</label>
                            <textarea class="form-input form-textarea" placeholder="Tell us about yourself...">{{ $users->bio ?? '' }}</textarea>
                        </div>
                    </form>
                </div>

                <!-- Account Settings Section -->
                <div class="settings-section" id="account">
                    <h2 class="section-title">Account Settings</h2>
                    
                    <form>
                        <div class="form-group">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-input" value="{{ $users->username ?? $users->name ?? '' }}" placeholder="Enter username">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Current Password</label>
                            <input type="password" class="form-input" placeholder="Enter current password">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-input" placeholder="Enter new password">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-input" placeholder="Confirm new password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Language</label>
                            <select class="form-input">
                                <option>English</option>
                                <option>Spanish</option>
                                <option>French</option>
                                <option>German</option>
                            </select>
                        </div>
                    </form>
                </div>

                <!-- Notifications Section -->
                <div class="settings-section" id="notifications">
                    <h2 class="section-title">Notification Preferences</h2>
                    
                    <div class="notification-item">
                        <div class="notification-info">
                            <h4>Email Notifications</h4>
                            <p>Receive notifications via email</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="notification-item">
                        <div class="notification-info">
                            <h4>Push Notifications</h4>
                            <p>Receive push notifications in browser</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="notification-item">
                        <div class="notification-info">
                            <h4>Business Updates</h4>
                            <p>Get notified about business-related activities</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="notification-item">
                        <div class="notification-info">
                            <h4>Marketing Communications</h4>
                            <p>Receive promotional emails and updates</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>

                <!-- Privacy & Security Section -->
                <div class="settings-section" id="privacy">
                    <h2 class="section-title">Privacy & Security</h2>
                    
                    <div class="notification-item">
                        <div class="notification-info">
                            <h4>Profile Visibility</h4>
                            <p>Make your profile visible to other users</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="notification-item">
                        <div class="notification-info">
                            <h4>Two-Factor Authentication</h4>
                            <p>Add an extra layer of security to your account</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="notification-item">
                        <div class="notification-info">
                            <h4>Data Analytics</h4>
                            <p>Allow us to collect anonymous usage data</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>

                <!-- Business Settings Section -->
                <div class="settings-section" id="business">
                    <h2 class="section-title">Business Settings</h2>
                    
                    <form>
                        <div class="form-group">
                            <label class="form-label">Business Name</label>
                            <input type="text" class="form-input" placeholder="Enter business name">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Business Type</label>
                                <select class="form-input">
                                    <option>Select business type</option>
                                    <option>Restaurant</option>
                                    <option>Retail</option>
                                    <option>Technology</option>
                                    <option>Healthcare</option>
                                    <option>Education</option>
                                    <option>Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Business Size</label>
                                <select class="form-input">
                                    <option>Select size</option>
                                    <option>1-10 employees</option>
                                    <option>11-50 employees</option>
                                    <option>51-200 employees</option>
                                    <option>200+ employees</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Business Description</label>
                            <textarea class="form-input form-textarea" placeholder="Describe your business..."></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Website URL</label>
                            <input type="url" class="form-input" placeholder="https://yourwebsite.com">
                        </div>
                    </form>
                </div>

                <div class="settings-actions">
                    <button class="btn-primary">Save Changes</button>
                    <button class="btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Settings navigation functionality
        document.querySelectorAll('.settings-nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all nav links and sections
                document.querySelectorAll('.settings-nav-link').forEach(l => l.classList.remove('active'));
                document.querySelectorAll('.settings-section').forEach(s => s.classList.remove('active'));
                
                // Add active class to clicked nav link
                this.classList.add('active');
                
                // Show corresponding section
                const sectionId = this.getAttribute('data-section');
                document.getElementById(sectionId).classList.add('active');
            });
        });

        // Form submission handling
        document.querySelector('.btn-primary').addEventListener('click', function(e) {
            e.preventDefault();
            
            // Show success message (you can replace this with actual form submission)
            alert('Settings saved successfully!');
        });

        // Cancel button
        document.querySelector('.btn-secondary').addEventListener('click', function(e) {
            e.preventDefault();
            
            if (confirm('Are you sure you want to discard your changes?')) {
                window.location.href = "{{ route('dashboard') }}";
            }
        });
    </script>
</body>
</html>
