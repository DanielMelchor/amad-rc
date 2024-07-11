<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Response;
use App\departamento;
use App\pais;

class DepartamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $listado = departamento::all();
        $paises  = pais::where('estado', 1)->get();
        
        return view('departamentos.index', compact('listado', 'paises'));
    }

    public function store(Request $request){
        $validData = $request->validate([
            'pais_id'     => 'required',
            'nombre'      => 'required'
        ]);

        $registro = new departamento();
        $registro->pais_id = $validData['pais_id'];
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
        $registro = departamento::findOrFail($registroId);

        return Response::json($registro);
    }

    public function update(Request $request){
        $registroId = Crypt::decrypt($request['eid']);
        $validData = $request->validate([
            'epais_id'     => 'required',
            'enombre'      => 'required'
        ]);

        $registro = departamento::findOrFail($registroId);
        $registro->pais_id = $validData['epais_id'];
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
