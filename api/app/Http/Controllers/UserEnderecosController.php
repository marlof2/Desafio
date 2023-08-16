<?php

namespace App\Http\Controllers;

use App\Models\UserEnderecos;
use App\Services\UserEndereco\UserEnderecoService;
use Illuminate\Http\Request;

class UserEnderecosController extends Controller
{
    protected $user_endereco_service;
    public function __construct(UserEnderecoService $user_endereco_service)
    {
        $this->user_endereco_service = $user_endereco_service;
    }
    public function index()
    {
    }


    public function store(Request $request)
    {
        return $this->user_endereco_service->store($request);
    }


    public function show(UserEnderecos $userEnderecos)
    {
        //
    }


    public function update(Request $request, UserEnderecos $userEnderecos)
    {
        //
    }


    public function destroy(Request $request)
    {
        return $this->user_endereco_service->destroy($request);
    }
}
