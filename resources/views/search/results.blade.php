@extends('layouts.app')

@section('content')
<div class="search-results-page">
    <!-- Search Header -->
    <div class="search-header">
        <div class="container">
            <div class="search-bar-container">
                <form action="{{ route('search.businesses') }}" method="GET" class="search-form">
                    <div class="search-input-group">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" 
                               name="query" 
                               value="{{ request('query') }}" 
                               placeholder="Search businesses, services..." 
                               class="search-input"
                               required>
                    </div>
                    <div class="search-input-group">
                        <i class="fas fa-map-marker-alt location-icon"></i>
                        <input type="text" 
                               name="location" 
                               value="{{ request('location') }}" 
                               placeholder="City, district or address" 
                               class="search-input"
                               list="locationSuggestions"
                               autocomplete="off"
                               required>
                        <datalist id="locationSuggestions">
                            @foreach($locations as $location)
                                <option value="{{ $location }}">
                            @endforeach
                        </datalist>
                    </div>
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                        Search
                    </button>
                </form>
                <button class="btn-link" id="toggle-advanced-search">
                    <i class="fas fa-sliders-h"></i> Advanced Search
                </button>
            </div>

            <!-- Advanced Search Panel -->
            <div class="advanced-search-panel" id="advanced-search-panel" style="display: none;">
                <form action="{{ route('search.businesses') }}" method="GET" class="advanced-search-form">
                    <input type="hidden" name="query" value="{{ request('query') }}">
                    <input type="hidden" name="location" value="{{ request('location') }}">
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category" class="form-control">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Minimum Rating</label>
                                <select name="rating" class="form-control">
                                    <option value="">Any Rating</option>
                                    <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4+ Stars</option>
                                    <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3+ Stars</option>
                                    <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2+ Stars</option>
                                    <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1+ Star</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sort By</label>
                                <select name="sort" class="form-control">
                                    <option value="relevance" {{ request('sort') == 'relevance' ? 'selected' : '' }}>Relevance</option>
                                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Features</label>
                                <div class="feature-options">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="feature1" name="features[]" value="wifi" {{ in_array('wifi', request('features', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="feature1">WiFi</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="feature2" name="features[]" value="parking" {{ in_array('parking', request('features', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="feature2">Parking</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="feature3" name="features[]" value="delivery" {{ in_array('delivery', request('features', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="feature3">Delivery</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                            <a href="{{ route('search.businesses') }}?query={{ request('query') }}&location={{ request('location') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
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
                            @endif
                            @if(!empty($location))
                                in {{ $location }}
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
                                            
                                            @if($business->category)
                                                <div class="business-category">
                                                    <i class="fas fa-tag"></i> {{ $business->category->name }}
                                                </div>
                                            @endif
                                            
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
                                                <a href="{{ route('business.show', $business->slug ?? $business->id) }}" class="btn btn-outline-primary btn-sm mr-2">
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
                                                        <a class="dropdown-item" href="#" onclick="shareOnSocial('facebook', '{{ route('business.show', $business->slug ?? $business->id) }}')">
                                                            <i class="fab fa-facebook-f mr-2"></i> Facebook
                                                        </a>
                                                        <a class="dropdown-item" href="#" onclick="shareOnSocial('twitter', '{{ route('business.show', $business->slug ?? $business->id) }}')">
                                                            <i class="fab fa-twitter mr-2"></i> Twitter
                                                        </a>
                                                        <a class="dropdown-item" href="#" onclick="shareOnSocial('linkedin', '{{ route('business.show', $business->slug ?? $business->id) }}')">
                                                            <i class="fab fa-linkedin-in mr-2"></i> LinkedIn
                                                        </a>
                                                        <a class="dropdown-item" href="#" onclick="copyToClipboard('{{ route('business.show', $business->slug ?? $business->id) }}')">
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
                
                <!-- Map View -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 20px;">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Map View</h5>
                            </div>
                            <div class="card-body p-0">
                                <div id="map" style="height: 500px; width: 100%;"></div>
                            </div>
                        </div>
                        
                        <!-- Search Summary -->
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Search Summary</h6>
                            </div>
                            <div class="card-body">
                                <p class="mb-2"><strong>Location:</strong> {{ $location }}</p>
                                @if(request('category'))
                                    @php
                                        $category = \App\Models\Category::find(request('category'));
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
                </div>
            </div>
        </div>
    </div>
</div>

<style>
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
    
    /* Search Header */
    .search-header {
        background: linear-gradient(135deg, #15202B 0%, #1a3a4a 100%);
        padding: 2rem 0;
        margin-bottom: 2rem;
    }
    
    .search-bar-container {
        max-width: 900px;
        margin: 0 auto;
    }
    
    .search-form {
        display: flex;
        gap: 10px;
        margin-bottom: 1rem;
    }
    
    .search-input-group {
        flex: 3;
        position: relative;
    }
    
    .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }
    
    .search-input {
        width: 100%;
        padding: 12px 20px 12px 45px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        font-size: 16px;
        transition: all 0.3s;
    }
    
    .search-input:focus {
        border-color: #09a509;
        box-shadow: 0 0 0 3px rgba(9, 165, 9, 0.1);
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
    
    /* Advanced Search */
    .advanced-search-panel {
        background: white;
        border-radius: 8px;
        padding: 1.5rem;
        margin-top: 1rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
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
    }
    
    .applied-filters .badge {
        padding: 5px 10px;
        font-weight: 500;
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
                            <a href="{{ route('business.show', $business->slug ?? $business->id) }}" class="btn btn-sm btn-primary btn-block mt-2">
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
