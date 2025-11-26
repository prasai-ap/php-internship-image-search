<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vision Search - Home</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-50">

<section class="relative bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
    <div class="container mx-auto px-6 py-32 text-center">
        <h1 class="text-5xl md:text-6xl font-bold mb-6">Vision Search</h1>
        <p class="text-lg md:text-2xl mb-8">Find products instantly by capturing or uploading an image.</p>
        <a href="{{ url('/capture') }}"
           class="bg-white text-blue-600 font-semibold px-8 py-4 rounded-full shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1 hover:scale-105">
            Get Started
        </a>
    </div>
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
        <svg class="relative block w-full h-20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1200 120">
            <path d="M0,0V46.29c47.88,22,103.33,29,158.5,27.3C280,68.4,335.2,26.7,436,13.28c92.5-12,167,16.8,256,29.18,108.3,15.33,196.3-4.3,292-25.11,66.2-14,129.6-21.6,197-10.29V0Z" fill="white"></path>
        </svg>
    </div>
</section>


<section class="container mx-auto px-6 py-20">
    <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Why Choose Vision Search?</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <div class="bg-white rounded-xl shadow-md p-8 text-center transform transition hover:-translate-y-2 hover:shadow-xl">
            <svg class="mx-auto mb-4 w-12 h-12 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0a12 12 0 1012 12A12.014 12.014 0 0012 0zm0 22a10 10 0 1110-10 10.011 10.011 0 01-10 10z"/><path d="M16.59 7.41L12 12l-4.59-4.59L6 9l6 6 6-6z"/></svg>
            <h3 class="text-xl font-semibold mb-2">Capture Images</h3>
            <p class="text-gray-500">Use your device camera to capture images and find matching products instantly.</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-8 text-center transform transition hover:-translate-y-2 hover:shadow-xl">
            <svg class="mx-auto mb-4 w-12 h-12 text-indigo-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0L15.09 7.36 23 8.55 17 14.14 18.18 22 12 18.26 5.82 22 7 14.14 1 8.55 8.91 7.36z"/></svg>
            <h3 class="text-xl font-semibold mb-2">Upload Images</h3>
            <p class="text-gray-500">Easily upload images from your device to detect and find similar products.</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-8 text-center transform transition hover:-translate-y-2 hover:shadow-xl">
            <svg class="mx-auto mb-4 w-12 h-12 text-green-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0a12 12 0 1012 12A12.014 12.014 0 0012 0zm1 17.93V19a1 1 0 01-2 0v-1.07a7.003 7.003 0 01-5.95-5.95H5a1 1 0 010-2h.05a7.003 7.003 0 015.95-5.95V5a1 1 0 012 0v1.07a7.003 7.003 0 015.95 5.95H19a1 1 0 010 2h-.05a7.003 7.003 0 01-5.95 5.95z"/></svg>
            <h3 class="text-xl font-semibold mb-2">Fast Search</h3>
            <p class="text-gray-500">AI-powered detection returns matching products quickly with accurate details.</p>
        </div>
    </div>
</section>

<section class="bg-blue-600 text-white py-20">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-6">Ready to find your product?</h2>
        <a href="{{ url('/capture') }}"
           class="bg-white text-blue-600 font-semibold px-8 py-4 rounded-full shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1 hover:scale-105">
            Go to Capture Page
        </a>
    </div>
</section>

</body>
</html>
