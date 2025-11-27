<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RicardoController extends Controller
{

    public function resolver(Request $request, string $accion, ?string $id = null)
    {
        if ($id !== null) {
            $id = strtolower($id) === 'null' ? null : (ctype_digit($id) ? (int) $id : $id);
        }

        switch ($accion) {
            case 'crear':
                return $this->crear();
        }

        switch ($accion) {
            case 'lista':
                return $this->lista();
        }
    }

    protected function crear()
    {
        return view('pages.productos_cocina.crear');
    }

    protected function lista()
    {
        return view('pages.productos_cocina.lista');
    }


}
