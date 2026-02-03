@extends('layouts.app')

@section('content')

<head>
    <meta charset="UTF-8">
    <title>Gestion des Stocks Médicaments</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

    <!-- jQuery complet (à charger en premier) -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    <!-- Chart.js (si nécessaire pour vos graphiques) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        h2, h3 {
            text-align: center;
        }
        /* Style pour le bouton d'exportation */
        .dataTables_wrapper .dt-buttons {
            margin-bottom: 10px;
            float: right;
        }
        .dataTables_filter {
            float: left;
        }
        h2 {
    font-size: 28px;
    font-weight: bold;
    color: #2c3e50;
    margin-top: 20px;
    margin-bottom: 10px;
    text-transform: uppercase;
    border-bottom: 3px solid #3498db;
    padding-bottom: 5px;
}

h3 {
    font-size: 22px;
    font-weight: 600;
    color: #34495e;
    margin-top: 30px;
    margin-bottom: 10px;
    border-left: 5px solid #2ecc71;
    padding-left: 10px;
}

canvas#stockChart {
    margin-bottom: 40px;
}
#medicationTable {
    margin-top: 30px;
}
#medicationTable {
    background-color: #642d2d; /* Couleur de fond claire */
}

#medicationTable thead {
    background-color: #3b3470; /* Fond plus soutenu pour l'en-tête */
    font-weight: bold;
    color: white;
}

#medicationTable tbody tr:nth-child(even) {
    background-color: #1d4851; /* Blanc pour les lignes paires */
    color: white;
}

#medicationTable tbody tr:nth-child(odd) {
    background-color: #1d4851; /* Gris très clair pour les lignes impaires */
    color: white;
}
#medicationTable tbody td:first-child {
    background-color: #cc3262; /* Bleu très clair */
    font-weight: bold;
}
.dt-buttons {
    display: none;
}

    </style>
</head>

<h2>Gestion Globale des Stocks de Médicaments</h2>

{{-- Graphique --}}
<h3>Visualisation Graphique</h3>
<canvas id="stockChart" width="800" height="400"></canvas>

{{-- Tableau --}}
<h3>Détails des Stocks par Médicament</h3>
<div style="display: flex; justify-content: flex-end; margin-bottom: 10px;">
    <button id="exportExcel" class="btn btn-success">Exporter</button>
