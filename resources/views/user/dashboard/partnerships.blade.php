<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partnerships - BizNest</title>
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

        .tabs-container {
            margin-bottom: 30px;
        }

        .tabs {
            display: flex;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 5px;
            margin-bottom: 30px;
        }

        .tab {
            flex: 1;
            padding: 15px 20px;
            text-align: center;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.7);
        }

        .tab.active {
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            color: white;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .partnerships-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .partnership-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 25px;
            border: 1px solid rgba(127, 176, 105, 0.2);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .partnership-card:hover {
            transform: translateY(-5px);
            border-color: rgba(127, 176, 105, 0.4);
        }

        .partnership-card::before {
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

        .partner-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .partner-logo {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            margin-right: 15px;
            font-weight: 700;
        }

        .partner-info h3 {
            font-size: 20px;
            font-weight: 700;
            color: white;
            margin-bottom: 5px;
        }

        .partner-type {
            background: rgba(127, 176, 105, 0.2);
            color: #7fb069;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .partnership-description {
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .partnership-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .stat-item {
            text-align: center;
            padding: 15px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
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

        .partnership-actions {
            display: flex;
            gap: 10px;
            position: relative;
            z-index: 2;
        }

        .action-btn {
            flex: 1;
            padding: 12px 15px;
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

        .find-partners-section {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(127, 176, 105, 0.2);
            margin-bottom: 30px;
        }

        .find-partners-section h3 {
            color: #7fb069;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .search-filters {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .filter-group select,
        .filter-group input {
            padding: 12px 15px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 14px;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            outline: none;
            border-color: #7fb069;
        }

        .search-btn {
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            color: white;
            padding: 12px 30px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            transform: translateY(-2px);
        }

        .partnership-status {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            z-index: 2;
        }

        .status-active {
            background: rgba(74, 222, 128, 0.2);
            color: #4ade80;
            border: 1px solid rgba(74, 222, 128, 0.3);
        }

        .status-pending {
            background: rgba(251, 191, 36, 0.2);
            color: #fbbf24;
            border: 1px solid rgba(251, 191, 36, 0.3);
        }

        .status-proposal {
            background: rgba(139, 92, 246, 0.2);
            color: #8b5cf6;
            border: 1px solid rgba(139, 92, 246, 0.3);
        }

        @media (max-width: 768px) {
            .partnerships-grid {
                grid-template-columns: 1fr;
            }
            
            .tabs {
                flex-direction: column;
            }
            
            .search-filters {
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
            <h1><i class="fas fa-handshake"></i> Business Partnerships</h1>
            <p>Connect with other businesses and build strategic partnerships</p>
        </div>

        <div class="tabs-container">
            <div class="tabs">
                <div class="tab active" onclick="switchTab('current')">Current Partners</div>
                <div class="tab" onclick="switchTab('proposals')">Proposals</div>
                <div class="tab" onclick="switchTab('discover')">Discover Partners</div>
            </div>

            <!-- Current Partners Tab -->
            <div id="current" class="tab-content active">
                <div class="partnerships-grid">
                    <div class="partnership-card">
                        <div class="partnership-status status-active">Active</div>
                        <div class="partner-header">
                            <div class="partner-logo">TG</div>
                            <div class="partner-info">
                                <h3>TechGrow Solutions</h3>
                                <div class="partner-type">Technology</div>
                            </div>
                        </div>
                        <p class="partnership-description">
                            Strategic partnership for digital transformation services. Mutual referrals and joint marketing campaigns.
                        </p>
                        <div class="partnership-stats">
                            <div class="stat-item">
                                <div class="stat-value">24</div>
                                <div class="stat-label">Referrals</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">$12.5K</div>
                                <div class="stat-label">Revenue</div>
                            </div>
                        </div>
                        <div class="partnership-actions">
                            <button class="action-btn btn-primary">View Details</button>
                            <button class="action-btn btn-secondary">Message</button>
                        </div>
                    </div>

                    <div class="partnership-card">
                        <div class="partnership-status status-active">Active</div>
                        <div class="partner-header">
                            <div class="partner-logo">MS</div>
                            <div class="partner-info">
                                <h3>Marketing Sphere</h3>
                                <div class="partner-type">Marketing</div>
                            </div>
                        </div>
                        <p class="partnership-description">
                            Cross-promotional partnership for content marketing and social media campaigns.
                        </p>
                        <div class="partnership-stats">
                            <div class="stat-item">
                                <div class="stat-value">18</div>
                                <div class="stat-label">Campaigns</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">$8.2K</div>
                                <div class="stat-label">Revenue</div>
                            </div>
                        </div>
                        <div class="partnership-actions">
                            <button class="action-btn btn-primary">View Details</button>
                            <button class="action-btn btn-secondary">Message</button>
                        </div>
                    </div>

                    <div class="partnership-card">
                        <div class="partnership-status status-active">Active</div>
                        <div class="partner-header">
                            <div class="partner-logo">FS</div>
                            <div class="partner-info">
                                <h3>FinanceSync</h3>
                                <div class="partner-type">Finance</div>
                            </div>
                        </div>
                        <p class="partnership-description">
                            Partnership for financial consulting services and business advisory solutions.
                        </p>
                        <div class="partnership-stats">
                            <div class="stat-item">
                                <div class="stat-value">12</div>
                                <div class="stat-label">Referrals</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">$15.8K</div>
                                <div class="stat-label">Revenue</div>
                            </div>
                        </div>
                        <div class="partnership-actions">
                            <button class="action-btn btn-primary">View Details</button>
                            <button class="action-btn btn-secondary">Message</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Proposals Tab -->
            <div id="proposals" class="tab-content">
                <div class="partnerships-grid">
                    <div class="partnership-card">
                        <div class="partnership-status status-pending">Pending</div>
                        <div class="partner-header">
                            <div class="partner-logo">DC</div>
                            <div class="partner-info">
                                <h3>DesignCraft Studio</h3>
                                <div class="partner-type">Design</div>
                            </div>
                        </div>
                        <p class="partnership-description">
                            Proposed partnership for web design and branding services. Mutual client referrals and joint projects.
                        </p>
                        <div class="partnership-stats">
                            <div class="stat-item">
                                <div class="stat-value">Sent</div>
                                <div class="stat-label">Status</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">3 days</div>
                                <div class="stat-label">Ago</div>
                            </div>
                        </div>
                        <div class="partnership-actions">
                            <button class="action-btn btn-secondary">View Proposal</button>
                            <button class="action-btn btn-secondary">Follow Up</button>
                        </div>
                    </div>

                    <div class="partnership-card">
                        <div class="partnership-status status-proposal">Received</div>
                        <div class="partner-header">
                            <div class="partner-logo">LC</div>
                            <div class="partner-info">
                                <h3>LogiCorp</h3>
                                <div class="partner-type">Logistics</div>
                            </div>
                        </div>
                        <p class="partnership-description">
                            Partnership proposal for supply chain and logistics optimization services for mutual clients.
                        </p>
                        <div class="partnership-stats">
                            <div class="stat-item">
                                <div class="stat-value">Received</div>
                                <div class="stat-label">Status</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">1 day</div>
                                <div class="stat-label">Ago</div>
                            </div>
                        </div>
                        <div class="partnership-actions">
                            <button class="action-btn btn-primary">Accept</button>
                            <button class="action-btn btn-secondary">Decline</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Discover Partners Tab -->
            <div id="discover" class="tab-content">
                <div class="find-partners-section">
                    <h3>Find Strategic Partners</h3>
                    <div class="search-filters">
                        <div class="filter-group">
                            <label>Industry</label>
                            <select>
                                <option>All Industries</option>
                                <option>Technology</option>
                                <option>Marketing</option>
                                <option>Finance</option>
                                <option>Design</option>
                                <option>Consulting</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label>Business Size</label>
                            <select>
                                <option>All Sizes</option>
                                <option>Startup (1-10)</option>
                                <option>Small (11-50)</option>
                                <option>Medium (51-200)</option>
                                <option>Large (200+)</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label>Location</label>
                            <input type="text" placeholder="Enter city or region">
                        </div>
                        <div class="filter-group">
                            <label>Partnership Type</label>
                            <select>
                                <option>All Types</option>
                                <option>Referral Partner</option>
                                <option>Joint Venture</option>
                                <option>Strategic Alliance</option>
                                <option>Supplier Partner</option>
                            </select>
                        </div>
                    </div>
                    <button class="search-btn">
                        <i class="fas fa-search"></i> Search Partners
                    </button>
                </div>

                <div class="partnerships-grid">
                    <div class="partnership-card" style="border: 2px dashed rgba(127, 176, 105, 0.3);">
                        <div class="partner-header">
                            <div class="partner-logo">EC</div>
                            <div class="partner-info">
                                <h3>EcoClean Services</h3>
                                <div class="partner-type">Environmental</div>
                            </div>
                        </div>
                        <p class="partnership-description">
                            Eco-friendly cleaning services looking for business partnerships and referral opportunities.
                        </p>
                        <div class="partnership-stats">
                            <div class="stat-item">
                                <div class="stat-value">4.8★</div>
                                <div class="stat-label">Rating</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">150+</div>
                                <div class="stat-label">Clients</div>
                            </div>
                        </div>
                        <div class="partnership-actions">
                            <button class="action-btn btn-primary">Send Proposal</button>
                            <button class="action-btn btn-secondary">View Profile</button>
                        </div>
                    </div>

                    <div class="partnership-card" style="border: 2px dashed rgba(127, 176, 105, 0.3);">
                        <div class="partner-header">
                            <div class="partner-logo">DH</div>
                            <div class="partner-info">
                                <h3>Digital Hub</h3>
                                <div class="partner-type">Technology</div>
                            </div>
                        </div>
                        <p class="partnership-description">
                            Digital transformation consultancy seeking partnerships with complementary service providers.
                        </p>
                        <div class="partnership-stats">
                            <div class="stat-item">
                                <div class="stat-value">4.9★</div>
                                <div class="stat-label">Rating</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">200+</div>
                                <div class="stat-label">Projects</div>
                            </div>
                        </div>
                        <div class="partnership-actions">
                            <button class="action-btn btn-primary">Send Proposal</button>
                            <button class="action-btn btn-secondary">View Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            // Hide all tab contents
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Remove active class from all tabs
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => tab.classList.remove('active'));
            
            // Show selected tab content
            document.getElementById(tabName).classList.add('active');
            
            // Add active class to clicked tab
            event.target.classList.add('active');
        }
    </script>
</body>
</html>
