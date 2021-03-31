<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PrincipalRequest extends FormRequest
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
            'trabajador.tthdatcage' => ['required', Rule::unique('tthdat','tthdatcage')->ignore($this->programa,'tthdatcage')],
            'trabajador.tthdatncar' => 'required',
            'trabajador.tthdatcusp' => 'required',
            'pago.tthpgpsbas' => 'required|numeric',
            'trabajador.tthdattcol' => 'required',
            'trabajador.tthdattper' => 'required', 
            'trabajador.tthdattcon' => 'required', 
            'trabajador.tthdatgere' => 'required', 
            'trabajador.tthdatdepa' => 'required', 
            'trabajador.tthdattare' => 'required', 
            'trabajador.tthdatgrup' => 'required', 
            'trabajador.tthdatnive' => 'required', 
            'trabajador.tthdatcate' => 'required', 
            'trabajador.tthdatosbs' => 'required', 
            'trabajador.tthdatspen' => 'required', 
            'pago.tthpgptdes' => 'required',
            'pago.tthpgpcent' => 'required', 
            'pago.tthpgpcnta' => 'required', 
            'pago.tthpgpfpag' => 'required', 
            'bonos' => 'required|array|min:1'
        ];
    }

    public function messages()
    {
        return [
            'bonos.min' => 'Debe Registrar al menos un Bono'
        ];
    }

    public function attributes(){
        return [
            'trabajador.tthdatcage' => 'Trabajador',
            'trabajador.tthdatncar' => 'Nombre del Puesto',
            'trabajador.tthdatcusp' => 'CUSPP',
            'pago.tthpgpsbas' => 'Sueldo Basico',
            'trabajador.tthdattcol' => 'T. Colaborador',
            'trabajador.tthdattper' => 'T. Personal',
            'trabajador.tthdattcon' => 'T. Contrato',
            'trabajador.tthdatgere' => 'Gerencia',
            'trabajador.tthdatdepa' => 'Gerencia',
            'trabajador.tthdattare' => 'Gerencia',
            'trabajador.tthdatgrup' => 'Grupo',
            'trabajador.tthdatnive' => 'Nivel',
            'trabajador.tthdatcate' => 'Categoria', 
            'trabajador.tthdatosbs' => 'Oficina SBS', 
            'trabajador.tthdatspen' => 'Sistema de Pensiones', 
            'pago.tthpgptdes' => 'Tipo', 
            'pago.tthpgpcent' => 'Enitdad', 
            'pago.tthpgpcnta' => 'Cuenta Ahorros',
            'pago.tthpgpfpag' => 'Frecuencia de Pago',  
        ];
    }
}
