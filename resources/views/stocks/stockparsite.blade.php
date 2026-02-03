@extends('layouts.app')

@section('content')
<meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container-fluid mt-4">
   <h3 class="mb-4 p-3 text-center text-white rounded shadow"
    style="background: linear-gradient(135deg, #0d6efd, #20c997); font-weight: bold; letter-spacing: 1px;">
    📦 Statistiques globales du stock
</h3>

    {{-- Filtres --}}
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="filterSupplyDate" class="form-label fw-bold">📅 Date d’approvisionnement</label>
            <select id="filterSupplyDate" class="form-select">
                <option value="">-- Toutes les dates --</option>
            </select>
        </div>
    </div>

    {{-- Tableau --}}
    <div class="table-responsive">
        <table id="stocksTable" class="table table-bordered table-striped" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Date création</th>
                    <th>Stock Total</th>
                    <th>Date approvisionnement</th>
                    <th>Fournisseur</th>
                    <th>Date expiration</th>
                    <th>Famille</th>
                    <th>Prix Unitaire</th>
                    <th>Type distribution</th>
                    <th>Total utilisé</th>
                    <th>Stock restant</th>
                    <th>Site 1</th>
                    <th>Site 2</th>
                    <th>Site 3</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

<!-- jQuery (version complète, pas slim !) -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

<!-- DataTables CSS + JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- Buttons extension CSS + JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>

<!-- JSZip (pour export Excel) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- HTML5 button export -->
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function () {
    var table = $('#stocksTable').DataTable({
        processing: true,
        serverSide: false,
        pageLength: 50,
        ajax: {
            url: "{{ url('/api/StockGlobal') }}",
            dataSrc: function (json) {
                // Remplir le select des dates (une seule fois)
                if ($("#filterSupplyDate option").length === 1) {
                    json.dates.forEach(function (date) {
                        $('#filterSupplyDate').append(
                            $('<option>', { value: date, text: date })
                        );
                    });
                }
                return json.data; // DataTables utilise uniquement les stocks
            }
        },
        columns: [
            { data: 'name' },
            { data: 'created_at' },
            { data: 'Stock_total' },
            { data: 'supply_date' },
            { data: 'supplier' },
            { data: 'expiration_date' },
            { data: 'famille_medicament' },
            { data: 'unit_price' },
            { data: 'type_distribution' },
            { data: 'total_used' },
            { data: 'stock_rest' },
            { data: 'site1_used' },
            { data: 'site2_used' },
            { data: 'site3_used' }
        ],
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copyHtml5', text: '<i class="bi bi-clipboard"></i> Copier', className: 'btn btn-secondary btn-sm' },
            { extend: 'excelHtml5', text: '<i class="bi bi-file-earmark-excel"></i> Excel', className: 'btn btn-success btn-sm' },
            { extend: 'csvHtml5', text: '<i class="bi bi-file-earmark-text"></i> CSV', className: 'btn btn-info btn-sm' },
            { extend: 'pdfHtml5', text: '<i class="bi bi-file-earmark-pdf"></i> PDF', className: 'btn btn-danger btn-sm' },
            { extend: 'print', text: '<i class="bi bi-printer"></i> Imprimer', className: 'btn btn-primary btn-sm' }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json"
        },
        order: [[3, "desc"]]
    });

    // Filtrer par date (colonne 3 = supply_date)
    $('#filterSupplyDate').on('change', function () {
        var selectedDate = $(this).val();
        table.column(3).search(selectedDate).draw();
    });
});
</script>
@endsection
