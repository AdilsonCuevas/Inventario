<?php

namespace App\Http\Controllers;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class categoryController extends Controller
{
    public function editar(Request $request) {
        if ($request->get('status') == "on"){
            $stado =TRUE;
        }else {
            $stado = FALSE;
        }
        DB::table('categorias')->where('id', $request->get('id'))->update([
            'name_category' => $request->get('name'),
            'status' => $stado
        ]);
        return redirect()->back();
    }

    public function eliminar($id) {
        category::destroy($id);
        return redirect()->back();
    }

    public function guardar(Request $request) {
        if ($request->get('status') == "on"){
            $stado =TRUE;
        }else {
            $stado = FALSE;
        }
        category::create([
            'name_category' => $request->get('name'),
            'status' => $stado
        ]);
        return redirect()->back();
    }
}
