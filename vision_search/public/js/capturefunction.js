let capturedFile = null;
let currentPage = 1;
let lastPage = 1;

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

    const ctx = canvas.getContext("2d");

    ctx.translate(canvas.width, 0);
    ctx.scale(-1, 1);

    ctx.drawImage(video, 0, 0);

    canvas.toBlob(blob => {
        capturedFile = new File([blob], "capture.jpg", { type: "image/jpeg" });

        const preview = document.getElementById("preview");
        preview.src = URL.createObjectURL(capturedFile);
        preview.classList.remove("hidden");

        document.getElementById("productsSection").classList.remove("hidden");
        sendImage(1);
    }, "image/jpeg");
}


document.getElementById("fileUpload").addEventListener("change", function () {
    if (this.files && this.files[0]) {
        capturedFile = this.files[0];

        const uploadPreview = document.getElementById("uploadPreview");
        uploadPreview.src = URL.createObjectURL(capturedFile);
        uploadPreview.classList.remove("hidden");

        document.getElementById("productsSection").classList.remove("hidden");
        sendImage(1);
    }
});


// Helper
function getImageSrc(path) {
    if (!path) return "";
    return path.startsWith("http") ? path : path;
}

function sendImage(page = 1) {
    if (!capturedFile) return;

    currentPage = page;
    const formData = new FormData();
    formData.append("file", capturedFile);
    formData.append("page", page);

    fetch("http://127.0.0.1:8000/api/identify", {
        method: "POST",
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            const list = document.getElementById("detectedList");
            list.innerHTML = "";

            if (data.success && data.products && data.products.length > 0) {
                data.products.forEach(product => {
                    const div = document.createElement("div");
                    div.className = "bg-gray-50 p-4 rounded-lg shadow hover:shadow-lg transition transform hover:-translate-y-1 fade-in";
                    div.innerHTML = `
                        <img src="${getImageSrc(product.prod_image)}" class="w-full h-48 object-cover rounded mb-2">
                        <h3 class="text-lg font-semibold">${product.prod_name}</h3>
                        <p class="text-gray-600">${product.parent_category_name}</p>
                    `;
                    list.appendChild(div);
                });

                // Pagination
                if (data.pagination) {
                    currentPage = data.pagination.current_page;
                    lastPage = data.pagination.last_page;

                    const paginationDiv = document.createElement("div");
                    paginationDiv.className = "col-span-full flex justify-center items-center space-x-4 mt-6";

                    if (currentPage > 1) {
                        const prevBtn = document.createElement("button");
                        prevBtn.textContent = "Previous";
                        prevBtn.className = "bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition";
                        prevBtn.onclick = () => sendImage(currentPage - 1);
                        paginationDiv.appendChild(prevBtn);
                    }

                    const pageInfo = document.createElement("span");
                    pageInfo.textContent = `Page ${currentPage} of ${lastPage}`;
                    pageInfo.className = "text-gray-700 font-semibold";
                    paginationDiv.appendChild(pageInfo);

                    if (currentPage < lastPage) {
                        const nextBtn = document.createElement("button");
                        nextBtn.textContent = "Next";
                        nextBtn.className = "bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition";
                        nextBtn.onclick = () => sendImage(currentPage + 1);
                        paginationDiv.appendChild(nextBtn);
                    }

                    list.appendChild(paginationDiv);
                }

            } else {
                list.innerHTML = '<p class="col-span-full text-center text-gray-500">No matching products found.</p>';
            }
        })
        .catch(err => {
            console.error(err);
            alert("Error sending image.");
        });
}
