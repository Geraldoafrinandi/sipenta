<?php

namespace App\Http\Controllers;

use App\Models\Kaprodi;
use Illuminate\Http\Request;

class KaprodiController extends Controller
{
    public function index()
    {
        return view('admin.kaprodi');
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
    public function show(Kaprodi $kaprodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kaprodi $kaprodi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kaprodi $kaprodi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kaprodi $kaprodi)
    {
        //
    }
}
