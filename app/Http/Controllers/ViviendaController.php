<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;
use Response;
use App\empresa;
use App\vivienda;

class ViviendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        // $listado = vivienda::all();
        $empresas = empresa::where('estado', 1)->get();

        $listado = DB::table('viviendas')
                   ->join('empresas', 'viviendas.empresa_id', 'empresas.id')
                   ->select('viviendas.id', 'empresas.nombre_comercial', 'viviendas.direccion', 'viviendas.estado')
                   ->get();
        
        return view('viviendas.index', compact('listado', 'empresas'));
    }

    public function store(Request $request){
        $validData = $request->validate([
            'empresa_id'  => 'required',
            'direccion'   => 'required'
        ]);

        $registro = new vivienda();
        $registro->direccion        = $validData['direccion'];
        $registro->empresa_id       = $validData['empresa_id'];
        if (isset($request['estado'])) {
            $registro->estado = 1;
        }else{
            $registro->estado = 0;
        }
        $registro->save();

        // if (isset($request['personas'])) {
        //     foreach ($request['personas'] as $key => $persona) {
        //         $registroD = new empresa_servicio();
        //         $registroD->empresa_id  = $registro->id;
        //         $registroD->servicio_id = $servicio['servicio'];
        //         $registroD->valor       = $servicio['valor'];
        //         $registroD->dia         = $servicio['dia'];
        //         $registroD->estado      = 1;
        //         $registroD->save();
        //     }
        // }

        $message = array(
            'message' => 'Registro almacenado con exito !!!',
            'type'    => 'success'
        );

        return redirect()->back()->with($message);
    }

    public function edit(){
        
        $arreglo_final       = [];
        $vivienda            = [];
        $empresas            = [];

        $id = $_POST['id'];
        $registroId = Crypt::decrypt($id);
        $vivienda   = vivienda::findOrFail($registroId);
        $empresas   = empresa::all();

        // $servicios = empresa_servicio::where('empresa_id', $registroId)->where('estado', 1)->get();

        array_push($arreglo_final, $vivienda);
        array_push($arreglo_final, $empresas);
        
        return Response::json($arreglo_final);
        // return view('servicios.edit', compact('registro'));    
    }

    public function update(Request $request){
        $registroId = Crypt::decrypt($request['eid']);
        $validData = $request->validate([
            'edireccion'  => 'required',
            'eempresa_id' => 'required'
        ]);

        $registro = vivienda::findOrFail($registroId);
        $registro->direccion        = $validData['edireccion'];
        $registro->empresa_id       = $request['eempresa_id'];
        if (isset($request['eestado'])) {
            $registro->estado = 1;
        }else{
            $registro->estado = 0;
        }
        $registro->save();

        /*empresa_servicio::where('empresa_id', $registroId)->update(['estado' => 0]);

        if (isset($request['servicios'])) {
            foreach ($request['servicios'] as $key => $servicio) {
                $existe = empresa_servicio::where('empresa_id', $registroId)->where('servicio_id', $servicio['servicio'])->count();
                if ($existe == 0) {
                    $registroD = new empresa_servicio();
                }else{
                    $registroD = empresa_servicio::where('empresa_id', $registroId)->where('servicio_id', $servicio['servicio'])->first();
                }
                
                $registroD->empresa_id  = $registro->id;
                $registroD->servicio_id = $servicio['servicio'];
                $registroD->valor       = $servicio['valor'];
                $registroD->dia         = $servicio['dia'];
                $registroD->estado      = 1;
                $registroD->save();
            }
        }*/

        $message = array(
            'message' => 'Registro actualizado con exito !!!',
            'type'    => 'success'
        );

        return redirect()->back()->with($message);
    }
}
