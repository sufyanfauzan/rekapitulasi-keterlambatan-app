const image = document.getElementById("previewImage");
const input = document.getElementById("bukti_create");

input.addEventListener("change", () => {
    if (input.files.length > 0) {
        image.src = URL.createObjectURL(input.files[0]);
        image.style.display = "block";
    } else {
        image.src = "";
        image.style.display = "none";
    }
});
