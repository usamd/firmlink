@extends('layouts.guestapp')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #15202B 40%, #09a509 100%);
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
        display: flex;
        align-items: center;
        margin: 0;
        padding: 20px;
    }

    .registration-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 1000px;
        margin: 0 auto;
    }

    .form-section {
        padding: 40px;
    }

    .form-control, .form-select {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 12px 15px;
        margin-bottom: 15px;
    }

    .form-control:focus, .form-select:focus {
        border-color: #09a509;
        box-shadow: 0 0 0 0.25rem rgba(9, 165, 9, 0.25);
    }

    .btn-primary {
        background-color: #09a509;
        border: none;
        padding: 12px 25px;
        font-weight: 600;
    }

    .btn-outline-primary {
        color: #09a509;
        border-color: #09a509;
    }

    .step-indicator {
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
        position: relative;
    }

    .step {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #6c757d;
        position: relative;
        z-index: 2;
    }

    .step.active {
        background: #09a509;
        color: white;
    }

    .step-line {
        position: absolute;
        height: 3px;
        background: #e9ecef;
        top: 50%;
        left: 20px;
        right: 20px;
        transform: translateY(-50%);
        z-index: 1;
    }

    .step-line-progress {
        position: absolute;
        height: 100%;
        background: #09a509;
        width: 0%;
        transition: all 0.3s;
    }

    @media (max-width: 768px) {
        .form-section {
            padding: 20px;
        }
        
        .btn-primary, .btn-outline-primary {
            width: 100%;
            margin-bottom: 10px;
        }
    }


</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize form steps
        let currentStep = 1;
        const totalSteps = 2;
        
        // Update step indicator
        function updateStepIndicator(step) {
            $('.step').removeClass('active');
            $(`.step-${step}`).addClass('active');
            const progress = ((step - 1) / (totalSteps - 1)) * 100;
            $('.step-line-progress').css('width', progress + '%');
        }

        // Next button click handler
        $("#next-button").click(function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            const currentSection = form.find(`#form-part-${currentStep}`);
            
            // Simple validation
            let isValid = true;
            currentSection.find('input[required], select[required]').each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            
            if (isValid) {
                currentStep++;
                updateStepIndicator(currentStep);
                $("#form-part-1").hide();
                $("#form-part-2").show();
                $("#back-button").show();
                $("#next-button").hide();
                $("#submit-button").show();
            }
        });

        // Back button click handler
        $("#back-button").click(function(e) {
            e.preventDefault();
            currentStep--;
            updateStepIndicator(currentStep);
            $("#form-part-2").hide();
            $("#form-part-1").show();
            $("#next-button").show();
            $("#submit-button").hide();
            if (currentStep === 1) {
                $("#back-button").hide();
            }
        });

        // Initialize form
        updateStepIndicator(1);
        $("#back-button").hide();
        $("#submit-button").hide();
        $("#form-part-2").hide();
    });
