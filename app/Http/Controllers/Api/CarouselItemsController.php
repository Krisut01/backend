<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\CarouselItems;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarouselRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function show(Request $request, string $id = null)
    {
        // Check if ID is provided
        if (is_null($id)) {
            return response()->json(['error' => 'ID not provided'], 400); // 400 Bad Request
        }
    
        try {
            $item = carouselItems::findOrFail($id);
            return response()->json($item);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'ID does not exist'], 404); // 404 Not Found
        }
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
