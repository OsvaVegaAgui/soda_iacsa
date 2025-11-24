

$(document).ready(function() {
    // Inicializar el selector de fecha
    flatpickr("#fecha", {
        dateFormat: "Y-m-d",
        defaultDate: "today",
        locale: "es"
    });

    // Contador para los detalles
    let contadorDetalles = 0;

    // Inicializar Select2 para la búsqueda remota
    const $selectorProducto = $('#selectorProducto');
    if ($selectorProducto.length) {
        $selectorProducto.select2({
            width: '100%',
            placeholder: 'Busca por nombre o código',
            allowClear: true,
            minimumInputLength: 2,
            language: {
                inputTooShort: () => 'Ingrese al menos 2 caracteres',
                noResults: () => 'Sin resultados',
                searching: () => 'Buscando...'
            },
            ajax: {
                url: window.buscarProductoUrl,
                dataType: 'json',
                delay: 300,
                data: function(params) {
                    return {
                        term: params.term || ''
                    };
                },
                processResults: function(response) {
                    if (!response.success || !Array.isArray(response.productos)) {
                        return { results: [] };
                    }

                    const resultados = response.productos.map(function(producto) {
                        return {
                            id: producto.codigo,
                            text: producto.etiqueta || `${producto.nombre} - ${producto.codigo}`,
                            producto: producto
                        };
                    });

                    return { results: resultados };
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo cargar el listado de productos',
                        confirmButtonText: 'Aceptar'
                    });
                }
            }
        });

        $selectorProducto.on('select2:select', function(e) {
            const data = e.params.data;
            if (data && data.producto) {
                agregarProductoDesdeBusqueda(data.producto);
                $selectorProducto.val(null).trigger('change');
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
                           placeholder="Nombre del producto" readonly>
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