</script>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="registration-card">
                <div class="form-section">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold text-dark mb-2">Register Your Business</h2>
                        <p class="text-muted">Join our business network and grow your audience</p>
                        
                        <!-- Step Indicator -->
                        <div class="step-indicator mt-4">
                            <div class="step step-1 active">1</div>
                            <div class="step-line">
                                <div class="step-line-progress"></div>
                            </div>
                            <div class="step step-2">2</div>
                        </div>
                    </div>

                    <h5 class="card-title text-center text-green mb-4 fw-light fs-lg" id="signup-business-text">{{ __('Details of the Business') }}</h5>
                    <h5 class="card-title text-center text-green mb-4 fw-light fs-lg" id="signup-business-owner-text" style="display: none;">{{ __('Details of the Owner') }}</h5>


                        <form method="POST" action="{{ route('register.business') }}" class="needs-validation" novalidate>
                        @csrf
                        
                        <!-- Business Information -->
                        <div id="form-part-1">
                            <h5 class="mb-4 text-dark">Business Information</h5>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="business_name" class="form-label">Business Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('business_name') is-invalid @enderror" 
                                               id="business_name" name="business_name" value="{{ old('business_name') }}" required>
                                        @error('business_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="business_email" class="form-label">Business Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('business_email') is-invalid @enderror" 
                                               id="business_email" name="business_email" value="{{ old('business_email') }}" required>
                                        @error('business_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="business_phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control @error('business_phone') is-invalid @enderror" 
                                               id="business_phone" name="business_phone" value="{{ old('business_phone') }}" required>
                                        @error('business_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="business_reg_no" class="form-label">Registration Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('business_reg_no') is-invalid @enderror" 
                                               id="business_reg_no" name="business_reg_no" value="{{ old('business_reg_no') }}" required>
                                        @error('business_reg_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="business_address" class="form-label">Business Address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('business_address') is-invalid @enderror" 
                                               id="business_address" name="business_address" value="{{ old('business_address') }}" required>
                                        @error('business_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                               id="city" name="city" value="{{ old('city') }}" required>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="state" class="form-label">State/Province <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('state') is-invalid @enderror" 
                                               id="state" name="state" value="{{ old('state') }}" required>
                                        @error('state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="postal_code" class="form-label">Postal Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('postal_code') is-invalid @enderror" 
                                               id="postal_code" name="postal_code" value="{{ old('postal_code') }}" required>
                                        @error('postal_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="business_description" class="form-label">Business Description</label>
                                        <textarea class="form-control @error('business_description') is-invalid @enderror" 
                                                  id="business_description" name="business_description" rows="3">{{ old('business_description') }}</textarea>
                                        @error('business_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="business_logo" class="form-label">Business Logo</label>
                                        <input type="file" class="form-control @error('business_logo') is-invalid @enderror" 
                                               id="business_logo" name="business_logo" accept="image/*">
                                        <div class="form-text">Upload your business logo (optional, max 2MB)</div>
                                        @error('business_logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between mt-5">
                                <a href="{{ route('register') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Back
                                </a>
                                <button type="button" id="next-button" class="btn btn-primary">
                                    Next <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Owner Information -->
                        <div id="form-part-2" style="display: none;">
                            <h5 class="mb-4 text-dark">Owner Information</h5>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="owner_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('owner_name') is-invalid @enderror" 
                                               id="owner_name" name="owner_name" value="{{ old('owner_name') }}" required>
                                        @error('owner_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="owner_email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('owner_email') is-invalid @enderror" 
                                               id="owner_email" name="owner_email" value="{{ old('owner_email') }}" required>
                                        @error('owner_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="owner_phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control @error('owner_phone') is-invalid @enderror" 
                                               id="owner_phone" name="owner_phone" value="{{ old('owner_phone') }}" required>
                                        @error('owner_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="owner_position" class="form-label">Position in Company <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('owner_position') is-invalid @enderror" 
                                               id="owner_position" name="owner_position" value="{{ old('owner_position') }}" required>
                                        @error('owner_position')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                               id="password" name="password" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" 
                                               id="password_confirmation" name="password_confirmation" required>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" 
                                               id="terms" name="terms" required>
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="{{ route('terms') }}" target="_blank">Terms of Service</a> and 
                                            <a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a> <span class="text-danger">*</span>
                                        </label>
                                        @error('terms')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" id="back-button" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Back
                                </button>
                                <button type="submit" id="submit-button" class="btn btn-primary">
                                    <i class="fas fa-check-circle me-2"></i>Submit Registration
                                </button>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <p class="mb-0">Already have an account? 
                                <a href="{{ route('login') }}" class="text-primary fw-semibold">Sign In</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Add Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<style>
    /* Additional custom styles */
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    
    .form-text {
        font-size: 0.875rem;
        color: #6c757d;
    }
    
    .btn {
        font-weight: 500;
        padding: 0.5rem 1.5rem;
    }
    
    .btn i {
        font-size: 0.9em;
    }
    
    .text-primary {
        color: #09a509 !important;
    }
    
    .btn-primary {
        background-color: #09a509;
        border-color: #09a509;
    }
    
    .btn-primary:hover {
        background-color: #078e07;
        border-color: #078e07;
    }
    
    .btn-outline-secondary {
        color: #6c757d;
        border-color: #dee2e6;
    }
    
    .btn-outline-secondary:hover {
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }
    
    .invalid-feedback {
        font-size: 0.875rem;
    }
</style>

<script>
    // Form validation
    (function () {
        'use strict'
        
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
        
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

<script>
    // Form navigation
    document.addEventListener('DOMContentLoaded', function() {
        const formPart1 = document.getElementById('form-part-1');
        const formPart2 = document.getElementById('form-part-2');
        const nextButton = document.getElementById('next-button');
        const backButton = document.getElementById('back-button');
        const submitButton = document.getElementById('submit-button');
        const form = document.querySelector('form');
        
        // Show first part by default
        formPart1.style.display = 'block';
        
        // Next button click handler
        if (nextButton) {
            nextButton.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Validate part 1
                const part1Inputs = formPart1.querySelectorAll('input[required], select[required]');
                let isValid = true;
                
                part1Inputs.forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                        input.classList.add('is-invalid');
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });
                
                if (isValid) {
                    formPart1.style.display = 'none';
                    formPart2.style.display = 'block';
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                } else {
                    // Scroll to first invalid input
                    const firstInvalid = formPart1.querySelector('.is-invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });
        }
        
        // Back button click handler
        if (backButton) {
            backButton.addEventListener('click', function(e) {
                e.preventDefault();
                formPart2.style.display = 'none';
                formPart1.style.display = 'block';
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
        
        // Form submission handler
        if (form) {
            form.addEventListener('submit', function(e) {
                const requiredInputs = formPart2.querySelectorAll('input[required], select[required]');
                let isValid = true;
                
                requiredInputs.forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                        input.classList.add('is-invalid');
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    const firstInvalid = formPart2.querySelector('.is-invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });
        }
    });
</script>

@endsection
                                        </div>
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="d-grid gap-2 custom-form-input text-center">
                                        <div class="row justify-content-center">
                                            <div class="col-md-6 col-sm-12 mb-2 mb-md-0">
                                                <button class="btn btn-lg  btn-login fw-bold text-uppercase rounded-pill" type="button" id="first-back-button"style="width: 400px; margin: 0 auto;">
                                                    Back
                                                </button>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <button class="btn btn-lg  btn-login fw-bold text-uppercase rounded-pill" type="button" id="next-button"style="width: 400px; margin: 0 auto;">
                                                    Next
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Part 2: Personal Information -->
                            <div id="form-part-2" style="display: none;">
                                <div class="row">
                                    <!-- First column spanning full width -->
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3 custom-form-input">
                                            <input id="owner_name" type="text" class="form-control  @error('name') is-invalid @enderror" name="owner_name" value="{{ old('name') }}" placeholder="Name" required autocomplete="name" autofocus>
                                            <label for="name">{{ __('Name') }}</label>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Split the remaining fields equally into two columns -->
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 custom-form-input">
                                            <input id="business_reg_no" type="text" class="form-control " name="business_reg_no" placeholder="Business Registration Number" required>
                                            <label for="business_reg_no">Business Registration Number</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 custom-form-input">
                                            <input id="owner_email" type="email" class="form-control  @error('email') is-invalid @enderror" name="owner_email" value="{{ old('email') }}" placeholder="name@example.com" required autocomplete="email">
                                            <label for="email">{{ __('Email Address') }}</label>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 custom-form-input">
                                            <input id="owner_phone" type="text" class="form-control " name="owner_phone" placeholder="Mobile" required>
                                            <label for="mobile">Mobile</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 custom-form-input">
                                            <input id="address" type="text" class="form-control " name="address" placeholder="Address" required>
                                            <label for="address">Address</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 custom-form-input">
                                            <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                                            <label for="password">{{ __('Password') }}</label>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 custom-form-input">
                                            <input id="password-confirm" type="password" class="form-control " name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="d-grid gap-2 custom-form-input text-center">
                                        <div class="row justify-content-center">
                                            <div class="col-md-6 col-sm-12 mb-2 mb-md-0">
                                                <button class="btn btn-lg  btn-login fw-bold text-uppercase rounded-pill" type="button" id="second-back-button" style="width: 400px;">
                                                    Back
                                                </button>

                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <button class="btn btn-lg  btn-login fw-bold text-uppercase rounded-pill" type="submit" style="width: 400px;">
                                                    {{ __('Register') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <hr class="my-4">

                                <div id="footer-signup-items"style="display: none;">
                                    <a class="d-block text-center btn-link mt-2 small" href="{{ route('login') }}">{{ __('Have an account? Sign In') }}</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
