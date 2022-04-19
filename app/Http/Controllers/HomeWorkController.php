<?php

namespace App\Http\Controllers;

use App\Http\Requests\tareaRequest;
use App\models\tareas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeWorkController extends Controller
{
    public function newHomeworkView()
    {
        return view('crearTarea');
    }
    
    public function homeworkListView ()
    {
        return view('listadoTareas');
    }
    public function newHomework(tareaRequest $request)
    {
        $data = [
            'error'=> 'on',
            'mensaje' => 'Hubo un error en el proceso'
        ];
        try{
            $tarea = new tareas();
            $tarea->nombre = $request['nombre'];
            $tarea->fechaInicio = $request['fechaInicio'];
            $tarea->fechaFin = $request['fechaFin'];
            $tarea->estado = $request['estado'];
            $tarea->idUser = Auth::user()->id;
            if($tarea->save()){
                $data['error'] = 'off';
                $data['mensaje'] = 'Se ha registrado la tarea correctamente';
            }
            return $data;
        }catch(\SoapFault $fault){
            return $data;
        }
    }
}
