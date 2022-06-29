<?php

namespace App\Http\Controllers;

use App\CategoriaProducto;
use Illuminate\Http\Request;
use DB;

class CategoriaProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->wantsJson()){
            $buscar = $request->buscar;
            $criterio = $request->criterio;

            try{
                if ($buscar=='') {
                    $categoria_productos = DB::table('categoria_productos as Ca')
                    ->orderBy('Ca.id','ASC')
                    ->paginate(10);
                } else {
                    $categoria_productos = DB::table('categoria_productos as Ca')
                    ->where('Ca.'.$criterio, 'like', '%'. $buscar . '%')
                    ->orderBy('Ca.id','ASC')
                    ->paginate(10);
                }
                



            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }

            return [
                'pagination' => [
                    'total' => $categoria_productos->total(),
                    'current_page' => $categoria_productos->currentPage(),
                    'per_page' => $categoria_productos->perPage(),
                    'last_page' => $categoria_productos->lastPage(),
                    'from' => $categoria_productos->firstItem(),
                    'to' => $categoria_productos->lastItem(),
                ],
                'categoria_productos' => $categoria_productos
            ];


        }else{
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->wantsJson()){

            $this->validate($request, [
                'nombre_categoria' => 'required',
                'descripcion_categoria' => 'required',
            ]);

        $categoria_producto = new CategoriaProducto();
       


            $categoria_producto->nombre_categoria = $request->nombre_categoria;
            $categoria_producto->descripcion_categoria = $request->descripcion_categoria;
            $categoria_producto->save();

            return response()->json([
                'status' => 'Muy bien!',
                'msg' => 'Categoria creada con exito',
                'code' => 2
            ],201);


        }else{
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CategoriaProducto  $categoriaProducto
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriaProducto $categoriaProducto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CategoriaProducto  $categoriaProducto
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriaProducto $categoriaProducto,Request $request, $id)
    {
        if($request->wantsJson()){

            $categoria_productos = CategoriaProducto::findOrFail($id);

            return $categoria_productos;

        }else{
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoriaProducto  $categoriaProducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->wantsJson()){

            $this->validate($request, [
                'nombre_categoria' => 'required',
                'descripcion_categoria' => 'required'
            ]);

            CategoriaProducto::find($id)->update($request->all());

        }else{
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoriaProducto  $categoriaProducto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->wantsJson()){

            $categoria_producto = CategoriaProducto::find($id);
            $categoria_producto->delete();


        }else{
            return redirect('/');
        }
    }
}
