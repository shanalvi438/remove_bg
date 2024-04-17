const imageInput = document.getElementById('imageInput');
const previewImage = document.getElementById('previewImage');
const removeBackgroundBtn = document.getElementById('removeBackgroundBtn');

imageInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function () {
            previewImage.src = reader.result;
            removeBackgroundBtn.removeAttribute('disabled');
        }
        reader.readAsDataURL(file);
    }
});

removeBackgroundBtn.addEventListener('click', () => {

});
