<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class tareaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'=>'required',
            'fechaInicio'=>'required|date',
            'fechaFin'=>'required|date',
            'estado'=>'required',
        ];
    }
    
    public function messages(){
        return[
            'nombre.required'=>'El campo nombre es requerido',

            'fechaInicio.required'=>'El campo Fecha de inicio requerido',
            'fechaInicio.date'=>'El valor en Fecha de inicio no es una fecha',

            'fechaFin.required'=>'El campo Fecha de fin es requerido',
            'fechaFin.date'=>'El valor en Fecha de fin no es una fecha',

            'estado.required'=>'El campo estado es requerido',
        ];
    }
}
