// remove-000webhost-watermark


window.addEventListener("load", function () {
    // Get all images on the page
    var images = document.getElementsByTagName("img");

    // Loop through each image
    for (var i = 0; i < images.length; i++) {
      // Check if the alt attribute of the image is www.000webhost.com
      if (images[i].alt === "www.000webhost.com") {
        // Set the display to none to hide the image
        images[i].style.display = "none";
      }
    }
  });
