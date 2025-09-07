@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h4 mb-0">Privacy Policy</h1>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h2 class="h5 text-primary">1. Information We Collect</h2>
                        <p>We collect personal information such as name, email, and business details when you register or use our services.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h5 text-primary">2. How We Use Your Information</h2>
                        <p>Your information is used to provide and improve our services, communicate with you, and ensure platform security.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h5 text-primary">3. Data Protection</h2>
                        <p>We implement security measures to protect your personal information from unauthorized access or disclosure.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h5 text-primary">4. Cookies and Tracking</h2>
                        <p>We use cookies to enhance your experience on our platform and analyze usage patterns.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h5 text-primary">5. Your Rights</h2>
                        <p>You have the right to access, correct, or delete your personal information at any time.</p>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <p class="text-muted mb-0">Last updated: {{ date('F d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
