<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Response;
use App\pais;

class PaisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $listado = pais::all();
        
        return view('paises.index', compact('listado'));
    }

    public function store(Request $request){
        $validData = $request->validate([
            'nombre'      => 'required',
            'abreviatura' => 'required',
            'codigo'      => 'required'
        ]);

        $registro = new pais();
        $registro->nombre      = $validData['nombre'];
        $registro->abreviatura = $validData['abreviatura'];
        $registro->codigo      = str_pad($validData['codigo'], 3, '0', STR_PAD_LEFT);
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
        $registro = pais::findOrFail($registroId);

        return Response::json($registro);
        // return view('puestos.edit', compact('registro'));    
    }

    public function update(Request $request){
        $registroId = Crypt::decrypt($request['eid']);
        $validData = $request->validate([
            'enombre'      => 'required',
            'eabreviatura' => 'required',
            'ecodigo'      => 'required'
        ]);

        $registro = pais::findOrFail($registroId);
        $registro->nombre      = $validData['enombre'];
        $registro->abreviatura = $validData['eabreviatura'];
        $registro->codigo      = str_pad($validData['ecodigo'], 3, '0', STR_PAD_LEFT);
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
