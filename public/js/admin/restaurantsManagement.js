// Función de carga
window.onload = function() {
    // Ocultamos el loader
    document.getElementById('loader').style.display = 'none';
    // Mostramos el contenido
    document.getElementById('main').style.display = 'block';

    // Llamamos a loadTable para cargar la tabla
    loadTable();
};