<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tugas_akhir;

class Tugas_akhirController extends Controller
{
    public function index()
    {
        return view('admin.tugas_akhir');
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
    public function show(Tugas_akhir $tugas_akhir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tugas_akhir $tugas_akhir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tugas_akhir $tugas_akhir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tugas_akhir $tugas_akhir)
    {
        //
    }
}
