<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Desayuno;

use App\Models\Almuerzo;

use App\Models\Refrigerio;

class LuisController extends Controller
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
        $desayunos = Desayuno::all();

        $almuerzos = Almuerzo::all();

        $refrigerios = Refrigerio::all();
        
        return view('pages.menu_site.menuSemanal', compact('desayunos','almuerzos','refrigerios'));
    }


}