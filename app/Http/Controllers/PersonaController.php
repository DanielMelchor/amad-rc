<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;
use Response;
use App\empresa;
use App\persona;
use App\persona_correo;
use App\persona_telefono;
use App\persona_vivienda;
use App\vivienda;

class PersonaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $listado = DB::table('personas')
                   ->select('id', 'cui', 'estado', 'genero', 
                    DB::raw('(CONCAT(primer_nombre, " ",
                             IFNULL(segundo_nombre,""), " ", 
                                    apellido_paterno, " ", 
                                    apellido_materno, " ", 
                                    IFNULL(apellido_casada, ""))) as nombre'))
                   ->get();

        $viviendas = vivienda::where('estado', 1)->get();
        
        return view('personas.index', compact('listado', 'viviendas'));
    }

    public function store(Request $request){
        $validData = $request->validate([
            'primer_nombre'    => 'required',
            'apellido_paterno' => 'required',
            'genero'           => 'required',
            'cui'              => 'required',
            'fecha_nacimiento' => 'required'
        ]);

        $registro = new persona();
        $registro->primer_nombre    = $validData['primer_nombre'];
        $registro->segundo_nombre   = $request['segundo_nombre'];
        $registro->apellido_paterno = $validData['apellido_paterno'];
        $registro->apellido_materno = $request['apellido_materno'];
        $registro->apellido_casada  = $request['apellido_casada'];
        $registro->fecha_nacimiento = $validData['fecha_nacimiento'];
        $registro->genero           = $request['genero'];
        $registro->cui              = $validData['cui'];
        $registro->estado           = $request['estado'];
        $registro->save();

        if (isset($request['telefonos'])) {
            foreach ($request['telefonos'] as $key => $telefono) {
                $registroT = new persona_telefono();
                $registroT->persona_id  = $registro->id;
                $registroT->tipo_numero = $telefono['tipo_telefono'];
                $registroT->codigo_area = 502;
                $registroT->numero      = $telefono['numero'];
                $registroT->estado      = $telefono['estado'];
                $registroT->save();
            }
        }

        if (isset($request['correos'])) {
            foreach ($request['correos'] as $key => $correo) {
                $registroC = new persona_correo();
                $registroC->persona_id = $registro->id;
                $registroC->email      = $correo['email'];
                $registroC->estado     = $correo['estado'];
                $registroC->save();
            }
        }

        if (isset($request['viviendas'])) {
            foreach ($request['viviendas'] as $key => $vivienda) {
                $registroV = new persona_vivienda();
                $registroV->persona_id = $registro->id;
                $registroV->vivienda_id = $vivienda['vivienda_id'];
                $registroV->tipo_persona = $vivienda['tipo'];
                $registroV->estado = $vivienda['estado'];
                $registroV->save();
            }
        }

        $message = array(
            'message' => 'Registro almacenado con exito !!!',
            'type'    => 'success'
        );

        return redirect()->back()->with($message);
    }

    public function edit(){
        $id = $_POST['id'];
        $registroId = Crypt::decrypt($id);
        $registro = persona::findOrFail($registroId);

        $telefonos = persona_telefono::where('persona_id', $registroId)->select('id', 'tipo_numero','numero', 'estado')->get();

        return response()->json([
            'registro' => $registro,
            'telefonos' => $telefonos
        ]);
    }

    public function update(Request $request){
        // dd($request);
        $validData = $request->validate([
            'eid'               => 'required',
            'eprimer_nombre'    => 'required',
            'eapellido_paterno' => 'required',
            'egenero'           => 'required',
            'ecui'              => 'required',
            'efecha_nacimiento' => 'required'
        ]);
        
        $registroId = Crypt::decrypt($validData['eid']);

        $registro = persona::findOrFail($registroId);
        $registro->primer_nombre    = $validData['eprimer_nombre'];
        $registro->segundo_nombre   = $request['esegundo_nombre'];
        $registro->apellido_paterno = $validData['eapellido_paterno'];
        $registro->apellido_materno = $request['eapellido_materno'];
        $registro->apellido_casada  = $request['eapellido_casada'];
        $registro->fecha_nacimiento = $validData['efecha_nacimiento'];
        $registro->genero           = $request['egenero'];
        $registro->cui              = $validData['ecui'];
        if (isset($request['eestado'])) {
            $registro->estado       = 1;
        }else{
            $registro->estado       = 0;
        }
        $registro->save();

        persona_telefono::where('persona_id', $registroId)->delete();

        if (isset($request['telefonos'])) {
            foreach ($request['telefonos'] as $key => $telefono) {
                $registroT = new persona_telefono();
                $registroT->persona_id  = $registro->id;
                $registroT->tipo_numero = $telefono['tipo_telefono'];
                $registroT->codigo_area = 502;
                $registroT->numero      = $telefono['numero'];
                $registroT->estado      = $telefono['estado'];
                $registroT->save();
            }
        }

        if (isset($request['correos'])) {
            foreach ($request['correos'] as $key => $correo) {
                $registroC = new persona_correo();
                $registroC->persona_id = $registro->id;
                $registroC->email      = $correo['email'];
                $registroC->estado     = $correo['estado'];
                $registroC->save();
            }
        }

        if (isset($request['viviendas'])) {
            foreach ($request['viviendas'] as $key => $vivienda) {
                $registroV = new persona_vivienda();
                $registroV->persona_id = $registro->id;
                $registroV->vivienda_id = $vivienda['vivienda_id'];
                $registroV->tipo_persona = $vivienda['tipo'];
                $registroV->estado = $vivienda['estado'];
                $registroV->save();
            }
        }
        // dd($registroId);



        $message = array(
            'message' => 'Registro actualizado con exito !!!',
            'type'    => 'success'
        );

        return redirect()->back()->with($message);
    }
}
