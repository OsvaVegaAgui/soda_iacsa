
$(document).ready(function () {
    $('#tablaDetallesVenta').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
        },
        responsive: true,
        order: [[0, 'asc']], // Ordenar por ID ascendente
        paging: false, // Desactivar paginación si hay pocos registros
        searching: false // Desactivar búsqueda en esta vista
    });
});