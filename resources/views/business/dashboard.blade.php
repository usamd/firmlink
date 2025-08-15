<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Dashboard - BizNest</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            min-height: 100vh;
            color: #ffffff;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: rgba(15, 32, 39, 0.95);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2rem 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar::-webkit-scrollbar {
            display: none;
        }

        .logo {
            text-align: center;
            margin-bottom: 3rem;
            padding: 0 2rem;
        }

        .logo h2 {
            color: #4ade80;
            font-size: 2rem;
            font-weight: bold;
            text-shadow: 0 0 20px rgba(74, 222, 128, 0.5);
        }

        .nav-menu {
            list-style: none;
            padding: 0 1rem;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: #e5e7eb;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link:hover, .nav-link.active {
            background: linear-gradient(135deg, rgba(74, 222, 128, 0.2), rgba(34, 197, 94, 0.1));
            color: #4ade80;
            transform: translateX(5px);
        }

        .nav-link i {
            margin-right: 1rem;
            font-size: 1.2rem;
            width: 20px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
        }

        .header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 2rem;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            padding: 1.5rem 2rem;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .welcome-text h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #4ade80, #22c55e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .welcome-text p {
            color: #9ca3af;
            font-size: 1.1rem;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4ade80, #22c55e);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(74, 222, 128, 0.3);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: #e5e7eb;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(74, 222, 128, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .stat-card:hover::before {
            left: 100%;
        }

        .stat-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #4ade80, #22c55e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #4ade80;
        }

        .stat-label {
            color: #9ca3af;
            font-size: 1rem;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 2rem;
        }

        .card-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #4ade80;
        }

        /* Recent Posts */
        .post-item {
            display: flex;
            gap: 1rem;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .post-item:hover {
            background: rgba(255, 255, 255, 0.05);
            transform: translateX(5px);
        }

        .post-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            background: linear-gradient(135deg, #4ade80, #22c55e);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .post-content h4 {
            color: #e5e7eb;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .post-meta {
            color: #9ca3af;
            font-size: 0.9rem;
            display: flex;
            gap: 1rem;
        }

        /* Followers List */
        .follower-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 0.5rem;
            background: rgba(255, 255, 255, 0.02);
            transition: all 0.3s ease;
        }

        .follower-item:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .follower-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4ade80, #22c55e);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .follower-info h5 {
            color: #e5e7eb;
            margin-bottom: 0.25rem;
        }

        .follower-info span {
            color: #9ca3af;
            font-size: 0.9rem;
        }

        /* Chart Container */
        .chart-container {
            position: relative;
            height: 300px;
            margin-top: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }

            .main-content {
                margin-left: 0;
            }

            .content-grid {
                grid-template-columns: 1fr;
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
        <aside class="sidebar">
            <div class="logo">
                <h2>BizNest</h2>
            </div>
            
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('business.dashboard') }}" class="nav-link active">
                            <i class="fas fa-chart-line"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('business.profile') }}" class="nav-link">
                            <i class="fas fa-building"></i>
                            Business Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('business.posts') }}" class="nav-link">
                            <i class="fas fa-newspaper"></i>
                            Posts & Content
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('business.analytics') }}" class="nav-link">
                            <i class="fas fa-chart-bar"></i>
                            Analytics
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('business.followers') }}" class="nav-link">
                            <i class="fas fa-users"></i>
                            Followers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('business.settings') }}" class="nav-link">
                            <i class="fas fa-cog"></i>
                            Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.dashboard') }}" class="nav-link">
                            <i class="fas fa-home"></i>
                            Main Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="nav-link" style="background: none; border: none; width: 100%; text-align: left;">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="welcome-text">
                    <h1>Business Dashboard</h1>
                    <p>Welcome back, {{ $user->name }}! Manage your business presence on BizNest.</p>
                </div>
                <div class="header-actions">
                    <a href="{{ route('business.posts.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Create Post
                    </a>
                    <a href="{{ route('business.profile') }}" class="btn btn-secondary">
                        <i class="fas fa-edit"></i>
                        Edit Profile
                    </a>
                </div>
            </header>

            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stat-number">{{ $stats['total_businesses'] }}</div>
                    <div class="stat-label">Business Profiles</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="stat-number">{{ $stats['total_posts'] }}</div>
                    <div class="stat-label">Total Posts</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number">{{ $stats['total_followers'] }}</div>
                    <div class="stat-label">Followers</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-number">{{ number_format($stats['total_views']) }}</div>
                    <div class="stat-label">Total Views</div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Recent Posts -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Recent Posts</h3>
                        <a href="{{ route('business.posts') }}" class="btn btn-secondary">View All</a>
                    </div>
                    
                    @if($recentPosts->count() > 0)
                        @foreach($recentPosts as $post)
                            <div class="post-item">
                                <div class="post-image">
                                    @if($post->image_path)
                                        <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post Image" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                                    @else
                                        <i class="fas fa-newspaper"></i>
                                    @endif
                                </div>
                                <div class="post-content">
                                    <h4>{{ Str::limit($post->title, 50) }}</h4>
                                    <div class="post-meta">
                                        <span><i class="fas fa-heart"></i> {{ $post->likes->count() }}</span>
                                        <span><i class="fas fa-comment"></i> {{ $post->comments->count() }}</span>
                                        <span><i class="fas fa-calendar"></i> {{ $post->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div style="text-align: center; padding: 2rem; color: #9ca3af;">
                            <i class="fas fa-newspaper" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                            <p>No posts yet. Create your first post to get started!</p>
                            <a href="{{ route('business.posts.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                                <i class="fas fa-plus"></i>
                                Create First Post
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Recent Followers -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Recent Followers</h3>
                        <a href="{{ route('business.followers') }}" class="btn btn-secondary">View All</a>
                    </div>
                    
                    @if($recentFollowers->count() > 0)
                        @foreach($recentFollowers as $follow)
                            <div class="follower-item">
                                <div class="follower-avatar">
                                    {{ strtoupper(substr($follow->follower->name, 0, 1)) }}
                                </div>
                                <div class="follower-info">
                                    <h5>{{ $follow->follower->name }}</h5>
                                    <span>{{ $follow->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div style="text-align: center; padding: 2rem; color: #9ca3af;">
                            <i class="fas fa-users" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                            <p>No followers yet. Start posting content to attract followers!</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Performance Chart -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Performance Overview (Last 30 Days)</h3>
                </div>
                <div class="chart-container">
                    <canvas id="performanceChart"></canvas>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Performance Chart
        const ctx = document.getElementById('performanceChart').getContext('2d');
        const performanceChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Posts', 'Likes', 'Comments', 'Followers'],
                datasets: [{
                    label: 'Last 30 Days',
                    data: [
                        {{ $performanceData['posts_last_30_days'] }},
                        {{ $performanceData['likes_last_30_days'] }},
                        {{ $performanceData['comments_last_30_days'] }},
                        {{ $performanceData['followers_last_30_days'] }}
                    ],
                    borderColor: '#4ade80',
                    backgroundColor: 'rgba(74, 222, 128, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#e5e7eb'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#9ca3af'
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#9ca3af'
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
