document.addEventListener("DOMContentLoaded", function () {
  // Form validation
  var forms = document.querySelectorAll(".needs-validation");

  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener(
      "submit",
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add("was-validated");
      },
      false
    );
  });

  // Custom file input label
  document.querySelectorAll(".custom-file-input").forEach(function (input) {
    input.addEventListener("change", function () {
      var fileName = input.files[0].name;
      var nextSibling = input.nextElementSibling;
      nextSibling.innerText = fileName;
    });
  });

  // Smooth scroll to sections
  document.querySelectorAll(".nav-link").forEach(function (link) {
    link.addEventListener("click", function (event) {
      if (this.hash !== "") {
        event.preventDefault();
        var hash = this.hash;

        window.scrollTo({
          top: document.querySelector(hash).offsetTop,
          behavior: "smooth",
        });
      }
    });
  });

  // Auto hide alerts
  var alert = document.querySelector(".alert");
  if (alert) {
    setTimeout(function () {
      alert.style.transition = "opacity 0.5s ease-out";
      alert.style.opacity = "0";
      setTimeout(function () {
        alert.style.display = "none";
      }, 500);
    }, 3000);
  }
});
