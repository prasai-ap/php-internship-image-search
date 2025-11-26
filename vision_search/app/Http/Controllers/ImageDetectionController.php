<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

            return response()->json([
                'success' => true,
                'detected_objects' => $response->json()
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
