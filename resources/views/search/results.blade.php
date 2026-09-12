@extends('layouts.search')

@section('content')
<!-- Navigation -->
<nav class="navbar">
    <div class="nav-container">
        <div class="nav-logo">
            <img src="{{ asset('assest/Biz.png') }}" alt="BizNest Logo" class="logo">
            <span class="logo-text">BizNest</span>
        </div>
        
        <div class="nav-menu">
            <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="#categories" class="nav-link">Categories</a>
            <a href="#trending" class="nav-link">Trending</a>
            <a href="#about" class="nav-link">About Us</a>
        </div>

        <div class="nav-buttons">
            @guest
                <a href="{{ route('login') }}" class="btn-secondary">Sign In</a>
                <a href="{{ route('register_user') }}" class="btn-primary">Sign Up</a>
            @else
                <a href="{{ route('user.dashboard') }}" class="btn-primary">My Dashboard</a>
            @endguest
        </div>
    </div>
</nav>

<div class="search-results-page">
    <!-- Search Header -->
    <div class="search-header">
        <div class="container">
            <div class="search-bar-container">
                <form action="{{ route('search.businesses') }}" method="GET" class="search-form">
                    <div class="search-input-group">
                        <i class="fas fa-search search-icon"></i>
                        <select name="category" class="search-input" required>
                            <option value="">Select a category...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search-input-group">
                        <i class="fas fa-map-marker-alt location-icon"></i>
                        <input type="text" 
                               name="location" 
                               value="{{ request('location') }}" 
                               placeholder="City, district or address" 
                               class="search-input location-input"
                               list="locationSuggestions"
                               autocomplete="off"
                               required>
                        <datalist id="locationSuggestions">
                            @foreach($locations as $location)
                                <option value="{{ $location }}">
                            @endforeach
                        </datalist>
                    </div>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-search"></i>
                        Search
                    </button>
                </form>
                <button class="btn-secondary" id="toggle-advanced-search">
                    <i class="fas fa-sliders-h"></i> Advanced Search
                </button>
            </div>

            <!-- Advanced Search Panel -->
            <div class="advanced-search-panel" id="advanced-search-panel" style="display: none;">
                <h3 class="mb-4" style="color: #1e3932; font-size: 1.5rem; font-weight: 600;">Refine Your Search</h3>
                <form action="{{ route('search.businesses') }}" method="GET" class="advanced-search-form">
                    <input type="hidden" name="query" value="{{ request('query') }}">
                    <input type="hidden" name="location" value="{{ request('location') }}">
                    
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="rating">Minimum Rating</label>
                        <select name="rating" id="rating" class="form-control">
                            <option value="">Any Rating</option>
                            <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4+ Stars</option>
                            <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3+ Stars</option>
                            <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2+ Stars</option>
                            <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1+ Star</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="sort">Sort By</label>
                        <select name="sort" id="sort" class="form-control">
                            <option value="relevance" {{ request('sort') == 'relevance' ? 'selected' : '' }}>Relevance</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Features</label>
                        <div class="feature-options">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="feature1" name="features[]" value="wifi" {{ in_array('wifi', request('features', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="feature1">WiFi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="feature2" name="features[]" value="parking" {{ in_array('parking', request('features', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="feature2">Parking</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="feature3" name="features[]" value="delivery" {{ in_array('delivery', request('features', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="feature3">Delivery</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <a href="{{ route('search.businesses') }}?query={{ request('query') }}&location={{ request('location') }}" class="btn-secondary" style="text-decoration: none; text-align: center;">
                            Reset
                        </a>
                        <button type="submit" class="btn-primary">
                            Apply Filters
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Search Results -->
    <div class="search-results-section">
        <div class="container">
            <div class="row">
                <!-- Results Count -->
                <div class="col-12">
                    <div class="results-count mb-4">
                        <h4>
                            {{ $businesses->total() }} results found 
                            @if(!empty($query))
                                for "{{ $query }}"
                                @if($businesses->isNotEmpty() && !empty($businesses->first()->district))
                                    in "{{ $businesses->first()->district }}"
                                @elseif(!empty($location))
                                    <!-- in "{{ $location }}" -->
                                @endif
                            @elseif($businesses->isNotEmpty() && !empty($businesses->first()->district))
                                in "{{ $businesses->first()->district }}"
                            @elseif(!empty($location))
                                <!-- in "{{ $location }}" -->
                            @endif
                        </h4>
                    </div>
                    @if(count(request()->except(['query', 'location', 'page'])) > 0)
                        <div class="applied-filters">
                            @foreach(request()->except(['query', 'location', 'page']) as $key => $value)
                                @if(is_array($value))
                                    @foreach($value as $item)
                                                {{ ucfirst($key) }}: {{ ucfirst($item) }}
                                                <a href="{{ request()->fullUrlWithQuery([$key => array_diff(request($key, []), [$item])]) }}" class="ml-1">&times;</a>
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="badge badge-light">
                                            {{ ucfirst($key) }}: {{ ucfirst($value) }}
                                            <a href="{{ request()->fullUrlWithQuery([$key => '']) }}" class="ml-1">&times;</a>
                                        </span>
                                    @endif
                                @endforeach
                                <a href="{{ route('search.businesses') }}?query={{ request('query') }}&location={{ request('location') }}" class="clear-all">Clear all</a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Results List -->
                <div class="col-lg-8">
                    @if($businesses->count() > 0)
                        @foreach($businesses as $business)
                            <div class="business-card">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="business-image">
                                            <img src="{{ $business->logo ? asset('storage/'.$business->logo) : asset('images/default-business.jpg') }}" alt="{{ $business->business_name }}" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="business-details">
                                            <div class="d-flex justify-content-between">
                                                <h3>{{ $business->business_name }}</h3>
                                                @if($business->reviews_count > 0)
                                                    <div class="rating">
                                                        @php
                                                            $avgRating = $business->reviews_avg_rating ?? 0;
                                                            $fullStars = floor($avgRating);
                                                            $hasHalfStar = $avgRating - $fullStars >= 0.5;
                                                        @endphp
                                                        
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $fullStars)
                                                                <i class="fas fa-star text-warning"></i>
                                                            @elseif($i == $fullStars + 1 && $hasHalfStar)
                                                                <i class="fas fa-star-half-alt text-warning"></i>
                                                            @else
                                                                <i class="far fa-star text-muted"></i>
                                                            @endif
                                                        @endfor
                                                        <span>({{ $business->reviews_count }} {{ Str::plural('review', $business->reviews_count) }})</span>
                                                    </div>
                                                @else
                                                    <div class="text-muted">No reviews yet</div>
                                                @endif
                                            </div>
                                            
                                            <!-- Debug: Business Data -->
                                            <div class="debug-info" style="display: none;">
                                                <pre>{{ print_r($business->toArray(), true) }}</pre>
                                            </div>
                                            
                                            <!-- Category Display -->
                                            <div class="business-category {{ empty($business->category_name) ? 'text-muted' : '' }}">
                                                <i class="fas fa-tag"></i> {{ $business->category_name ?? 'No category' }}
                                            </div>
                                            
                                            <div class="business-location">
                                                <i class="fas fa-map-marker-alt"></i> {{ $business->business_address }}, {{ $business->district }}
                                            </div>
                                            
                                            <div class="business-description">
                                                {{ Str::limit($business->description, 200) }}
                                            </div>
                                            
                                            <div class="business-features mt-2">
                                                @php
                                                    $features = [];
                                                    if ($business->has_wifi) $features[] = 'WiFi';
                                                    if ($business->has_parking) $features[] = 'Parking';
                                                    if ($business->has_delivery) $features[] = 'Delivery';
                                                    if ($business->has_outdoor_seating) $features[] = 'Outdoor Seating';
                                                    if ($business->takes_reservations) $features[] = 'Reservations';
                                                    if ($business->credit_cards_accepted) $features[] = 'Credit Cards';
                                                @endphp
                                                
                                                @foreach($features as $feature)
                                                    <span class="badge badge-light mr-2 mb-2">
                                                        @switch($feature)
                                                            @case('WiFi')
                                                                <i class="fas fa-wifi"></i>
                                                                @break
                                                            @case('Parking')
                                                                <i class="fas fa-parking"></i>
                                                                @break
                                                            @case('Delivery')
                                                                <i class="fas fa-truck"></i>
                                                                @break
                                                            @case('Outdoor Seating')
                                                                <i class="fas fa-umbrella-beach"></i>
                                                                @break
                                                            @case('Reservations')
                                                                <i class="fas fa-calendar-check"></i>
                                                                @break
                                                            @case('Credit Cards')
                                                                <i class="far fa-credit-card"></i>
                                                                @break
                                                        @endswitch
                                                        {{ $feature }}
                                                    </span>
                                                @endforeach
                                            </div>
                                            
                                            <div class="mt-3 d-flex">
                                                <a href="{{ route('business.show', $business->businesses_id) }}" class="btn btn-outline-primary btn-sm mr-2">
                                                    <i class="fas fa-eye"></i> View Details
                                                </a>
                                                @auth
                                                    @if(auth()->user()->hasRole('customer'))
                                                        <button class="btn btn-outline-danger btn-sm mr-2 save-business" data-business-id="{{ $business->id }}">
                                                            <i class="far fa-heart"></i> Save
                                                        </button>
                                                    @endif
                                                @else
                                                    <button class="btn btn-outline-secondary btn-sm mr-2" data-toggle="modal" data-target="#loginModal">
                                                        <i class="far fa-heart"></i> Save
                                                    </button>
                                                @endauth
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="shareDropdown{{ $business->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-share-alt"></i> Share
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="shareDropdown{{ $business->id }}">
                                                        <a class="dropdown-item" href="#" onclick="shareOnSocial('facebook', '{{ route('business.show', $business->businesses_id) }}')">
                                                            <i class="fab fa-facebook-f mr-2"></i> Facebook
                                                        </a>
                                                        <a class="dropdown-item" href="#" onclick="shareOnSocial('twitter', '{{ route('business.show', $business->businesses_id) }}')">
                                                            <i class="fab fa-twitter mr-2"></i> Twitter
                                                        </a>
                                                        <a class="dropdown-item" href="#" onclick="shareOnSocial('linkedin', '{{ route('business.show', $business->businesses_id) }}')">
                                                            <i class="fab fa-linkedin-in mr-2"></i> LinkedIn
                                                        </a>
                                                        <a class="dropdown-item" href="#" onclick="copyToClipboard('{{ route('business.show', $business->businesses_id) }}')">
                                                            <i class="fas fa-link mr-2"></i> Copy Link
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $businesses->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="no-results text-center py-5">
                            <i class="fas fa-search fa-3x mb-3" style="color: #6c757d;"></i>
                            <h4>No businesses found</h4>
                            <p class="text-muted">Try adjusting your search or filter to find what you're looking for.</p>
                            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Back to Home</a>
                        </div>
                    @endif
                </div>
                
                <!-- Map and Search Summary Row -->
                <div class="row mt-4">
                    <!-- Map View (Left Side) -->
                    <div class="col-lg-8">
                        <div class="card h-100">
                            <div class="card text-white mb-0" style="background-color:rgb(37, 75, 65);">
                                <h5 class="mb-2 mt-2">Map View</h5>
                            </div>
                            <div class="card-body p-0">
                                <div id="map" style="height: 600px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Search Summary (Right Side) -->
                    <div class="col-lg-4">
                        <div class="card h-100">
                            <div class="card text-white mb-0" style="background-color:rgb(37, 75, 65);">
                                <h5 class="mb-2 mt-2">Search Summary</h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-2"><strong>Location:</strong> {{ $location }}</p>
                                @if(request('category'))
                                    @php
                                        $categoryId = request('category');
                                        $category = $categories->firstWhere('id', $categoryId);
                                    @endphp
                                    <p class="mb-2"><strong>Category:</strong> {{ $category ? $category->name : 'All Categories' }}</p>
                                @endif
                                @if(request('min_rating'))
                                    <p class="mb-2">
                                        <strong>Minimum Rating:</strong> 
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= request('min_rating'))
                                                <i class="fas fa-star text-warning"></i>
                                            @else
                                                <i class="far fa-star text-muted"></i>
                                            @endif
                                        @endfor
                                        +
                                    </p>
                                @endif
                                @if(count(request('features', [])) > 0)
                                    <p class="mb-0">
                                        <strong>Features:</strong> 
                                        {{ implode(', ', array_map('ucfirst', request('features', []))) }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
</br>
                </div>
            </div>
        </div>
    </div>

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
</div>


<style>
    /* ===== Base Styles ===== */
    :root {
        --primary-color: #1a5d4a;
        --primary-dark: #0f4c3a;
        --text-color: #1a2e1a;
        --white: #ffffff;
        --transition: all 0.3s ease;
    }

    /* ===== Navigation Styles ===== */
    .navbar {
        background-color: white;
        padding: 1rem 0;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .back-to-home {
        position: fixed;
        top: 20px;
        left: 20px;
        color: white;
        text-decoration: none;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        background: #1e3932;
        padding: 10px 15px;
        border-radius: 25px;
        z-index: 1001;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .back-to-home:hover {
        background: #2c5530;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    }
    
    .nav-container {
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
        position: relative;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    @media (max-width: 1200px) {
        .nav-container {
            padding: 0.75rem 1rem;
        }
        
        .nav-search {
            order: 1;
            flex: 1 1 100%;
            margin: 0.5rem 0;
            max-width: 100%;
        }
        
        .nav-menu {
            margin: 0.5rem 0;
            width: 100%;
            justify-content: center;
            order: 2;
        }
        
        .nav-buttons {
            order: 0;
            margin-left: auto;
        }
    }
    
    @media (max-width: 768px) {
        .back-to-home {
            top: 10px;
            left: 10px;
            padding: 8px 12px;
            font-size: 0.9rem;
        }
        
        .nav-logo .logo-text {
            font-size: 1.2rem;
        }
        
        .nav-menu {
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .search-form {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .search-btn {
            width: 100%;
            justify-content: center;
            padding: 0.6rem 1rem;
        }
    }
    
    @media (max-width: 480px) {
        .nav-menu {
            font-size: 0.9rem;
            gap: 0.75rem;
        }
        
        .nav-buttons {
            gap: 0.5rem;
        }
        
        .btn-primary, .btn-secondary {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
        }
    }
    
    .nav-logo {
        display: flex;
        align-items: center;
        text-decoration: none;
    }
    
    .logo {
        height: 36px;
        width: auto;
        margin-right: 10px;
    }
    
    .logo-text {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
    }
    
    .nav-menu {
        display: flex;
        gap: 2rem;
        margin: 0 2rem;
    }
    
    .nav-search {
        flex: 1;
        max-width: 600px;
        margin: 0 2rem;
    }
    
    .search-form {
        display: flex;
        gap: 0.5rem;
        width: 100%;
    }
    
    .search-input-group {
        flex: 1;
        position: relative;
        display: flex;
        align-items: center;
    }
    
    .search-input {
        width: 100%;
        padding: 0.6rem 1rem 0.6rem 2.5rem;
        border: 1px solid #ddd;
        border-radius: 25px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    
    .search-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(40, 167, 69, 0.2);
    }
    
    .search-icon, .location-icon {
        position: absolute;
        left: 1rem;
        color: #777;
    }
    
    .search-btn {
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 25px;
        padding: 0 1.5rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .search-btn:hover {
        background: #1e7e34;
        transform: translateY(-1px);
    }
    
    .nav-buttons {
        display: flex;
        gap: 1rem;
        align-items: center;
    }
    }
    
    .nav-link {
        text-decoration: none;
        color: #333;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
        padding: 0.5rem 0;
    }
    
    .nav-link:hover,
    .nav-link.active {
        color: #1e3932;
    }
    
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(135deg, #1e3932, #2c5530);
        transition: width 0.3s ease;
    }
    
    .nav-link:hover::after,
    .nav-link.active::after {
        width: 100%;
    }

    /* Navigation Buttons */
/* Navigation Styles */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    z-index: 1000;
    transition: all 0.3s ease;
}

.nav-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 70px;
}

.nav-logo {
    display: flex;
    align-items: center;
    gap: 10px;
}

.logo {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

.logo-text {
    font-size: 24px;
    font-weight: 700;
    background: linear-gradient(135deg, #1e3932, #2c5530);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.nav-menu {
    display: flex;
    gap: 30px;
}

.nav-link {
    text-decoration: none;
    color: #333;
    font-weight: 500;
    transition: all 0.3s ease;
    position: relative;
}

.nav-link:hover,
.nav-link.active {
    color: #1e3932;
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(135deg, #1e3932, #2c5530);
    transition: width 0.3s ease;
}

.nav-link:hover::after,
.nav-link.active::after {
    width: 100%;
}

.nav-buttons {
    display: flex;
    gap: 15px;
}

.btn-secondary {
    padding: 10px 20px;
    border: 2px solid #1e3932;
    background: transparent;
    color: #1e3932;
    border-radius: 25px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    text-align: center;
}

.btn-secondary:hover {
    background: #1e3932;
    color: white;
}

.btn-primary {
    padding: 10px 20px;
    background: linear-gradient(135deg, #1e3932, #2c5530);
    color: white;
    border: none;
    border-radius: 25px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    text-align: center;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(30, 57, 50, 0.4);
}

    
    /* Mobile Menu Toggle */
    .mobile-menu-toggle {
        display: none;
        background: none;
        border: none;
        font-size: 1.5rem;
        color: var(--primary-color);
        cursor: pointer;
        padding: 0.5rem;
        margin-left: 1rem;
    }

    /* Content Spacing */
    .search-results-page {
        padding-top: 80px;
        min-height: 100vh;
    }

    /* Map Info Window Styles */
    .map-info-window {
        padding: 10px;
        max-width: 250px;
    }
    
    .map-info-window h6 {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 5px;
        color: #2d3748;
    }
    
    .map-info-window p {
        font-size: 12px;
        color: #4a5568;
        margin-bottom: 5px;
    }
    
    .map-info-window .btn {
        font-size: 12px;
        padding: 4px 8px;
    }
    
    /* ===== Search Header ===== */
    .search-header {
        background: linear-gradient(135deg, #1e3932 0%, #2c5530 100%);
        padding: 4rem 0 2rem;
        margin: 0;
        position: relative;
        overflow: hidden;
    }
    
    .search-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M54.627 0l-5.455 5.456 5.455 5.455-5.455 5.455L43.717 0l-5.455 5.455L43.717 16.37 38.26 21.82l5.455 5.457-5.455 5.455-5.455-5.455-5.456 5.455L26.95 27.277 21.493 32.73l5.455 5.457-5.455 5.455-5.455-5.455-5.456 5.455L.215 38.186 5.67 32.73.215 27.275l5.455-5.456L.215 16.37 5.67 10.91.213 5.455 5.67 0l5.456 5.455L16.583 0l5.456 5.455L27.494 0l5.456 5.455L38.405 0l5.456 5.455L49.37 0l5.257 5.257L60 5.455 54.627 0z' fill='%233a6b3f' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.5;
        z-index: 0;
    }
    
    .search-bar-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 1;
    }
    
    .search-form {
        display: flex;
        gap: 10px;
        margin-bottom: 1rem;
        background: white;
        border-radius: 50px;
        padding: 5px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        position: relative;
        overflow: hidden;
    }
    
    .search-input-group {
        flex: 1;
        position: relative;
        margin: 0;
    }
    
    .search-icon, .location-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        z-index: 1;
        font-size: 1.1rem;
    }
    
    .search-input, .location-input {
        width: 100%;
        padding: 15px 20px 15px 48px;
        border: none;
        border-radius: 50px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }
    
    .search-input:focus, .location-input:focus {
        outline: none;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(30, 57, 50, 0.1);
    }
    
    .search-input:focus, .location-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(26, 93, 74, 0.2);
        outline: none;
    }
    
    .search-btn {
        background: linear-gradient(135deg, #1e3932, #2c5530);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 28px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(30, 57, 50, 0.2);
    }
    
    .search-btn:hover {
        background: linear-gradient(135deg, #2c5530, #1e3932);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(30, 57, 50, 0.3);
    }
    
    .search-btn i {
        margin-right: 8px;
        font-size: 0.9em;
    }
    
    /* Advanced Search Button */
    #toggle-advanced-search {
        background: transparent;
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50px;
        padding: 10px 20px;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        margin: 0;
        text-decoration: none;
    }
    
    #toggle-advanced-search i {
        margin-right: 8px;
        font-size: 0.9em;
    }
    
    #toggle-advanced-search:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.5);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .location-select {
        flex: 2;
        position: relative;
    }
    
    .location-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        z-index: 1;
    }
    
    .location-dropdown {
        width: 100%;
        padding: 12px 20px 12px 40px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        font-size: 16px;
        appearance: none;
        background-color: white;
        cursor: pointer;
    }
    
    .search-btn {
        flex: 1;
        background-color: #09a509;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 0 20px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    
    .search-btn:hover {
        background-color: #078e07;
    }
    
    /* Advanced Search Panel */
    .advanced-search-panel {
        background: white;
        border-radius: 12px;
        padding: 25px;
        margin: 20px 0;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        position: relative;
        z-index: 2;
        animation: slideDown 0.3s ease-out;
    }
    
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .advanced-search-form {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }
    
    .form-group {
        margin-bottom: 1.25rem;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #1e3932;
        font-size: 0.9rem;
        letter-spacing: 0.3px;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
        color: #2d3748;
    }
    
    .form-control:focus {
        border-color: #1e3932;
        box-shadow: 0 0 0 3px rgba(30, 57, 50, 0.1);
        outline: none;
        background-color: #fff;
    }
    
    /* Form Checkbox Styles */
    .form-check {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
    }
    
    .form-check-input {
        width: 18px;
        height: 18px;
        margin-right: 0.5rem;
        border: 2px solid #cbd5e0;
        border-radius: 4px;
        appearance: none;
        -webkit-appearance: none;
        cursor: pointer;
        position: relative;
        transition: all 0.2s ease;
    }
    
    .form-check-input:checked {
        background-color: #1e3932;
        border-color: #1e3932;
    }
    
    .form-check-input:checked::after {
        content: '✓';
        position: absolute;
        color: white;
        font-size: 12px;
        font-weight: bold;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }
    
    .form-check-label {
        font-size: 0.9rem;
        color: #4a5568;
        cursor: pointer;
    }
    
    .form-check-input:focus {
        box-shadow: 0 0 0 3px rgba(30, 57, 50, 0.2);
    }
    
    .form-actions {
        grid-column: 1 / -1;
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 10px;
        padding-top: 15px;
        border-top: 1px solid #edf2f7;
    }
    
    .feature-options {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    /* Results Section */
    .results-count {
        background: white;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .applied-filters {
        margin-top: 10px;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        align-items: center;
        color: #2d3748;
    }
    
    .applied-filters .badge {
        padding: 5px 10px;
        font-weight: 500;
        color: #2d3748;
    }
    
    .clear-all {
        margin-left: 10px;
        color: #09a509;
        font-size: 14px;
        text-decoration: none;
    }
    
    /* Business Card */
    .business-card {
        background: white;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .business-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .business-image {
        height: 150px;
        overflow: hidden;
        border-radius: 6px;
    }
    
    .business-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .business-details h3 {
        margin: 0 0 5px 0;
        font-size: 1.5rem;
        color: #2d3748;
    }
    
    .business-category, .business-location {
        color: #4a5568;
        margin-bottom: 5px;
    }
    
    .business-description {
        color: #4a5568;
        margin: 10px 0;
        font-size: 0.95rem;
        line-height: 1.5;
    }
    
    .rating {
        color: #f59e0b;
    }
    
    .rating span {
        color: #6b7280;
        font-size: 0.9rem;
        margin-left: 5px;
    }

    /* Footer */
.footer {
    background: #0f2419;
    color: white;
    padding: 60px 0 20px;
}

.footer-content {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 40px;
    margin-bottom: 40px;
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
}

.footer-logo img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

.footer-logo span {
    font-size: 24px;
    font-weight: 700;
}

.footer-section p {
    margin-bottom: 20px;
    line-height: 1.6;
    opacity: 0.9;
}

.social-links {
    display: flex;
    gap: 15px;
}

.social-links a {
    width: 40px;
    height: 40px;
    background: #2c4a35;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.social-links a:hover {
    background: #1e3932;
    transform: translateY(-2px);
}

.footer-section h3 {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 20px;
}

.footer-section ul {
    list-style: none;
}

.footer-section ul li {
    margin-bottom: 10px;
}

.footer-section ul li a {
    color: #7fb069;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-section ul li a:hover {
    color: white;
}

.contact-info p {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
    font-size: 0.9rem;
}

.footer-bottom {
    border-top: 1px solid #2c4a35;
    padding-top: 20px;
}

.footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.footer-links {
    display: flex;
    gap: 20px;
}

.footer-links a {
    color: #7fb069;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.footer-links a:hover {
    color: white;
}
    
    /* Responsive */
    @media (max-width: 992px) {
        .search-form {
            flex-direction: column;
        }
        
        .search-input-group, 
        .location-select, 
        .search-btn {
            width: 100%;
            margin-bottom: 10px;
        }
        
        .business-image {
            height: 200px;
            margin-bottom: 1rem;
        }
    }
    
    @media (max-width: 768px) {
        .advanced-search-form .row > div {
            margin-bottom: 15px;
        }
    }
</style>

@push('scripts')
<script>
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 20) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
    
    // Toggle advanced search
    document.getElementById('toggle-advanced-search').addEventListener('click', function() {
        const panel = document.getElementById('advanced-search-panel');
        panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
        this.innerHTML = panel.style.display === 'none' 
            ? '<i class="fas fa-sliders-h"></i> Advanced Search'
            : '<i class="fas fa-times"></i> Hide Advanced';
    });
    
    // Initialize map
    function initMap() {
        // Default to Sri Lanka center if no businesses or coordinates
        let center = { lat: 7.8731, lng: 80.7718 }; // Center of Sri Lanka
        let zoom = 7;
        
        // Create the map
        const map = new google.maps.Map(document.getElementById('map'), {
            center: center,
            zoom: zoom,
            styles: [
                {
                    featureType: 'poi',
                    elementType: 'labels',
                    stylers: [{ visibility: 'off' }]
                }
            ]
        });
        
        // Create an info window to share between markers
        const infoWindow = new google.maps.InfoWindow();
        
        // Create an array to hold markers
        const markers = [];
        
        // Add markers for each business with coordinates
        @foreach($businesses as $business)
            @if($business->latitude && $business->longitude)
                const marker{{ $business->id }} = new google.maps.Marker({
                    position: { lat: {{ $business->latitude }}, lng: {{ $business->longitude }} },
                    map: map,
                    title: '{{ addslashes($business->business_name) }}',
                    animation: google.maps.Animation.DROP,
                    icon: {
                        url: '{{ $business->logo ? asset('storage/'.$business->logo) : asset('images/default-marker.png') }}',
                        scaledSize: new google.maps.Size(40, 40),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(20, 40)
                    }
                });
                
                // Add click event to show info window
                marker{{ $business->id }}.addListener('click', () => {
                    infoWindow.setContent(`
                        <div class="map-info-window">
                            <h6 class="mb-1">{{ addslashes($business->business_name) }}</h6>
                            @if($business->average_rating)
                                <div class="mb-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $business->average_rating)
                                            <i class="fas fa-star text-warning" style="font-size: 12px;"></i>
                                        @else
                                            <i class="far fa-star text-muted" style="font-size: 12px;"></i>
                                        @endif
                                    @endfor
                                    <small>({{ $business->reviews_count }} {{ Str::plural('review', $business->reviews_count) }})</small>
                                </div>
                            @endif
                            <p class="mb-1 small">{{ Str::limit(strip_tags($business->description), 100) }}</p>
                            <a href="{{ route('business.show', $business->businesses_id) }}" class="btn btn-sm btn-primary btn-block mt-2">
                                View Details
                            </a>
                        </div>
                    `);
                    infoWindow.open(map, marker{{ $business->id }});
                });
                
                markers.push(marker{{ $business->id }});
            @endif
        @endforeach
        
        // If we have markers, fit the map to bounds
        if (markers.length > 0) {
            const bounds = new google.maps.LatLngBounds();
            markers.forEach(marker => bounds.extend(marker.getPosition()));
            map.fitBounds(bounds);
            
            // Add a small padding to the bounds
            const padding = 0.02; // degrees of padding
            const ne = bounds.getNorthEast();
            const sw = bounds.getSouthWest();
            bounds.extend(new google.maps.LatLng(ne.lat() + padding, ne.lng() + padding));
            bounds.extend(new google.maps.LatLng(sw.lat() - padding, sw.lng() - padding));
            map.fitBounds(bounds);
            
            // Set a maximum zoom level
            const maxZoom = 15;
            const minZoom = 12;
            const listener = google.maps.event.addListener(map, 'bounds_changed', function() {
                if (this.getZoom() > maxZoom) this.setZoom(maxZoom);
                if (this.getZoom() < minZoom) this.setZoom(minZoom);
                google.maps.event.removeListener(listener);
            });
        }
    }
    
    // Share on social media
    function shareOnSocial(platform, url) {
        const shareUrl = new URL(url);
        const title = document.title;
        const text = 'Check out this business on BizNest: ' + title;
        
        switch(platform) {
            case 'facebook':
                window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}`, '_blank');
                break;
            case 'twitter':
                window.open(`https://twitter.com/intent/tweet?url=${encodeURIComponent(shareUrl)}&text=${encodeURIComponent(text)}`, '_blank');
                break;
            case 'linkedin':
                window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(shareUrl)}`, '_blank');
                break;
        }
        return false;
    }
    
    // Copy URL to clipboard
    function copyToClipboard(url) {
        navigator.clipboard.writeText(url).then(function() {
            // Show success message
            const originalText = event.target.innerHTML;
            event.target.innerHTML = '<i class="fas fa-check"></i> Copied!';
            setTimeout(() => {
                event.target.innerHTML = originalText;
            }, 2000);
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
        return false;
    }
    
    // Toggle save business
    document.addEventListener('DOMContentLoaded', function() {
        // Handle save business button click
        document.querySelectorAll('.save-business').forEach(button => {
            button.addEventListener('click', function() {
                const businessId = this.getAttribute('data-business-id');
                const button = this;
                
                // Toggle save state
                const isSaved = button.classList.contains('saved');
                const url = isSaved 
                    ? `/businesses/${businessId}/unsave`
                    : `/businesses/${businessId}/save`;
                
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        button.classList.toggle('saved');
                        button.classList.toggle('btn-outline-danger');
                        button.classList.toggle('btn-danger');
                        
                        const icon = button.querySelector('i');
                        if (isSaved) {
                            icon.classList.remove('fas');
                            icon.classList.add('far');
                        } else {
                            icon.classList.remove('far');
                            icon.classList.add('fas');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
            });
        });
    });
    
    // Load the Google Maps API (replace YOUR_API_KEY with your actual API key)
    function loadGoogleMaps() {
        const script = document.createElement('script');
        script.src = `https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap`;
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);
    }
    
    // Load map when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        loadGoogleMaps();
    });
    
    // Handle pagination with filters
    document.querySelectorAll('.pagination a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const url = new URL(this.href);
            window.location.href = url.pathname + window.location.search.replace(/&?page=[^&]*/, '') + 
                                 (window.location.search ? '&' : '?') + 'page=' + url.searchParams.get('page');
        });
    });
</script>
@endpush
@endsection
