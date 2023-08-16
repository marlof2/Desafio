<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

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
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function update()
    {
        return [];
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
            'email.required' => 'Logradouro é obrigatório.',
            'email.email' => 'Email inválido',
            'password.required' => 'Logradouro é obrigatório.',
        ];
    }



    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['message' => 'Erro de validação de atributo', 'error' => $validator->errors()], Response::HTTP_NOT_ACCEPTABLE));
    }
}
