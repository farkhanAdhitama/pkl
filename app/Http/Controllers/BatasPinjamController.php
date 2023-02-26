<?php

namespace App\Http\Controllers;

use App\Models\BatasPinjam;
use App\Http\Requests\StoreBatasPinjamRequest;
use App\Http\Requests\UpdateBatasPinjamRequest;

class BatasPinjamController extends Controller
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
     * @param  \App\Http\Requests\StoreBatasPinjamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBatasPinjamRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BatasPinjam  $batasPinjam
     * @return \Illuminate\Http\Response
     */
    public function show(BatasPinjam $batasPinjam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BatasPinjam  $batasPinjam
     * @return \Illuminate\Http\Response
     */
    public function edit(BatasPinjam $batasPinjam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBatasPinjamRequest  $request
     * @param  \App\Models\BatasPinjam  $batasPinjam
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBatasPinjamRequest $request, BatasPinjam $batasPinjam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BatasPinjam  $batasPinjam
     * @return \Illuminate\Http\Response
     */
    public function destroy(BatasPinjam $batasPinjam)
    {
        //
    }
}
