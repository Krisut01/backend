<?php

namespace App\Http\Controllers\Api;


use App\Models\user;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
   
    public function index()
    {
        return user::all();
    }

    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        $user = user::create( $validated);

        return $user;
    }


    
    public function show(string $id)
    {
        return User::findOrFail($id);
    }

   
    public function update(user $request, string $id) 
    {
        $validated = $request->validated(); 
        
        $user = user::findOrFail($id);
        $user->password = Hash::make($validated['password']);
        return $user;   

        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = user::findOrFail($id);
 
        $user->delete();  

        return $user;   

      }
      public function image(Request $request, string $id)
      {
          $user = User::findOrFail($id);
      
          // Check if the file is present in the request
          if ($request->hasFile('image')) {
              $image = $request->file('image');
      
              // Delete the old image if it exists
              if (!is_null($user->image)) {
                  Storage::disk('public')->delete($user->image);
              }
      
              // Store the new image
              $user->image = $image->storePublicly('images', 'public');
              $user->save();
      
              return $user;
          } else {
              return response()->json(['message' => 'No image file found in the request'], 400);
          }
      }
      
    
}
