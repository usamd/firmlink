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

    protected function businessRegisterIndex()
    {
        return view('auth.register_business');
    }

    protected function userRegisterIndex()
    {
        return view('auth.register_user');
    }

    public function registerBusiness(Request $request)
    {
        try {
            $this->businessValidator($request->all())->validate();

            // Get business role ID
            $businessRole = Role::where('name', 'business')->first();

            $user = User::create([
                'name' => $request->owner_name,
                'email' => $request->owner_email,
                'password' => Hash::make($request->password),
                'mobile_number' => $request->owner_phone,
                'address' => $request->business_address,
                'role_id' => $businessRole ? $businessRole->id : 2, // Business role
                'business_reg_no' => $request->business_reg_no,
                'is_active' => true
            ]);

            $business = Business::create([
                'business_name' => $request->business_name,
                'business_email' => $request->business_email,
                'business_address' => $request->business_address,
                'phone' => $request->phone,
                'district' => $request->district,
                'postal' => $request->postal,
                'category' => $request->category,
                'province' => $request->province,
                'user_id' => $user->id,
                'is_verified' => false, // Business needs admin verification
                'status' => 'pending'
            ]);

            event(new Registered($user));
            auth()->login($user);

            return redirect($this->redirectPath())->with('success', 'Business registration successful! Your business is pending verification.');
        } catch (\Exception $e) {
            Log::error('Error during business registration: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Registration failed. Please try again.'])->withInput();
        }
    }

    protected function businessValidator(array $data)
    {
        Log::info('Validating business registration data.', $data);

        return Validator::make($data, [
            'business_name' => ['required', 'string', 'max:255'],
            'business_email' => ['required', 'string', 'email', 'max:255', 'unique:businesses'],
            'business_address' => ['required', 'string', 'max:255'],
            'business_reg_no' => ['required', 'string', 'max:255', 'unique:users'], // Changed to unique:businesses
            'phone' => ['required', 'string', 'max:15'],
            'district' => ['required', 'string', 'max:255'],
            'postal' => ['required', 'string', 'max:10'],
            'category' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'owner_name' => ['required', 'string', 'max:255'], // Changed this to match form field name
            'owner_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'], // Changed to unique:users,email
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'owner_phone' => ['required', 'string', 'max:15'], // Changed this to match form field name
        ]);
    }
}
