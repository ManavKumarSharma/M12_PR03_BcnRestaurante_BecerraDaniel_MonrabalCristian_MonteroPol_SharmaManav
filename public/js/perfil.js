document.querySelector(".toggle-password").addEventListener("click", function () {
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

// Al hacer click en "Subir foto", se activa el input de archivo del formulario oculto
document.getElementById("btnSubirFoto").addEventListener("click", function() {
    document.getElementById("photoInput").click();
});

// Mostrar modal de confirmación al hacer click en "Eliminar foto"
document.getElementById("btnEliminarFoto")?.addEventListener("click", function() {
    var confirmModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    confirmModal.show();
});

// Al confirmar la eliminación en el modal, enviar el formulario
document.getElementById("confirmDeleteBtn").addEventListener("click", function() {
    document.getElementById("deletePhotoForm").submit();
});
