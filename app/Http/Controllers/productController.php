<?php

namespace App\Http\Controllers;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productController extends Controller
{
    public function editar(Request $request) {
        if ($request->hasFile('imagen')){

            $file = $request->file('imagen');
            $file_name_new = uniqid('',true);
            $path = "$file_name_new.png";
            $actualpath ="imagens/$path";
            $file->move('imagens', $path);
        }
        else {
            $actualpath = '/imagens/th.jfif';
        }

        DB::table('productos')->where('id', $request->get('id'))->update([
            'name_product' => $request->get('name'),
            'description' => $request->get('description'),
            'imagen' => $actualpath,
            'valor' => $request->get('valor'),
            'subcategory' => $request->get('subcategory'),
            'cantidad' => $request->get('cantidad'),
        ]);
        return redirect()->back();
    }

    public function eliminar($id) {
        products::destroy($id);
        return redirect()->back();
    }

    public function guardar(Request $request) {
        if ($request->hasFile('imagen')){

            $file = $request->file('imagen');
            $file_name_new = uniqid('',true);
            $path = "$file_name_new.png";
            $actualpath ="imagens/$path";
            $file->move('imagens', $path);
        }
        else {
            $actualpath = '/imagens/th.jfif';
        }
        products::create([
            'name_product' => $request->get('name'),
            'description' => $request->get('description'),
            'imagen' => $actualpath,
            'valor' => $request->get('valor'),
            'subcategory' => $request->get('subcategory'),
            'cantidad' => $request->get('cantidad'),
        ]);
        $productos = products::all();
        $cont=0;
        foreach ($productos as $producto){
            if ($request->get('subcategory') == $producto->subcategory){
                $cont +=1;
            }
        }
        DB::table('subcategorias')->where('id', $request->get('subcategory'))->update([
            'Npruducts' => $cont
        ]);
        return redirect()->back();
    }
}
