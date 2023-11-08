@extends('layouts.app')
@section('scripts')
    <script>
        function confirmDelete() {
            let response = null;
            response = confirm("Vuoi proseguire con l'eliminazione?");
            if (!response) {
                event.preventDefault();
            }
        }
</script>
@stop 

@section('headers')
    <h1>Scansioni</h1>
    <a href="{{ route('scansioni.create') }}" role="button" class="btn btn-info">
        Nuova Scansione
    </a>

    <a href="{{ route('scansioni.export') }}" role="button" class="btn btn-success">  
        Scarica CSV
    </a>

    <a href="{{ route('scansioni.deleteAll') }}" onclick="confirmDelete()" role="button" class="btn btn-danger">  
        CANCELLA STORICO SCANSIONI
    </a>
@stop

@section('content')
    <table class="table table-sm table-hover mt-3">
        <thead>
            <tr>
                <th>Codice</th>
                <th>Quantità</th>
            </tr>
        </thead>
        <tbody>
            @foreach($scansioni as $scansione)
                <tr>
                    <td>{{ $scansione->codice_articolo }}</td>
                    <td>{{ $scansione->quantita_rilevata }}</td>
                    <td>
                        <a href="{{ route('scansioni.edit', $scansione->id) }}" role="butoon" class="btn btn-warning">
                            Modifica
                        </a>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('scansioni.destroy', $scansione->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="confirmDelete()" class="btn btn-danger">
                                Elimina
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Add pagination links -->
    {{ $scansioni->links() }}
@stop
