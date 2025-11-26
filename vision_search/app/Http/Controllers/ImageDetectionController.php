<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;   

class ImageDetectionController extends Controller
{
    public function detect(Request $request)
    {
        $request->validate([
            'file' => 'required|image'
        ]);

        $image = $request->file('file');

        try {
            $response = Http::attach(
                'file',
                fopen($image->getRealPath(), 'r'),
                $image->getClientOriginalName()
            )->post('http://127.0.0.1:8001/detect/');

            $result = $response->json();

            if (!isset($result['categories'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid YOLO response',
                ], 500);
            }

            $detectedCategories = array_keys($result['categories']);
            $page = $request->input('page', 1);

            $products = Product::whereIn('parent_category_name', $detectedCategories)
                            ->paginate(100, ['*'], 'page', $page); 

            return response()->json([
                'success' => true,
                'detected_objects' => $result['categories'],
                'products' => $products->items(), 
                'pagination' => [
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total()
                ]
]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error detecting objects',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
