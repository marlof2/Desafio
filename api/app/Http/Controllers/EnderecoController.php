<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnderecoRequest;
use App\Services\Endereco\EnderecoService;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{

    protected $endereco_service;
    public function __construct(EnderecoService $endereco_service)
    {
        $this->endereco_service = $endereco_service;
    }


    public function index(Request $request)
    {
        return $this->endereco_service->index($request);
    }


    public function store(StoreEnderecoRequest $request)
    {
        return $this->endereco_service->store($request);
    }


    public function show($id)
    {
        return $this->endereco_service->show($id);
    }


    public function update(StoreEnderecoRequest $request, $id)
    {
        return $this->endereco_service->update($request, $id);
    }


    public function destroy($id)
    {
        return $this->endereco_service->destroy($id);
    }
}
