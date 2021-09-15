const WIDTH = 200;
const HEIGHT = 200;

let base64 = "";

// Get the image and check if the size is not above 200*200
// Then submit the form with the new image
function sendForm() {
  let img = document.getElementById("previewDisplay");
  let uploaderForm = document.getElementById("uploaderForm");
  if ((img.src = "" || !isImageBelowSize(img, WIDTH, HEIGHT))) {
    return;
  }
  uploaderForm.submit();
}

// Check if size is below rule size, alert the user if above
function isImageBelowSize(image, width, height) {
  //console.log("Check img size", image.width, image.height, image);
  if (image.width > width || image.height > height) {
    alert(`Image cannot have a size above ${width}*${height} pixels`);
    return false;
  }
  return true;
}

// Handle image display and file reader
function previewFile() {
  const preview = document.querySelector("img");
  var file = document.querySelector("input[type=file]").files[0];
  var reader = new FileReader();

  // When the file reader is loaded, convert image file to base64 string
  reader.addEventListener(
    "load",
    function () {
      // Display image from its url processed by the file reader
      preview.src = reader.result;
      base64 = reader.result.split(",")[1];

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
