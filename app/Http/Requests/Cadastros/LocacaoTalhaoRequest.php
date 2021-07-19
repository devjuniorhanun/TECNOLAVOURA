<?php

namespace App\Http\Requests\Cadastros;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class LocacaoTalhaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'safra_id' => 'required',
            'cultura_id' => 'required',
            'variedade_cultura_id' => 'required',
            'talhao_id' => 'required',
            'area_plantada' => 'required',
            'inicio_plantio' => 'required',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
