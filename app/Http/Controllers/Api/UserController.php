<?php

namespace App\Http\Controllers\Api;


use App\Models\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

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

   
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
