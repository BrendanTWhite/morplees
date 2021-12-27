<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSLRecipeRequest;
use App\Http\Requests\UpdateSLRecipeRequest;
use App\Models\SLRecipe;

class SLRecipeController extends Controller
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
     * @param  \App\Http\Requests\StoreSLRecipeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSLRecipeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SLRecipe  $sLRecipe
     * @return \Illuminate\Http\Response
     */
    public function show(SLRecipe $sLRecipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SLRecipe  $sLRecipe
     * @return \Illuminate\Http\Response
     */
    public function edit(SLRecipe $sLRecipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSLRecipeRequest  $request
     * @param  \App\Models\SLRecipe  $sLRecipe
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSLRecipeRequest $request, SLRecipe $sLRecipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SLRecipe  $sLRecipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(SLRecipe $sLRecipe)
    {
        //
    }
}
