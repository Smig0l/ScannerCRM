<?php

namespace App\Http\Controllers;

use App\Models\Scansioni;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class ScansioniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('scansioni.index', [
            'scansioni' => Scansioni::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('scansioni.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        
        $validated = $request->validate([
            'codice_articolo' => 'required|string|max:255',
            'quantita_rilevata' => 'required|numeric|max:9999999999.99',
        ]);
 
        // Create a new instance of Scansioni and set its attributes
        $scansione = new Scansioni;
        $scansione->codice_articolo = $validated['codice_articolo'];
        $scansione->quantita_rilevata = $validated['quantita_rilevata'];

        $scansione->save(); // Save the model to the database
 
        return redirect(route('scansioni.index'));
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
    public function destroy($id): RedirectResponse
    {
        $scansione = Scansioni::findOrFail($id);
    
        $scansione->delete();
    
        return redirect(route('scansioni.index'));
    }

    public function export()
    {
        $scansioni = Scansioni::all();
        $currentDateTime = date('Y-m-d_H-i-s');
        $csvFileName = "scansioni_{$currentDateTime}.csv";

        // Create a temporary CSV file
        $tempFilePath = public_path('tmp/' . $csvFileName);

        $handle = fopen($tempFilePath, 'w');

        // Add headers to the CSV file
        fputcsv($handle, ['codice_articolo', 'magazzino', 'quantita_rilevata'], ';');

        // Add data rows to the CSV file
        foreach ($scansioni as $scansione) {
            $data = [
                $scansione->codice_articolo,
                $scansione->magazzino,
                $scansione->quantita_rilevata,
            ];

            // Write the row without double quotes and separated by semicolons
            fputcsv($handle, $data, ';');
        }

        fclose($handle);

        // Create a response to download the CSV
        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($tempFilePath, $csvFileName, $headers)->deleteFileAfterSend(true);
    }
}
