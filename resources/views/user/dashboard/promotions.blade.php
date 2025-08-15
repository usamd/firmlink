<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promotions - BizNest</title>
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

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .create-btn {
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            color: white;
            padding: 15px 30px;
            border-radius: 15px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .create-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(127, 176, 105, 0.3);
        }

        .promotions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .promotion-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 25px;
            border: 1px solid rgba(127, 176, 105, 0.2);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .promotion-card:hover {
            transform: translateY(-5px);
            border-color: rgba(127, 176, 105, 0.4);
        }

        .promotion-card::before {
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

        .promotion-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .promotion-type {
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .promotion-status {
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-active {
            background: rgba(74, 222, 128, 0.2);
            color: #4ade80;
            border: 1px solid rgba(74, 222, 128, 0.3);
        }

        .status-draft {
            background: rgba(251, 191, 36, 0.2);
            color: #fbbf24;
            border: 1px solid rgba(251, 191, 36, 0.3);
        }

        .status-ended {
            background: rgba(248, 113, 113, 0.2);
            color: #f87171;
            border: 1px solid rgba(248, 113, 113, 0.3);
        }

        .promotion-title {
            font-size: 20px;
            font-weight: 700;
            color: white;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
        }

        .promotion-description {
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .promotion-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 18px;
            font-weight: 700;
            color: #7fb069;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.6);
            text-transform: uppercase;
        }

        .promotion-actions {
            display: flex;
            gap: 10px;
            position: relative;
            z-index: 2;
        }

        .action-btn {
            flex: 1;
            padding: 10px 15px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            font-size: 14px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            color: white;
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .action-btn:hover {
            transform: translateY(-2px);
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(20px);
            border-radius: 20px;
            border: 1px solid rgba(127, 176, 105, 0.2);
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: white;
            margin: 0 auto 20px;
        }

        .empty-title {
            font-size: 24px;
            font-weight: 700;
            color: white;
            margin-bottom: 10px;
        }

        .empty-description {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 30px;
        }

        .promotion-date {
            color: rgba(255, 255, 255, 0.6);
            font-size: 12px;
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
        }

        @media (max-width: 768px) {
            .promotions-grid {
                grid-template-columns: 1fr;
            }
            
            .header-actions {
                flex-direction: column;
                gap: 20px;
                align-items: stretch;
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
            <h1><i class="fas fa-bullhorn"></i> Promotions & Campaigns</h1>
            <p>Create and manage your marketing campaigns to boost business visibility</p>
        </div>

        <div class="header-actions">
            <h2 style="color: white; font-size: 24px; font-weight: 700;">Active Campaigns</h2>
            <button class="create-btn" onclick="createPromotion()">
                <i class="fas fa-plus"></i>
                Create New Campaign
            </button>
        </div>

        <div class="promotions-grid">
            <!-- Active Promotion -->
            <div class="promotion-card">
                <div class="promotion-header">
                    <div class="promotion-type">Social Media</div>
                    <div class="promotion-status status-active">Active</div>
                </div>
                <h3 class="promotion-title">Summer Business Boost</h3>
                <div class="promotion-date">
                    <i class="fas fa-calendar"></i> June 1 - August 31, 2024
                </div>
                <p class="promotion-description">
                    Promote your business services with special summer discounts and attract new customers during peak season.
                </p>
                <div class="promotion-stats">
                    <div class="stat-item">
                        <div class="stat-value">2,543</div>
                        <div class="stat-label">Impressions</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">187</div>
                        <div class="stat-label">Clicks</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">7.3%</div>
                        <div class="stat-label">CTR</div>
                    </div>
                </div>
                <div class="promotion-actions">
                    <button class="action-btn btn-primary">View Details</button>
                    <button class="action-btn btn-secondary">Edit</button>
                </div>
            </div>

            <!-- Draft Promotion -->
            <div class="promotion-card">
                <div class="promotion-header">
                    <div class="promotion-type">Email</div>
                    <div class="promotion-status status-draft">Draft</div>
                </div>
                <h3 class="promotion-title">New Product Launch</h3>
                <div class="promotion-date">
                    <i class="fas fa-calendar"></i> Scheduled for July 15, 2024
                </div>
                <p class="promotion-description">
                    Announce your latest product or service to your customer base with an engaging email campaign.
                </p>
                <div class="promotion-stats">
                    <div class="stat-item">
                        <div class="stat-value">0</div>
                        <div class="stat-label">Sent</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">1,250</div>
                        <div class="stat-label">Recipients</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">-</div>
                        <div class="stat-label">Open Rate</div>
                    </div>
                </div>
                <div class="promotion-actions">
                    <button class="action-btn btn-primary">Launch</button>
                    <button class="action-btn btn-secondary">Edit</button>
                </div>
            </div>

            <!-- Ended Promotion -->
            <div class="promotion-card">
                <div class="promotion-header">
                    <div class="promotion-type">Display Ads</div>
                    <div class="promotion-status status-ended">Ended</div>
                </div>
                <h3 class="promotion-title">Spring Sale Campaign</h3>
                <div class="promotion-date">
                    <i class="fas fa-calendar"></i> March 1 - May 31, 2024
                </div>
                <p class="promotion-description">
                    Successful spring promotion that increased brand awareness and drove significant traffic to your business.
                </p>
                <div class="promotion-stats">
                    <div class="stat-item">
                        <div class="stat-value">5,892</div>
                        <div class="stat-label">Impressions</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">423</div>
                        <div class="stat-label">Clicks</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">7.2%</div>
                        <div class="stat-label">CTR</div>
                    </div>
                </div>
                <div class="promotion-actions">
                    <button class="action-btn btn-secondary">View Report</button>
                    <button class="action-btn btn-secondary">Duplicate</button>
                </div>
            </div>

            <!-- Active Promotion 2 -->
            <div class="promotion-card">
                <div class="promotion-header">
                    <div class="promotion-type">Social Media</div>
                    <div class="promotion-status status-active">Active</div>
                </div>
                <h3 class="promotion-title">Customer Testimonials</h3>
                <div class="promotion-date">
                    <i class="fas fa-calendar"></i> June 15 - July 15, 2024
                </div>
                <p class="promotion-description">
                    Showcase positive customer reviews and testimonials to build trust and credibility with potential clients.
                </p>
                <div class="promotion-stats">
                    <div class="stat-item">
                        <div class="stat-value">1,876</div>
                        <div class="stat-label">Impressions</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">134</div>
                        <div class="stat-label">Clicks</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">7.1%</div>
                        <div class="stat-label">CTR</div>
                    </div>
                </div>
                <div class="promotion-actions">
                    <button class="action-btn btn-primary">View Details</button>
                    <button class="action-btn btn-secondary">Edit</button>
                </div>
            </div>
        </div>

        <!-- Campaign Templates Section -->
        <div style="margin-top: 50px;">
            <h2 style="color: white; font-size: 24px; font-weight: 700; margin-bottom: 20px;">Campaign Templates</h2>
            <div class="promotions-grid">
                <div class="promotion-card" style="border: 2px dashed rgba(127, 176, 105, 0.3);">
                    <div style="text-align: center; padding: 20px;">
                        <div class="empty-icon" style="margin: 0 auto 20px; width: 60px; height: 60px; font-size: 24px;">
                            <i class="fas fa-store"></i>
                        </div>
                        <h3 style="color: white; margin-bottom: 10px;">Business Showcase</h3>
                        <p style="color: rgba(255, 255, 255, 0.7); margin-bottom: 20px; font-size: 14px;">
                            Highlight your business services and unique value proposition
                        </p>
                        <button class="action-btn btn-primary" style="width: 100%;">Use Template</button>
                    </div>
                </div>

                <div class="promotion-card" style="border: 2px dashed rgba(127, 176, 105, 0.3);">
                    <div style="text-align: center; padding: 20px;">
                        <div class="empty-icon" style="margin: 0 auto 20px; width: 60px; height: 60px; font-size: 24px;">
                            <i class="fas fa-percentage"></i>
                        </div>
                        <h3 style="color: white; margin-bottom: 10px;">Special Offers</h3>
                        <p style="color: rgba(255, 255, 255, 0.7); margin-bottom: 20px; font-size: 14px;">
                            Create compelling discount and promotional campaigns
                        </p>
                        <button class="action-btn btn-primary" style="width: 100%;">Use Template</button>
                    </div>
                </div>

                <div class="promotion-card" style="border: 2px dashed rgba(127, 176, 105, 0.3);">
                    <div style="text-align: center; padding: 20px;">
                        <div class="empty-icon" style="margin: 0 auto 20px; width: 60px; height: 60px; font-size: 24px;">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h3 style="color: white; margin-bottom: 10px;">Event Promotion</h3>
                        <p style="color: rgba(255, 255, 255, 0.7); margin-bottom: 20px; font-size: 14px;">
                            Promote upcoming events and business activities
                        </p>
                        <button class="action-btn btn-primary" style="width: 100%;">Use Template</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function createPromotion() {
            alert('Create New Campaign functionality will be implemented here');
        }
    </script>
</body>
</html>
