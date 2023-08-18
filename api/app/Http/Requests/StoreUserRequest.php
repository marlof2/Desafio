<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|max:100',
            'cpf' => 'required|max:14',
            'email' => 'required|max:200',
        ];
    }

    public function update()
    {
        return [
            'name' => 'required|max:100',
            'cpf' => 'required|max:14',
            'email' => 'required|max:200',
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
            'name.required' => 'Logradouro é obrigatório.',
            'cpf.required' => 'Logradouro é obrigatório.',
            'email.required' => 'Logradouro é obrigatório.',
            'name.max' => 'O campo logradouro deve ter no máximo 100 caracteres.',
            'cpf.max' => 'O campo logradouro deve ter no máximo 14 caracteres.',
            'email.max' => 'O campo logradouro deve ter no máximo 200 caracteres.',
        ];
    }



    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['message' => 'Erro de validação de atributo', 'error' => $validator->errors()], Response::HTTP_NOT_ACCEPTABLE));
    }
}
