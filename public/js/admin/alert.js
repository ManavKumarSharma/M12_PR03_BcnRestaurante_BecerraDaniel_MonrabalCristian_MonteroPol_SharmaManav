function displaySweetAlert($message) {
    Swal.fire({
        icon: $message.icon,
        title: $message.title,
        text: $message.text,
        confirmButtonColor: '#e65c00'
      });
}

function askSweetAlert() {
  return new Promise((resolve) => {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#686868',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Mantener'
    }).then((result) => {
        resolve(result.isConfirmed);  // Devuelve el resultado cuando se resuelve la promesa
    });
});
}