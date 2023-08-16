<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEnderecoRequest extends FormRequest
{
    public $id_request;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $this->id_request = $this->route('id');

        return match ($this->method()) {
            'POST' => $this->store(),
            'PUT' => $this->update(),
            'PATCH' => $this->patch(),
            default => $this->view()
        };
    }

    public function store()
    {
        return [
            'logradouro' => 'required|max:255',
            'cep' => 'required|max:8',
        ];
    }

    public function update()
    {
        return [
            'logradouro' => 'required|max:255',
            'cep' => 'required|max:8',
        ];
    }

    public function patch()
    {
        return [];
    }


    public function view()
    {
        return [];
    }


    public function messages()
    {
        return [
            'logradouro.required' => 'Logradouro é obrigatório.',
            'logradouro.max' => 'O campo logradouro deve ter no máximo 255 caracteres.',
            'cep.max' => 'O campo CEP deve ter no máximo 255 caracteres.',
            'cep.required' => 'CEP é obrigatório.',
        ];
    }



    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['message' => 'Erro de validação de atributo', 'error' => $validator->errors()], Response::HTTP_NOT_ACCEPTABLE));
    }
}
