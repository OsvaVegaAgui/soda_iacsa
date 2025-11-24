
$(document).ready(function () {
    $('#tablaVentas').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
        },
        responsive: true,
        order: [[0, 'desc']] // Ordenar por ID descendente (más recientes primero)
    });
});