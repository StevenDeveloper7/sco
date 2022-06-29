<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SolicitudVenta;
use App\Usuario;
use App\Laboratorio;
use App\Comision;
use App\Estado_venta;
use DB;
use DateTime;

class SolicitudVentaController extends Controller
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
                    $ventas = DB::table('solicitud_ventas as V')
                    ->join('usuarios as U', 'V.id_cliente', '=', 'U.id')
                    ->join('usuarios as UV', 'V.id_vendedor', '=', 'UV.id')
                    ->join('estados as E', 'V.id_estado_venta', '=', 'E.id')
                    ->join('estado_ventas as Ev', 'V.id_estado', '=', 'Ev.id')
                    ->leftjoin('laboratorios as L', 'V.id_laboratorio', '=', 'L.id')
                    ->join('laboratorios as LB', 'V.id_laboratorio_bisel', '=', 'LB.id')
                    ->select('V.*', 'U.nombre_completo as nombre_cliente', 'UV.nombre_completo as nombre_vendedor',
                     'Ev.nombre as nombre_estado', 'LB.nombre as nombre_laboratorio_bisel', 'L.nombre as nombre_laboratorio')
                    ->where('V.id_estado_venta','=',1)
                    ->orderBy('V.id','ASC')
                    ->paginate(10);
                } else {
/*                     if ($criterio=='id_cliente') {
                        $cliente = Usuario::where('nombre_completo', 'like', '%'. $buscar . '%')
                        ->where('U.id_estado','=',1)
                        ->where('U.id_role','=',3)
                        ->orderBy('usuarios.id','ASC');

                        $id_cliente =$cliente->id;
                    } else {
                        # code...
                    } */

                    $ventas = DB::table('solicitud_ventas as V')
                    ->join('usuarios as U', 'V.id_cliente', '=', 'U.id')
                    ->join('usuarios as UV', 'V.id_vendedor', '=', 'UV.id')
                    ->join('estados as E', 'V.id_estado', '=', 'E.id')
                    ->join('estado_ventas as Ev', 'V.id_estado_venta', '=', 'Ev.id')
                    ->leftjoin('laboratorios as L', 'V.id_laboratorio', '=', 'L.id')
                    ->join('laboratorios as LB', 'V.id_laboratorio_bisel', '=', 'LB.id')
                    ->select('V.*', 'U.nombre_completo as nombre_cliente', 'UV.nombre_completo as nombre_vendedor',
                     'Ev.nombre as nombre_estado', 'LB.nombre as nombre_laboratorio_bisel', 'L.nombre as nombre_laboratorio')
                    ->where('V.id_estado','=',1)
                    ->where('V.'.$criterio, 'like', '%'. $buscar . '%')
                    ->orderBy('V.id','ASC')
                    ->paginate(10);
                }








            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }

            return [
                'pagination' => [
                    'total' => $ventas->total(),
                    'current_page' => $ventas->currentPage(),
                    'per_page' => $ventas->perPage(),
                    'last_page' => $ventas->lastPage(),
                    'from' => $ventas->firstItem(),
                    'to' => $ventas->lastItem(),
                ],
                'ventas' => $ventas
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
    public function select_cliente(Request $request)
    {
        if($request->wantsJson()){

            $clientes = Usuario::select('id', 'nombre_completo', 'id_role')
            ->where('usuarios.id_role','=',3)
            ->orderBy('id', 'asc')->get();

            return ['clientes' => $clientes];
        }else{
            return redirect('/');
        }
    }
    public function select_vendedor(Request $request)
    {
        if($request->wantsJson()){

            $vendedores = Usuario::select('id', 'nombre_completo', 'id_role')
            ->where('usuarios.id_role','=',2)
            ->orderBy('id', 'asc')->get();

            return ['vendedores' => $vendedores];
        }else{
            return redirect('/');
        }
    }
    public function select_laboratorio(Request $request)
    {
        if($request->wantsJson()){

            $laboratorios = Laboratorio::select('id', 'nombre')
            ->orderBy('id', 'asc')->get();

            return ['laboratorios' => $laboratorios];
        }else{
            return redirect('/');
        }
    }

    public function select_estado(Request $request)
    {
        if($request->wantsJson()){

            $estados = Estado_venta::select('id', 'nombre')
            ->orderBy('id', 'asc')->get();

            return ['estados' => $estados];
        }else{
            return redirect('/');
        }
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
                'id_cliente' => 'required',
                //'id_laboratorio' => 'required',
                'id_vendedor' => 'required',

            ]);

        $venta = new SolicitudVenta();



        if ($request) {

            $date = new DateTime();

            $venta->fecha = $date;
            $venta->id_cliente = $request->id_cliente;
            $venta->casillero = $request->casillero;
            $venta->gaveta = $request->gaveta;
            $venta->od_esf = $request->od_esf;
            $venta->od_cyl = $request->od_cyl;
            $venta->od_eje = $request->od_eje;
            $venta->od_add = $request->od_add;
            $venta->od_dp = $request->od_dp;
            $venta->od_af = $request->od_af;
            $venta->oi_esf = $request->oi_esf;
            $venta->oi_cyl = $request->oi_cyl;
            $venta->oi_eje = $request->oi_eje;
            $venta->oi_add = $request->oi_add;
            $venta->oi_dp = $request->oi_dp;
            $venta->oi_af = $request->oi_af;
            $venta->medidas_especiales = $request->medidas_especiales;
            $venta->tipo_lente = $request->tipo_lente;
            $venta->valor_lente = $request->valor_lente;
            $venta->comision_lente = $request->comision_lente;
            $venta->filtros_adicionales = $request->filtros_adicionales;
            $venta->id_laboratorio = $request->id_laboratorio;
            $venta->id_laboratorio_bisel = $request->id_laboratorio_bisel;
            $venta->montura = $request->montura;
            $venta->color = $request->color;
            $venta->valor_montura = $request->valor_montura;
            $venta->comision_montura = $request->comision_montura;
            $venta->id_vendedor = $request->id_vendedor;
            $venta->id_estado = $request->id_estado;
            $venta->id_estado_venta = $request->id_estado_venta;
            $venta->observaciones = $request->observaciones;
            $venta->save();

            if (($request->comision_lente) == 1) {
                $comision_lente = ($request->valor_lente) * 0.03;

                $comision = new Comision();
                $comision->id_solicitud_venta = $venta->id;
                $comision->valor_comision = $comision_lente;
                $comision->tipo_comision = "lente";
                $comision->save();
            }
            if (($request->comision_montura) == 1) {
                $comision_montura = 10000;

                $comision = new Comision();
                $comision->id_solicitud_venta = $venta->id;
                $comision->valor_comision = $comision_montura;
                $comision->tipo_comision = "montura";
                $comision->save();
            }


            return response()->json([
                'status' => 'Operacion Concretada!',
                'msg' => 'Venta Realizada satisfactoriamente',
                'code' => 2
            ],201);

        }else{

            return response()->json([
                'status' => 'Ocurrio un error!',
                'msg' => 'Ocurrio un error al realizar la Venta',
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
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if($request->wantsJson()){

            $ventas = SolicitudVenta::findOrFail($id);

            return $ventas;

        }else{
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->wantsJson()){

            $this->validate($request, [
                'id_cliente' => 'required',
                //'id_laboratorio' => 'required',
                'id_vendedor' => 'required',
            ]);


                $venta = SolicitudVenta::find($id);

                $venta->fecha = $request->fecha;
                $venta->id_cliente = $request->id_cliente;
                $venta->casillero = $request->casillero;
                $venta->gaveta = $request->gaveta;
                $venta->od_esf = $request->od_esf;
                $venta->od_cyl = $request->od_cyl;
                $venta->od_eje = $request->od_eje;
                $venta->od_add = $request->od_add;
                $venta->od_dp = $request->od_dp;
                $venta->od_af = $request->od_af;
                $venta->oi_esf = $request->oi_esf;
                $venta->oi_cyl = $request->oi_cyl;
                $venta->oi_eje = $request->oi_eje;
                $venta->oi_add = $request->oi_add;
                $venta->oi_dp = $request->oi_dp;
                $venta->oi_af = $request->oi_af;
                $venta->medidas_especiales = $request->medidas_especiales;
                $venta->tipo_lente = $request->tipo_lente;
                $venta->valor_lente = $request->valor_lente;
                $venta->comision_lente = $request->comision_lente;
                $venta->filtros_adicionales = $request->filtros_adicionales;
                $venta->id_laboratorio = $request->id_laboratorio;
                $venta->id_laboratorio_bisel = $request->id_laboratorio_bisel;
                $venta->montura = $request->montura;
                $venta->color = $request->color;
                $venta->valor_montura = $request->valor_montura;
                $venta->comision_montura = $request->comision_montura;
                $venta->id_vendedor = $request->id_vendedor;
                $venta->id_estado = $request->id_estado;
                $venta->id_estado_venta = $request->id_estado_venta;
                $venta->observaciones = $request->observaciones;



                $venta->save();

                return;

            }else{
                return redirect('/');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        if($request->wantsJson()){

            $venta = SolicitudVenta::find($id);
            $venta->id_estado_venta = 2;

            $venta->save();

        }else{
            return redirect('/');
        }
    }
}
