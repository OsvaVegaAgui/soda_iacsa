@extends('layouts.master')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-xl-8">
        <div class="card custom-card text-center">
            <div class="card-header">
                <h4 class="card-title">Seleccionar tipo de menú a editar</h4>
            </div>

            <div class="card-body">
                <p class="mb-4 text-muted">
                    Elige si deseas modificar el menú de Desayuno, Almuerzo o Refrigerio.
                </p>

               <div class="row justify-content-center">
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('menu_admin', ['accion' => 'editar', 'id' => 'desayuno']) }}" class="btn btn-lg btn-primary w-100">
                            Desayuno
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('menu_admin', ['accion' => 'editar', 'id' => 'almuerzo']) }}" class="btn btn-lg btn-success w-100">
                            Almuerzo
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('menu_admin', ['accion' => 'editar', 'id' => 'refrigerio']) }}" class="btn btn-lg btn-warning w-100">
                            Refrigerio
                        </a>
                    </div>
               </div>
               
            </div>

            <div class="card-footer text-muted">
                Sistema de gestión de menús
            </div>
        </div>
    </div>
</div>
@endsection
