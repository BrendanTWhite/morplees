<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSLItemRequest;
use App\Http\Requests\UpdateSLItemRequest;
use App\Models\SLItem;

class SLItemController extends Controller
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
     * @param  \App\Http\Requests\StoreSLItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSLItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SLItem  $sLItem
     * @return \Illuminate\Http\Response
     */
    public function show(SLItem $sLItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SLItem  $sLItem
     * @return \Illuminate\Http\Response
     */
    public function edit(SLItem $sLItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSLItemRequest  $request
     * @param  \App\Models\SLItem  $sLItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSLItemRequest $request, SLItem $sLItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SLItem  $sLItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(SLItem $sLItem)
    {
        //
    }
}
