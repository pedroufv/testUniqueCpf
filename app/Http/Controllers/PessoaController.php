<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaStoreRequest;
use App\Http\Requests\PessoaUpdateRequest;
use App\Http\Resources\PessoaResource;
use App\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PessoaStoreRequest  $request
     * @return PessoaResource
     */
    public function store(PessoaStoreRequest $request)
    {
        return new PessoaResource(Pessoa::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PessoaUpdateRequest  $request
     * @param  Pessoa  $pessoa
     * @return PessoaResource
     */
    public function update(PessoaUpdateRequest $request, Pessoa $pessoa)
    {
        $pessoa->update($request->validated());

        return new PessoaResource($pessoa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
