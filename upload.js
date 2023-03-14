const fileInput = document.getElementById('fileInput');
const uploadButton = document.getElementById('uploadButton');
const progressBar = document.getElementById('progress');

const chunkSize = 10 * 2048 * 2048; // 100 MB chunk size

uploadButton.addEventListener('click', function () {
    const file = fileInput.files[0];
    const totalChunks = Math.ceil(file.size / chunkSize);
    let currentChunk = 0;

    async function uploadChunk() {
        const start = currentChunk * chunkSize;
        const end = start + chunkSize >= file.size ? file.size : start + chunkSize;
        const chunk = file.slice(start, end);

        const formData = new FormData();
        formData.append('file', chunk);
        formData.append('fileName', file.name);
        formData.append('chunkNumber', currentChunk);
        formData.append('totalChunks', totalChunks);

        const response = await fetch('./upload.php', {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            currentChunk++;
            progressBar.value = currentChunk / totalChunks * 100;
            if (currentChunk < totalChunks) {
                uploadChunk();
                console.log('uploaded chunk '+ currentChunk);
            }
        } else {
            console.error('An error occurred while uploading the file.');
        }
    }

    uploadChunk();
});