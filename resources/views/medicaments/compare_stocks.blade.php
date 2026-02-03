@extends('layouts.app')

@section('content')
<meta charset="UTF-8">

<div class="container py-4">
    <h2 class="mb-4 text-center text-primary fw-bold" style="font-size: 2rem; text-shadow: 1px 1px 2px #ccc;">
        Comparatif des stocks par supply_date
    </h2>

    <div class="d-flex flex-wrap mb-3" style="gap: 10px;">
        <button id="exportExcel" class="btn btn-success d-flex align-items-center">
            <i class="bi bi-file-earmark-excel me-1"></i> Excel
        </button>
        <button id="exportPDF" class="btn btn-danger d-flex align-items-center">
            <i class="bi bi-file-earmark-pdf me-1"></i> PDF
        </button>
        <button id="printAll" class="btn btn-primary d-flex align-items-center">
            <i class="bi bi-printer me-1"></i> Imprimer
        </button>
    </div>

    <table id="stocks-table" class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Supply Date</th>
                <th>Quantité Initiale</th>
                <th>Quantité Utilisée</th>
                <th>Quantité Restante</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<div class="mt-4">
    <canvas id="stocksChart" style="height: 400px;"></canvas>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.6.1/jspdf.umd.min.js"></script>

<script>
$(document).ready(function () {
    const table = $('#stocks-table').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        pageLength: 10
    });

    fetch("{{ url('/api/medicaments/comparer-stocks') }}")
        .then(res => res.json())
        .then(data => {
            data.forEach(item => {
                table.row.add([
                    item.supply_date,
                    item.qte_initiale,
                    item.qte_utilisee,
                    item.qte_restante
                ]).draw();
            });
        });

    // Export Excel
    $('#exportExcel').on('click', function() {
        let wb = XLSX.utils.book_new();
        let wsData = [["Supply Date","Quantité Initiale","Quantité Utilisée","Quantité Restante"]];
        table.rows().data().each(function(row) {
            wsData.push(row);
        });
        let ws = XLSX.utils.aoa_to_sheet(wsData);
        XLSX.utils.book_append_sheet(wb, ws, "Stocks");
        XLSX.writeFile(wb, "Comparatif_Stocks.xlsx");
    });

    // Export PDF
    $('#exportPDF').on('click', function() {
        const { jsPDF } = window.jspdf;
        let doc = new jsPDF();
        let y = 10;
        doc.setFontSize(12);
        doc.text("Comparatif des stocks", 10, y); y += 10;
        table.rows().every(function() {
            let row = this.data();
            doc.text(row.join(" | "), 10, y);
            y += 7;
            if(y > 280){ doc.addPage(); y = 10; }
        });
        doc.save("Comparatif_Stocks.pdf");
    });

    // Print
    $('#printAll').on('click', function() {
        window.print();
    });
});
</script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
fetch("{{ url('/api/medicaments/comparer-stocks') }}")
    .then(res => res.json())
    .then(data => {
        const labels = data.map(d => d.supply_date);
        const initiales = data.map(d => parseInt(d.qte_initiale));
        const utilisees = data.map(d => parseInt(d.qte_utilisee));
        const restantes = data.map(d => parseInt(d.qte_restante));

        const ctx = document.getElementById('stocksChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Quantité Initiale',
                        data: initiales,
                        backgroundColor: 'rgba(78, 115, 223, 0.7)'
                    },
                    {
                        label: 'Quantité Utilisée',
                        data: utilisees,
                        backgroundColor: 'rgba(28, 200, 138, 0.7)'
                    },
                    {
                        label: 'Quantité Restante',
                        data: restantes,
                        backgroundColor: 'rgba(231, 74, 59, 0.7)'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: {
                        display: true,
                        text: 'Comparatif des stocks par supply_date'
                    }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
</script>
@endsection
