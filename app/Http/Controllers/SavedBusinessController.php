<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\SavedBusiness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedBusinessController extends Controller
{
    /**
     * Save a business for the authenticated user
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function save(Business $business)
    {
        $user = Auth::user();
        
        // Check if already saved
        if ($user->savedBusinesses()->where('business_id', $business->id)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Business already saved'
            ]);
        }
        
        // Save the business
        $savedBusiness = new SavedBusiness([
            'user_id' => $user->id,
            'business_id' => $business->id
        ]);
        $savedBusiness->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Business saved successfully',
            'saved' => true
        ]);
    }
    
    /**
     * Unsave a business for the authenticated user
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function unsave(Business $business)
    {
        $user = Auth::user();
        
        // Delete the saved business record
        $deleted = $user->savedBusinesses()->where('business_id', $business->id)->delete();
        
        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Business removed from saved list',
                'saved' => false
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Business not found in saved list'
        ], 404);
    }
}
