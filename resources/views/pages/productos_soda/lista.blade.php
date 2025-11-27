
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
	
<style>
    body {
      background-color: #f4f0f9;
      color: #2e0854;
    }

    .table thead {
      background-color: #6f42c1; /* Morado principal */
      color: Black;
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #ede7f6;
    }

    .table-hover tbody tr:hover {
      background-color: #d1c4e9;
    }

    .dataTables_filter input {
      border-radius: 8px;
      border: 1px solid #6f42c1;
      padding: 5px 10px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
      background: #6f42c1 !important;
      color: white !important;
      border: none !important;
      border-radius: 5px !important;
      margin: 2px;
      padding: 4px 8px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
      background: #5a32a3 !important;
    }

    .btn-editar {
      background-color: #7b4fc9;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 6px 10px;
      transition: 0.2s;
    }
    .btn-editar:hover {
      background-color: #5d34a6;
    }

    .btn-eliminar {
      background-color: #d63384;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 6px 10px;
      transition: 0.2s;
    }
    .btn-eliminar:hover {
      background-color: #b81f6e;
    }
  </style>
</head>
<body class="p-4">

  <div class="container">
    <h2 class="mb-4 text-center">Lista de Productos</h2>

    <table id="tablaProductos" class="table table-striped table-hover align-middle text-center">
      <thead>
        <tr>
          <th>ID Producto</th>
          <th>Nombre</th>
          <th>Código Softland</th>
          <th>Código de Barras</th>
          <th>Precio</th>
          <th>Activo</th>
          <th>Editar</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody>
    @forelse ($productos as $producto)
        <tr>
            <td>{{ $producto->id_producto_soda }}</td>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->codigo_softland ?? '-' }}</td>
            <td>{{ $producto->codigo_barras ?? '-' }}</td>
            <td>₡{{ number_format($producto->precio, 2) }}</td>
            <td>
                @if ($producto->activo)
                    ✅
                @else
                    ❌
                @endif
            </td>
            <td>
                <button class="btn-editar">
                  <a href="{{ route('productos-soda', ['accion' => 'ver-editar', 'id' => $producto->id_producto_soda]) }}" >
                      <i class="bi bi-pencil-square"></i>
                  </a> 
                </button>
            </td>
            <td>
              <form method="POST"
                  action="{{ route('productos-soda', ['accion' => 'eliminar', 'id' => $producto->id_producto_soda]) }}"
                  class="form-eliminar-producto d-inline">
                  @csrf
                  <button type="submit"
                          class="btn btn-sm btn-eliminar btn-eliminar-producto"
                          data-nombre="{{ $producto->nombre }}">
                      <i class="bi bi-trash3"></i>
                  </button>
              </form>
                
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8">No hay productos registrados.</td>
        </tr>
    @endforelse
</tbody>

    </table>
  </div>

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#tablaProductos').DataTable({
      });
    });
  </script>
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
    @vite('resources/assets/js/productos-soda2.js')

@endsection
