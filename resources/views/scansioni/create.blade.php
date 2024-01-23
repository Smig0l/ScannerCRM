@extends('layouts.app')

@section('scripts')
    <!-- <script src="{{ asset('js/zxing-library-0.20.0.min.js') }}"></script> --> 
    <!-- <script type="text/javascript">
       $(document).ready(function() {
            //DISABLED BECAUSE AS OF JAN24 THEY USE A LASER SCANNER INSTEAD OF THE CAM
            //DOCS: https://github.com/zxing-js/library srcjs: https://unpkg.com/@zxing/library@latest/umd/index.min.js
            const constraints = {
                audio: false,
                video: {
                    facingMode: { exact: "environment" },
                    width: { ideal: 200 },
                    height: { ideal: 300 }
                }
            };
            const codeReader = new ZXing.BrowserMultiFormatReader();
            codeReader.decodeOnceFromConstraints(constraints, 'video')
            .then(result => {
                $('#codice_articolo').val("");
                $('#codice_articolo').val(result.text);
                $('#video').hide();
                $('#quantita_rilevata').focus();
                codeReader.reset();
            })
            .catch(err => {
                // Display a Bootstrap alert with the error message
                const alertContainer = $('#alert-container');
                const errorMessage = err.message && 'Errore! prova a ricaricare la pagina e consenti a questo sito di accedere alla fotocamera.';
                const alertHtml = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${errorMessage}
                    </div>
                `;
                alertContainer.html(alertHtml);
            });
        });
    </script> -->
@stop

@section('headers')
    <div class="mb-5">
        <h1 class="">Nuova Scansione</h1>
        <div title="home">
            <a href="{{ route('scansioni.index') }}" class="btn btn-danger" role="button">
                HOME / LISTA
            </a>
        </div>
    </div>
@stop

@section('content')

    <!-- <video id="video" style="width:200;height:300;"></video> -->
    <div id="alert-container"></div>

    <form action="{{ route('scansioni.store') }}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="codice_articolo">Codice Articolo</label>
                <input type="text" name="codice_articolo" class="form-control" id="codice_articolo" required autofocus>
            </div>
            <div class="form-group col-md-6">
                <label for="quantita_rilevata">Quantità</label>
                <input type="number" name="quantita_rilevata" placeholder="immetti il numero di articoli (es. 1234,13)" step="0.01" min="0" class="form-control" id="quantita_rilevata" required>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary mt-2">INSERISCI</button>
        </div>
    </form>    
@stop