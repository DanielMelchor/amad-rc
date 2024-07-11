<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Response;
use App\servicio;

class ServicioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $listado = servicio::all();
        
        return view('servicios.index', compact('listado'));
    }

    public function store(Request $request){
        $validData = $request->validate([
            'nombre' => 'required'
        ]);

        $registro = new servicio();
        $registro->nombre = $validData['nombre'];
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
        $registro = servicio::findOrFail($registroId);

        return Response::json($registro);
        // return view('servicios.edit', compact('registro'));    
    }

    public function update(Request $request){
        $registroId = Crypt::decrypt($request['eid']);
        $validData = $request->validate([
            'enombre' => 'required'
        ]);

        $registro = servicio::findOrFail($registroId);
        $registro->nombre = $validData['enombre'];
        if (isset($request['eestado'])) {
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
}
