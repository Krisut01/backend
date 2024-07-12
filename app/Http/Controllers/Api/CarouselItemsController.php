<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\CarouselItems;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarouselRequest;

class CarouselItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarouselItems::all();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CarouselRequest $request)
    {
        $validated = $request->validated();

        $carouselItem = carouselItems::create( $validated);

        return $carouselItem;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return carouselItems::findOrFail($id);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $carouselItem = carouselItems::findOrFail($id);
 
        $carouselItem->delete();  

        return $carouselItem;   

      }
}
