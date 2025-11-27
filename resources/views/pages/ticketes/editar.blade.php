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
                        Form editar ticket
                    </div>
                </div>
                <div class="card-body">
                    <form id="formEditar" method="POST"
                    action="{{ route('ticketes-soda', ['accion' => 'editar', 'id' => $ticket->id_ticket]) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre ticket</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre" aria-label="nombre" value="{{ old('nombre', $ticket->nombre) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Codigo ticket</label>
                            <input type="text" name="codigo" id="codigo" placeholder="codigo" aria-label="codigo" value="{{ old('codigo', $ticket->codigo) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Precio ticket</label>
                            <input type="number" class="form-control" id="precio" name="precio" placeholder="precio" aria-label="precio" value="{{ old('precio', $ticket->precio) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Cantidad ticket</label>
                            <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="cantidad" aria-label="cantidad" value="{{ old('cantidad', $ticket->cantidad) }}">
                        </div>

                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text text-muted">
                                        <i class="ri-calendar-line"></i>
                                    </div>
                                    <input type="date" class="form-control" id="fecha" name="fecha" placeholder="fecha" value="{{ old('fecha', $ticket->fecha) }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="categoria" class="form-label">Categoría de ticket</label>
                            <select class=" form-select" name="categoria_id" id="categoria_id" value="{{ old('categoria_id', $ticket->categoria_id) }}">
                                @foreach ($config as $categoria)
                                    <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="categoriaInst" class="form-label">Categoría Instituto</label>
                            <select class=" form-select" name="categoriaInst" id="categoriaInst" value="{{ old('categoriaInst', $ticket->categoria_instituto_id) }}">
                                @foreach ($categoriaInstituto as $categoriainst)
                                    <option value="{{ $categoriainst->id_categoria_inst }}">{{ $categoriainst->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="card-footer d-none border-top-0">

                    </div>
                    <div class="card-footer border-top-0">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary" id="enviar">Subir</button>
                        </div>
                    </form>
                    <div style="display: none" id="mensaje" class="alert alert-info" role="alert">
                        <strong>Información</strong> almacenada satisfactoriamente.
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


    {{-- jJS PARA TABLAS --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> --}}
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

    @vite('resources/assets/js/ticket.js');

@endsection
