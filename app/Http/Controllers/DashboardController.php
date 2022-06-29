<?php

namespace App\Http\Controllers;

use App\Estado;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function total_clientes(Request $request)
    {
        if($request->wantsJson()){

            $total_clientes = DB::table('usuarios')
            ->select('id')
            ->where('id_role',3)
            ->count();

            return $total_clientes;

        }else{
            return redirect('/');
        }
    }

    public function total_ventas(Request $request)
    {
        if($request->wantsJson()){

            $total_ventas = DB::table('solicitud_ventas')
            ->select('id')
            ->where('id_estado_venta',3)
            ->count();

            return $total_ventas;

        }else{
            return redirect('/');
        }
    }

    public function total_vendedores(Request $request)
    {
        if($request->wantsJson()){

            $total_vendedores= DB::table('usuarios')
            ->select('id')
            ->where('id_role',2)
            ->count();

            return $total_vendedores;

        }else{
            return redirect('/');
        }
    }

    public function total_comisiones(Request $request)
    {
        if($request->wantsJson()){

            $total_comisiones = DB::table('comisions')
            ->sum('valor_comision');


            return $total_comisiones;

        }else{
            return redirect('/');
        }
    }

    public function ventas_anuales(Request $request)
    {

        if($request->wantsJson()){
            try{

                $ventas_anuales = DB::table('solicitud_ventas')
                ->select(
                    DB::raw('sum(valor_montura + valor_lente) as total'),
                    DB::raw("DATE_FORMAT(fecha,'%Y') as year")
                    )
                ->where('id_estado_venta',3)
                ->groupBy('year')
                ->get();


                }catch(QueryException $queryException){
                    return $queryException->getMessage();
                }


                return response()->json($ventas_anuales);
        }else{
            return redirect('/');
        }

    }

    public function ventas_mensuales(Request $request)
    {

        if($request->wantsJson()){
            try{

                $fecha_actual = Carbon::now()->format('Y');

                $ventas_vendedor = DB::table('solicitud_ventas as Sv')

                    ->select(
                        DB::raw('sum(Sv.valor_montura + Sv.valor_lente) as total'),
                        DB::raw("DATE_FORMAT(Sv.fecha,'%M') as month")
                        )
                    ->whereYear('Sv.fecha','=', date($fecha_actual))
                    ->groupBy('month')
                    ->get();


                }catch(QueryException $queryException){
                    return $queryException->getMessage();
                }


                return response()->json($ventas_vendedor);
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
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function show(Estado $estado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit(Estado $estado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estado $estado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estado $estado)
    {
        //
    }
}
