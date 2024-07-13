<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\CarouselItems;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarouselRequest;

class CarouselItemsController extends Controller
{
    public function index()
    {
        return CarouselItems::all();
    }
    public function store(CarouselRequest $request)
    {
        $validated = $request->validated();

        $carouselItem = carouselItems::create( $validated);

        return $carouselItem;
    }

    public function show(string $id)
    {
        return carouselItems::findOrFail($id);
    }
    public function update(CarouselRequest $request, string $id) 
    {
        $validated = $request->validated(); 
        
        $carouselItem = carouselItems::findOrFail($id);
        $carouselItem   ->update($validated);
        return $carouselItem;   

        }

    public function destroy(string $id)
    {
        $carouselItem = carouselItems::findOrFail($id);
 
        $carouselItem->delete();  

        return $carouselItem;   

      }
}
