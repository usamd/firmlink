<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - BizNest</title>
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
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
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

        .profile-header {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 40px;
            border: 1px solid rgba(127, 176, 105, 0.2);
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
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

        .profile-info {
            display: flex;
            align-items: center;
            gap: 30px;
            position: relative;
            z-index: 2;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: white;
            font-weight: 700;
            border: 4px solid rgba(127, 176, 105, 0.3);
            position: relative;
            overflow: hidden;
        }

        .profile-avatar::before {
            content: '';
            position: absolute;
            top: -4px;
            left: -4px;
            right: -4px;
            bottom: -4px;
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

        .profile-details h1 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .profile-details .role {
            font-size: 18px;
            color: rgba(127, 176, 105, 0.9);
            margin-bottom: 15px;
            font-weight: 500;
        }

        .profile-details .bio {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            max-width: 600px;
            margin-bottom: 20px;
        }

        .profile-actions {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(127, 176, 105, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .profile-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(127, 176, 105, 0.2);
            transition: all 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(127, 176, 105, 0.2);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .card-title {
            font-size: 20px;
            font-weight: 700;
            color: white;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 15px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            background: rgba(127, 176, 105, 0.1);
            transform: translateY(-2px);
        }

        .stat-number {
            font-size: 24px;
            font-weight: 700;
            color: #7fb069;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
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
            width: 40px;
            height: 40px;
            background: rgba(127, 176, 105, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #7fb069;
        }

        .activity-content {
            flex: 1;
        }

        .activity-text {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            margin-bottom: 5px;
        }

        .activity-time {
            color: rgba(255, 255, 255, 0.5);
            font-size: 12px;
        }

        .skill-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .skill-name {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        .skill-level {
            background: rgba(255, 255, 255, 0.1);
            height: 8px;
            border-radius: 4px;
            width: 100px;
            overflow: hidden;
        }

        .skill-progress {
            height: 100%;
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
            color: rgba(255, 255, 255, 0.8);
        }

        .contact-item i {
            color: #7fb069;
            width: 20px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        @media (max-width: 1024px) {
            .profile-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }

            .profile-info {
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
    <div class="container">
        <a href="{{ route('dashboard') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Dashboard
        </a>

        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-info">
                <div class="profile-avatar">
                    {{ strtoupper(substr($users->name ?? 'U', 0, 1)) }}
                </div>
                <div class="profile-details">
                    <h1>{{ $users->name ?? 'User Name' }}</h1>
                    <div class="role">Business Owner & Entrepreneur</div>
                    <div class="bio">
                        {{ $users->bio ?? 'Passionate business professional focused on growth, innovation, and building meaningful connections in the business community.' }}
                    </div>
                    <div class="profile-actions">
                        <a href="{{ route('user.dashboard.settings') }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                            Edit Profile
                        </a>
                        <button class="btn btn-secondary">
                            <i class="fas fa-share"></i>
                            Share Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Content Grid -->
        <div class="profile-grid">
            <!-- Statistics Card -->
            <div class="profile-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="card-title">Statistics</div>
                </div>
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number">{{ $products->count() ?? '0' }}</div>
                        <div class="stat-label">Products</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">1,234</div>
                        <div class="stat-label">Views</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">567</div>
                        <div class="stat-label">Connections</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">89%</div>
                        <div class="stat-label">Growth</div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="profile-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-address-book"></i>
                    </div>
                    <div class="card-title">Contact Info</div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>{{ $users->email ?? 'user@example.com' }}</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <span>{{ $users->phone ?? '+1 (555) 123-4567' }}</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ $users->location ?? 'New York, NY' }}</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-globe"></i>
                    <span>{{ $users->website ?? 'www.example.com' }}</span>
                </div>
            </div>

            <!-- Skills & Expertise -->
            <div class="profile-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="card-title">Skills & Expertise</div>
                </div>
                <div class="skill-item">
                    <span class="skill-name">Business Strategy</span>
                    <div class="skill-level">
                        <div class="skill-progress" style="width: 90%"></div>
                    </div>
                </div>
                <div class="skill-item">
                    <span class="skill-name">Marketing</span>
                    <div class="skill-level">
                        <div class="skill-progress" style="width: 85%"></div>
                    </div>
                </div>
                <div class="skill-item">
                    <span class="skill-name">Leadership</span>
                    <div class="skill-level">
                        <div class="skill-progress" style="width: 95%"></div>
                    </div>
                </div>
                <div class="skill-item">
                    <span class="skill-name">Networking</span>
                    <div class="skill-level">
                        <div class="skill-progress" style="width: 80%"></div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="profile-card full-width">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="card-title">Recent Activity</div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Added a new product to your business listing</div>
                        <div class="activity-time">2 hours ago</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Received 15 likes on your latest business post</div>
                        <div class="activity-time">5 hours ago</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Connected with 3 new business partners</div>
                        <div class="activity-time">1 day ago</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-comment"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Commented on a business discussion thread</div>
                        <div class="activity-time">2 days ago</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-share"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Shared your business profile with potential clients</div>
                        <div class="activity-time">3 days ago</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add some interactive functionality
        document.querySelectorAll('.stat-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.05)';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(-2px) scale(1)';
            });
        });

        // Animate skill progress bars on page load
        document.addEventListener('DOMContentLoaded', function() {
            const skillBars = document.querySelectorAll('.skill-progress');
            skillBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 500);
            });
        });

        // Share profile functionality
        document.querySelector('.btn-secondary').addEventListener('click', function() {
            if (navigator.share) {
                navigator.share({
                    title: 'My BizNest Profile',
                    text: 'Check out my business profile on BizNest',
                    url: window.location.href
                });
            } else {
                // Fallback for browsers that don't support Web Share API
                navigator.clipboard.writeText(window.location.href).then(() => {
                    alert('Profile link copied to clipboard!');
                });
            }
        });
    </script>
</body>
</html>
