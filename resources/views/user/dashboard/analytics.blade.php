<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - BizNest</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .page-header {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 40px;
            border: 1px solid rgba(127, 176, 105, 0.2);
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
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
            animation: shimmer 8s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes shimmer {
            0%, 100% {
                background-position: -100% -100%;
                opacity: 0.3;
            }
            50% {
                background-position: 100% 100%;
                opacity: 0.7;
            }
        }

        .page-header h1 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
            z-index: 2;
        }

        .page-header p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 18px;
            position: relative;
            z-index: 2;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(127, 176, 105, 0.2);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(127, 176, 105, 0.4);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                135deg,
                transparent 30%,
                rgba(127, 176, 105, 0.03) 50%,
                transparent 70%
            );
            background-size: 200% 200%;
            animation: cardShimmer 6s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes cardShimmer {
            0%, 100% {
                background-position: -100% -100%;
            }
            50% {
                background-position: 100% 100%;
            }
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 800;
            color: #7fb069;
            margin-bottom: 8px;
            position: relative;
            z-index: 2;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.7);
            font-size: 16px;
            font-weight: 500;
            position: relative;
            z-index: 2;
        }

        .stat-change {
            font-size: 14px;
            margin-top: 10px;
            position: relative;
            z-index: 2;
        }

        .stat-change.positive {
            color: #4ade80;
        }

        .stat-change.negative {
            color: #f87171;
        }

        .charts-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        .chart-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(127, 176, 105, 0.2);
            position: relative;
            overflow: hidden;
        }

        .chart-card h3 {
            color: #7fb069;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .chart-container {
            position: relative;
            height: 300px;
            z-index: 2;
        }

        .insights-section {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(127, 176, 105, 0.2);
            position: relative;
            overflow: hidden;
        }

        .insights-section h3 {
            color: #7fb069;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .insight-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            z-index: 2;
        }

        .insight-item:last-child {
            border-bottom: none;
        }

        .insight-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
            margin-right: 15px;
        }

        .insight-text {
            flex: 1;
        }

        .insight-text h4 {
            color: white;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .insight-text p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .charts-section {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('user.dashboard') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Dashboard
        </a>

        <div class="page-header">
            <h1><i class="fas fa-chart-line"></i> Business Analytics</h1>
            <p>Track your business performance and growth metrics</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="stat-value">12,543</div>
                <div class="stat-label">Total Views</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> +15.3% from last month
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value">1,247</div>
                <div class="stat-label">Followers</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> +8.7% from last month
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="stat-value">3,892</div>
                <div class="stat-label">Engagement</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> +23.1% from last month
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-share"></i>
                </div>
                <div class="stat-value">567</div>
                <div class="stat-label">Shares</div>
                <div class="stat-change negative">
                    <i class="fas fa-arrow-down"></i> -2.4% from last month
                </div>
            </div>
        </div>

        <div class="charts-section">
            <div class="chart-card">
                <h3>Performance Overview</h3>
                <div class="chart-container">
                    <canvas id="performanceChart"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <h3>Audience Demographics</h3>
                <div class="chart-container">
                    <canvas id="demographicsChart"></canvas>
                </div>
            </div>
        </div>

        <div class="insights-section">
            <h3>Key Insights</h3>
            
            <div class="insight-item">
                <div class="insight-icon">
                    <i class="fas fa-trending-up"></i>
                </div>
                <div class="insight-text">
                    <h4>Peak Engagement Time</h4>
                    <p>Your audience is most active between 2-4 PM on weekdays</p>
                </div>
            </div>

            <div class="insight-item">
                <div class="insight-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="insight-text">
                    <h4>Top Performing Content</h4>
                    <p>Business tips and industry insights generate 40% more engagement</p>
                </div>
            </div>

            <div class="insight-item">
                <div class="insight-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="insight-text">
                    <h4>Audience Growth</h4>
                    <p>Steady growth with 25-34 age group being your primary audience</p>
                </div>
            </div>

            <div class="insight-item">
                <div class="insight-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <div class="insight-text">
                    <h4>Device Usage</h4>
                    <p>78% of your audience accesses content via mobile devices</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Performance Chart
        const performanceCtx = document.getElementById('performanceChart').getContext('2d');
        new Chart(performanceCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Views',
                    data: [8500, 9200, 10100, 11300, 12000, 12543],
                    borderColor: '#7fb069',
                    backgroundColor: 'rgba(127, 176, 105, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Engagement',
                    data: [2100, 2400, 2800, 3200, 3600, 3892],
                    borderColor: '#5a8a4a',
                    backgroundColor: 'rgba(90, 138, 74, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: 'white'
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.7)'
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    },
                    y: {
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.7)'
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    }
                }
            }
        });

        // Demographics Chart
        const demographicsCtx = document.getElementById('demographicsChart').getContext('2d');
        new Chart(demographicsCtx, {
            type: 'doughnut',
            data: {
                labels: ['25-34', '35-44', '18-24', '45-54', '55+'],
                datasets: [{
                    data: [35, 28, 20, 12, 5],
                    backgroundColor: [
                        '#7fb069',
                        '#5a8a4a',
                        '#9bc97b',
                        '#4a7a3a',
                        '#3a6a2a'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: 'white',
                            padding: 20
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
