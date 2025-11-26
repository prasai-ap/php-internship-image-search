let capturedFile = null;

navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
        document.getElementById("camera").srcObject = stream;
    })
    .catch(err => console.error("Camera error:", err));

function capture() {
    const video = document.getElementById("camera");
    const canvas = document.createElement("canvas");
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    canvas.getContext("2d").drawImage(video, 0, 0);

    canvas.toBlob(blob => {
        capturedFile = new File([blob], "capture.jpg", { type: "image/jpeg" });
        const preview = document.getElementById("preview");
        preview.src = URL.createObjectURL(capturedFile);
        preview.style.display = "block";
    }, "image/jpeg");
}

document.getElementById("fileUpload").addEventListener("change", function () {
    if (this.files && this.files[0]) {
        capturedFile = this.files[0];
        const uploadPreview = document.getElementById("uploadPreview");
        uploadPreview.src = URL.createObjectURL(capturedFile);
        uploadPreview.style.display = "block";
    }
});

function sendImage() {
    if (!capturedFile) {
        alert("Please capture or upload an image first.");
        return;
    }

    const formData = new FormData();
    formData.append("file", capturedFile);

    fetch("http://127.0.0.1:8000/api/identify", {
        method: "POST",
        body: formData,
    })
        .then(res => res.json())
        .then(data => {
            const list = document.getElementById("detectedList");
            list.innerHTML = "";

            if (data.success) {
                const objects = data.detected_objects.categories || data.detected_objects;

                for (const [label, confidence] of Object.entries(objects)) {
                    const li = document.createElement("li");
                    li.textContent = `${label} - Confidence: ${confidence.toFixed(2)}`;
                    list.appendChild(li);
                }
            } else {
                const li = document.createElement("li");
                li.textContent = "Detection failed: " + (data.message || "Unknown error");
                list.appendChild(li);
            }
        })
        .catch(err => {
            console.error(err);
            alert("Error sending image.");
        });
}
