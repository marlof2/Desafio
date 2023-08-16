<?php

namespace App\Http\Controllers;

use App\Models\Papel;
use App\Services\papel\PapelService;
use Illuminate\Http\Request;

class PapelController extends Controller
{
    protected $papel_service;
    public function __construct(PapelService $papel_service)
    {
        $this->papel_service = $papel_service;
    }
    public function index(Request $request)
    {
        return $this->papel_service->index($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->papel_service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Papel $papel)
    {
        return $this->papel_service->show($papel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Papel $papel)
    {
        return $this->papel_service->update($request, $papel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Papel $papel)
    {
        return $this->papel_service->destroy($papel);
    }
}
