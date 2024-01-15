
document.addEventListener("scroll", function () {
   let header = document.querySelector(".navbarPrincipal");

   if (window.scrollY) {
      header.style.position = "fixed";
      header.style.transition = "top";
      header.style.width = "100%";
   } else {
      header.style.position = "static";
   }
});


