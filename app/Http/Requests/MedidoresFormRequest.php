<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedidoresFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }



    public function rules()
    {
        return [
            'nsd_220'=>'required|numeric',
            'nsd_480'=>'required|numeric',
            'blanqueo'=>'required|numeric',
            'calderas'=>'required|numeric',
            'sulfonacion'=>'required|numeric',
            'oficinas'=>'required|numeric',
            'daf'=>'required|numeric',
            'comby'=>'required|numeric',
            'saponificacion'=>'required|numeric',
            'enee_principal'=>'required|numeric',
            'enee_reactivo'=>'required|numeric',
            'fp'=>'required|numeric',
        ];
    }
}
