<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OsvaldoController extends Controller
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
    }

    protected function crear()
    {
        return view('pages.generar_tiquetes.crear');
    }


}