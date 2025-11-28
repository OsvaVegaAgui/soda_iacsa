 @extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Editar Menú de {{ ucfirst($tipo) }}
                </div>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

               <form id="formEditar" method="POST" action="{{ route('menu_admin', ['accion' => 'actualizar']) }}">
                    @csrf
                    <input type="hidden" name="tipo" value="{{ $tipo }}">

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label fw-bold">Día</label>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label fw-bold">Platillo</label>
                        </div>

                        @foreach($dias as $dia)
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" value="{{ $dia->dia }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <textarea name="menu[{{ $dia->id_desayuno ?? $dia->id_almuerzo ?? $dia->id_refrigerio }}]" class="form-control"rows="1" >{{ $dia->platillo }}</textarea>
                            </div> 
                        @endforeach
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('menu_admin', ['accion' => 'seleccionar']) }}" class="btn btn-secondary">Volver</a>
                    </div>
                </form>
            </div>

            <div class="card-footer text-muted text-center">
                Sistema de gestión de menús
            </div>
        </div>
    </div>
</div>
<div id="mensaje" style="display:none" class="alert alert-info">
    <strong id="msgTitle"></strong> <span id="msgText"></span>
</div>

@endsection
@section('scripts')
        
   @vite('resources/assets/js/stacy.js')

@endsection