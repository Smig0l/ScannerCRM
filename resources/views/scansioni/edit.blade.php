@extends('layouts.app')

@section('scripts')
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        //html5qrcode scanner popup https://scanapp.org/html5-qrcode-docs/docs/intro
        $( document ).ready(function() {

            const html5QrCode = new Html5Qrcode("qr-reader");
            const qrCodeSuccessCallback = (decodedText, decodedResult) => {
                // handle success 
                $('#codice_articolo').val("");
                $('#codice_articolo').val(decodedText);
                $('#qr-reader').hide();
                $('#quantita_rilevata').focus(); //FIXME: does not show keyboard automatically
            };
            const config = { fps: 10, qrbox: { width: 250, height: 100 } };
            // Force select back camera or fail with `OverconstrainedError`
            html5QrCode.start(
                { facingMode: { exact: "environment"} }, 
                config, 
                qrCodeSuccessCallback
            ).catch((err) => {
                // Display a Bootstrap alert with the error message
                const alertContainer = $('#alert-container');
                const errorMessage = err.message || 'Errore! prova a ricaricare la pagina e consenti a questo sito di accedere alla fotocamera.';
                const alertHtml = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${errorMessage}
                    </div>
                `;
                alertContainer.html(alertHtml);
             });
                
        });
    </script>
@stop

@section('headers')
    <div class="mb-5">
        <h1 class="">Modifica Scansione</h1>
        <div title="torna indietro">
            <a href="{{ url()->previous() }}" class="btn btn-danger" role="button">
                TORNA INDIETRO
            </a>
        </div>
    </div>
@stop

@section('content')

    <div id="qr-reader" style="width:300px;"></div>
    <div id="alert-container"></div>
    <input type="hidden" id="elementtofocusquantita"></input>

    <form action="{{ route('scansioni.update', $scansione->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="codice_articolo">Codice Articolo</label>
                <input type="text" name="codice_articolo" class="form-control" id="codice_articolo" value="{{ $scansione->codice_articolo }}" required>
            </div>
            <div class="form-group col-md-6">
                <label for="quantita_rilevata">Quantità</label>
                <input type="number" name="quantita_rilevata" placeholder="immetti il numero di articoli (es. 1234,13)" step="0.01" min="0" class="form-control" id="quantita_rilevata" value="{{ $scansione->quantita_rilevata }}" required>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary mt-2">MODIFICA</button>
        </div>
    </form>    
@stop