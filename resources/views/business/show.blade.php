@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Business Info -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h4 mb-0">{{ $business->business_name }}</h1>
                        @auth
                            @if(auth()->user()->id === $business->user_id)
                                <a href="{{ route('business.edit', $business->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit Business
                                </a>
                            @else
                                <button class="btn {{ $is_following ? 'btn-outline-danger' : 'btn-outline-primary' }} btn-sm" id="follow-btn" data-business-id="{{ $business->id }}">
                                    <i class="fas {{ $is_following ? 'fa-user-minus' : 'fa-user-plus' }}"></i>
                                    {{ $is_following ? 'Unfollow' : 'Follow' }}
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="card-body">
                    @if($business->logo_path)
                        <img src="{{ asset('storage/' . $business->logo_path) }}" alt="{{ $business->business_name }} Logo" class="img-fluid rounded mb-4" style="max-height: 200px;">
                    @endif
                    
                    <div class="mb-4">
                        <h5 class="text-muted">About</h5>
                        <p>{{ $business->description ?? 'No description available.' }}</p>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-muted">Contact Information</h5>
                            <p class="mb-1"><i class="fas fa-envelope text-primary mr-2"></i> {{ $business->business_email }}</p>
                            <p class="mb-1"><i class="fas fa-phone text-primary mr-2"></i> {{ $business->phone }}</p>
                            <p class="mb-1"><i class="fas fa-map-marker-alt text-primary mr-2"></i> {{ $business->business_address }}, {{ $business->district }}</p>
                            @if($business->website)
                                <p class="mb-1">
                                    <i class="fas fa-globe text-primary mr-2"></i> 
                                    <a href="{{ $business->website }}" target="_blank">{{ $business->website }}</a>
                                </p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-muted">Business Details</h5>
                            <p class="mb-1"><strong>Category:</strong> {{ $business->category }}</p>
                            <p class="mb-1"><strong>District:</strong> {{ $business->district }}</p>
                            <p class="mb-1"><strong>Province:</strong> {{ $business->province }}</p>
                            <p class="mb-1"><strong>Postal Code:</strong> {{ $business->postal }}</p>
                            <p class="mb-1"><strong>Followers:</strong> {{ $followers_count }}</p>
                        </div>
                    </div>
                    
                    @if($business->services && count($business->services) > 0)
                        <div class="mb-4">
                            <h5 class="text-muted">Services</h5>
                            <div class="d-flex flex-wrap">
                                @foreach($business->services as $service)
                                    <span class="badge badge-primary mr-2 mb-2">{{ $service }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Posts Section -->
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Posts</h5>
                </div>
                <div class="card-body">
                    @if($business->posts && $business->posts->count() > 0)
                        @foreach($business->posts as $post)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <img src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}" class="rounded-circle mr-3" width="40" height="40">
                                        <div>
                                            <h6 class="mb-0">{{ $post->user->name }}</h6>
                                            <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                    <p>{{ $post->content }}</p>
                                    @if($post->image_path)
                                        <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post Image" class="img-fluid rounded mb-3">
                                    @endif
                                    
                                    <!-- Like and Comment Buttons -->
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-outline-primary mr-2">
                                            <i class="far fa-thumbs-up"></i> Like ({{ $post->likes_count ?? 0 }})
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary">
                                            <i class="far fa-comment"></i> Comment ({{ $post->comments_count ?? 0 }})
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted text-center py-4">No posts yet.</p>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Business Hours -->
            @if($business->business_hours && count($business->business_hours) > 0)
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Business Hours</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            @foreach($business->business_hours as $day => $hours)
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="font-weight-bold">{{ ucfirst($day) }}:</span>
                                    <span>{{ $hours['open'] ? $hours['open_time'] . ' - ' . $hours['close_time'] : 'Closed' }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            
            <!-- Location Map -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Location</h5>
                </div>
                <div class="card-body p-0">
                    <div id="map" style="height: 250px;"></div>
                </div>
            </div>
            
            <!-- Contact Business -->
            @auth
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Contact Business</h5>
                    </div>
                    <div class="card-body">
                        <form id="contact-business-form">
                            @csrf
                            <input type="hidden" name="business_id" value="{{ $business->id }}">
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <p class="mb-3">Sign in to contact this business</p>
                        <a href="{{ route('login') }}" class="btn btn-primary">Sign In</a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Initialize map
    function initMap() {
        // For now, using a static map. You can integrate with Google Maps or Mapbox
        const mapElement = document.getElementById('map');
        if (mapElement) {
            // This is a placeholder. Replace with actual map initialization
            mapElement.innerHTML = `
                <div class="p-3 text-center text-muted">
                    <i class="fas fa-map-marked-alt fa-3x mb-2"></i>
                    <p>Map integration would appear here</p>
                    <small>Address: {{ $business->business_address }}, {{ $business->district }}</small>
                </div>
            `;
        }
    }

    // Follow/Unfollow functionality
    document.addEventListener('DOMContentLoaded', function() {
        const followBtn = document.getElementById('follow-btn');
        
        if (followBtn) {
            followBtn.addEventListener('click', function() {
                const businessId = this.dataset.businessId;
                const isFollowing = this.classList.contains('btn-outline-danger');
                const url = isFollowing ? `/business/${businessId}/unfollow` : `/business/${businessId}/follow`;
                
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const icon = this.querySelector('i');
                        if (isFollowing) {
                            this.classList.remove('btn-outline-danger');
                            this.classList.add('btn-outline-primary');
                            icon.classList.remove('fa-user-minus');
                            icon.classList.add('fa-user-plus');
                            this.textContent = 'Follow';
                            this.insertBefore(icon, this.firstChild);
                        } else {
                            this.classList.remove('btn-outline-primary');
                            this.classList.add('btn-outline-danger');
                            icon.classList.remove('fa-user-plus');
                            icon.classList.add('fa-user-minus');
                            this.textContent = 'Unfollow';
                            this.insertBefore(icon, this.firstChild);
                        }
                        
                        // Update followers count if element exists
                        const followersCount = document.querySelector('[data-followers-count]');
                        if (followersCount) {
                            const currentCount = parseInt(followersCount.textContent);
                            followersCount.textContent = isFollowing ? currentCount - 1 : currentCount + 1;
                        }
                    }
                });
            });
        }
        
        // Initialize map when the page loads
        initMap();
    });
</script>
@endpush
@endsection