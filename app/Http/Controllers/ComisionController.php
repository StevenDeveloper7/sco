<?php

namespace App\Http\Controllers;

use App\Comision;
use Illuminate\Http\Request;
use DB;


class ComisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->wantsJson()){

            try{

            $comisiones = DB::table('comisions as C')
            ->join('solicitud_ventas as S', 'C.id_solicitud_venta', '=', 'S.id')
            ->join('usuarios as U', 'S.id_vendedor', '=', 'U.id')
            ->select('C.*', 'S.*', 'S.fecha as fecha','U.nombre_completo as nombre_vendedor')
            ->orderBy('C.id','ASC')
            ->paginate(10);

            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }

            return [
                'pagination' => [
                    'total' => $comisiones->total(),
                    'current_page' => $comisiones->currentPage(),
                    'per_page' => $comisiones->perPage(),
                    'last_page' => $comisiones->lastPage(),
                    'from' => $comisiones->firstItem(),
                    'to' => $comisiones->lastItem(),
                ],
                'comisiones' => $comisiones
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function show(Comision $comision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function edit(Comision $comision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comision $comision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comision $comision)
    {
        //
    }
}
