<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Venta;
use App\Models\DetalleVenta;

class MiltonController extends Controller
{
    /**
     * Método principal que resuelve las acciones dinámicas de ventas
     * Recibe la acción y opcionalmente un ID
     */
    public function resolver(Request $request, string $accion, ?string $id = null)
    {
        // Convertir el ID si viene como string
        if ($id !== null) {
            $id = strtolower($id) === 'null' ? null : (ctype_digit($id) ? (int) $id : $id);
        }

        // Switch para manejar las diferentes acciones
        switch ($accion) {
            case 'crear':
                // Si es POST, guardar la venta
                if ($request->isMethod('post')) {
                    return $this->guardar($request);
                }
                // Si es GET, mostrar el formulario
                return $this->crear();
            
            case 'lista':
                return $this->lista();
            
            case 'ver':
                // Ver detalles de una venta específica
                if ($id === null) {
                    return redirect()->route('ventas', ['accion' => 'lista']);
                }
                return $this->ver($id);
            
            default:
                // Si la acción no existe, redirigir a la lista
                return redirect()->route('ventas', ['accion' => 'lista']);
        }
    }

    /**
     * Muestra el formulario para crear una nueva venta
     */
    protected function crear()
    {
        return view('pages.ventas.crear');
    }

    /**
     * Guarda una nueva venta con sus detalles
     */
    protected function guardar(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'fecha' => 'required|date',
            'detalles' => 'required|array|min:1',
            'detalles.*.codigo' => 'required|string|max:50',
            'detalles.*.cantidad_vendida' => 'required|integer|min:1',
            'detalles.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        // Iniciar transacción para asegurar que todo se guarde correctamente
        try {
            DB::beginTransaction();

            // Obtener el ID del usuario autenticado o usar el primero disponible
            $userId = auth()->id();
            if (!$userId) {
                // Si no hay usuario autenticado, buscar el primer usuario disponible
                $firstUser = \App\Models\User::first();
                if ($firstUser) {
                    $userId = $firstUser->id;
                } else {
                    // Si no hay usuarios, crear uno temporal o retornar error
                    return response()->json([
                        'success' => false,
                        'message' => 'Error: No hay usuarios en la base de datos. Por favor, cree al menos un usuario primero.'
                    ], 500);
                }
            }

            // Crear la venta
            $venta = new Venta();
            $venta->fecha = $request->fecha;
            $venta->user_id = $userId;
            $venta->save();

            // Crear los detalles de la venta
            foreach ($request->detalles as $detalleData) {
                // Calcular el subtotal
                $subtotal = $detalleData['cantidad_vendida'] * $detalleData['precio_unitario'];

                $detalle = new DetalleVenta();
                $detalle->venta_id = $venta->id;
                $detalle->codigo = $detalleData['codigo'];
                $detalle->cantidad_vendida = $detalleData['cantidad_vendida'];
                $detalle->precio_unitario = $detalleData['precio_unitario'];
                $detalle->subtotal = $subtotal;
                $detalle->save();
            }

            // Confirmar la transacción
            DB::commit();

            // Retornar respuesta JSON para SweetAlert
            return response()->json([
                'success' => true,
                'message' => 'Venta guardada correctamente',
                'venta_id' => $venta->id
            ]);

        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            
            // Retornar error
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar la venta: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Muestra la lista de todas las ventas
     */
    protected function lista()
    {
        // Obtener todas las ventas con sus relaciones (usuario y detalles)
        $ventas = Venta::with(['user', 'detalles'])
            ->orderBy('fecha', 'desc')
            ->get();
        
        return view('pages.ventas.lista', compact('ventas'));
    }

    /**
     * Muestra los detalles de una venta específica
     */
    protected function ver($id)
    {
        // Buscar la venta con sus relaciones
        $venta = Venta::with(['user', 'detalles'])->find($id);
        
        // Si no existe la venta, redirigir a la lista
        if (!$venta) {
            return redirect()->route('ventas', ['accion' => 'lista'])
                ->with('error', 'Venta no encontrada');
        }
        
        return view('pages.ventas.ver', compact('venta'));
    }
}