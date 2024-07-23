<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function image(UserRequest $request)
    {
        // Get the authenticated user
        $user = $request->user();
    
        // Check if the image attribute is not null
        if (!is_null($user->image)) {
            // Delete the old image if it exists
            Storage::disk('public')->delete($user->image);
        }
    
        // Store the new image
        $user->image = $request->file('image')->storePublicly('images', 'public');
        $user->save();
    
        return $user;
    }



    public function show(Request $request)
    {
        return $request->user();
    }
    
}
