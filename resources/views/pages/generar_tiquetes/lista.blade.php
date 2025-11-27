@extends('layouts.master')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">
            Tickets generados - 
            {{ \Carbon\Carbon::parse($fechaSeleccionada)->translatedFormat('l, d \\d\\e F Y') }}
        </h4>

        <!-- Formulario POST para ocultar fecha en URL -->
        <form method="POST" action="{{ url('/generar-ticketes/lista') }}" id="formFecha" class="d-flex align-items-center">
            @csrf
            <input type="date" name="fecha" class="form-control form-control-sm me-2"
                   value="{{ $fechaSeleccionada->toDateString() }}" />
        </form>
    </div>

    <!-- Buscador en tiempo real -->
    <div class="mb-3">
        <input id="buscarTicket" type="text" class="form-control" 
               placeholder="Buscar por nombre, categoría o código...">
    </div>

    <!-- TABLA -->
    <div class="table-responsive">
        <table class="table table-hover" id="tablaTickets">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Acción</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($ticketsResumen as $t)
                    <tr>
                        <td>{{ ucfirst($t->nombre) }}</td>

                        <!-- CANTIDAD EDITABLE -->
                        <td class="text-center">
                            <span class="cantidad-editable"
                                data-id="{{ $t->id_ticket }}"
                                data-original="{{ $t->cantidad }}"
                                style="cursor:pointer;">
                                {{ $t->cantidad }}
                            </span>
                        </td>

                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($t->fecha)->format('d/m/Y') }}
                        </td>

                        <td class="text-center">
                            <button class="btn btn-sm btn-primary btn-imprimir"
                                    data-id="{{ $t->id_ticket }}"
                                    data-nombre="{{ $t->nombre }}">
                                Imprimir
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted">No hay tickets para esta fecha.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection



@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    /* ===============================
       AUTO-SUBMIT AL CAMBIAR FECHA
    ================================*/
    const formFecha = document.getElementById('formFecha');
    const inputFecha = formFecha.querySelector('input[name="fecha"]');

    inputFecha.addEventListener('change', () => formFecha.submit());


    /* ===============================
       BUSCADOR EN TIEMPO REAL
    ================================*/
    const buscador = document.getElementById('buscarTicket');

    buscador.addEventListener('keyup', function() {
        let value = this.value.toLowerCase();
        let filas = document.querySelectorAll('#tablaTickets tbody tr');

        filas.forEach(fila => {
            fila.style.display = fila.textContent.toLowerCase().includes(value) ? '' : 'none';
        });
    });


    /* ===============================
       EDICIÓN EN LÍNEA DE CANTIDAD
    ================================*/
    document.querySelectorAll('.cantidad-editable').forEach(span => {

        span.addEventListener('dblclick', function () {

            const valorOriginal = this.dataset.original;

            // Crear input
            const input = document.createElement('input');
            input.type = 'number';
            input.min = 1;
            input.value = valorOriginal;
            input.className = 'form-control text-center';
            input.style.width = '80px';
            input.style.margin = 'auto';

            // Reemplazar el span por el input
            this.innerHTML = '';
            this.appendChild(input);
            input.focus();


            // Guardar al presionar ENTER
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    actualizarValor(this, input.value);
                }
            });

            // Guardar al perder foco
            input.addEventListener('blur', () => {
                actualizarValor(this, input.value);
            });
        });

    });


    /* ===============================
       FUNCIÓN PARA ACTUALIZAR VALOR
    ================================*/
    function actualizarValor(span, nuevoValor) {
        if (nuevoValor === "" || nuevoValor <= 0) {
            nuevoValor = span.dataset.original; // restaurar
        }

        span.dataset.original = nuevoValor; // actualizar dataset
        span.textContent = nuevoValor;      // visualizar nuevo valor
    }



    /* ===============================
       IMPRIMIR USANDO CANTIDAD EDITADA
    ================================*/
    document.querySelectorAll('.btn-imprimir').forEach(btn => {
        btn.addEventListener('click', () => {

            const id = btn.dataset.id;

            // Buscar cantidad editada en la misma fila
            const spanCantidad = btn.closest('tr').querySelector('.cantidad-editable');
            const cantidad = spanCantidad.dataset.original;

            // Crear formulario automático
            const form = document.createElement('form');
            form.method = "POST";
            form.action = `/generar-ticketes/imprimir/${id}`;

            // CSRF token
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = "{{ csrf_token() }}";

            // Cantidad
            const inputCant = document.createElement('input');
            inputCant.type = 'hidden';
            inputCant.name = 'cantidad';
            inputCant.value = cantidad;

            form.appendChild(csrf);
            form.appendChild(inputCant);
            document.body.appendChild(form);

            form.submit();
        });
    });

});
</script>
@endsection
