<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vision Search - Capture</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        video::-webkit-media-controls { display: none !important; }
        #detectedList { max-height: 600px; overflow-y: auto; transition: all 0.3s ease; }
        .hidden-product { display: none; }
        .fade-in { animation: fadeIn 0.5s ease forwards; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gradient-to-b from-gray-100 to-gray-50 min-h-screen">

<div class="container mx-auto p-6">
    <div class="text-center mb-10">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-2 animate-bounce">Vision Search</h1>
        <p class="text-gray-600 text-lg md:text-xl">Capture or upload an image to find matching products instantly.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
        <div class="bg-white shadow-lg rounded-2xl p-6 text-center hover:shadow-2xl transition transform hover:-translate-y-1">
            <video id="camera" autoplay playsinline class="rounded-lg w-full h-64 object-cover mb-4 border-2 border-gray-200"></video>
            <img id="preview" class="mx-auto rounded-lg w-64 h-64 object-cover mb-4 hidden border-2 border-gray-200">
            <button onclick="capture()" 
                class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition transform hover:-translate-y-1 hover:scale-105">
                Capture Image
            </button>
        </div>

        <div class="bg-white shadow-lg rounded-2xl p-6 text-center hover:shadow-2xl transition transform hover:-translate-y-1">
            <input type="file" id="fileUpload" accept="image/*" class="mb-4">
            <img id="uploadPreview" class="mx-auto rounded-lg w-64 h-64 object-cover hidden border-2 border-gray-200">
        </div>

    </div>

    <div id="productsSection" class="bg-white shadow-lg rounded-2xl p-6 hidden">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Matched Products</h2>
        <div id="detectedList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
        </div>
    </div>

</div>

<script src="{{ asset('js/capturefunction.js') }}"></script>
</body>
</html>
