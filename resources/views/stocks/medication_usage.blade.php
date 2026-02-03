@extends('layouts.app')
    <title>Utilisation des Médicaments</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
@section('content')
    <h2>Résumé de l’utilisation des médicaments</h2>
    <table id="medication-usage-table" class="display nowrap">
        <thead>
            <tr>
                <th>Médicament</th>
                <th>Famille</th>
                <th>Type distribution</th>
                <th>Projet</th>
                <th>Site</th>
                <th>Stock (boîtes)</th>
                <th>Comprimés/boîte</th>
                <th>Prix unitaire</th>
                <th>Date d’acquisition</th>
                <th>Agent</th>
                <th>Fonction</th>

                <th>Quantité totale utilisée</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $entry)
                <tr>
                    <td>{{ $entry->medication_name }}</td>
                    <td>{{ $entry->FamilleMedicament }}</td>
                    <td>{{ $entry->type_distribution }}</td>
                    <td>{{ $entry->projet }}</td>
                    <td>{{ $entry->site }}</td>
                    <td>{{ $entry->QuantiteBoîte }}</td>
                    <td>{{ $entry->Quantitecomprime }}</td>
                    <td>{{ number_format($entry->unit_price, 2) }}</td>
                    <td>{{ $entry->Datedacquisition }}</td>
                    <td>{{ $entry->nom }} {{ $entry->prenom }}</td>
                    <td>{{ $entry->fonction }} </td>

                    <td>{{ $entry->total_quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@section('script')
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
    <script>
        $(document).ready(function() {
            $('#medication-usage-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'csv', 'pdf', 'print'
                ],
                pageLength: 30,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json'
                }
            });
        });
    </script>
@stop
@stop
