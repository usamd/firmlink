<!DOCTYPE html>
<html lang="en">
<head>
	<title>BizNest - Professional Business Listings</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Discover and connect with businesses in Sri Lanka. Professional business listings platform.">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('Land Page/LandPage.css') }}">
</head>
<body>
	<!-- Navigation -->
	<nav class="navbar">
		<div class="nav-container">
			<div class="nav-logo">
				<img src="{{ asset('assest/Biz.png') }}" alt="BizNest Logo" class="logo">
				<span class="logo-text">BizNest</span>
			</div>
			
			<div class="nav-menu">
				<a href="#home" class="nav-link active">Home</a>
				<a href="#categories" class="nav-link">Categories</a>
				<a href="#trending" class="nav-link">Trending</a>
				<a href="#about" class="nav-link">About Us</a>
			</div>

			<div class="nav-buttons">
				<a href="{{ route('login') }}" class="btn-secondary">Sign In</a>
				<a href="{{ route('register_user') }}" class="btn-primary">Sign Up</a>
			</div>
		</div>
	</nav>

	<!-- Hero Section -->
	<section class="hero" id="home">
		<div class="hero-container">
			<div class="hero-content">
				<div class="hero-text">
					<h1 class="hero-title">
						<span class="gradient-text">Discover</span> & <span class="gradient-text">Connect</span><br>
						with Sri Lanka's Best Businesses
					</h1>
					<p class="hero-subtitle">
						Find trusted businesses, explore services, and grow your network in Sri Lanka's premier business directory.
					</p>
					
					<!-- Search Form -->
					<div class="search-container">
						<form class="search-form" action="search" method="get">
							<div class="search-input-group">
								<i class="fas fa-search search-icon"></i>
								<input type="text" placeholder="Search businesses, services..." name="search" class="search-input">
							</div>
							<div class="location-select">
								<i class="fas fa-map-marker-alt location-icon"></i>
								<select name="location" class="location-dropdown">
									<option value="all">All Locations</option>
									<option value="colombo">Colombo</option>
									<option value="kandy">Kandy</option>
									<option value="galle">Galle</option>
									<option value="jaffna">Jaffna</option>
									<option value="polonnaruwa">Polonnaruwa</option>
									<option value="ratnapura">Ratnapura</option>
								</select>
							</div>
							<button type="submit" class="search-btn">
								<i class="fas fa-search"></i>
								Search
							</button>
						</form>
					</div>
				</div>
				
				<div class="hero-image">
					<div class="image-container mirror-effect">
						<img src="{{ asset('assest/IMG-20240607-WA0014 .jpg') }}" alt="Business professionals" class="hero-img">
						<div class="mirror-reflection"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Stats Section -->
	<section class="stats-section">
		<div class="stats-container">
			<div class="stat-card mirror-card">
				<div class="stat-icon">
					<i class="fas fa-building"></i>
				</div>
				<div class="stat-number">25,000+</div>
				<div class="stat-label">Registered Businesses</div>
			</div>
			
			<div class="stat-card mirror-card">
				<div class="stat-icon">
					<i class="fas fa-users"></i>
				</div>
				<div class="stat-number">150,000+</div>
				<div class="stat-label">Active Users</div>
			</div>
			
			<div class="stat-card mirror-card">
				<div class="stat-icon">
					<i class="fas fa-map-marker-alt"></i>
				</div>
				<div class="stat-number">25</div>
				<div class="stat-label">Districts Covered</div>
			</div>
			
			<div class="stat-card mirror-card">
				<div class="stat-icon">
					<i class="fas fa-star"></i>
				</div>
				<div class="stat-number">50,000+</div>
				<div class="stat-label">Reviews & Ratings</div>
			</div>
		</div>
	</section>

	<!-- Business Categories -->
	<section class="categories-section" id="categories">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title">Popular Business Categories</h2>
				<p class="section-subtitle">Explore businesses by category</p>
			</div>
			
			<div class="categories-grid">
				<div class="category-card mirror-card">
					<div class="category-icon">
						<i class="fas fa-utensils"></i>
					</div>
					<h3>Restaurants & Food</h3>
					<p>2,500+ businesses</p>
				</div>
				
				<div class="category-card mirror-card">
					<div class="category-icon">
						<i class="fas fa-shopping-bag"></i>
					</div>
					<h3>Retail & Shopping</h3>
					<p>3,200+ businesses</p>
				</div>
				
				<div class="category-card mirror-card">
					<div class="category-icon">
						<i class="fas fa-heartbeat"></i>
					</div>
					<h3>Healthcare</h3>
					<p>1,800+ businesses</p>
				</div>
				
				<div class="category-card mirror-card">
					<div class="category-icon">
						<i class="fas fa-graduation-cap"></i>
					</div>
					<h3>Education</h3>
					<p>1,200+ businesses</p>
				</div>
				
				<div class="category-card mirror-card">
					<div class="category-icon">
						<i class="fas fa-tools"></i>
					</div>
					<h3>Services</h3>
					<p>4,100+ businesses</p>
				</div>
				
				<div class="category-card mirror-card">
					<div class="category-icon">
						<i class="fas fa-car"></i>
					</div>
					<h3>Automotive</h3>
					<p>900+ businesses</p>
				</div>
			</div>
		</div>
	</section>

	<!-- Featured Businesses -->
	<section class="featured-section" id="trending">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title">Featured Businesses</h2>
				<p class="section-subtitle">Discover top-rated businesses in your area</p>
			</div>
			
			<div class="featured-grid">
				<div class="featured-card mirror-card">
					<div class="featured-image">
						<img src="{{ asset('Land Page/j1.jpg') }}" alt="Featured Business 1">
						<div class="featured-badge">Premium</div>
					</div>
					<div class="featured-content">
						<h3>Elite Restaurant</h3>
						<p class="featured-category">Restaurant & Food</p>
						<div class="featured-rating">
							<i class="fas fa-star"></i>
							<span>4.8 (250 reviews)</span>
						</div>
						<p class="featured-location">Colombo, Sri Lanka</p>
					</div>
				</div>
				
				<div class="featured-card mirror-card">
					<div class="featured-image">
						<img src="{{ asset('Land Page/j2.jpg') }}" alt="Featured Business 2">
						<div class="featured-badge">Trending</div>
					</div>
					<div class="featured-content">
						<h3>Tech Solutions Hub</h3>
						<p class="featured-category">Technology Services</p>
						<div class="featured-rating">
							<i class="fas fa-star"></i>
							<span>4.9 (180 reviews)</span>
						</div>
						<p class="featured-location">Kandy, Sri Lanka</p>
					</div>
				</div>
			</div>
			
			<div class="browse-all">
				<button class="btn-outline">Browse All Businesses</button>
			</div>
		</div>
	</section>

	<!-- Business Advertisements Section -->
	<section class="business-ads-section">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title">Featured Business Advertisements</h2>
				<p class="section-subtitle">Discover amazing offers from our registered businesses</p>
			</div>
			
			<div class="ads-grid">
				<div class="ad-card mirror-card">
					<div class="ad-image">
						<img src="{{ asset('Land Page/IMG-20240607-WA0015.jpg') }}" alt="Business Advertisement">
						<div class="ad-overlay">
							<div class="ad-badge">Special Offer</div>
						</div>
					</div>
					<div class="ad-content">
						<h3>Grand Opening Sale</h3>
						<p class="ad-business">Premium Electronics Store</p>
						<p class="ad-description">Get up to 50% off on all electronics. Limited time offer for grand opening celebration.</p>
						<div class="ad-details">
							<span class="ad-location"><i class="fas fa-map-marker-alt"></i> Colombo</span>
							<span class="ad-expires"><i class="fas fa-clock"></i> Expires in 5 days</span>
						</div>
						<button class="ad-cta-btn">View Offer</button>
					</div>
				</div>
				
				<div class="ad-card mirror-card">
					<div class="ad-image">
						<img src="{{ asset('Land Page/j1.jpg') }}" alt="Restaurant Advertisement">
						<div class="ad-overlay">
							<div class="ad-badge">New Menu</div>
						</div>
					</div>
					<div class="ad-content">
						<h3>Authentic Sri Lankan Cuisine</h3>
						<p class="ad-business">Spice Garden Restaurant</p>
						<p class="ad-description">Experience traditional flavors with our new authentic Sri Lankan menu. Book your table now!</p>
						<div class="ad-details">
							<span class="ad-location"><i class="fas fa-map-marker-alt"></i> Kandy</span>
							<span class="ad-rating"><i class="fas fa-star"></i> 4.7 (120 reviews)</span>
						</div>
						<button class="ad-cta-btn">Book Table</button>
					</div>
				</div>
				
				<div class="ad-card mirror-card">
					<div class="ad-image">
						<img src="{{ asset('Land Page/j2.jpg') }}" alt="Service Advertisement">
						<div class="ad-overlay">
							<div class="ad-badge">Premium Service</div>
						</div>
					</div>
					<div class="ad-content">
						<h3>Professional Web Development</h3>
						<p class="ad-business">Digital Solutions Lanka</p>
						<p class="ad-description">Transform your business with our cutting-edge web development and digital marketing services.</p>
						<div class="ad-details">
							<span class="ad-location"><i class="fas fa-map-marker-alt"></i> Galle</span>
							<span class="ad-price"><i class="fas fa-tag"></i> Starting from LKR 25,000</span>
						</div>
						<button class="ad-cta-btn">Get Quote</button>
					</div>
				</div>
			</div>
			
			<div class="ads-carousel">
				<div class="swiper ads-slider">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<div class="banner-ad mirror-card">
								<div class="banner-content">
									<h3>Join BizNest Today!</h3>
									<p>List your business and reach thousands of potential customers</p>
									<button class="banner-btn">Register Your Business</button>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="banner-ad mirror-card">
								<div class="banner-content">
									<h3>Advertise with Us</h3>
									<p>Promote your business to our growing community of users</p>
									<button class="banner-btn">Start Advertising</button>
								</div>
							</div>
						</div>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			</div>
		</div>
	</section>

	<!-- Customer Testimonials -->
	<section class="testimonials-section" id="about">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title">What Our Users Say</h2>
				<p class="section-subtitle">Real experiences from our business community</p>
			</div>
			
			<div class="swiper testimonials-slider">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<div class="testimonial-card mirror-card">
							<div class="testimonial-content">
								<div class="quote-icon">
									<i class="fas fa-quote-left"></i>
								</div>
								<p>"BizNest has transformed how I discover local businesses. The platform is intuitive and the business listings are comprehensive. I've found amazing restaurants and services through this platform."</p>
								<div class="testimonial-rating">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
								</div>
							</div>
							<div class="testimonial-author">
								<img src="{{ asset('Land Page/c1.jpg') }}" alt="Customer">
								<div class="author-info">
									<h4>Priya Sharma</h4>
									<span>Marketing Professional</span>
								</div>
							</div>
						</div>
					</div>
					
					<div class="swiper-slide">
						<div class="testimonial-card mirror-card">
							<div class="testimonial-content">
								<div class="quote-icon">
									<i class="fas fa-quote-left"></i>
								</div>
								<p>"As a business owner, listing my restaurant on BizNest was the best decision. I've seen a 40% increase in customers and the review system helps build trust with potential clients."</p>
								<div class="testimonial-rating">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
								</div>
							</div>
							<div class="testimonial-author">
								<img src="{{ asset('Land Page/c2.jpg') }}" alt="Business Owner">
								<div class="author-info">
									<h4>Rajesh Fernando</h4>
									<span>Restaurant Owner</span>
								</div>
							</div>
						</div>
					</div>
					
					<div class="swiper-slide">
						<div class="testimonial-card mirror-card">
							<div class="testimonial-content">
								<div class="quote-icon">
									<i class="fas fa-quote-left"></i>
								</div>
								<p>"The search functionality is excellent and the business profiles are detailed. I can easily find contact information, reviews, and even special offers. Highly recommended!"</p>
								<div class="testimonial-rating">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
								</div>
							</div>
							<div class="testimonial-author">
								<img src="{{ asset('Land Page/c3.jpg') }}" alt="User">
								<div class="author-info">
									<h4>Amara Silva</h4>
									<span>Freelance Designer</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="swiper-pagination"></div>
			</div>
		</div>
	</section>

	<!-- Footer -->
	<footer class="footer">
		<div class="container">
			<div class="footer-content">
				<div class="footer-section">
					<div class="footer-logo">
						<img src="{{ asset('assest/Biz.png') }}" alt="BizNest Logo">
						<span>BizNest</span>
					</div>
					<p>Sri Lanka's premier business directory connecting customers with trusted local businesses.</p>
					<div class="social-links">
						<a href="#"><i class="fab fa-facebook"></i></a>
						<a href="#"><i class="fab fa-twitter"></i></a>
						<a href="#"><i class="fab fa-instagram"></i></a>
						<a href="#"><i class="fab fa-linkedin"></i></a>
					</div>
				</div>
				
				<div class="footer-section">
					<h3>For Businesses</h3>
					<ul>
						<li><a href="#">List Your Business</a></li>
						<li><a href="#">Advertise with Us</a></li>
						<li><a href="#">Business Dashboard</a></li>
						<li><a href="#">Pricing Plans</a></li>
					</ul>
				</div>
				
				<div class="footer-section">
					<h3>For Users</h3>
					<ul>
						<li><a href="#">Browse Businesses</a></li>
						<li><a href="#">Write Reviews</a></li>
						<li><a href="#">Mobile App</a></li>
						<li><a href="#">Help Center</a></li>
					</ul>
				</div>
				
				<div class="footer-section">
					<h3>Contact Info</h3>
					<div class="contact-info">
						<p><i class="fas fa-map-marker-alt"></i> 123 Business Street, Colombo 03, Sri Lanka</p>
						<p><i class="fas fa-phone"></i> +94 11 234 5678</p>
						<p><i class="fas fa-envelope"></i> info@biznest.lk</p>
					</div>
				</div>
			</div>
			
			<div class="footer-bottom">
				<div class="footer-bottom-content">
					<p>&copy; 2024 BizNest. All rights reserved.</p>
					<div class="footer-links">
						<a href="#">Privacy Policy</a>
						<a href="#">Terms of Service</a>
						<a href="#">Cookie Policy</a>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<!-- JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
	<script>
		// Initialize Testimonials Slider
		const testimonialsSwiper = new Swiper('.testimonials-slider', {
			slidesPerView: 1,
			spaceBetween: 30,
			loop: true,
			autoplay: {
				delay: 5000,
				disableOnInteraction: false,
			},
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
			breakpoints: {
				768: {
					slidesPerView: 2,
				},
				1024: {
					slidesPerView: 3,
				}
			}
		});

		// Initialize Ads Slider
		const adsSwiper = new Swiper('.ads-slider', {
			slidesPerView: 1,
			spaceBetween: 20,
			loop: true,
			autoplay: {
				delay: 4000,
				disableOnInteraction: false,
			},
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			}
		});

		// Smooth scrolling for navigation links
		document.querySelectorAll('.nav-link').forEach(link => {
			link.addEventListener('click', function(e) {
				e.preventDefault();
				const targetId = this.getAttribute('href');
				const targetSection = document.querySelector(targetId);
				if (targetSection) {
					targetSection.scrollIntoView({
						behavior: 'smooth',
						block: 'start'
					});
				}
			});
		});

		// Add active class to navigation links on scroll
		window.addEventListener('scroll', function() {
			const sections = document.querySelectorAll('section[id]');
			const navLinks = document.querySelectorAll('.nav-link');
			
			let current = '';
			sections.forEach(section => {
				const sectionTop = section.offsetTop;
				const sectionHeight = section.clientHeight;
				if (pageYOffset >= sectionTop - 200) {
					current = section.getAttribute('id');
				}
			});

			navLinks.forEach(link => {
				link.classList.remove('active');
				if (link.getAttribute('href') === '#' + current) {
					link.classList.add('active');
				}
			});
		});

		// Add animation to stats numbers
		const animateNumbers = () => {
			const numbers = document.querySelectorAll('.stat-number');
			numbers.forEach(number => {
				const target = parseInt(number.textContent.replace(/[^0-9]/g, ''));
				let current = 0;
				const increment = target / 100;
				const timer = setInterval(() => {
					current += increment;
					if (current >= target) {
						current = target;
						clearInterval(timer);
					}
					number.textContent = Math.floor(current).toLocaleString() + '+';
				}, 20);
			});
		};

		// Trigger number animation when stats section is visible
		const statsSection = document.querySelector('.stats-section');
		const observer = new IntersectionObserver((entries) => {
			entries.forEach(entry => {
				if (entry.isIntersecting) {
					animateNumbers();
					observer.unobserve(entry.target);
				}
			});
		});

		if (statsSection) {
			observer.observe(statsSection);
		}
	</script>
</body>
</html>
