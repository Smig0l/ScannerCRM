@extends('layouts.app')

@section('scripts')
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        //FIXME: html5qrcode scanner popup
        $( document ).ready(function() {
            var lastResult, countResults = 0;

            function onScanSuccess(decodedText, decodedResult) {
                if (decodedText !== lastResult) {
                    ++countResults;
                    lastResult = decodedText;
                    // Handle on success condition with the decoded message.
                    console.log(`Scan result ${decodedText}`, decodedResult);
                    $('#codice_articolo').val(decodedText);
                }
            }

            var html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", { fps: 10, qrbox: 250 });
            html5QrcodeScanner.render(onScanSuccess);
        });
    </script>
@stop

@section('headers')
    <div class="mb-5">
        <h1 class="">Nuova Scansione</h1>
        <div title="torna indietro">
            <a href="{{ url()->previous() }}" class="btn btn-danger" role="button">
                TORNA INDIETRO
            </a>
        </div>
    </div>
@stop

@section('content')
    <!--parte di codice che mostra eventuali errori quando si compila il form di creazione-->
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="qr-reader" style="width:300px"></div>

    <form action="{{ route('scansioni.store') }}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="codice_articolo">Codice Articolo</label>
                <input type="text" name="codice_articolo" class="form-control" id="codice_articolo" required>
            </div>
            <div class="form-group col-md-6">
                <label for="quantita">Quantità</label>
                <input type="number" name="quantita_rilevata" placeholder="immetti il numero di articoli (es. 1234,13)" step="0.01" min="0" class="form-control" id="quantita_rilevata" required>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary mt-2">CREA</button>
        </div>
    </form>    
@stop