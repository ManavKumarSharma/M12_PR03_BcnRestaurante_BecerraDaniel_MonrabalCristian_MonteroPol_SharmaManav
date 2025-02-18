document.addEventListener("DOMContentLoaded", function() {
    // Función para activar la pestaña y hacer scroll
    function activateTabFromHash() {
        const hash = window.location.hash;
        if(hash) {
            // Busca el botón de pestaña cuyo data-bs-target coincide con el hash
            const triggerEl = document.querySelector('button[data-bs-target="' + hash + '"]');
            if(triggerEl) {
                let tab = new bootstrap.Tab(triggerEl);
                tab.show();

                // Opcional: hacer scroll hasta el elemento con el hash
                const targetEl = document.querySelector(hash);
                if(targetEl) {
                    targetEl.scrollIntoView({ behavior: 'smooth' });
                }
            }
        }
    }

    // Llama a la función al cargar la página
    activateTabFromHash();

    // Escucha el evento hashchange para cambios posteriores
    window.addEventListener('hashchange', activateTabFromHash);
});
