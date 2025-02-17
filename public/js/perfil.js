document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePasswordBtn = document.querySelector(".toggle-password");
    if (togglePasswordBtn) {
      togglePasswordBtn.addEventListener("click", function () {
        let passwordInput = document.getElementById("password");
        let icon = this.querySelector("i");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        } else {
            passwordInput.type = "password";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        }
      });
    }
  
    // Click en "Subir foto" activa el input oculto
    const btnSubirFoto = document.getElementById("btnSubirFoto");
    if (btnSubirFoto) {
      btnSubirFoto.addEventListener("click", function() {
        document.getElementById("photoInput").click();
      });
    }
  
    // Confirmación para eliminar foto
    const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
    if (confirmDeleteBtn) {
      confirmDeleteBtn.addEventListener("click", function () {
        document.getElementById("deletePhotoForm").submit();
      });
    }
  });
  