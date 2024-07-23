<?php
namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use thiagoalessio\TesseractOCR\TesseractOCR;

class AiController extends Controller
{
    public function ocr(UserRequest $request)
    {
        try {
            // Clear existing files
            $images = Storage::allFiles('public/ocr');
            Storage::delete($images);
            
            // Store new image
            $imagePath = $request->file('image')->storePublicly('ocr', 'public');
            $fullPath = storage_path('app/public/') . $imagePath;
            
            // Parse image
            $parsedText = (new TesseractOCR($fullPath))->run();
            
            // Prepare response
            $response = [
                'image_path' => $imagePath,
                'full_path'  => $fullPath,
                'text'       => $parsedText,
            ];
            
            return response()->json($response, 200);
        } catch (\Exception $e) {
            Log::error('OCR Error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while processing the image'], 500);
        }
    }
}