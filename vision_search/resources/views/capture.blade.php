<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Detection</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="container">

    <div class="header">
        <h1>Image Detection</h1>
        <p>Capture a photo or upload one from your device.</p>
    </div>

    
    <div class="card">
        <video id="camera" autoplay playsinline></video>
        <img id="preview" class="preview">
        <button class="btn" onclick="capture()">Capture Image</button>
    </div>

    <div class="divider"></div>


    <div class="card">
        <input type="file" id="fileUpload" accept="image/*">
        <img id="uploadPreview" class="preview">
    </div>
        <button class="btn" onclick="sendImage()">Search</button>
    

</div>

<script src="{{ asset('js/capturefunction.js') }}"></script>

</body>
</html>
