const MAX_WIDTH = 150; // Max width size allowed
const MAX_HEIGHT = 150; // Max height size allowed
const MAX_BYTE_SIZE = 65535; // Max file size allowed

let base64 = "";
let imageSize;

// Get the image and check if the size is not above 200*200
// Then submit the form with the new image
function sendForm() {
  let img = document.getElementById("previewDisplay");
  let uploaderForm = document.getElementById("uploaderForm");
  if ((img.src = "" || !isImageBelowSize(img, MAX_WIDTH, MAX_HEIGHT))) {
    return;
  }
  uploaderForm.submit();
}

// Check if size is below rule size, alert the user if above
function isImageBelowSize(image, MAX_WIDTH, MAX_HEIGHT) {
  //console.log("Check img size", image.width, image.height, image);
  if (image.width > MAX_WIDTH || image.height > MAX_HEIGHT) {
    alert(`Image cannot have a size above ${MAX_WIDTH}*${MAX_HEIGHT} pixels`);
    return false;
  }
  if (imageSize > MAX_BYTE_SIZE) {
    alert(`Image file cannot exceed ${MAX_BYTE_SIZE / 1024} KB`);
    return false;
  }
  return true;
}

// Handle image display and file reader
function previewFile() {
  const preview = document.querySelector("img");
  const file = document.querySelector("input[type=file]").files[0];
  const reader = new FileReader();

  // When the file reader is loaded, convert image file to base64 string
  reader.addEventListener(
    "load",
    function () {
      // Display image from its url processed by the file reader
      preview.src = reader.result;
      base64 = reader.result; //.split(",")[1]; // Keep image header

      // Put url in avatar input for upload
      var avatar = document.querySelector("#avatar");
      if (avatar) {
        avatar.value = base64;
      } else {
        console.log("No input");
      }
    },
    false
  );

  if (file) {
    reader.readAsDataURL(file);
  }
}

(() => {
  // Add click event on file reader
  document.getElementById("imageFile").addEventListener("click", () => {
    previewFile();
  });
})();
