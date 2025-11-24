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

                    {{-- Campo de búsqueda rápida por código --}}
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card custom-card bg-light">
                                <div class="card-body">
                                    <h6 class="mb-3">Búsqueda Rápida por Código</h6>
                                    <div class="input-group">
                                        <input type="text" 
                                               class="form-control" 
                                               id="codigoBusqueda" 
                                               placeholder="Ingrese el código del producto y presione Enter"
                                               autocomplete="off">
                                        <button type="button" 
                                                class="btn btn-primary" 
                                                id="btnBuscarProducto">
                                            <i class="ri-search-line me-1"></i>Buscar
                                        </button>
                                    </div>
                                    <small class="text-muted">
                                        Busca en productos_soda (codigo_softland) y productos_cocina (codigo)
                                    </small>
                                </div>
                            </div>
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
                                            <th>nombre</th>
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
        
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    
    {{-- Definir URL de búsqueda de productos --}}
    <script>
        window.buscarProductoUrl = '{{route("ventas", ["accion" => "buscar-producto"])}}';
    </script>
    
    @vite('resources/assets/js/milton/crear-venta.js')
    @vite('resources/assets/js/validation.js')  



@endsection
