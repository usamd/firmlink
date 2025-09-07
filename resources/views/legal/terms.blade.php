@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h4 mb-0">Terms of Service</h1>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h2 class="h5 text-primary">1. Acceptance of Terms</h2>
                        <p>By accessing or using the BizNest platform, you agree to be bound by these Terms of Service.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h5 text-primary">2. User Responsibilities</h2>
                        <p>Users are responsible for maintaining the confidentiality of their account information and for all activities that occur under their account.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h5 text-primary">3. Content Policy</h2>
                        <p>Users agree not to post content that is illegal, offensive, or violates any third-party rights.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h5 text-primary">4. Termination</h2>
                        <p>BizNest reserves the right to terminate or suspend accounts that violate these terms.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h5 text-primary">5. Changes to Terms</h2>
                        <p>We may modify these terms at any time. Continued use of the platform constitutes acceptance of the new terms.</p>
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
