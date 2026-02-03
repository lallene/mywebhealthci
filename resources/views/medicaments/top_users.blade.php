@extends('layouts.app')

@section('content')
<meta charset="UTF-8">

<div class="container py-4">
    <h2 class="mb-4 text-center text-primary fw-bold" style="font-size: 2rem; text-shadow: 1px 1px 2px #ccc;">
        Comparatif des stocks par supply_date
    </h2>

    <!-- Menu filtrage -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap" style="gap: 10px;">
        <div class="d-flex align-items-center" style="gap: 10px;">
            <label for="filterSupplyDate" class="form-label fw-bold mb-0">Date d’Approvisionnement :</label>
            <select id="filterSupplyDate" class="form-select w-auto border-primary" style="min-width: 180px;">
                <option value="">Toutes les dates</option>
            </select>
        </div>

        <div class="d-flex flex-wrap" style="gap: 10px;">
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
    </div>

    <!-- Conteneur des cartes -->
    <div id="stocks-container" style="display: flex; flex-direction: column; gap: 20px;"></div>
</div>

<style>
.card {
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.2s;
}
.card:hover { transform: translateY(-3px); }
.card-header {
    font-size: 1.2rem;
    font-weight: bold;
    background: linear-gradient(to right, #4e73df, #224abe);
    color: #fff;
    padding: 12px 20px;
}
table.dataTable { width: 100% !important; border-collapse: collapse; font-size: 0.95rem; }
table.dataTable thead { background-color: #f1f3f7; color: #224abe; font-weight: bold; }
table.dataTable tbody tr:hover { background-color: #e2f0d9; transition: 0.2s; }
.btn i { font-size: 1rem; }
@media print { .btn, select, label { display: none; } body { zoom: 0.9; } }
</style>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.6.1/jspdf.umd.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let allTables = [];
    let supplyDates = new Set();

    fetch("{{ url('/api/medicaments/comparer-stocks') }}")
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById("stocks-container");

            data.forEach(item => {
                const supplyDate = item.supply_date;
                supplyDates.add(supplyDate);

                const card = document.createElement("div");
                card.classList.add("card", "mb-4");
                card.dataset.supply = supplyDate;

                const header = document.createElement("div");
                header.classList.add("card-header");
                header.textContent = `Approvisionnement : ${supplyDate}`;
                card.appendChild(header);

                const table = document.createElement("table");
                table.classList.add("table", "table-bordered", "stocks-table", "mb-3");

                table.innerHTML = `
                    <thead class="table-light">
                        <tr>
                            <th>Quantité Initiale</th>
                            <th>Quantité Utilisée</th>
                            <th>Quantité Restante</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>${item.qte_initiale}</td>
                            <td>${item.qte_utilisee}</td>
                            <td>${item.qte_restante}</td>
                        </tr>
                    </tbody>
                `;

                card.appendChild(table);
                container.appendChild(card);

                $(table).DataTable({
                    paging: false,
                    searching: false,
                    ordering: false
                });

                allTables.push(table);
            });

            // Filtrage par supply_date
            const filterSelect = document.getElementById("filterSupplyDate");
            Array.from(supplyDates).sort((a,b) => new Date(b) - new Date(a))
                 .forEach(date => {
                     const opt = document.createElement("option");
                     opt.value = date;
                     opt.textContent = date;
                     filterSelect.appendChild(opt);
                 });

            filterSelect.addEventListener("change", function() {
                const selected = this.value;
                allTables.forEach(table => {
                    const card = table.closest(".card");
                    card.style.display = (!selected || card.dataset.supply === selected) ? "" : "none";
                });
            });

            // Export Excel
            document.getElementById("exportExcel").addEventListener("click", function() {
                let wb = XLSX.utils.book_new();
                allTables.forEach((table, idx) => {
                    let dt = $(table).DataTable();
                    let wsData = [["Quantité Initiale","Quantité Utilisée","Quantité Restante"]];
                    table.querySelectorAll("tbody tr").forEach(tr => {
                        let rowData = Array.from(tr.cells).map(td => td.innerText);
                        wsData.push(rowData);
                    });
                    let ws = XLSX.utils.aoa_to_sheet(wsData);
                    XLSX.utils.book_append_sheet(wb, ws, `Appro_${idx+1}`);
                });
                XLSX.writeFile(wb, "Comparatif_Stocks.xlsx");
            });

            // Export PDF
            document.getElementById("exportPDF").addEventListener("click", function() {
                const { jsPDF } = window.jspdf;
                let doc = new jsPDF();
                let y = 10;
                allTables.forEach((table, idx) => {
                    doc.setFontSize(12);
                    doc.text(`Approvisionnement ${idx+1}`, 10, y); y += 10;
                    table.querySelectorAll("tr").forEach(tr => {
                        let rowText = Array.from(tr.cells).map(td => td.innerText).join(" | ");
                        doc.text(rowText, 10, y); y += 7;
                        if (y > 280) { doc.addPage(); y = 10; }
                    });
                    y += 10; if (y > 280) { doc.addPage(); y = 10; }
                });
                doc.save("Comparatif_Stocks.pdf");
            });

            // Print
            document.getElementById("printAll").addEventListener("click", function() { window.print(); });

        })
        .catch(error => console.error("Erreur lors du chargement :", error));
});
</script>
@endsection
