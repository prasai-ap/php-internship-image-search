<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Detection</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .preview {
            max-width: 300px;
            max-height: 300px;
            display: block;
            margin-top: 10px;
        }
        .results {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .results ul {
            list-style: none;
            padding: 0;
        }
        .results li {
            padding: 5px 0;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <h1>Image Detection</h1>
        <p>Capture a photo or upload one from your device.</p>
    </div>

    <div class="card">
        <video id="camera" autoplay playsinline></video>
        <img id="preview" class="preview" style="display:none;">
        <button class="btn" onclick="capture()">Capture Image</button>
    </div>

    <div class="divider"></div>

    <div class="card">
        <input type="file" id="fileUpload" accept="image/*">
        <img id="uploadPreview" class="preview" style="display:none;">
    </div>

    <button class="btn" onclick="sendImage()">Detect</button>

    <div class="results">
        <h2>Detected Categories:</h2>
        <ul id="detectedList"></ul>
    </div>

</div>

<script src="{{ asset('js/capturefunction.js') }}"></script>
</body>
</html>
