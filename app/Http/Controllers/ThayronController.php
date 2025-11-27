<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\ProductoSoda;

class ThayronController extends Controller{
    public function resolver(Request $request, string $accion, ?string $id = null)
    {
        if ($id !== null) {
            $id = strtolower($id) === 'null' ? null : (ctype_digit($id) ? (int) $id : $id);
        }

        switch ($accion) {
            case 'crear':
                return $this->crear(); 
            case 'insertar': 
                return $this->insertar($request);
            case 'lista':
                return $this->lista();
            case 'ver-editar':
                return $this->editar($id);
            case 'editar':
                return $this->productosEditarPost($request, $id);
            case 'eliminar':
                return $this->eliminar($id);
            default:
                abort(404, 'Acción no soportada.');
        }
    }

    protected function crear()
    {
        return view('pages.productos_soda.crear');
    }

    protected function insertar(Request $request)
    {
        // Validar datos del formulario
        $validated = $request->validate([
            'nombre'       => ['required','string','max:20'],
             'precio'  => ['required','numeric','min:0'],
             'codigo_softland'      => ['required','string'],
             'codigo_barras' => ['required','numeric','min:1'],
              'activo' => 'required|in:0,1',
         ], [
             'nombre.required'       => 'El nombre del producto es obligatorio.',
             'nombre.max'            => 'El nombre no puede tener más de 20 caracteres.',
             'precio.numeric'   => 'Debe ser un número.',
             'precio.required'   => 'El precio es obligatorio.',
             'codigo_softland.required'   => 'El codigo St es obligatorio.',
             'codigo_barras.numeric'  => 'El codigo de barras debe ser numero.',
             'codigo_barras.min'  => 'Tiene que llevar minimo un numero.',
             'codigo_barras.required'  => 'El codigo de barras es obligatorio.'
         ]);

        // Crear el registro
        ProductoSoda::create($validated);

        // Si es una solicitud AJAX (fetch)
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Producto creado correctamente.',
                'redirect' => url('productos-soda/lista'),
            ]);
        }

        // Si no es AJAX (por si acaso)
        return redirect('productos-soda/lista')->with('success', 'Producto creado correctamente.');
    }

    protected function lista()
    {
        $productos = ProductoSoda::orderBy('id_producto_soda', 'asc')->get();
        return view('pages.productos_soda.lista', compact('productos'));
    }


    
     protected function editar($id)
    {
        $soda = ProductoSoda::findOrFail($id);
        return view('pages.productos_soda.editar', compact('soda'));
    }

    protected function productosEditarPost(Request $request, $id)
    {
         $validator = Validator::make($request->all(), [
             'nombre'       => ['required','string','max:20'],
             'precio'  => ['required','numeric','min:0'],
             'codigo_softland'      => ['required','string'],
             'codigo_barras' => ['required','numeric','min:1'],
              'activo' => 'required|in:0,1',
         ], [
             'nombre.required'       => 'El nombre del producto es obligatorio.',
             'nombre.max'            => 'El nombre no puede tener más de 20 caracteres.',
             'precio.numeric'   => 'Debe ser un número.',
             'codigo_barras.numeric'  => 'Debe ser un numero.',
             'codigo_barras.min'  => 'Tiene que llevar minimo un numero.',
         ]);

         if ($validator->fails()) {
             return response()->json([
                 'message' => 'Revise los campos del formulario.',
                 'errors'  => $validator->errors(),
             ], 422);
         }

        try {
            $soda = ProductoSoda::findOrFail($id);

            $soda->nombre              = $request->input('nombre');
            $soda->codigo_softland     = $request->input('codigo_softland');
            $soda->codigo_barras       = $request->input('codigo_barras');
            $soda->precio              = $request->input('precio');
            $soda->activo              = $request->input('activo');
            $soda->save();

           return response()->json([
                'ok'       => true,
                'id'       => $soda->id_producto_soda,
                'message'  => 'Producto actualizado correctamente.',
                'redirect' => url('productos-soda/lista'),
            ], 200);


        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error al actualizar el producto en la base de datos.',
                'errors'  => ['server' => [$e->getMessage()]],
            ], 500);
        }
    }

    protected function eliminar($id)
    {
        try {
            $soda = ProductoSoda::findOrFail($id);
            $soda->delete();

            return response()->json([
                'ok'      => true,
                'id'      => $id,
                'message' => 'Producto eliminado correctamente.',
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'ok'      => false,
                'message' => 'El producto indicado no existe.',
            ], 404);

        } catch (\Throwable $e) {
            return response()->json([
                'ok'      => false,
                'message' => 'Error al eliminar el producto en la base de datos.',
                'errors'  => ['server' => [$e->getMessage()]],
            ], 500);
        }
    }
}
