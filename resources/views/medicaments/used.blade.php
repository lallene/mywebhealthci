@extends('layouts.app')

@section('content')
<meta charset="UTF-8">

<div class="container py-4">
    <h2 class="mb-4 text-center text-primary fw-bold" style="font-size: 2rem; text-shadow: 1px 1px 2px #ccc;">
        Médicaments Utilisés - Vue Analyste
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
    <div id="medicaments-container" style="display: flex; flex-direction: column; gap: 20px;"></div>
</div>

<!-- Styles additionnels -->
<style>
/* CARD */
.card {
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.2s;
}
.card:hover {
    transform: translateY(-3px);
}
.card-header {
    font-size: 1.2rem;
    font-weight: bold;
    background: linear-gradient(to right, #4e73df, #224abe);
    color: #fff;
    padding: 12px 20px;
}

/* TABLE */
table.dataTable {
    width: 100% !important;
    border-collapse: collapse;
    font-size: 0.95rem;
}
table.dataTable thead {
    background-color: #f1f3f7;
    color: #224abe;
    font-weight: bold;
}
table.dataTable tbody tr:hover {
    background-color: #e2f0d9;
    transition: 0.2s;
}

/* FLÈCHES */
.arrow-up { color: green; font-weight: bold; }
.arrow-down { color: red; font-weight: bold; }

/* SEUIL D'ALERTE */
.row-alert-stock { background-color: #f8d7da !important; font-weight: bold; }
.row-safe-stock { background-color: #d4edda !important; font-weight: bold; }

/* BUTTONS */
.btn i { font-size: 1rem; }

/* RESPONSIVE PRINT */
@media print {
    .btn, select, label { display: none; }
    body { zoom: 0.9; }
    .card-header { font-size: 1rem; }
    table.dataTable { font-size: 0.85rem; }
}
.arrow-up { color: green; font-weight: bold; }
.arrow-down { color: red; font-weight: bold; }
.row-full-stock { background-color: #d4edda !important; }
.row-empty-stock { background-color: #f8d7da !important; }
</style>



<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.6.1/jspdf.umd.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let allTables = [];
    let supplyDates = new Set();

    fetch("{{ url('/api/medicaments/used') }}")
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById("medicaments-container");

            for (const [supplyDate, supplyData] of Object.entries(data)) {
                supplyDates.add(supplyData.approvisionnement);

                const card = document.createElement("div");
                card.classList.add("card", "mb-4");
                card.dataset.supply = supplyData.approvisionnement;

                const header = document.createElement("div");
                header.classList.add("card-header");
                header.textContent = `Approvisionnement : ${supplyData.approvisionnement}`;
                card.appendChild(header);

                const table = document.createElement("table");
                table.classList.add("table", "table-bordered", "medicaments-table", "mb-3");

                let rowsHTML = [];
                Object.entries(supplyData.familles).forEach(([famille, meds]) => {
                    meds.forEach(med => {
                        let totalUsed = Number(med.total_used);
                        let stockRest = Number(med.stock_rest);
                        let stockTotal = Number(med.stock_total);

                        let arrowUsed = totalUsed > 0 ? '▲' : '';
                        let arrowRest = stockRest < stockTotal ? '▼' : '';
                        let rowClass = '';
                        if (stockRest > stockTotal * 0.7) rowClass = 'row-full-stock';
                        if (stockRest <= stockTotal * 0.7) rowClass = 'row-empty-stock';

                       rowsHTML.push(`
                                <tr class="${rowClass}">
                                    <td>${med.medicament}</td>
                                    <td>${med.stock_created_at}</td>
                                    <td>${famille}</td>
                                    <td>${med.supplier}</td>
                                    <td>${med.type_distribution}</td>
                                    <td>${Number(med.unit_price).toLocaleString()}</td>
                                    <td data-order="${stockTotal}">${stockTotal}</td>
                                    <td data-order="${totalUsed}">${totalUsed} <span class="arrow arrow-up">${arrowUsed}</span></td>
                                    <td data-order="${stockRest}">${stockRest} <span class="arrow arrow-down">${arrowRest}</span></td>
                                    <td data-order="${Math.round(stockTotal * 0.2)}"
                                        ${stockRest <= stockTotal * 0.7 ? 'class="text-danger fw-bold"' : ''}>
                                        ${Math.round(stockTotal * 0.7)}
                                    </td>
                                </tr>
                            `);

                    });
                });

                table.innerHTML = `
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Date Création Stock</th>
                            <th>Famille</th>
                            <th>Fournisseur</th>
                            <th>Type Distribution</th>
                            <th>Prix Unitaire</th>
                            <th>Quantité Totale</th>
                            <th>Utilisé</th>
                            <th>Restant</th>
                            <th>Seuil</>
                        </tr>
                    </thead>
                    <tbody>
                        ${rowsHTML.join('')}
                    </tbody>
                `;

                card.appendChild(table);
                container.appendChild(card);

                // Initialisation DataTable avec colonnes numériques
                $(table).DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    pageLength: 10,
                    columnDefs: [
                        { targets: 6, type: 'num' }, // Quantité Totale
                        { targets: 7, type: 'num' }, // Utilisé
                        { targets: 8, type: 'num' }  // Restant
                    ]
                });

                allTables.push(table);
            }

            // Menu déroulant par approvisionnement
            const filterSelect = document.getElementById("filterSupplyDate");
            Array.from(supplyDates).sort((a,b) => new Date(b)-new Date(a))
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
                    let data = dt.rows().data().toArray();
                    let wsData = [
                        ["Nom","Date Création Stock","Famille","Fournisseur","Type Distribution","Prix Unitaire","Quantité Totale","Utilisé","Restant"]
                    ];
                    data.forEach(row => wsData.push([
                        row[0], row[1], row[2], row[3], row[4], row[5], row[6], row[7], row[8]
                    ]));
                    let ws = XLSX.utils.aoa_to_sheet(wsData);
                    XLSX.utils.book_append_sheet(wb, ws, `Appro_${idx+1}`);
                });
                XLSX.writeFile(wb, "Medicaments.xlsx");
            });

            // Export PDF
            document.getElementById("exportPDF").addEventListener("click", function() {
                const { jsPDF } = window.jspdf;
                let doc = new jsPDF();
                let y = 10;
                allTables.forEach((table, idx) => {
                    doc.setFontSize(12);
                    doc.text(`Approvisionnement ${idx+1}`, 10, y);
                    y += 10;
                    table.querySelectorAll("tr").forEach(tr => {
                        let rowText = Array.from(tr.cells).map(td => td.innerText).join(" | ");
                        doc.text(rowText, 10, y);
                        y += 7;
                        if (y > 280) { doc.addPage(); y = 10; }
                    });
                    y += 10;
                    if (y > 280) { doc.addPage(); y = 10; }
                });
                doc.save("Medicaments.pdf");
            });

            // Print
            document.getElementById("printAll").addEventListener("click", function() { window.print(); });

        })
        .catch(error => console.error("Erreur lors du chargement :", error));
});
</script>

@endsection
