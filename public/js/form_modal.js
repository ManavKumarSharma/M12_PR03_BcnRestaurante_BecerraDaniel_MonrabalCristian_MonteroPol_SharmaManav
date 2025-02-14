document.addEventListener('DOMContentLoaded', function () {
    modalTriggers = document.querySelectorAll('[data-modal]');
    modals = document.querySelectorAll('.modal');
    closeBtns = document.querySelectorAll('.close-btn');

    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', function () {
            modalId = this.getAttribute('data-modal');
            modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'block';
                errorMessage = modal.querySelector('.text-danger');
                if (errorMessage) {
                    errorMessage.remove();
                }
            }
        });
    });

    closeBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            modal = this.closest('.modal');
            if (modal) {
                modal.style.display = 'none';
            }
        });
    });

    window.addEventListener('click', function (event) {
        modals.forEach(modal => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
});

