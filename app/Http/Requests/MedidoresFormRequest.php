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
            'nsd_220'=>'required|numeric|max:9999999999',
            'nsd_480'=>'required|numeric|max:9999999999',
            'blanqueo'=>'required|numeric|max:9999999999',
            'calderas'=>'required|numeric|max:9999999999',
            'sulfonacion'=>'required|numeric|max:9999999999',
            'oficinas'=>'required|numeric|max:9999999999',
            'daf'=>'required|numeric|max:9999999999',
            'comby'=>'required|numeric|max:9999999999',
            'saponificacion'=>'required|numeric|max:9999999999',
            'enee_principal'=>'required|numeric|max:9999999999',
            'enee_reactivo'=>'required|numeric|max:9999999999',
            'fp'=>'required|numeric|max:9999999999',
        ];
    }
}
