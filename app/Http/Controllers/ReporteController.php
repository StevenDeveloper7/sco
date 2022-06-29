<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
use Carbon\Carbon;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function prueba()
    {


      /*  $ventas = DB::table('solicitud_ventas as Sv')
                ->join('usuarios as V','V.id', '=', 'Sv.id_vendedor')
                ->join('usuarios as C','C.id', '=', 'Sv.id_cliente')
                ->select('Sv.*',
                         'V.nombre_completo as nombre_vendedor',
                         'C.nombre_completo as nombre_cliente',
                        // DB::raw("DATE_FORMAT(Sv.fecha,'%d') as day"),
                        // DB::raw("DATE_FORMAT(Sv.fecha,'%M') as month")

                         )

                //->whereYear('A.fecha','=', date($desde))
                ->whereBetween('Sv.fecha', ['2020-01-01','2020-01-20'])
                //->groupBy('month' ,'day')
                ->get();

                $comisiones = DB::table('comisions as Co')
                ->join('solicitud_ventas as Sv','Sv.id', '=', 'Co.id_solicitud_venta')
                ->join('usuarios as V','V.id', '=', 'Sv.id_vendedor')
                ->select('Co.*',
                         'V.*',
                         'Sv.fecha',
                          DB::raw("sum(Co.valor_comision) as total"),

                         )

                //->whereYear('A.fecha','=', date($desde))
                ->whereBetween('Sv.fecha', ['2020-01-01','2020-01-20'])
                ->where('V.numero_documento', 11124326754)
                ->groupBy('V.id')
                ->get();*/


                $fecha_actual = Carbon::now()->format('Y');

                $ventas_vendedor = DB::table('solicitud_ventas as Sv')

                    ->select(
                        DB::raw('sum(Sv.valor_montura + Sv.valor_lente) as total'),
                        DB::raw("DATE_FORMAT(Sv.fecha,'%M') as month")
                        )
                    ->whereYear('Sv.fecha','=', date($fecha_actual))
                    ->groupBy('month')
                    ->get();

                return $ventas_vendedor;

    }

    public function reporte_clientes(Request $request)
    {


            try{

            $clientes = DB::table('usuarios as U')
            ->join('tipo_documentos as T', 'U.id_tipo_documento', '=', 'T.id')
            //->join('estados as E', 'U.id_estado', '=', 'E.id')
            ->select('U.*', 'T.nombre as tipo_documento')
            ->where('U.id_role','=',3)
            ->orderBy('U.id','ASC')
            ->get();

            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }

            $pdf = PDF::loadView('reportes.clientes',compact('clientes'));
            return $pdf->download('document.pdf');



    }

    public function reporte_ventas(Request $request, $start, $end)
    {


        $array_fecha_desde = explode(" ", $start);

        if ($array_fecha_desde[1]=="Jan") $array_fecha_desde[1]="01";
        if ($array_fecha_desde[1]=="Feb") $array_fecha_desde[1]="02";
        if ($array_fecha_desde[1]=="Mar") $array_fecha_desde[1]="03";
        if ($array_fecha_desde[1]=="Apr") $array_fecha_desde[1]="04";
        if ($array_fecha_desde[1]=="May") $array_fecha_desde[1]="05";
        if ($array_fecha_desde[1]=="Jun") $array_fecha_desde[1]="06";
        if ($array_fecha_desde[1]=="Jul") $array_fecha_desde[1]="07";
        if ($array_fecha_desde[1]=="Aug") $array_fecha_desde[1]="08";
        if ($array_fecha_desde[1]=="Sep") $array_fecha_desde[1]="09";
        if ($array_fecha_desde[1]=="Oct") $array_fecha_desde[1]="10";
        if ($array_fecha_desde[1]=="Nov") $array_fecha_desde[1]="11";
        if ($array_fecha_desde[1]=="Dec") $array_fecha_desde[1]="12";

        $desde = $array_fecha_desde[3].'-'.$array_fecha_desde[1].'-'.$array_fecha_desde[2];


        $array_fecha_hasta = explode(" ", $end);

        if ($array_fecha_hasta[1]=="Jan") $array_fecha_hasta[1]="01";
        if ($array_fecha_hasta[1]=="Feb") $array_fecha_hasta[1]="02";
        if ($array_fecha_hasta[1]=="Mar") $array_fecha_hasta[1]="03";
        if ($array_fecha_hasta[1]=="Apr") $array_fecha_hasta[1]="04";
        if ($array_fecha_hasta[1]=="May") $array_fecha_hasta[1]="05";
        if ($array_fecha_hasta[1]=="Jun") $array_fecha_hasta[1]="06";
        if ($array_fecha_hasta[1]=="Jul") $array_fecha_hasta[1]="07";
        if ($array_fecha_hasta[1]=="Aug") $array_fecha_hasta[1]="08";
        if ($array_fecha_hasta[1]=="Sep") $array_fecha_hasta[1]="09";
        if ($array_fecha_hasta[1]=="Oct") $array_fecha_hasta[1]="10";
        if ($array_fecha_hasta[1]=="Nov") $array_fecha_hasta[1]="11";
        if ($array_fecha_hasta[1]=="Dec") $array_fecha_hasta[1]="12";

        $hasta = $array_fecha_hasta[3].'-'.$array_fecha_hasta[1].'-'.$array_fecha_hasta[2];


            try{

                $ventas = DB::table('solicitud_ventas as Sv')
                ->join('usuarios as V','V.id', '=', 'Sv.id_vendedor')
                ->join('usuarios as C','C.id', '=', 'Sv.id_cliente')
                ->join('estado_ventas as E', 'E.id', '=', 'Sv.id_estado')
                ->join('laboratorios as Lb', 'Lb.id', '=', 'Sv.id_laboratorio_bisel')
                ->leftjoin('laboratorios as L', 'Sv.id_laboratorio', '=', 'L.id')
                ->select('Sv.*',
                         'V.nombre_completo as nombre_vendedor',
                         'C.nombre_completo as nombre_cliente',
                         'E.nombre as estado',
                         'L.nombre as laboratorio',
                         'Lb.nombre as laboratorio_bisel'
                        // DB::raw("DATE_FORMAT(Sv.fecha,'%d') as day"),
                        // DB::raw("DATE_FORMAT(Sv.fecha,'%M') as month")

                         )

                //->whereYear('A.fecha','=', date($desde))
                ->whereBetween('Sv.fecha', [$desde,$hasta])
                //->groupBy('month' ,'day')
                ->get();

            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }


            $pdf = PDF::loadView('reportes.ventas',compact('ventas','desde','hasta'));
            return $pdf->download('document.pdf');



    }

    public function reporte_comisiones(Request $request, $start, $end, $documento)
    {

    if($documento == 0 ){


        $array_fecha_desde = explode(" ", $start);

        if ($array_fecha_desde[1]=="Jan") $array_fecha_desde[1]="01";
        if ($array_fecha_desde[1]=="Feb") $array_fecha_desde[1]="02";
        if ($array_fecha_desde[1]=="Mar") $array_fecha_desde[1]="03";
        if ($array_fecha_desde[1]=="Apr") $array_fecha_desde[1]="04";
        if ($array_fecha_desde[1]=="May") $array_fecha_desde[1]="05";
        if ($array_fecha_desde[1]=="Jun") $array_fecha_desde[1]="06";
        if ($array_fecha_desde[1]=="Jul") $array_fecha_desde[1]="07";
        if ($array_fecha_desde[1]=="Aug") $array_fecha_desde[1]="08";
        if ($array_fecha_desde[1]=="Sep") $array_fecha_desde[1]="09";
        if ($array_fecha_desde[1]=="Oct") $array_fecha_desde[1]="10";
        if ($array_fecha_desde[1]=="Nov") $array_fecha_desde[1]="11";
        if ($array_fecha_desde[1]=="Dec") $array_fecha_desde[1]="12";

        $desde = $array_fecha_desde[3].'-'.$array_fecha_desde[1].'-'.$array_fecha_desde[2];


        $array_fecha_hasta = explode(" ", $end);

        if ($array_fecha_hasta[1]=="Jan") $array_fecha_hasta[1]="01";
        if ($array_fecha_hasta[1]=="Feb") $array_fecha_hasta[1]="02";
        if ($array_fecha_hasta[1]=="Mar") $array_fecha_hasta[1]="03";
        if ($array_fecha_hasta[1]=="Apr") $array_fecha_hasta[1]="04";
        if ($array_fecha_hasta[1]=="May") $array_fecha_hasta[1]="05";
        if ($array_fecha_hasta[1]=="Jun") $array_fecha_hasta[1]="06";
        if ($array_fecha_hasta[1]=="Jul") $array_fecha_hasta[1]="07";
        if ($array_fecha_hasta[1]=="Aug") $array_fecha_hasta[1]="08";
        if ($array_fecha_hasta[1]=="Sep") $array_fecha_hasta[1]="09";
        if ($array_fecha_hasta[1]=="Oct") $array_fecha_hasta[1]="10";
        if ($array_fecha_hasta[1]=="Nov") $array_fecha_hasta[1]="11";
        if ($array_fecha_hasta[1]=="Dec") $array_fecha_hasta[1]="12";

        $hasta = $array_fecha_hasta[3].'-'.$array_fecha_hasta[1].'-'.$array_fecha_hasta[2];


            try{

                $comisiones = DB::table('comisions as Co')
                ->join('solicitud_ventas as Sv','Sv.id', '=', 'Co.id_solicitud_venta')
                ->join('usuarios as V','V.id', '=', 'Sv.id_vendedor')
                ->select('Co.*',
                         'V.nombre_completo as nombre_vendedor',
                         'Sv.fecha',
                        // DB::raw("DATE_FORMAT(Sv.fecha,'%d') as day"),
                        // DB::raw("DATE_FORMAT(Sv.fecha,'%M') as month")

                         )

                //->whereYear('A.fecha','=', date($desde))
                ->whereBetween('Sv.fecha', [$desde,$hasta])
                //->groupBy('month' ,'day')
                ->get();

            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }


            $pdf = PDF::loadView('reportes.comisiones',compact('comisiones','desde','hasta'));
            return $pdf->download('document.pdf');

        }else{


            $array_fecha_desde = explode(" ", $start);

        if ($array_fecha_desde[1]=="Jan") $array_fecha_desde[1]="01";
        if ($array_fecha_desde[1]=="Feb") $array_fecha_desde[1]="02";
        if ($array_fecha_desde[1]=="Mar") $array_fecha_desde[1]="03";
        if ($array_fecha_desde[1]=="Apr") $array_fecha_desde[1]="04";
        if ($array_fecha_desde[1]=="May") $array_fecha_desde[1]="05";
        if ($array_fecha_desde[1]=="Jun") $array_fecha_desde[1]="06";
        if ($array_fecha_desde[1]=="Jul") $array_fecha_desde[1]="07";
        if ($array_fecha_desde[1]=="Aug") $array_fecha_desde[1]="08";
        if ($array_fecha_desde[1]=="Sep") $array_fecha_desde[1]="09";
        if ($array_fecha_desde[1]=="Oct") $array_fecha_desde[1]="10";
        if ($array_fecha_desde[1]=="Nov") $array_fecha_desde[1]="11";
        if ($array_fecha_desde[1]=="Dec") $array_fecha_desde[1]="12";

        $desde = $array_fecha_desde[3].'-'.$array_fecha_desde[1].'-'.$array_fecha_desde[2];


        $array_fecha_hasta = explode(" ", $end);

        if ($array_fecha_hasta[1]=="Jan") $array_fecha_hasta[1]="01";
        if ($array_fecha_hasta[1]=="Feb") $array_fecha_hasta[1]="02";
        if ($array_fecha_hasta[1]=="Mar") $array_fecha_hasta[1]="03";
        if ($array_fecha_hasta[1]=="Apr") $array_fecha_hasta[1]="04";
        if ($array_fecha_hasta[1]=="May") $array_fecha_hasta[1]="05";
        if ($array_fecha_hasta[1]=="Jun") $array_fecha_hasta[1]="06";
        if ($array_fecha_hasta[1]=="Jul") $array_fecha_hasta[1]="07";
        if ($array_fecha_hasta[1]=="Aug") $array_fecha_hasta[1]="08";
        if ($array_fecha_hasta[1]=="Sep") $array_fecha_hasta[1]="09";
        if ($array_fecha_hasta[1]=="Oct") $array_fecha_hasta[1]="10";
        if ($array_fecha_hasta[1]=="Nov") $array_fecha_hasta[1]="11";
        if ($array_fecha_hasta[1]=="Dec") $array_fecha_hasta[1]="12";

        $hasta = $array_fecha_hasta[3].'-'.$array_fecha_hasta[1].'-'.$array_fecha_hasta[2];


            try{

                $comisiones = DB::table('comisions as Co')
                ->join('solicitud_ventas as Sv','Sv.id', '=', 'Co.id_solicitud_venta')
                ->join('usuarios as V','V.id', '=', 'Sv.id_vendedor')
                ->join('usuarios as C','C.id', '=', 'Sv.id_cliente')
                ->select('Co.*',
                         'V.*',
                         'C.nombre_completo as nombre_cliente',
                         'Sv.fecha',
                         'Sv.id as numero_venta'
                        // DB::raw("DATE_FORMAT(Sv.fecha,'%d') as day"),
                        // DB::raw("DATE_FORMAT(Sv.fecha,'%M') as month")

                         )

                //->whereYear('A.fecha','=', date($desde))
                ->whereBetween('Sv.fecha', [$desde,$hasta])
                ->where('V.numero_documento', $documento)
                //->groupBy('month' ,'day')
                ->get();

                $vendedor = DB::table('usuarios as U')
                ->select('U.*')
                ->where('U.numero_documento','=', $documento)
                ->first();


                $total_comisiones = DB::table('comisions as Co')
                ->join('solicitud_ventas as Sv','Sv.id', '=', 'Co.id_solicitud_venta')
                ->join('usuarios as V','V.id', '=', 'Sv.id_vendedor')
                ->where('V.numero_documento','=', $documento )
                ->sum('Co.valor_comision');



            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }


            $pdf = PDF::loadView('reportes.comisiones_vendedor',compact('comisiones','vendedor','total_comisiones','desde','hasta'));
            return $pdf->download('document.pdf');


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
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit()
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
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
