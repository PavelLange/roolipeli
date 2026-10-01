const fileInput = document.getElementById("campaign-image");
const preview = document.getElementById("image-preview");
const uploadButton = document.querySelector(".image-upload-button");

if (fileInput) {
    fileInput.addEventListener("change", function () {
        const file = this.files[0];
        if (!file) return;

        preview.src = URL.createObjectURL(file);
        preview.hidden = false;

        uploadButton.textContent = "Change picture";

        document.querySelectorAll('input[name="default_image"]')
                .forEach(radio => radio.checked = false);
    });
}
