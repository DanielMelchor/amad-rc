<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;
use Response;
use App\departamento;
use App\municipio;

class MunicipioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $listado        = DB::table('municipios as m')
                          ->join('departamentos as d', 'm.departamento_id', 'd.id')
                          ->select('d.nombre as departamento_nombre', 'm.id', 'm.nombre', 'm.estado')
                          ->get();

        $departamentos  = departamento::where('estado', 1)->get();
        
        return view('municipios.index', compact('listado', 'departamentos'));
    }

    public function store(Request $request){
        $validData = $request->validate([
            'departamento_id' => 'required',
            'nombre'          => 'required'
        ]);

        $registro = new municipio();
        $registro->departamento_id = $validData['departamento_id'];
        $registro->nombre  = $validData['nombre'];
        if (isset($request['estado'])) {
            $registro->estado = 1;
        }else{
            $registro->estado = 0;
        }
        $registro->save();

        $message = array(
            'message' => 'Registro almacenado con exito !!!',
            'type'    => 'success'
        );

        return redirect()->back()->with($message);
    }

    public function edit(){
        $id = $_POST['id'];
        $registroId = Crypt::decrypt($id);
        $registro = municipio::findOrFail($registroId);

        return Response::json($registro);
    }

    public function update(Request $request){
        $registroId = Crypt::decrypt($request['eid']);
        $validData = $request->validate([
            'edepartamento_id' => 'required',
            'enombre'          => 'required'
        ]);

        $registro = municipio::findOrFail($registroId);
        $registro->departamento_id = $validData['edepartamento_id'];
        $registro->nombre  = $validData['enombre'];
        if (isset($request['eestado'])) {
            $registro->estado = 1;
        }else{
            $registro->estado = 0;
        }
        $registro->save();

        $message = array(
            'message' => 'Registro actualizado con exito !!!',
            'type'    => 'success'
        );

        return redirect()->back()->with($message);
    }
}
