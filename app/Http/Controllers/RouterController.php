<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouterController extends Controller
{
    public function resolver(Request $request, string $accion, ?string $id = null)
    {
        if ($id !== null) {
            $id = strtolower($id) === 'null' ? null : (ctype_digit($id) ? (int) $id : $id);
        }

        switch ($accion) {

            case 'crear':
                return $this->paisesCrearForm();

            case 'insertar':
                return $this->paisesCrearPost($request);

            case 'eliminar':
                return $this->paisesEliminar($id);

            case 'ver-editar':
                return $this->paisesEditarForm($id);
            case 'editar':
                return $this->paisesEditarPost($request, $id);

            case 'lista':
                return $this->paisesVer($id);

            case 'prueba':
                return $this->prueba();

            default:
                abort(404, 'Acción no soportada para paises.');
        }
    }

    protected function prueba()
    {
        return view('pages.paises.crear');
    }

    protected function paisesCrearForm()
    {
        return view('pages.paises.crear');
    }

    protected function paisesCrearPost(Request $request)
    {
    }

    protected function paisesEliminar($id)
    {
    }

    protected function paisesEditarForm($id)
    {
        return view('pages.paises.editar',compact('id'));
    }

    protected function paisesEditarPost(Request $request, $id)
    {
    }

    protected function paisesVer($id)
    {
    }
}
