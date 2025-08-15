<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events - BizNest</title>
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

        .view-toggle {
            display: flex;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            padding: 5px;
        }

        .view-btn {
            padding: 10px 20px;
            border: none;
            background: transparent;
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .view-btn.active {
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            color: white;
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

        .calendar-view {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(127, 176, 105, 0.2);
            margin-bottom: 30px;
        }

        .calendar-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 30px;
        }

        .calendar-nav {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 10px 15px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .nav-btn:hover {
            background: rgba(127, 176, 105, 0.2);
            border-color: rgba(127, 176, 105, 0.4);
        }

        .current-month {
            font-size: 24px;
            font-weight: 700;
            color: #7fb069;
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .event-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 25px;
            border: 1px solid rgba(127, 176, 105, 0.2);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
            border-color: rgba(127, 176, 105, 0.4);
        }

        .event-card::before {
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

        .event-date {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .date-badge {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
        }

        .date-day {
            font-size: 20px;
            line-height: 1;
        }

        .date-month {
            font-size: 12px;
            text-transform: uppercase;
        }

        .event-time {
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            font-weight: 600;
        }

        .event-title {
            font-size: 20px;
            font-weight: 700;
            color: white;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
        }

        .event-description {
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .event-details {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
        }

        .detail-icon {
            width: 20px;
            height: 20px;
            background: rgba(127, 176, 105, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: #7fb069;
        }

        .event-actions {
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

        .event-type {
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

        .type-workshop {
            background: rgba(139, 92, 246, 0.2);
            color: #8b5cf6;
            border: 1px solid rgba(139, 92, 246, 0.3);
        }

        .type-networking {
            background: rgba(236, 72, 153, 0.2);
            color: #ec4899;
            border: 1px solid rgba(236, 72, 153, 0.3);
        }

        .type-conference {
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .type-webinar {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .upcoming-section {
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #7fb069, #5a8a4a);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        @media (max-width: 768px) {
            .events-grid {
                grid-template-columns: 1fr;
            }
            
            .header-actions {
                flex-direction: column;
                gap: 20px;
                align-items: stretch;
            }
            
            .calendar-nav {
                flex-direction: column;
                gap: 10px;
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
            <h1><i class="fas fa-calendar-alt"></i> Business Events</h1>
            <p>Manage your business events, workshops, and networking opportunities</p>
        </div>

        <div class="header-actions">
            <div class="view-toggle">
                <button class="view-btn active" onclick="switchView('list')">
                    <i class="fas fa-list"></i> List View
                </button>
                <button class="view-btn" onclick="switchView('calendar')">
                    <i class="fas fa-calendar"></i> Calendar View
                </button>
            </div>
            <button class="create-btn" onclick="createEvent()">
                <i class="fas fa-plus"></i>
                Create New Event
            </button>
        </div>

        <!-- Calendar View -->
        <div id="calendar-view" class="calendar-view" style="display: none;">
            <div class="calendar-header">
                <div class="calendar-nav">
                    <button class="nav-btn">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="current-month">July 2024</div>
                    <button class="nav-btn">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            <div style="text-align: center; padding: 40px; color: rgba(255, 255, 255, 0.7);">
                <i class="fas fa-calendar" style="font-size: 48px; margin-bottom: 20px; color: #7fb069;"></i>
                <p>Calendar view will be implemented here</p>
            </div>
        </div>

        <!-- List View -->
        <div id="list-view">
            <!-- Upcoming Events -->
            <div class="upcoming-section">
                <div class="section-title">
                    <div class="section-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    Upcoming Events
                </div>
                
                <div class="events-grid">
                    <div class="event-card">
                        <div class="event-type type-workshop">Workshop</div>
                        <div class="event-date">
                            <div class="date-badge">
                                <div class="date-day">25</div>
                                <div class="date-month">Jul</div>
                            </div>
                            <div class="event-time">
                                <i class="fas fa-clock"></i> 2:00 PM - 5:00 PM
                            </div>
                        </div>
                        <h3 class="event-title">Digital Marketing Mastery</h3>
                        <p class="event-description">
                            Comprehensive workshop covering social media marketing, content strategy, and analytics for business growth.
                        </p>
                        <div class="event-details">
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                Business Center, Downtown
                            </div>
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                45 Attendees
                            </div>
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                $75 per person
                            </div>
                        </div>
                        <div class="event-actions">
                            <button class="action-btn btn-primary">View Details</button>
                            <button class="action-btn btn-secondary">Edit Event</button>
                        </div>
                    </div>

                    <div class="event-card">
                        <div class="event-type type-networking">Networking</div>
                        <div class="event-date">
                            <div class="date-badge">
                                <div class="date-day">28</div>
                                <div class="date-month">Jul</div>
                            </div>
                            <div class="event-time">
                                <i class="fas fa-clock"></i> 6:00 PM - 9:00 PM
                            </div>
                        </div>
                        <h3 class="event-title">Business Networking Mixer</h3>
                        <p class="event-description">
                            Connect with local entrepreneurs and business leaders in a relaxed networking environment with refreshments.
                        </p>
                        <div class="event-details">
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                Rooftop Lounge, City Hotel
                            </div>
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                120 Attendees
                            </div>
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                Free Entry
                            </div>
                        </div>
                        <div class="event-actions">
                            <button class="action-btn btn-primary">View Details</button>
                            <button class="action-btn btn-secondary">Edit Event</button>
                        </div>
                    </div>

                    <div class="event-card">
                        <div class="event-type type-webinar">Webinar</div>
                        <div class="event-date">
                            <div class="date-badge">
                                <div class="date-day">02</div>
                                <div class="date-month">Aug</div>
                            </div>
                            <div class="event-time">
                                <i class="fas fa-clock"></i> 1:00 PM - 2:30 PM
                            </div>
                        </div>
                        <h3 class="event-title">Financial Planning for Startups</h3>
                        <p class="event-description">
                            Online webinar covering essential financial planning strategies, budgeting, and investment tips for new businesses.
                        </p>
                        <div class="event-details">
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-globe"></i>
                                </div>
                                Online Event
                            </div>
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                200+ Registered
                            </div>
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                $25 per person
                            </div>
                        </div>
                        <div class="event-actions">
                            <button class="action-btn btn-primary">View Details</button>
                            <button class="action-btn btn-secondary">Edit Event</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Past Events -->
            <div class="upcoming-section">
                <div class="section-title">
                    <div class="section-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    Past Events
                </div>
                
                <div class="events-grid">
                    <div class="event-card" style="opacity: 0.8;">
                        <div class="event-type type-conference">Conference</div>
                        <div class="event-date">
                            <div class="date-badge" style="background: rgba(255, 255, 255, 0.2);">
                                <div class="date-day">15</div>
                                <div class="date-month">Jun</div>
                            </div>
                            <div class="event-time">
                                <i class="fas fa-clock"></i> 9:00 AM - 6:00 PM
                            </div>
                        </div>
                        <h3 class="event-title">Tech Innovation Summit 2024</h3>
                        <p class="event-description">
                            Annual technology conference featuring keynote speakers, panel discussions, and networking opportunities.
                        </p>
                        <div class="event-details">
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                Convention Center
                            </div>
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                350 Attended
                            </div>
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                4.8/5 Rating
                            </div>
                        </div>
                        <div class="event-actions">
                            <button class="action-btn btn-secondary">View Report</button>
                            <button class="action-btn btn-secondary">Duplicate</button>
                        </div>
                    </div>

                    <div class="event-card" style="opacity: 0.8;">
                        <div class="event-type type-workshop">Workshop</div>
                        <div class="event-date">
                            <div class="date-badge" style="background: rgba(255, 255, 255, 0.2);">
                                <div class="date-day">08</div>
                                <div class="date-month">Jun</div>
                            </div>
                            <div class="event-time">
                                <i class="fas fa-clock"></i> 10:00 AM - 4:00 PM
                            </div>
                        </div>
                        <h3 class="event-title">Leadership Development Workshop</h3>
                        <p class="event-description">
                            Interactive workshop focused on developing leadership skills and team management strategies.
                        </p>
                        <div class="event-details">
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                Training Center
                            </div>
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                28 Attended
                            </div>
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                4.9/5 Rating
                            </div>
                        </div>
                        <div class="event-actions">
                            <button class="action-btn btn-secondary">View Report</button>
                            <button class="action-btn btn-secondary">Duplicate</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchView(view) {
            const listView = document.getElementById('list-view');
            const calendarView = document.getElementById('calendar-view');
            const viewBtns = document.querySelectorAll('.view-btn');
            
            // Remove active class from all buttons
            viewBtns.forEach(btn => btn.classList.remove('active'));
            
            if (view === 'calendar') {
                listView.style.display = 'none';
                calendarView.style.display = 'block';
                event.target.classList.add('active');
            } else {
                listView.style.display = 'block';
                calendarView.style.display = 'none';
                event.target.classList.add('active');
            }
        }

        function createEvent() {
            alert('Create New Event functionality will be implemented here');
        }
    </script>
</body>
</html>
