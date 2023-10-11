<?php

namespace App\Http\Controllers;

use App\Models\Scansioni;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScansioniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('scansioni.index', [
            'scansioni' => Scansioni::latest()->get(),
        ]);
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
    public function show(Scansioni $scansioni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Scansioni $scansioni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Scansioni $scansioni)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scansioni $scansioni)
    {
        //
    }
}
