<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\CategoriaTicket;
use App\Models\HistorialTiquetes;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class OsvaldoController extends Controller
{

   // resolver: pasar $request cuando llamás lista() y otros.
public function resolver(Request $request, string $accion, ?string $id = null)
{
    if ($id !== null) {
        $id = strtolower($id) === 'null' ? null : (ctype_digit($id) ? (int)$id : $id);
    }

    switch ($accion) {
        case 'crear':
            return $this->crear();
        case 'guardar':
            return $this->guardar($request);
        case 'lista':
            return $this->lista($request);
        case 'imprimir': // POST desde modal/form para generar PDF y guardar historial
            return $this->imprimir($request, $id);
        case 'pdf': // ver o descargar como antes si lo necesitas
            return $this->pdf($id);
        case 'ver':
            return $this->ver($id);
        default:
            abort(404);
    }
}

protected function lista(Request $request)
{
    Carbon::setLocale('es');
    $zona = 'America/Costa_Rica';

    // fecha seleccionada (POST o GET). Si no viene, usar hoy
    $fechaSeleccionada = $request->input('fecha')
        ? Carbon::parse($request->input('fecha'), $zona)
        : Carbon::now($zona);

    // obtener tickets creados (el compañero crea registros en 'ticket')
    $tickets = Ticket::with('categoria')
        ->orderBy('fecha', 'desc')
        ->get();

    // filtrar por la fecha seleccionada (solo mostrar esa fecha)
    $ticketsDia = $tickets->filter(fn($t) => $t->fecha->isSameDay($fechaSeleccionada));

    // resumen por tipo (nombre)
    $ticketsResumen = $ticketsDia->groupBy(fn($t) => $t->nombre . '|' . $t->categoria_d)
        ->map(function ($grupo) {
            $ej = $grupo->first();
            return (object)[
                'id_ticket' => $ej->id_ticket,
                'nombre' => $ej->nombre,
                'categoria' => $ej->categoria,
                'precio' => $ej->precio,
                'fecha' => $ej->fecha,
                'cantidad' => $grupo->sum('cantidad'),
            ];
        });

    return view('pages.generar_tiquetes.lista', compact(
        'ticketsResumen',
        'ticketsDia',
        'fechaSeleccionada'
    ));
}

protected function imprimir(Request $request, $id)
{
    // Validar
    $request->validate([
        'cantidad' => 'required|integer|min:1|max:1000'
    ]);

    $cantidad = (int) $request->input('cantidad', 20);

    $ticketBase = Ticket::findOrFail($id);

    // GENERAR CODIGOS USANDO LA FECHA REAL DEL TICKET
    $fechaCodigo = $ticketBase->fecha->format('Ymd'); // ← USAMOS LA FECHA DEL TICKET

    $ticketsGenerados = [];

    for ($i = 1; $i <= $cantidad; $i++) {
        $codigo = strtoupper(substr($ticketBase->nombre, 0, 3))
                . $fechaCodigo
                . str_pad($i, 3, '0', STR_PAD_LEFT);

        $ticketsGenerados[] = (object)[
            'nombre' => $ticketBase->nombre,
            'codigo' => $codigo,
            'categoria' => $ticketBase->categoria,
            'precio' => $ticketBase->precio,
            'cantidad' => 1,
            'fecha' => $ticketBase->fecha, // ← FECHA REAL, YA NO HOY
        ];
    }

    // GUARDAR HISTORIAL
    HistorialTiquetes::create([
        'id_ticket' => $ticketBase->id_ticket,
        'cantidad_impresa' => $cantidad,
        'usuario' => auth()->user()->name ?? 'Sistema',
        'fecha_impresion' => Carbon::now('America/Costa_Rica'),
    ]);

    // PDF
    $pdf = Pdf::loadView('pages.generar_tiquetes.pdf', compact('ticketsGenerados'))
              ->setPaper('a4', 'landscape');

    $nombreArchivo = "{$ticketBase->nombre}_" . Carbon::now('America/Costa_Rica')->format('Y-m-d_His') . ".pdf";

    return $pdf->download($nombreArchivo);
}



}