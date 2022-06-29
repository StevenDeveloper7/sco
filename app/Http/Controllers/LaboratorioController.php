<?php

namespace App\Http\Controllers;

use App\Laboratorio;
use Illuminate\Http\Request;
use DB;

class LaboratorioController extends Controller
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

                    $laboratorios = DB::table('laboratorios as L')
                    ->join('estados as E', 'L.id_estado', '=', 'E.id')
                    ->select('L.*', 'E.nombre as nombre_estado')
                    ->where('L.id_estado','=',1)
                    ->orderBy('L.id','ASC')
                    ->paginate(10);

                } else {

                    $laboratorios = DB::table('laboratorios as L')
                    ->join('estados as E', 'L.id_estado', '=', 'E.id')
                    ->select('L.*', 'E.nombre as nombre_estado')
                    ->where('L.id_estado','=',1)
                    ->where('L.'.$criterio, 'like', '%'. $buscar . '%')
                    ->orderBy('L.id','ASC')
                    ->paginate(10);
                }




            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }

            return [
                'pagination' => [
                    'total' => $laboratorios->total(),
                    'current_page' => $laboratorios->currentPage(),
                    'per_page' => $laboratorios->perPage(),
                    'last_page' => $laboratorios->lastPage(),
                    'from' => $laboratorios->firstItem(),
                    'to' => $laboratorios->lastItem(),
                ],
                'laboratorios' => $laboratorios
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
                'nit' => 'required',
                'nombre' => 'required',
                'telefono' => 'required',
                'direccion' => 'required',
            ]);

        $laboratorio = new Laboratorio();

        $validar_nit = Laboratorio::where('nit', '=', $request->nit)->first();

        $validar_correo = Laboratorio::where('email', '=', $request->email)->first();


        if ($validar_correo !== null) {

            return response()->json([
                'status' => 'Ocurrio un error!',
                'msg' => 'El correo ya se encuentra registrado',
                'code' => 1
            ],400);
        }

        if ($validar_nit === null) {

            $laboratorio->nit = $request->nit;
            $laboratorio->nombre = $request->nombre;
            $laboratorio->telefono = $request->telefono;
            $laboratorio->direccion = $request->direccion;
            $laboratorio->id_estado = $request->id_estado;
            $laboratorio->email= $request->email;


            $laboratorio->save();

            return response()->json([
                'status' => 'Muy bien!',
                'msg' => 'Laboratorio creado',
                'code' => 2
            ],201);

        }else{

            return response()->json([
                'status' => 'Ocurrio un error!',
                'msg' => 'Ocurrio un error al crear el laboratorio',
                'code' => 3
            ],400);
        }


        }else{
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laboratorio  $laboratorio
     * @return \Illuminate\Http\Response
     */
    public function show(Laboratorio $laboratorio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Laboratorio  $laboratorio
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if($request->wantsJson()){

            $laboratorios = Laboratorio::findOrFail($id);

            return $laboratorios;

        }else{
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laboratorio  $laboratorio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->wantsJson()){

            $this->validate($request, [
                'nit' => 'required',
                'nombre' => 'required',
                'telefono' => 'required',
                'direccion' => 'required',
            ]);

            $laboratorio = Laboratorio::find($id);

            $laboratorio->nit = $request->nit;
            $laboratorio->nombre = $request->nombre;
            $laboratorio->telefono = $request->telefono;
            $laboratorio->direccion = $request->direccion;
            $laboratorio->email = $request->email;
            $laboratorio->id_estado = $request->id_estado;

            $laboratorio->save();

        }else{
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laboratorio  $laboratorio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->wantsJson()){

            $laboratorio = Laboratorio::find($id);
            $laboratorio->id_estado = 2;

            $laboratorio->save();

        }else{
            return redirect('/');
        }
    }
}
