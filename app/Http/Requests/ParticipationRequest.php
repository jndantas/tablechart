<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipationRequest extends FormRequest
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
        switch($this->method())
        {
            case 'GET':
                break;
            case 'DELETE':
                break;
            case 'POST':
            {
                return [
                    'first_name'=> 'required|min:3',
                    'last_name'=> 'required|min:3',
                    'value'=> 'required'
                ];
                break;
            }
            case 'PUT':
                return [
                    'first_name'=> 'required|min:3',
                    'last_name'=> 'required|min:3',
                    'participation'=> 'required'
                ];
                break;
            case 'PATCH':
                break;
            default:
            break;
        }
    }

    public function messages(){
        return [
        'first_name.required' => 'Por favor insira o Nome',
        'first_name.min' => 'O campo nome deve conter mais de 3 caracteres.',
        'last_name.required' => 'Por favor insira o Sobrenome',
        'last_name.min' => 'O campo nome deve conter mais de 3 caracteres.',
        'participation.required' => 'Por favor insira o valor da porcentagem de participação'

        ];
    }
}
