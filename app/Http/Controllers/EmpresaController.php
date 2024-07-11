<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Response;
use App\empresa;
use App\empresa_servicio;

class EmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $listado = empresa::all();
        
        return view('empresas.index', compact('listado'));
    }

    public function store(Request $request){
        $validData = $request->validate([
            'razon_social'     => 'required',
            'nombre_comercial' => 'required'
        ]);

        $registro = new empresa();
        $registro->razon_social     = $validData['razon_social'];
        $registro->nombre_comercial = $validData['nombre_comercial'];
        $registro->direccion        = $request['direccion'];
        $registro->telefonos        = $request['telefonos'];
        if (isset($request['estado'])) {
            $registro->estado = 1;
        }else{
            $registro->estado = 0;
        }
        $registro->save();

        if (isset($request['servicios'])) {
            foreach ($request['servicios'] as $key => $servicio) {
                $registroD = new empresa_servicio();
                $registroD->empresa_id  = $registro->id;
                $registroD->servicio_id = $servicio['servicio'];
                $registroD->valor       = $servicio['valor'];
                $registroD->dia         = $servicio['dia'];
                $registroD->estado      = 1;
                $registroD->save();
            }
        }

        $message = array(
            'message' => 'Registro almacenado con exito !!!',
            'type'    => 'success'
        );

        return redirect()->back()->with($message);
    }

    public function edit(){
        
        $arreglo_final       = [];
        $empresa             = [];
        $servicio            = [];

        $id = $_POST['id'];
        $registroId = Crypt::decrypt($id);
        $registro = empresa::findOrFail($registroId);

        $servicios = empresa_servicio::where('empresa_id', $registroId)->where('estado', 1)->get();

        // array_push($empresa, $registro);
        // array_push($servicio, $servicios);
        array_push($arreglo_final, $registro);
        array_push($arreglo_final, $servicios);
        

        return Response::json($arreglo_final);
        // return view('servicios.edit', compact('registro'));    
    }

    public function update(Request $request){
        $registroId = Crypt::decrypt($request['eid']);
        $validData = $request->validate([
            'erazon_social'     => 'required',
            'enombre_comercial' => 'required'
        ]);

        $registro = empresa::findOrFail($registroId);
        $registro->razon_social     = $validData['erazon_social'];
        $registro->nombre_comercial = $validData['enombre_comercial'];
        $registro->direccion        = $request['edireccion'];
        $registro->telefonos        = $request['etelefonos'];
        if (isset($request['eestado'])) {
            $registro->estado = 1;
        }else{
            $registro->estado = 0;
        }
        $registro->save();

        empresa_servicio::where('empresa_id', $registroId)->update(['estado' => 0]);

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
        }

        $message = array(
            'message' => 'Registro actualizado con exito !!!',
            'type'    => 'success'
        );

        return redirect()->back()->with($message);
    }
}
