@extends('layouts.master')

@section('styles')

    {{-- CSS PARA FECHA BONITA --}}
    <link rel="stylesheet" href="{{asset('build/assets/libs/flatpickr/flatpickr.min.css')}}">

    {{-- SELECT PARA BUSCAR --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <!-- CSS PARA VALIDACION DE CAMPOS -->
    <link rel="stylesheet" href="{{asset('build/assets/libs/prismjs/themes/prism-coy.min.css')}}">

@endsection

@section('content')
	
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Crear Nueva Venta
                </div>
                <div class="prism-toggle">
                    <a href="{{route('ventas', ['accion' => 'lista'])}}" class="btn btn-sm btn-primary-light">
                        <i class="ri-arrow-left-line me-1"></i>Volver a Lista
                    </a>
                </div>
            </div>
            <div class="card-body">
                {{-- Formulario para crear una nueva venta --}}
                <form id="formCrearVenta" method="POST" action="{{route('ventas', ['accion' => 'crear'])}}">
                    @csrf
                    
                    <div class="row">
                        {{-- Campo de Fecha --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha de la Venta <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control" 
                                   id="fecha" 
                                   name="fecha" 
                                   placeholder="Seleccione la fecha"
                                   required>
                            <div class="invalid-feedback">
                                Por favor seleccione una fecha
                            </div>
                        </div>

                        {{-- Campo de Usuario (se puede obtener del usuario autenticado) --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Usuario</label>
                            <input type="text" 
                                   class="form-control" 
                                   value="{{ auth()->user()->name ?? 'Usuario' }}" 
                                   disabled>
                            <small class="text-muted">El usuario actual será asignado a la venta</small>
                        </div>
                    </div>

                    {{-- Sección para agregar detalles de venta --}}
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5 class="mb-3">Detalles de la Venta</h5>
                            
                            {{-- Tabla para los detalles --}}
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tablaDetalles">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Subtotal</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyDetalles">
                                        {{-- Las filas se agregarán dinámicamente --}}
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                            <td><strong id="totalVenta">₡0.00</strong></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            {{-- Botón para agregar un nuevo detalle --}}
                            <button type="button" class="btn btn-primary mt-3" id="btnAgregarDetalle">
                                <i class="ri-add-line me-1"></i>Agregar Item
                            </button>
                        </div>
                    </div>

                    {{-- Botones de acción --}}
                    <div class="row mt-4">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-save-line me-1"></i>Guardar Venta
                            </button>
                            <a href="{{route('ventas', ['accion' => 'lista'])}}" class="btn btn-secondary">
                                <i class="ri-close-line me-1"></i>Cancelar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
        
    {{-- JS PARA FECHA BONITA --}}
    <script src="{{asset('build/assets/libs/flatpickr/flatpickr.min.js')}}"></script>
    @vite('resources/assets/js/date&time_pickers.js')

    {{-- JS PARA SELECT QUE BUSCA --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @vite('resources/assets/js/select2.js')

    <!-- JS PARA VALIDACIONES -->
    <script src="{{asset('build/assets/libs/prismjs/prism.js')}}"></script>
    @vite('resources/assets/js/prism-custom.js')
    @vite('resources/assets/js/validation.js')

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Inicializar el selector de fecha
            flatpickr("#fecha", {
                dateFormat: "Y-m-d",
                defaultDate: "today",
                locale: "es"
            });

            // Contador para los detalles
            let contadorDetalles = 0;

            // Función para agregar un nuevo detalle
            function agregarFilaDetalle() {
                contadorDetalles++;
                const nuevaFila = `
                    <tr id="fila-${contadorDetalles}">
                        <td>
                            <input type="text" 
                                   class="form-control codigo" 
                                   name="detalles[${contadorDetalles}][codigo]" 
                                   placeholder="Código del producto"
                                   required>
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
                                   placeholder="0.00"
                                   required>
                        </td>
                        <td>
                            <input type="text" 
                                   class="form-control subtotal" 
                                   readonly 
                                   value="0.00">
                            <input type="hidden" 
                                   class="subtotal-hidden" 
                                   name="detalles[${contadorDetalles}][subtotal]" 
                                   value="0.00">
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
            }

            // Agregar primera fila al cargar
            agregarFilaDetalle();

            // Evento para agregar nueva fila
            $('#btnAgregarDetalle').on('click', function() {
                agregarFilaDetalle();
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
    </script>

@endsection
