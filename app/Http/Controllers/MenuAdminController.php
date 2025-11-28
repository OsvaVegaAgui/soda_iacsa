<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Desayuno;
use App\Models\Almuerzo;
use App\Models\Refrigerio;
use Illuminate\Support\Facades\Validator;

class MenuAdminController extends Controller
{
    public function resolver(Request $request, string $accion, ?string $id = null)
    {
        switch ($accion) {
            case 'seleccionar':
                return $this->seleccionar();

            case 'editar':
                return $this->editar($id);

            case 'actualizar':
                return $this->actualizar($request);

            default:
                abort(404, 'Acción no encontrada');
        }
    }

    protected function seleccionar()
    {
        return view('pages.menu_admin.seleccionar');
    }

    protected function editar($tipo)
    {
        switch ($tipo) {
            case 'desayuno':
                $dias = Desayuno::all();
                break;
            case 'almuerzo':
                $dias = Almuerzo::all();
                break;
            case 'refrigerio':
                $dias = Refrigerio::all();
                break;
            default:
                abort(404, 'Tipo de menú no válido');
        }

        return view('pages.menu_admin.editar', compact('dias', 'tipo'));
    }

   protected function actualizar(Request $request)
{
    // VALIDACIÓN SOLO DE CAMPOS VACÍOS
    $validator = Validator::make($request->all(), [
        'tipo' => ['required'],
        'menu' => ['required', 'array'],
        'menu.*' => ['required', 'string'], // ← CLAVE
    ], [
        'tipo.required' => 'El tipo de menú es obligatorio.',
        'menu.required' => 'Debe llenar todos los platillos.',
        'menu.array'    => 'El formato del menú no es válido.',
        'menu.*.required' => 'Los platillos no pueden estar vacíos.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Revise los campos del formulario.',
            'errors'  => $validator->errors(),
        ], 422);
    }

    $tipo = $request->input('tipo');
    $menus = $request->input('menu', []);

    switch ($tipo) {
        case 'desayuno': $model = new Desayuno(); break;
        case 'almuerzo': $model = new Almuerzo(); break;
        case 'refrigerio': $model = new Refrigerio(); break;
        default:
            return response()->json([
                'message' => 'Tipo de menú no válido.',
            ], 422);
    }

    foreach ($menus as $id => $platillo) {
        $model::where($model->getKeyName(), $id)->update([
            'platillo' => $platillo
        ]);
    }

    return response()->json([
        'ok'      => true,
        'message' => 'Menú actualizado correctamente.',
        'redirect' => route('menu_admin', ['accion' => 'seleccionar']),

    ]);
}

}