</div>
<table id="medicationTable">
    <thead>
        <tr>
            <th>Médicament</th>
            <th>Stock Initial Site 1</th>
            <th>Stock Initial Site 2</th>
            <th>Stock Initial Site 3</th>
            <th>Utilisé Site 1</th>
            <th>Utilisé Site 2</th>
            <th>Utilisé Site 3</th>
            <th>Stock Restant Site 1</th>
            <th>Stock Restant Site 2</th>
            <th>Stock Restant Site 3</th>
            <th>Stock Global Initial</th>
            <th>Stock Global Utilisé</th>
            <th>Stock Global Restant</th>
        </tr>
    </thead>
    <tbody>
        @foreach($result as $medication)
            <tr>
                <td>{{ $medication['medication_name'] }}</td>
                <td>{{ $medication['stock_initial_site_1'] }}</td>
                <td>{{ $medication['stock_initial_site_2'] }}</td>
                <td>{{ $medication['stock_initial_site_3'] }}</td>
                <td>{{ $medication['site_1_utilise'] }}</td>
                <td>{{ $medication['site_2_utilise'] }}</td>
                <td>{{ $medication['site_3_utilise'] }}</td>
                <td>{{ $medication['stock_restant_site_1'] }}</td>
                <td>{{ $medication['stock_restant_site_2'] }}</td>
                <td>{{ $medication['stock_restant_site_3'] }}</td>
                <td>{{ $medication['global_initial'] }}</td>
                <td>{{ $medication['global_utilise'] }}</td>
                <td>{{ $medication['global_restant'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@section('script')

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
    $(document).ready(function() {
        // Initialisation de DataTable et des boutons d'exportation
        var table = $('#medicationTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: 'Stock_Médicaments',
                    className: 'buttons-excel'
                }
            ],
            responsive: true
        });

        // Lier l'événement du bouton d'exportation personnalisé
        $('#exportExcel').on('click', function () {
            table.button('.buttons-excel').trigger();
        });

        // Exemple de traitement des données pour le graphique
        const dataFromController = @json($result);

        // Trier les données par stock global restant et prendre uniquement les 10 premiers
        const sortedData = dataFromController.sort((a, b) => b.global_restant - a.global_restant);
        const top10Data = sortedData.slice(0, 5);

        const labels = top10Data.map(item => item.medication_name);
        const dataSite1Initial = top10Data.map(item => Math.max(0, item.stock_initial_site_1)); // Pas de valeurs négatives
        const dataSite1Restant = top10Data.map(item => Math.max(0, item.stock_restant_site_1)); // Pas de valeurs négatives
        const dataSite2Initial = top10Data.map(item => Math.max(0, item.stock_initial_site_2)); // Pas de valeurs négatives
        const dataSite2Restant = top10Data.map(item => Math.max(0, item.stock_restant_site_2)); // Pas de valeurs négatives
        const dataSite3Initial = top10Data.map(item => Math.max(0, item.stock_initial_site_3)); // Pas de valeurs négatives
        const dataSite3Restant = top10Data.map(item => Math.max(0, item.stock_restant_site_3)); // Pas de valeurs négatives

        const ctx = document.getElementById('stockChart').getContext('2d');

        // Créer les dégradés pour chaque site
        const gradientInitialSite1 = ctx.createLinearGradient(0, 0, 0, 400);
        gradientInitialSite1.addColorStop(0, '#ADD8E6'); // Bleu clair
        gradientInitialSite1.addColorStop(1, '#00008B'); // Bleu foncé

        const gradientRestantSite1 = ctx.createLinearGradient(0, 0, 0, 400);
        gradientRestantSite1.addColorStop(0, '#00008B'); // Bleu foncé
        gradientRestantSite1.addColorStop(1, '#ADD8E6'); // Bleu clair

        const gradientInitialSite2 = ctx.createLinearGradient(0, 0, 0, 400);
        gradientInitialSite2.addColorStop(0, '#90EE90'); // Vert clair
        gradientInitialSite2.addColorStop(1, '#006400'); // Vert foncé

        const gradientRestantSite2 = ctx.createLinearGradient(0, 0, 0, 400);
        gradientRestantSite2.addColorStop(0, '#006400'); // Vert foncé
        gradientRestantSite2.addColorStop(1, '#90EE90'); // Vert clair

        const gradientInitialSite3 = ctx.createLinearGradient(0, 0, 0, 400);
        gradientInitialSite3.addColorStop(0, '#D8BFD8'); // Violet clair
        gradientInitialSite3.addColorStop(1, '#800080'); // Violet foncé

        const gradientRestantSite3 = ctx.createLinearGradient(0, 0, 0, 400);
        gradientRestantSite3.addColorStop(0, '#800080'); // Violet foncé
        gradientRestantSite3.addColorStop(1, '#D8BFD8'); // Violet clair

        const stockChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Stock Initial Site 1',
                        data: dataSite1Initial,
                        backgroundColor: gradientInitialSite1,
                        borderColor: gradientInitialSite1,
                        borderWidth: 1,
                        borderRadius: 5,
                        hoverBackgroundColor: '#00008B',
                        hoverBorderColor: '#ADD8E6'
                    },
                    {
                        label: 'Stock Restant Site 1',
                        data: dataSite1Restant,
                        backgroundColor: gradientRestantSite1,
                        borderColor: gradientRestantSite1,
                        borderWidth: 1,
                        borderRadius: 5,
                        hoverBackgroundColor: '#ADD8E6',
                        hoverBorderColor: '#00008B'
                    },
                    {
                        label: 'Stock Initial Site 2',
                        data: dataSite2Initial,
                        backgroundColor: gradientInitialSite2,
                        borderColor: gradientInitialSite2,
                        borderWidth: 1,
                        borderRadius: 5,
                        hoverBackgroundColor: '#006400',
                        hoverBorderColor: '#90EE90'
                    },
                    {
                        label: 'Stock Restant Site 2',
                        data: dataSite2Restant,
                        backgroundColor: gradientRestantSite2,
                        borderColor: gradientRestantSite2,
                        borderWidth: 1,
                        borderRadius: 5,
                        hoverBackgroundColor: '#90EE90',
                        hoverBorderColor: '#006400'
                    },
                    {
                        label: 'Stock Initial Site 3',
                        data: dataSite3Initial,
                        backgroundColor: gradientInitialSite3,
                        borderColor: gradientInitialSite3,
                        borderWidth: 1,
                        borderRadius: 5,
                        hoverBackgroundColor: '#800080',
                        hoverBorderColor: '#D8BFD8'
                    },
                    {
                        label: 'Stock Restant Site 3',
                        data: dataSite3Restant,
                        backgroundColor: gradientRestantSite3,
                        borderColor: gradientRestantSite3,
                        borderWidth: 1,
                        borderRadius: 5,
                        hoverBackgroundColor: '#D8BFD8',
                        hoverBorderColor: '#800080'
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        barPercentage: 0.4, // Réduire la largeur des barres
                        categoryPercentage: 0.5, // Espacement des groupes de barres
                    },
                    y: {
                        beginAtZero: true, // Toujours commencer l'axe Y à zéro
                        ticks: {
                            stepSize: 10 // Ajuster la taille des ticks sur l'axe Y
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                            }
                        }
                    },
                    annotation: {
                        annotations: [
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'x',
                                value: 0, // Position sous chaque groupe de barres
                                borderColor: '#000000',
                                borderWidth: 1,
                                borderDash: [5, 5], // Ligne en pointillé
                                label: {
                                    enabled: false
                                }
                            }
                        ]
                    }
                }
            }
        });
    });
</script>




@endsection

@endsection
