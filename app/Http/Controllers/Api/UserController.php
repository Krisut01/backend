<?php

namespace App\Http\Controllers\Api;

use App\Models\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
   
    public function index()
    {
        return user::all();
    }

    public function store(Request $request)
    {
        //
    }

    
    public function show(string $id)
    {
        //
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
