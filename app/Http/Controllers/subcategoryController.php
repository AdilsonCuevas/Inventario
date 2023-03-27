<?php

namespace App\Http\Controllers;
use App\Models\subcategory;
use Illuminate\Http\Request;

class subcategoryController extends Controller
{
    public function editar(Request $request) {
        if ($request->get('status') == "on"){
            $stado =TRUE;
        }else {
            $stado = FALSE;
        }
        DB::table('subcategorias')->where('id', $request->get('id'))->update([
            'name_subcategory' => $request->get('name'),
            'category' => $request->get('category'),
            'status' => $stado
        ]);
        return redirect()->back();
    }

    public function eliminar($id) {
        subcategory::destroy($id);
        return redirect()->back();
    }

    public function guardar(Request $request) {
        if ($request->get('status') == "on"){
            $stado =TRUE;
        }else {
            $stado = FALSE;
        }
        subcategory::create([
            'name_subcategory' => $request->get('name'),
            'category' => $request->get('category'),
            'status' => $stado
        ]);
        return redirect()->back();
    }
}
