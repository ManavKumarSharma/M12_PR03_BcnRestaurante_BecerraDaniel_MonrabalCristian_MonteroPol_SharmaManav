document.addEventListener("DOMContentLoaded", function() {
    let formIdToDelete = null; // Variable global para guardar el ID del formulario

    // Cuando se abra el modal, capturamos el ID del formulario del botón que lo activó
    const confirmModal = document.getElementById('confirmDeleteFavoriteModal');
    confirmModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // El botón que abrió el modal
        formIdToDelete = button.getAttribute('data-form-id');
    });

    // Al hacer clic en el botón de confirmar eliminación, se envía el formulario correspondiente
    const confirmDeleteFavoriteBtn = document.getElementById('confirmDeleteFavoriteBtn');
    confirmDeleteFavoriteBtn.addEventListener('click', function() {
        if(formIdToDelete) {
            document.getElementById(formIdToDelete).submit();
        }
    });
});
