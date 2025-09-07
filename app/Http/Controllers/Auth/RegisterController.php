<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'string', 'max:255'],
            'nearest_city' => ['required', 'string', 'max:255'],
            'mobile_number' => ['required', 'string', 'max:20'],
            'id_number' => ['required', 'string', 'max:20'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Get customer role ID (default role)
        $customerRole = Role::where('name', 'customer')->first();
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'nearest_city' => $data['nearest_city'],
            'mobile_number' => $data['mobile_number'],
            'id_number' => $data['id_number'],
            'role_id' => $customerRole ? $customerRole->id : 3, // Default to customer role
            'is_active' => true
        ]);
    }

    public function businessRegisterIndex()
    {
        $categories = \App\Models\Category::all();
        return view('auth.register_business_clean', compact('categories'));
    }

    protected function userRegisterIndex()
    {
        return view('auth.register_user');
    }

    public function registerBusiness(Request $request)
    {
        // Log the incoming request data
        Log::info('Business registration request received', $request->all());
        
        try {
            // Validate the request data
            $validator = $this->businessValidator($request->all());
            
            if ($validator->fails()) {
                Log::error('Validation failed', $validator->errors()->toArray());
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            $validatedData = $validator->validated();
            Log::info('Validation passed', $validatedData);
            
            // Start database transaction to ensure data consistency
            return DB::transaction(function () use ($request, $validatedData) {
                // Get business role ID
                $businessRole = Role::where('name', 'business')->first();
                
                if (!$businessRole) {
                    Log::error('Business role not found in database');
                    throw new \Exception('Business role not found');
                }

                // Prepare user data
                $userData = [
                    'name' => $request->owner_name,
                    'email' => $request->owner_email,
                    'password' => Hash::make($request->password),
                    'mobile_number' => $request->owner_phone,
                    'address' => $request->business_address,
                    'role_id' => $businessRole->id,
                    'business_reg_no' => $request->business_reg_no,
                    'is_active' => true,
                    'email_verified_at' => now()
                ];
                
                Log::info('Creating user with data:', $userData);
                
                // Create the user account
                $user = User::create($userData);
                
                if (!$user) {
                    Log::error('Failed to create user account');
                    throw new \Exception('Failed to create user account');
                }
                
                Log::info('User created successfully', ['user_id' => $user->id]);

                // Prepare business data
                $businessData = [
                    'business_name' => $request->business_name,
                    'business_email' => $request->business_email,
                    'business_address' => $request->business_address,
                    'phone' => $request->phone,
                    'district' => $request->district,
                    'postal' => $request->postal_code,
                    'category_id' => $request->category,
                    'province' => $request->province,
                    'business_type' => $request->business_type,
                    'user_id' => $user->id,
                    'is_verified' => false,
                    'status' => 'pending',
                    'business_reg_no' => $request->business_reg_no
                ];
                
                Log::info('Creating business with data:', $businessData);
                
                // Create the business record
                $business = Business::create($businessData);
                
                if (!$business) {
                    Log::error('Failed to create business record');
                    throw new \Exception('Failed to create business record');
                }
                
                Log::info('Business created successfully', ['business_id' => $business->id]);

                // Send email verification notification
                event(new Registered($user));
                
                // Redirect to login page with success message
                return redirect()->route('login')
                    ->with('status', 'Business registration successful! Please check your email to verify your account. Your business is pending admin verification.');
            });
        } catch (\Exception $e) {
            Log::error('Error during business registration: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                ->withErrors(['error' => 'Registration failed: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Get a validator for business registration
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function businessValidator(array $data)
    {
        Log::info('Validating business registration data.', $data);

        $rules = [
            // Business Information
            'business_name' => ['required', 'string', 'max:255'],
            'business_email' => ['required', 'string', 'email', 'max:255', 'unique:businesses'],
            'business_address' => ['required', 'string', 'max:255'],
            'business_reg_no' => ['required', 'string', 'max:255', 'unique:businesses'],
            'phone' => ['required', 'string', 'max:15', 'regex:/^[0-9+\-\s()]+$/'],
            'district' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:10'],
            'category' => ['required', 'exists:categories,id'],
            'province' => ['required', 'string', 'max:255'],
            'business_type' => ['required', 'string', 'in:wholesale,retail,both'],
            
            // Owner/User Information
            'owner_name' => ['required', 'string', 'max:255'],
            'owner_email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                'unique:users,email',
                function ($attribute, $value, $fail) use ($data) {
                    // Check if owner email matches business email
                    if (isset($data['business_email']) && strtolower($value) === strtolower($data['business_email'])) {
                        $fail('Owner email cannot be the same as business email.');
                    }
                }
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
            'owner_phone' => ['required', 'string', 'max:15', 'regex:/^[0-9+\-\s()]+$/'],
        ];

        $messages = [
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'owner_phone.regex' => 'Please enter a valid phone number.',
            'phone.regex' => 'Please enter a valid phone number.',
        ];

        return Validator::make($data, $rules, $messages);
    }
}
