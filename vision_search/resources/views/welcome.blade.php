<h2>Capture Image OR Upload Image</h2>

<!-- REAL-TIME CAMERA -->
<video id="camera" autoplay playsinline width="300"></video>
<br>
<button onclick="capture()">Search</button>

<!-- HIDDEN CANVAS FOR CAPTURE -->
<canvas id="canvas" style="display:none;"></canvas>

<hr>

<!-- FILE UPLOAD OPTION -->
<input type="file" id="fileUpload" accept="image/*">

<br><br>
<button onclick="sendImage()">Search</button>

<script>
let capturedFile = null;

// START CAMERA
navigator.mediaDevices.getUserMedia({ video: true })
.then(stream => {
    document.getElementById("camera").srcObject = stream;
});

// CAPTURE IMAGE
function capture() {
    const video = document.getElementById("camera");
    const canvas = document.getElementById("canvas");
    const ctx = canvas.getContext("2d");

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    ctx.drawImage(video, 0, 0);

    canvas.toBlob(blob => {
        capturedFile = new File([blob], "captured.jpg", { type: "image/jpeg" });
        alert("Image captured!");
    }, "image/jpeg");
}

// SEND IMAGE (CAPTURED OR UPLOADED)
function sendImage() {
    let fileInput = document.getElementById("fileUpload");
    let file = capturedFile ? capturedFile : fileInput.files[0];

    if (!file) {
        alert("Please capture or upload an image.");
        return;
    }

    let formData = new FormData();
    formData.append("image", file);

    fetch("/api/identify", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        console.log("Server Response:", data);
        alert("Check console for results");
    })
    .catch(err => console.error(err));
}
</script>
