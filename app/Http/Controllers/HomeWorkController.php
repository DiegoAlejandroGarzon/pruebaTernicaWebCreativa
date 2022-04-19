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

    public function homeworkListDataTable(){
        $tareas = tareas::where('idUser', Auth::user()->id)->get();
        $concatenaTabla=collect([]);
        foreach($tareas as $tarea){
            $collectionTabla = collect([
                [
                    'id' => $tarea->id,
                    'nombre'=>$tarea->nombre,
                    'fechaInicio'=>$tarea->fechaInicio,
                    'fechaFin'=>$tarea->fechaFin,
                    'estado'=>$tarea->estado,
                ]
            ]);
            $concatenaTabla = $collectionTabla->concat($concatenaTabla);
        }
        return response()->json(['data'=>$concatenaTabla],200);
    }

    public function updateHomework(tareaRequest $request){
        $data = [
            'error'=> 'on',
            'mensaje' => 'Hubo un error en el proceso'
        ];
        try{
            $tarea = tareas::find($request->id);
            if($tarea->estado == "COMPLETADA" && $request['estado'] !== "COMPLETADA"){
                $data['mensaje'] = 'El estado ya no es posible cambiarse';
                return $data;
            }
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

    public function deleteHomework(Request $request){
        $data = [
            'error'=> 'on',
            'mensaje' => 'Hubo un error en el proceso'
        ];
        $tarea = tareas::find($request->id);
        if($tarea->idUser !== Auth::user()->id){
            $data['mensaje'] = 'La tarea que quieres eliminar no te pertenece';
            return $data;
        }
        if($tarea->delete()){
            $data['error'] = 'off';
            $data['mensaje'] = 'Se ha eliminado la tarea correctamente';
        }
        return $data;
    }

    public function reportStatus(){
        $tarea = tareas::where('idUser', Auth::user()->id)->get();
        $data=[
            'iniciada'=>$tarea->where('estado', 'INICIADA')->count(),
            'enProceso'=>$tarea->where('estado', 'EN PROCESO')->count(),
            'cancelada'=>$tarea->where('estado', 'CANCELADA')->count(),
            'completada'=>$tarea->where('estado', 'COMPLETADA')->count(),
        ];
        return $data;
    }
}
