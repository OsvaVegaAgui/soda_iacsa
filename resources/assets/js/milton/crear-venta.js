

$(document).ready(function() {
    // Inicializar el selector de fecha
    flatpickr("#fecha", {
        dateFormat: "Y-m-d",
        defaultDate: "today",
        locale: "es"
    });

    // Contador para los detalles
    let contadorDetalles = 0;

    // Función para buscar producto por código
    function buscarProductoPorCodigo(codigo) {
        if (!codigo || codigo.trim() === '') {
            Swal.fire({
                icon: 'warning',
                title: 'Atención',
                text: 'Por favor ingrese un código',
                confirmButtonText: 'Entendido'
            });
            return;
        }

        // Mostrar loading
        Swal.fire({
            title: 'Buscando...',
            text: 'Por favor espere',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Realizar búsqueda por AJAX
        $.ajax({
            url: window.buscarProductoUrl,
            method: 'GET',
            data: { codigo: codigo.trim() },
            success: function(response) {
                Swal.close();
                
                if (response.success && response.producto) {
                    // Agregar el producto a la tabla
                    agregarProductoDesdeBusqueda(response.producto);
                    // Limpiar el campo de búsqueda
                    $('#codigoBusqueda').val('').focus();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Producto no encontrado',
                        text: response.message || 'No se encontró un producto con ese código',
                        confirmButtonText: 'Entendido'
                    });
                }
            },
            error: function(xhr) {
                Swal.close();
                let mensaje = 'Error al buscar el producto';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    mensaje = xhr.responseJSON.message;
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: mensaje,
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    }

    // Función para agregar un producto encontrado a la tabla
    function agregarProductoDesdeBusqueda(producto) {
        // Escapar valores para evitar XSS
        const codigoEscapado = $('<div>').text(producto.codigo || '').html();
        const precio = parseFloat(producto.precio) || 0;
        const precioFormateado = precio.toFixed(2);
        const nombreEscapado = $('<div>').text(producto.nombre || '').html();
        
        // Buscar si ya existe una fila con el mismo código
        let filaExistente = null;
        $('#tbodyDetalles tr').each(function() {
            const codigoFila = $(this).find('.codigo').val();
            if (codigoFila === producto.codigo) {
                filaExistente = $(this);
                return false; // Salir del each
            }
        });
        
        // Si ya existe, sumar la cantidad
        if (filaExistente && filaExistente.length > 0) {
            const cantidadInput = filaExistente.find('.cantidad');
            const cantidadActual = parseInt(cantidadInput.val()) || 0;
            const nuevaCantidad = cantidadActual + 1;
            cantidadInput.val(nuevaCantidad);
            
            // Recalcular el subtotal de esa fila
            calcularSubtotal(filaExistente);
            
            // Mostrar mensaje de actualización
            Swal.fire({
                icon: 'success',
                title: 'Cantidad actualizada',
                text: `${nombreEscapado} - Cantidad: ${nuevaCantidad}`,
                timer: 1500,
                showConfirmButton: false
            });
            return;
        }
        
        // Si no existe, agregar nueva fila
        contadorDetalles++;
        const nuevaFila = `
            <tr id="fila-${contadorDetalles}">
                <td>
                    <input type="text" 
                           class="form-control codigo" 
                           name="detalles[${contadorDetalles}][codigo]" 
                           value="${codigoEscapado}"
                           placeholder="Código del producto"
                           required>
                </td>
                <td>
                    <input type="text" 
                           class="form-control nombre readonly" 
                           name="detalles[${contadorDetalles}][nombre]" 
                           value="${nombreEscapado}"
                           placeholder="Nombre del producto" readonly disabled>
                </td>
                <td>
                    <input type="number" 
                           class="form-control cantidad" 
                           name="detalles[${contadorDetalles}][cantidad_vendida]" 
                           min="1" 
                           value="1"
                           required>
                </td>
                <td>
                    <input type="number" 
                           class="form-control precio" 
                           name="detalles[${contadorDetalles}][precio_unitario]" 
                           step="0.01" 
                           min="0" 
                           value="${precioFormateado}"
                           placeholder="0.00"
                           required>
                </td>
                <td>
                    <input type="text" 
                           class="form-control subtotal" 
                           readonly 
                           value="${precioFormateado}">
                    <input type="hidden" 
                           class="subtotal-hidden" 
                           name="detalles[${contadorDetalles}][subtotal]" 
                           value="${precioFormateado}">
                </td>
                <td>
                    <button type="button" 
                            class="btn btn-sm btn-danger btnEliminarFila" 
                            data-fila="${contadorDetalles}">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </td>
            </tr>
        `;
        $('#tbodyDetalles').append(nuevaFila);
        
        // Calcular el total
        calcularTotal();
        
        // Mostrar mensaje de éxito
        Swal.fire({
            icon: 'success',
            title: 'Producto agregado',
            text: `${nombreEscapado} - ₡${precioFormateado}`,
            timer: 1500,
            showConfirmButton: false
        });
    }

    // Evento para buscar producto al presionar Enter en el campo de búsqueda
    $('#codigoBusqueda').on('keypress', function(e) {
        if (e.which === 13) { // Enter
            e.preventDefault();
            const codigo = $(this).val();
            buscarProductoPorCodigo(codigo);
        }
    });

    // Evento para buscar producto al hacer clic en el botón
    $('#btnBuscarProducto').on('click', function() {
        const codigo = $('#codigoBusqueda').val();
        buscarProductoPorCodigo(codigo);
    });

    // Evento para eliminar fila
    $(document).on('click', '.btnEliminarFila', function() {
        const filaId = $(this).data('fila');
        $(`#fila-${filaId}`).remove();
        calcularTotal();
    });

    // Función para calcular el subtotal de una fila
    function calcularSubtotal(fila) {
        const cantidad = parseFloat($(fila).find('.cantidad').val()) || 0;
        const precio = parseFloat($(fila).find('.precio').val()) || 0;
        const subtotal = cantidad * precio;
        $(fila).find('.subtotal').val(subtotal.toFixed(2));
        // Actualizar también el campo hidden
        $(fila).find('.subtotal-hidden').val(subtotal.toFixed(2));
        calcularTotal();
    }

    // Función para calcular el total general
    function calcularTotal() {
        let total = 0;
        $('.subtotal').each(function() {
            total += parseFloat($(this).val()) || 0;
        });
        $('#totalVenta').text('₡' + total.toFixed(2));
    }

    // Eventos para calcular automáticamente
    $(document).on('input', '.cantidad, .precio', function() {
        const fila = $(this).closest('tr');
        calcularSubtotal(fila);
    });

    // Validación y envío del formulario
    $('#formCrearVenta').on('submit', function(e) {
        e.preventDefault();
        
        // Validar que haya al menos un detalle
        if ($('#tbodyDetalles tr').length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Atención',
                text: 'Debe agregar al menos un item a la venta',
                confirmButtonText: 'Entendido'
            });
            return;
        }

        // Validar que todos los campos de los detalles estén completos
        let hayErrores = false;
        $('#tbodyDetalles tr').each(function() {
            const codigo = $(this).find('.codigo').val();
            const cantidad = $(this).find('.cantidad').val();
            const precio = $(this).find('.precio').val();
            
            if (!codigo || !cantidad || !precio || cantidad <= 0 || precio <= 0) {
                hayErrores = true;
                return false;
            }
        });

        if (hayErrores) {
            Swal.fire({
                icon: 'error',
                title: 'Error de validación',
                text: 'Por favor complete todos los campos de los detalles correctamente',
                confirmButtonText: 'Entendido'
            });
            return;
        }

        // Mostrar loading
        Swal.fire({
            title: 'Guardando...',
            text: 'Por favor espere',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Obtener los datos del formulario
        const formData = new FormData(this);

        // Enviar por AJAX
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: response.message,
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        // Redirigir a la lista de ventas
                        window.location.href = '{{route("ventas", ["accion" => "lista"])}}';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Error al guardar la venta',
                        confirmButtonText: 'Aceptar'
                    });
                }
            },
            error: function(xhr) {
                let mensaje = 'Error al guardar la venta';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    mensaje = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    // Mostrar errores de validación
                    let errores = '';
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        errores += value[0] + '\n';
                    });
                    mensaje = errores;
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: mensaje,
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    });
});