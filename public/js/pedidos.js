document.addEventListener('DOMContentLoaded', function () {
    const costos = document.querySelectorAll('.costo');
    const cantidades = document.querySelectorAll('.cantidad');

    costos.forEach(costo => {
        costo.addEventListener('input', function () {
            const cantidad = costo.nextElementSibling;
            if (this.value.trim() !== '') {
                cantidad.required = true;
            } else {
                cantidad.required = false;
            }
        });
    });

    cantidades.forEach(cantidad => {
        cantidad.addEventListener('input', function () {
            const costo = cantidad.previousElementSibling;
            if (this.value.trim() !== '') {
                costo.required = true;
            } else {
                costo.required = false;
            }
        });
    });
});