<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            width: 25%;
            padding: 6px;
            vertical-align: top;
        }

        .ticket {
            border: 1px solid #000;
            border-radius: 8px;
            padding: 6px 4px;
            text-align: center;
            height: 135px; /* un poquito más alto para que ajuste bien */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .nombre {
            font-size: 13px;
            font-weight: bold;
        }

        .fecha {
            font-size: 11px;
        }

        /* CENTRAR Y FORZAR AL SVG A USAR TODO EL ANCHO */
        .barcode-container svg,
        .barcode-container img {
            width: 100% !important;      /* ocupa TODO el ancho del cuadrito */
            height: 40px !important;     /* más grande */
            display: block !important;   /* elimina espacios extra */
            margin: 0 auto;              /* centra */
        }

        .codigo-texto {
            font-size: 11px;
            margin-top: 4px;
        }
    </style>
</head>
<body>

<table>
<tr>
@foreach ($ticketsGenerados as $i => $t)

    <td>
        <div class="ticket">

            <div class="nombre">{{ ucfirst($t->nombre) }}</div>

            <div class="fecha">
                Fecha: {{ \Carbon\Carbon::parse($t->fecha)->format('d/m/Y') }}
            </div>

            <div class="barcode-container">
                {!! DNS1D::getBarcodeHTML($t->codigo, 'C128', 1.4, 45) !!}
            </div>

            <div class="codigo-texto">{{ $t->codigo }}</div>

        </div>
    </td>

    @if(($i + 1) % 4 == 0)
        </tr><tr>
    @endif

@endforeach
</tr>
</table>

</body>
</html>
