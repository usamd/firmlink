<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BizNest</title>
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
            width: 300px;
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
            color: #ef4444;
            font-size: 2rem;
            font-weight: bold;
            text-shadow: 0 0 20px rgba(239, 68, 68, 0.5);
        }

        .logo span {
            color: #9ca3af;
            font-size: 0.9rem;
            display: block;
            margin-top: 0.5rem;
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
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.2), rgba(220, 38, 38, 0.1));
            color: #ef4444;
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
            margin-left: 300px;
            padding: 2rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
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
            background: linear-gradient(135deg, #ef4444, #dc2626);
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
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: #e5e7eb;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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
            background: linear-gradient(90deg, transparent, rgba(239, 68, 68, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .stat-card:hover::before {
            left: 100%;
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #ef4444;
        }

        .stat-label {
            color: #9ca3af;
            font-size: 0.9rem;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
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
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #ef4444;
        }

        /* Lists */
        .list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 0.5rem;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .list-item:hover {
            background: rgba(255, 255, 255, 0.05);
            transform: translateX(5px);
        }

        .list-item-info h4 {
            color: #e5e7eb;
            margin-bottom: 0.25rem;
            font-size: 1rem;
        }

        .list-item-info span {
            color: #9ca3af;
            font-size: 0.9rem;
        }

        .list-item-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
            border-radius: 8px;
        }

        .btn-success {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        /* Badge */
        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .badge-success {
            background: rgba(34, 197, 94, 0.2);
            color: #22c55e;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .badge-danger {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
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
                <span>Admin Panel</span>
            </div>
            
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users') }}" class="nav-link">
                            <i class="fas fa-users"></i>
                            User Management
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.businesses') }}" class="nav-link">
                            <i class="fas fa-building"></i>
                            Business Verification
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.posts') }}" class="nav-link">
                            <i class="fas fa-newspaper"></i>
                            Content Moderation
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.analytics') }}" class="nav-link">
                            <i class="fas fa-chart-bar"></i>
                            Analytics
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.dashboard') }}" class="nav-link">
                            <i class="fas fa-home"></i>
                            Main Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link" id="admin-logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                        <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <script>
                            document.getElementById('admin-logout-btn').addEventListener('click', function(e) {
                                e.preventDefault();
                                document.getElementById('admin-logout-form').submit();
                            });
                        </script>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="welcome-text">
                    <h1>Admin Dashboard</h1>
                    <p>System overview and management controls for BizNest platform.</p>
                </div>
                <div class="header-actions">
                    <a href="{{ route('admin.users') }}" class="btn btn-primary">
                        <i class="fas fa-users-cog"></i>
                        Manage Users
                    </a>
                    <a href="{{ route('admin.businesses') }}" class="btn btn-secondary">
                        <i class="fas fa-check-circle"></i>
                        Verify Businesses
                    </a>
                </div>
            </header>

            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number">{{ number_format($stats['total_users']) }}</div>
                    <div class="stat-label">Total Users</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stat-number">{{ number_format($stats['total_businesses']) }}</div>
                    <div class="stat-label">Businesses</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="stat-number">{{ number_format($stats['total_posts']) }}</div>
                    <div class="stat-label">Total Posts</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-number">{{ number_format($stats['pending_verifications']) }}</div>
                    <div class="stat-label">Pending Verifications</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="stat-number">{{ number_format($stats['active_users']) }}</div>
                    <div class="stat-label">Active Users</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <div class="stat-number">{{ number_format($stats['posts_today']) }}</div>
                    <div class="stat-label">Posts Today</div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Pending Business Verifications -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pending Business Verifications</h3>
                        <a href="{{ route('admin.businesses') }}" class="btn btn-secondary btn-sm">View All</a>
                    </div>
                    
                    @if($pendingBusinesses->count() > 0)
                        @foreach($pendingBusinesses as $business)
                            <div class="list-item">
                                <div class="list-item-info">
                                    <h4>{{ $business->business_name }}</h4>
                                    <span>{{ $business->user->name }} • {{ $business->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="list-item-actions">
                                    <form method="POST" action="{{ route('admin.businesses.verify', $business) }}" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <button class="btn btn-danger btn-sm" onclick="rejectBusiness({{ $business->businesses_id }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div style="text-align: center; padding: 2rem; color: #9ca3af;">
                            <i class="fas fa-check-circle" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                            <p>No pending business verifications!</p>
                        </div>
                    @endif
                </div>

                <!-- Recent Users -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Recent Users</h3>
                        <a href="{{ route('admin.users') }}" class="btn btn-secondary btn-sm">View All</a>
                    </div>
                    
                    @foreach($recentUsers as $recentUser)
                        <div class="list-item">
                            <div class="list-item-info">
                                <h4>{{ $recentUser->name }}</h4>
                                <span>{{ $recentUser->email }} • {{ $recentUser->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="list-item-actions">
                                @if($recentUser->role)
                                    <span class="badge badge-{{ $recentUser->role->name === 'admin' ? 'danger' : ($recentUser->role->name === 'business' ? 'warning' : 'success') }}">
                                        {{ ucfirst($recentUser->role->name) }}
                                    </span>
                                @endif
                                @if($recentUser->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Posts -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Posts</h3>
                    <a href="{{ route('admin.posts') }}" class="btn btn-secondary">Moderate Content</a>
                </div>
                
                @if($recentPosts->count() > 0)
                    @foreach($recentPosts as $post)
                        <div class="list-item">
                            <div class="list-item-info">
                                <h4>{{ Str::limit($post->title, 60) }}</h4>
                                <span>By {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="list-item-actions">
                                <span class="badge badge-{{ $post->status === 'published' ? 'success' : ($post->status === 'draft' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($post->status) }}
                                </span>
                                @if($post->is_promoted)
                                    <span class="badge badge-warning">Promoted</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div style="text-align: center; padding: 2rem; color: #9ca3af;">
                        <i class="fas fa-newspaper" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                        <p>No recent posts to display.</p>
                    </div>
                @endif
            </div>

            <!-- Registration Trends Chart -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Registration Trends (Last 30 Days)</h3>
                </div>
                <div class="chart-container">
                    <canvas id="registrationChart"></canvas>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Registration Trends Chart
        const ctx = document.getElementById('registrationChart').getContext('2d');
        const registrationChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Users', 'Businesses'],
                datasets: [{
                    label: 'New Registrations (Last 30 Days)',
                    data: [
                        {{ $registrationTrends['users_last_30_days'] }},
                        {{ $registrationTrends['businesses_last_30_days'] }}
                    ],
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
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

        // Reject Business Function
        function rejectBusiness(businessId) {
            const reason = prompt('Please provide a reason for rejection:');
            if (reason && reason.trim()) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/businesses/${businessId}/reject`;
                
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
                
                form.innerHTML = `
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="reason" value="${reason}">
                `;
                
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
