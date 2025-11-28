@extends('layouts.master')

@section('styles')

    {{-- CSS PARA FECHA BONITA --}}
    <link rel="stylesheet" href="{{asset('build/assets/libs/flatpickr/flatpickr.min.css')}}">

    {{-- SELECT PARA BUSCAR --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <!-- CSS PARA VALIDACION DE CAMPOS -->
    <link rel="stylesheet" href="{{asset('build/assets/libs/prismjs/themes/prism-coy.min.css')}}">

    {{-- CSS PARA TABLAS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

@endsection

@section('content')
	
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Detalles de la Venta #{{ $venta->id }}
                </div>
                <div class="prism-toggle">
                    <a href="{{route('ventas', ['accion' => 'lista'])}}" class="btn btn-sm btn-primary-light">
                        <i class="ri-arrow-left-line me-1"></i>Volver a Lista
                    </a>
                </div>
            </div>
            <div class="card-body">
                {{-- Información general de la venta --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="mb-3">Información de la Venta</h6>
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">ID Venta:</th>
                                <td>{{ $venta->id }}</td>
                            </tr>
                            <tr>
                                <th>Fecha:</th>
                                <td>{{ $venta->fecha ? $venta->fecha->format('d/m/Y') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Usuario:</th>
                                <td>{{ $venta->user ? $venta->user->name : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Total Items:</th>
                                <td>{{ $venta->detalles ? $venta->detalles->count() : 0 }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-3">Resumen</h6>
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">Total Venta:</th>
                                <td class="fw-bold text-primary fs-5">
                                    ₡{{ number_format($venta->detalles ? $venta->detalles->sum('subtotal') : 0, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <th>Fecha de Creación:</th>
                                <td>{{ $venta->created_at ? $venta->created_at->format('d/m/Y H:i:s') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Última Actualización:</th>
                                <td>{{ $venta->updated_at ? $venta->updated_at->format('d/m/Y H:i:s') : 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                {{-- Tabla de detalles de la venta --}}
                <div class="row">
                    <div class="col-12">
                        <h6 class="mb-3">Detalles de la Venta</h6>
                        <div class="table-responsive">
                            <table id="tablaDetallesVenta" class="table table-striped table-hover align-middle text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Código</th>
                                        <th>Cantidad Vendida</th>
                                        <th>Precio Unitario</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($venta->detalles as $detalle)
                                        <tr>
                                            <td>{{ $detalle->id }}</td>
                                            <td>{{ $detalle->nombre_producto ?? 'N/A' }}</td>
                                            <td>{{ $detalle->codigo }}</td>
                                            <td>{{ $detalle->cantidad_vendida }}</td>
                                            <td>₡{{ number_format($detalle->precio_unitario, 2) }}</td>
                                            <td>₡{{ number_format($detalle->subtotal, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No hay detalles registrados para esta venta</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr class="fw-bold">
                                        <td colspan="4" class="text-end">TOTAL:</td>
                                        <td>₡{{ number_format($venta->detalles ? $venta->detalles->sum('subtotal') : 0, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
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

    {{-- JS PARA TABLAS --}}
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    @vite('resources/assets/js/datatables.js')
    @vite('resources/assets/js/milton/ver-venta.js')

@endsection

