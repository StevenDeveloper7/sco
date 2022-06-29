<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
use App\FileUpload;
use Intervention\Image\Facades\Image as Image;


class UsuarioController extends Controller
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
                    $usuarios = DB::table('usuarios as U')
                    ->join('tipo_documentos as T', 'U.id_tipo_documento', '=', 'T.id')
                    ->join('estados as E', 'U.id_estado', '=', 'E.id')
                    ->join('roles as R', 'U.id_role', '=', 'R.id')
                    ->select('U.*', 'T.nombre as tipo_documento', 'E.nombre as nombre_estado', 'R.nombre as nombre_role')
                    ->where('U.id_estado','=',1)
                    ->where('U.id_role','!=',3)
                    ->orderBy('U.id','ASC')
                    ->paginate(10);
                } else {
                    $usuarios = DB::table('usuarios as U')
                    ->join('tipo_documentos as T', 'U.id_tipo_documento', '=', 'T.id')
                    ->join('estados as E', 'U.id_estado', '=', 'E.id')
                    ->join('roles as R', 'U.id_role', '=', 'R.id')
                    ->select('U.*', 'T.nombre as tipo_documento', 'E.nombre as nombre_estado', 'R.nombre as nombre_role')
                    ->where('U.id_estado','=',1)
                    ->where('U.id_role','!=',3)
                    ->where('U.'.$criterio, 'like', '%'. $buscar . '%')
                    ->orderBy('U.id','ASC')
                    ->paginate(10);
                }

            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }

            return [
                'pagination' => [
                    'total' => $usuarios->total(),
                    'current_page' => $usuarios->currentPage(),
                    'per_page' => $usuarios->perPage(),
                    'last_page' => $usuarios->lastPage(),
                    'from' => $usuarios->firstItem(),
                    'to' => $usuarios->lastItem(),
                ],
                'usuarios' => $usuarios
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
                'id_tipo_documento' => 'required',
                'numero_documento' => 'required',
                'nombre_completo' => 'required',
                'telefono' => 'required',
                'direccion' => 'required',
            ]);

            if($request->get('foto'))
            {
               $foto = $request->get('foto');
               $name = time().'.' . explode('/', explode(':', substr($foto, 0, strpos($foto, ';')))[1])[1];
               Image::make($request->get('foto'))->save(public_path('fotos/').$name);


             }

        $usuario = new Usuario();

        $validar_documento = Usuario::where('numero_documento', '=', $request->numero_documento)->first();

        $validar_correo = Usuario::where('email', '=', $request->email)->first();


        if ($validar_correo !== null) {

            return response()->json([
                'status' => 'Ocurrio un error!',
                'msg' => 'El correo ya se encuentra registrado',
                'code' => 1
            ],400);
        }

        if ($validar_documento === null) {

            $usuario->id_tipo_documento = $request->id_tipo_documento;
            $usuario->numero_documento = $request->numero_documento;
            $usuario->nombre_completo = $request->nombre_completo;
            $usuario->telefono = $request->telefono;
            $usuario->direccion = $request->direccion;
            $usuario->id_estado = $request->id_estado;
            $usuario->id_role = $request->id_role;
            $usuario->email = $request->email;
            $usuario->password = bcrypt($request->password);

            if($request->foto == null){
                $usuario->foto = 'usuario.jpg';
            }else{
                $usuario->foto = $name;
            }




            $usuario->save();

            return response()->json([
                'status' => 'Operacion concretada!',
                'msg' => 'Usuario creado satisfactoriamente',
                'code' => 2
            ],201);

        }else{

            return response()->json([
                'status' => 'Ocurrio un error!',
                'msg' => 'Ocurrio un error al crear el Usuario',
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

            $usuarios = Usuario::findOrFail($id);

            return $usuarios;

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
                'id_tipo_documento' => 'required',
                'numero_documento' => 'required',
                'nombre_completo' => 'required',
                'telefono' => 'required',
                'direccion' => 'required',
            ]);


                $usuario = Usuario::find($id);

                $usuario->id_tipo_documento = $request->id_tipo_documento;
                $usuario->numero_documento = $request->numero_documento;
                $usuario->nombre_completo = $request->nombre_completo;
                $usuario->telefono = $request->telefono;
                $usuario->direccion = $request->direccion;
                $usuario->id_estado = $request->id_estado;
                $usuario->id_role = $request->id_role;
                $usuario->email= $request->email;

                if (empty($request->password)) {
                    $usuario->password = $usuario->password;
                }else{
                    $usuario->password = bcrypt($request->password);
                }


                $usuario->save();

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

            $usuario = Usuario::find($id);
            $usuario->id_estado = 2;

            $usuario->save();

        }else{
            return redirect('/');
        }
    }
}
