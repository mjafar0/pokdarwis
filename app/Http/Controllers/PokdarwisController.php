<?php

namespace App\Http\Controllers;

use App\Models\Pokdarwis;
use Illuminate\Http\Request;

class PokdarwisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.pokdarwis');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pokdarwis $pokdarwis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pokdarwis $pokdarwis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pokdarwis $pokdarwis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pokdarwis $pokdarwis)
    {
        //
    }
}
