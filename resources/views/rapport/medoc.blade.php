@extends('layouts.app')

<link rel="stylesheet" href="{{ asset("assets/css/recherche.css") }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <!-- Include html2canvas.js using a script tag -->
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<style>
            .form-check-input:checked {
            background-color: #cc3262 !important;
            border-color: #cc3262 !important;
        }
        .bg-sucess {
            background-color: #1d4851!important;
        }
        .filter{
            background-color: white;
            box-shadow: 0px 0px 68px 3px #1d4851;
            width: 100%;
            border-radius: 6px;
            MARGIN-LEFT: 0PX;
        }
        .title{
            padding: 25px 35px 22px 38px;
            position: relative;
            font-size: 32px;
            font-weight: bold;

            text-align: center;
        }
        .title h2 {
            color: #cc3262 ;
        }
        .contact-form5 {
                background-color: #174650 !important;
                position: relative;
                border-radius: 12PX;
                TOP: 0PX;
                HEIGHT: 350PX;
            }

        .aff{
            color: white !important;
        }
</style>

@section('content')
        <div class="container-fluid">
            <div class="row column_title mb-3 filter" style="background-color: #1d485147;     margin-right: 0px;
            margin-left: 0px;">

                <div class="contact-form5">
                    <div class=" col align-self-center">
                        <div class="title mb-0" style="box-shadow: none!important">
                            <span style="color:#F77F00	">My</span>
                            <span style="color:#FFFFFF">Webhealth</span>
                            <span style="color:#009E60">CI CNX</span>
                        </div>
                    </div>
                    <div class="">
                        <span class="circle one"></span>
                        <span class="circle two"></span>
                        <span class="circle three"></span>
                        <span class="circle four"></span>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <form method="get" class="row" action="{{route('filter')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-2">
                                        <div class="input-container focus">
                                        <input type="date" class="input" id="datedebut" value="<?= ($test != null) ? $_GET['datedebut'] :  date('Y-m-d')  ?>" placeholder=" <?= ($test) ? $_GET['datedebut'] :  date('Y-m-d') ?>"  name="datedebut" >
                                        <label for="datedebut">Date de début </label>
                                        <span>Date de début </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-container focus">
                                        <input type="date" class="input"  id="datefin" value="<?= ($test != null) ? $_GET['datefin'] :  date('Y-m-d')  ?>"  name="datefin" >
                                        <label for="datefin">Date de fin </label>
                                        <span>Date de fin </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="input-container focus">
                                            <select name="siteConsultation" class="input" id="siteSelected">
                                                <option value="all" {{ (isset($_GET['siteConsultation']) && $_GET['siteConsultation'] == 'all') ? 'selected' : '' }}>Tous les sites</option>
                                                <option value="1" {{ (isset($_GET['siteConsultation']) && $_GET['siteConsultation'] == '1') ? 'selected' : '' }}>Abidjan - Site 1</option>
                                                <option value="2" {{ (isset($_GET['siteConsultation']) && $_GET['siteConsultation'] == '2') ? 'selected' : '' }}>Abidjan - Site 2</option>
                                                <option value="3" {{ (isset($_GET['siteConsultation']) && $_GET['siteConsultation'] == '3') ? 'selected' : '' }}>Abidjan - Site 3</option>
                                            </select>
                                            <label for="siteConsultation">Site de consultation </label>
                                            <span>Site de consultation</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="input-container focus">
                                            <select name="projetSelected[]" class="input" id="projetSelected" multiple>
                                                <option value="ALL" disabled="true" selected="true">TOUS </option>

                                            </select>
                                            <label for="projetSelected">Les projets </label>
                                            <span>Les projets</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="debut" class="center">&nbsp; &nbsp;</label>
                                        <button class="btn btn-success w-100" type="submit">Afficher</button>
                                    </div>
                                </form>
                               

                            </div>

                        </div>
                 </div>
                </div>

            </div>
            <div class="row justify-content-center align-items-stretch g-4">
                <!-- Graphique 1 : Consommation des Médicaments -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="container position-relative d-flex flex-column align-items-center mt-3 p-4 shadow rounded bg-white" style="min-height: 400px;">
                        <div class="position-absolute top-0 end-0 mt-2 me-2 d-flex gap-2">
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#zoomModal" onclick="showZoom('medicamentChart')" title="Zoomer">🔍</button>
                            <a href="{{ route('medicaments.consommation') }}" class="btn btn-outline-secondary btn-sm" title="Voir en plein écran">📄</a>
                        </div>
                        <h2 class="mb-4 text-center fw-bold text-dark">Consommation des Médicaments</h2>
                        <canvas id="medicamentChart"></canvas>
                    </div>
                </div>
            
                <!-- Graphique 2 : Consommation par Projet et Site -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="container position-relative d-flex flex-column align-items-center mt-3 p-4 shadow rounded bg-white" style="min-height: 400px;">
                        <div class="position-absolute top-0 end-0 mt-2 me-2 d-flex gap-2">
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#zoomModal" onclick="showZoom('medicamentChart2')" title="Zoomer">🔍</button>
                            <a href="{{ route('medicaments.consommation_par_projet_site') }}" class="btn btn-outline-secondary btn-sm" title="Voir en plein écran">📄</a>
                        </div>
                        <h2 class="mb-4 text-center fw-bold text-dark">Consommation par Projet et Site</h2>
                        <canvas id="medicamentChart2"></canvas>
                    </div>
                </div>
            
                <!-- Graphique 3 : Évolution du budget pharmacie -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="container position-relative d-flex flex-column align-items-center mt-3 p-4 shadow rounded bg-white" style="min-height: 400px;">
                        <div class="position-absolute top-0 end-0 mt-2 me-2 d-flex gap-2">
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#zoomModal" onclick="showZoom('evolutionChart')" title="Zoomer">🔍</button>
                            <a href="{{ route('medicaments.evolution_budget_pharmacie') }}" class="btn btn-outline-secondary btn-sm" title="Voir en plein écran">📄</a>
                        </div>
                        <h2 class="mb-4 text-center fw-bold text-dark">Évolution du budget pharmacie</h2>
                        <canvas id="evolutionChart"></canvas>
                    </div>
                </div>
            
                <!-- Graphique 4 : Coût des achats et des consommations -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="container position-relative d-flex flex-column align-items-center mt-3 p-4 shadow rounded bg-white" style="min-height: 400px;">
                        <div class="position-absolute top-0 end-0 mt-2 me-2 d-flex gap-2">
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#zoomModal" onclick="showZoom('costChart')" title="Zoomer">🔍</button>
                            <a href="{{ route('medicaments.cout_achats_consommations') }}" class="btn btn-outline-secondary btn-sm" title="Voir en plein écran">📄</a>
                        </div>
                        <h2 class="mb-4 text-center fw-bold text-dark">Coût des achats et des consommations</h2>
                        <canvas id="costChart"></canvas>
                    </div>
                </div>
            </div>
            
            
            <div class="row justify-content-center align-items-stretch g-4">
                <!-- Médicaments en rupture ou en seuil critique -->
                <div class="col-md-6 col-lg-3">
                    <div class="container position-relative d-flex flex-column align-items-center mt-3 p-4 shadow rounded bg-white" style="min-height: 400px;">
                        <div class="position-absolute top-0 end-0 mt-2 me-2 d-flex gap-2">
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#zoomModal" onclick="showZoom('stockChart')" title="Zoomer">🔍</button>
                            <a href="{{ route('medicaments.rupture_seuil_critique') }}" class="btn btn-outline-secondary btn-sm" title="Voir en plein écran">📄</a>
                        </div>
                        <h2 class="mb-4 text-center fw-bold text-dark">Médicaments en rupture ou en seuil critique</h2>
                        <canvas id="stockChart"></canvas>
                    </div>
                </div>
            
                <!-- Médicaments proches de la péremption -->
                <div class="col-md-6 col-lg-3">
                    <div class="container position-relative d-flex flex-column align-items-center mt-3 p-4 shadow rounded bg-white" style="min-height: 400px;">
                        <div class="position-absolute top-0 end-0 mt-2 me-2 d-flex gap-2">
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#zoomModal" onclick="showZoom('expiryChart')" title="Zoomer">🔍</button>
                            <a href="{{ route('medicaments.proches_peremption') }}" class="btn btn-outline-secondary btn-sm" title="Voir en plein écran">📄</a>
                        </div>
                        <h2 class="mb-4 text-center fw-bold text-dark">Médicaments proches de la péremption</h2>
                        <canvas id="expiryChart"></canvas>
                    </div>
                </div>
            
                <!-- Évolution des stocks et de la consommation -->
                <div class="col-md-6 col-lg-3">
                    <div class="container position-relative d-flex flex-column align-items-center mt-3 p-4 shadow rounded bg-white" style="min-height: 400px;">
                        <div class="position-absolute top-0 end-0 mt-2 me-2 d-flex gap-2">
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#zoomModal" onclick="showZoom('stockChart1')" title="Zoomer">🔍</button>
                            <a href="{{ route('medicaments.evolution_stocks_consommation') }}" class="btn btn-outline-secondary btn-sm" title="Voir en plein écran">📄</a>
                        </div>
                        <h2 class="mb-4 text-center fw-bold text-dark">Évolution des stocks et consommation</h2>
                        <canvas id="stockChart1"></canvas>
                    </div>
                </div>
            
                <!-- Historique des mouvements de stock -->
                <div class="col-md-6 col-lg-3">
                    <div class="container position-relative d-flex flex-column align-items-center mt-3 p-4 shadow rounded bg-white" style="min-height: 400px;">
                        <div class="position-absolute top-0 end-0 mt-2 me-2 d-flex gap-2">
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#zoomModal" onclick="showZoom('historiqueTable')" title="Zoomer">🔍</button>
                            <a href="{{ route('medicaments.historique_mouvements_stock') }}" class="btn btn-outline-secondary btn-sm" title="Voir en plein écran">📄</a>
                        </div>
                        <h2 class="mb-4 text-center fw-bold text-dark">Historique des mouvements de stock</h2>
                        <table id="historiqueTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Médicament</th>
                                    <th>Type de mouvement</th>
                                    <th>Quantité</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>10/03/2025</td><td>Paracétamol</td><td><span class="badge text-bg-success">Entrée</span></td><td>500</td></tr>
                                <tr><td>12/03/2025</td><td>Ibuprofène</td><td><span class="badge text-bg-danger">Sortie</span></td><td>200</td></tr>
                                <tr><td>15/03/2025</td><td>Amoxicilline</td><td><span class="badge text-bg-success">Entrée</span></td><td>300</td></tr>
                                <tr><td>18/03/2025</td><td>Aspirine</td><td><span class="badge text-bg-danger">Sortie</span></td><td>150</td></tr>
                                <tr><td>20/03/2025</td><td>Doliprane</td><td><span class="badge text-bg-success">Entrée</span></td><td>400</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            
            
                        <!-- Modale de Zoom -->
            <div class="modal fade" id="zoomModal" tabindex="-1" aria-labelledby="zoomModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="zoomModalLabel">Zoom - Graphique</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body d-flex justify-content-center">
                            <canvas id="zoomedCanvas" style="width: 100%; max-height: 500px;"></canvas>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 

    
@stop



@section('script')


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.0/morris.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <!-- Include html2canvas.js using a script tag -->

  <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    function showZoom(chartId) {
        const canvas = document.getElementById(chartId);
        const zoomCanvas = document.getElementById("zoomedCanvas");
        const ctx = zoomCanvas.getContext("2d");
    
        // Copier le graphique original dans la modale
        const img = new Image();
        img.src = canvas.toDataURL();
        img.onload = function () {
            zoomCanvas.width = img.width;
            zoomCanvas.height = img.height;
            ctx.clearRect(0, 0, zoomCanvas.width, zoomCanvas.height);
            ctx.drawImage(img, 0, 0);
        };
    }
   </script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('stockChart1').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Nov 2024', 'Déc 2024', 'Jan 2025', 'Fév 2025', 'Mar 2025', 'Avr 2025'], // Périodes fixes
                datasets: [
                    {
                        label: 'Stock Initial',
                        data: [500, 480, 460, 430, 410, 390], 
                        backgroundColor: '#36A2EB',
                        borderColor: '#fff',
                        borderWidth: 1
                    },
                    {
                        label: 'Consommation',
                        data: [20, 25, 30, 35, 40, 45], 
                        backgroundColor: '#FF6384',
                        borderColor: '#fff',
                        borderWidth: 1
                    },
                    {
                        label: 'Stock Final',
                        data: [480, 455, 430, 395, 370, 345], 
                        backgroundColor: '#4BC0C0',
                        borderColor: '#fff',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true },
                    tooltip: { enabled: true }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 50 }
                    }
                },
                elements: {
                    bar: {
                        barPercentage: 0.6,
                        categoryPercentage: 0.6
                    }
                }
            }
        });
    });
</script>

<script>
    window.exportToCSV = function () {
    fetch('/export-medicaments', {
        method: 'GET',
        headers: {
            'Accept': 'text/csv'
        }
    })
    .then(response => response.blob()) // Convertir la réponse en Blob
    .then(blob => {
        const url = window.URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', 'consommation_medicaments.csv');

        // Ajouter le lien invisible et déclencher le téléchargement
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        // Libérer l'URL du Blob après utilisation
        window.URL.revokeObjectURL(url);
    })
    .catch(error => console.error('Erreur lors du téléchargement :', error));
};

</script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('stockChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar', // Type de graphique : barres
            data: {
                labels: ['Paracétamol', 'Ibuprofène', 'Amoxicilline', 'Aspirine', 'Doliprane'], // Médicaments
                datasets: [{
                    label: 'Stock Actuel', // Légende pour les stocks actuels
                    data: [30, 15, 5, 50, 10], // Stock actuel (valeurs fictives)
                    backgroundColor: '#FF6384', // Couleur des barres du stock actuel
                    borderColor: '#fff',
                    borderWidth: 1
                },
                {
                    label: 'Stock de Sécurité', // Légende pour le stock de sécurité
                    data: [20, 20, 10, 25, 15], // Stock de sécurité (valeurs fictives)
                    backgroundColor: '#36A2EB', // Couleur des barres du stock de sécurité
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true },
                    tooltip: { enabled: true }
                },
                scales: {
                    y: {
                        beginAtZero: true, // Commence à zéro pour l'axe Y
                        ticks: { stepSize: 5 } // Espacement des ticks sur l'axe Y
                    }
                },
                elements: {
                    bar: {
                        barPercentage: 0.5, // Réduit la largeur des barres
                        categoryPercentage: 0.5 // Réduit l'espace entre les barres
                    }
                }
            }
        });
    });
</script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('costChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar', // Type de graphique : barres pour les achats
            data: {
                labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai'], // Périodes
                datasets: [{
                    label: 'Achats de Médicaments', // Légende de la barre des achats
                    data: [5000, 7000, 8000, 6000, 7500], // Coût des achats
                    backgroundColor: '#FF6384', // Couleur des barres des achats
                    borderColor: '#fff',
                    borderWidth: 1,
                    yAxisID: 'y',
                    fill: false
                },
                {
                    label: 'Consommation des Médicaments', // Légende de la ligne de consommation
                    data: [4500, 6800, 7500, 5800, 7200], // Coût des consommations
                    fill: false, // Pas de remplissage sous la ligne
                    borderColor: '#36A2EB', // Couleur de la ligne de consommation
                    borderWidth: 2,
                    tension: 0.1,
                    yAxisID: 'y1'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true },
                    tooltip: { enabled: true }
                },
                scales: {
                    y: {
                        beginAtZero: true, // Commence à zéro pour l'axe Y
                        ticks: { stepSize: 1000 }, // Espacement des ticks sur l'axe Y
                        position: 'left'
                    },
                    y1: {
                        beginAtZero: true, // Commence à zéro pour l'axe Y secondaire
                        ticks: { stepSize: 1000 }, // Espacement des ticks sur l'axe Y secondaire
                        position: 'right'
                    },
                    x: {
                        ticks: { autoSkip: true, maxTicksLimit: 5 }
                    }
                }
            }
        });
    });
</script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('evolutionChart').getContext('2d');

        new Chart(ctx, {
            type: 'line', // Type de graphique : ligne
            data: {
                labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai'], // Périodes
                datasets: [{
                    label: 'Dépenses 2025', // Légende de la première ligne
                    data: [500, 700, 800, 600, 750], // Dépenses pour chaque période
                    fill: false, // Pas de remplissage sous la ligne
                    borderColor: '#FF6384', // Couleur de la ligne
                    tension: 0.1 // Lissage de la courbe
                },
                {
                    label: 'Dépenses 2024', // Légende de la deuxième ligne
                    data: [450, 650, 720, 580, 730], // Dépenses pour chaque période
                    fill: false, // Pas de remplissage sous la ligne
                    borderColor: '#36A2EB', // Couleur de la ligne
                    tension: 0.1 // Lissage de la courbe
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true },
                    tooltip: { enabled: true }
                },
                scales: {
                    y: {
                        beginAtZero: true, // Commence à zéro pour l'axe Y
                        ticks: { stepSize: 100 } // Espacement des ticks sur l'axe Y
                    }
                }
            }
        });
    });
</script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('medicamentChart2').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Projet A', 'Projet B', 'Projet C'], // Liste des projets
                datasets: [{
                    label: 'Site 1',
                    data: [100, 200, 150], // Consommation pour Site 1
                    backgroundColor: '#FF6384',
                    borderColor: '#fff',
                    borderWidth: 1
                },
                {
                    label: 'Site 2',
                    data: [120, 180, 130], // Consommation pour Site 2
                    backgroundColor: '#36A2EB',
                    borderColor: '#fff',
                    borderWidth: 1
                },
                {
                    label: 'Site 3',
                    data: [80, 160, 200], // Consommation pour Site 3
                    backgroundColor: '#FFCE56',
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true },
                    tooltip: { enabled: true }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 50 }
                    },
                    x: {
                        ticks: { autoSkip: true, maxTicksLimit: 5 } // Limite le nombre de labels sur l'axe des X
                    }
                },
                elements: {
                    bar: {
                        barPercentage: 0.5, // Réduit la largeur des barres
                        categoryPercentage: 0.5 // Réduit l'espace entre les barres
                    }
                }
            }
        });
    });
</script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('medicamentChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Paracétamol', 'Ibuprofène', 'Amoxicilline', 'Aspirine', 'Doliprane'],
                datasets: [{
                    label: 'Nombre d’unités consommées',
                    data: [250, 180, 220, 130, 200],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true },
                    tooltip: { enabled: true }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 50 }
                    },
                    x: {
                        ticks: { autoSkip: true, maxTicksLimit: 5 } // Limite le nombre de labels pour mieux espacer
                    }
                },
                elements: {
                    bar: {
                        barPercentage: 0.5, // Réduit la largeur des barres
                        categoryPercentage: 0.5 // Réduit l’espace entre les barres
                    }
                }
            }
        });
    });
</script>

    <script>

        // affichage multiple
        $('#first').change(function(){   if($(this).is(":checked")) {    $('.first').removeClass('d-none');    } else {        $('.first').addClass('d-none');} });
        $('#second').change(function(){   if($(this).is(":checked")) {    $('.second').removeClass('d-none');    } else {        $('.second').addClass('d-none');} });
        $('#third').change(function(){   if($(this).is(":checked")) {    $('.third').removeClass('d-none');    } else {        $('.third').addClass('d-none');} });
        $('#fourth').change(function(){   if($(this).is(":checked")) {    $('.fourth').removeClass('d-none');    } else {        $('.fourth').addClass('d-none');} });
        $('#fiveth').change(function(){   if($(this).is(":checked")) {    $('.fiveth').removeClass('d-none');    } else {        $('.fiveth').addClass('d-none');} });
        $('#sixth').change(function(){   if($(this).is(":checked")) {    $('.sixth').removeClass('d-none');    } else {        $('.sixth').addClass('d-none');} });
        $('#seventh').change(function(){   if($(this).is(":checked")) {    $('.seventh').removeClass('d-none');    } else {        $('.seventh').addClass('d-none');} });
        $('#eighth').change(function(){   if($(this).is(":checked")) {    $('.eighth').removeClass('d-none');    } else {        $('.eighth').addClass('d-none');} });
        $('#nineth').change(function(){   if($(this).is(":checked")) {    $('.nineth').removeClass('d-none');    } else {        $('.nineth').addClass('d-none');} });
        $('#tenth').change(function(){   if($(this).is(":checked")) {    $('.tenth').removeClass('d-none');    } else {        $('.tenth').addClass('d-none');} });
        $('#eleventh').change(function(){   if($(this).is(":checked")) {    $('.eleventh').removeClass('d-none');    } else {        $('.eleventh').addClass('d-none');} });
        $('#twelveth').change(function(){   if($(this).is(":checked")) {    $('.twelveth').removeClass('d-none');    } else {        $('.twelveth').addClass('d-none');} });
        $('#thirteenth').change(function(){   if($(this).is(":checked")) {    $('.thirteenth').removeClass('d-none');    } else {        $('.thirteenth').addClass('d-none');} });
        $('#fourteenth').change(function(){   if($(this).is(":checked")) {    $('.fourteenth').removeClass('d-none');    } else {        $('.fourteenth').addClass('d-none');} });




        $( document ).ready(function() {
            $('#sidebarCollapse').trigger('click');

            $('input[name="datefilter"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });

            $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            var  config = {
                data: <?= json_encode($dataPoints) ?>,
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Nbre Consultation', 'Nbre Arrêt'],
                fillOpacity: 0.6,
                hideHover: 'auto',
                behaveLikeLine: true,
                resize: true,
                pointFillColors:['#ffffff'],
                pointStrokeColors: ['black'],
                lineColors:['gray','red']
            };
            config.element = 'bar-chart';
            Morris.Bar(config);

            // Par Type de Contrat

            Morris.Donut({
                element: 'chartByContrat',
                data: <?= json_encode($byTypeContrat, JSON_NUMERIC_CHECK) ?>
            });

            // Par Sexe

            Morris.Donut({
                element: 'chartBySexe',
                data: <?= json_encode($bySexe, JSON_NUMERIC_CHECK) ?>
            });

            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('chartByAccidentPic').addEventListener('click', function () {
                    // Sélectionnez l'élément contenant le graphique
                    var chartContainer = document.getElementById('chartByAccidentPic');

                    // Utilisez html2canvas pour capturer le graphique et le convertir en base64
                    html2canvas(chartContainer).then(function (canvas) {
                        // Convertir le canvas en base64
                        var imgData = canvas.toDataURL('image/png');

                        // Créer un lien de téléchargement
                        var link = document.createElement('a');
                        link.href = imgData;
                        link.download = 'chart.png';

                        // Ajouter le lien à la page et déclencher le téléchargement
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    });
                });
                });



            // Par Tranche d'âge

            var  config = {
                data: <?= json_encode($arretsByTranche) ?>,
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Nbre Consultation', 'Nbre Arrêt'],
                fillOpacity: 0.6,
                hideHover: 'auto',
                behaveLikeLine: true,
                resize: true,
                pointFillColors:['#ffffff'],
                pointStrokeColors: ['black'],
                lineColors:['gray','red']
            };
            config.element = 'chartByTranche';
            Morris.Bar(config);

            // Par Couverture Maladie

            var  configCouverture = {
                data: <?= json_encode($byCouverture) ?>,
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Nombre arrêts'],
                fillOpacity: 0.6,
                hideHover: 'auto',
                behaveLikeLine: true,
                resize: true,
                pointFillColors:['#ffffff'],
                pointStrokeColors: ['black'],
                lineColors:['gray','red']
            };
            configCouverture.element = 'chartByAssurance';
            Morris.Bar(configCouverture);



             // Par  Maladie Professionnelle

             var  configMaladiePro = {
                data: <?= json_encode($byMaladiePro) ?>,
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Nombre arrêts'],
                fillOpacity: 0.6,
                hideHover: 'auto',
                behaveLikeLine: true,
                resize: true,
                pointFillColors:['#ffffff'],
                pointStrokeColors: ['black'],
                lineColors:['gray','red'],
                title: ['Titre du graphique']
            };
            configMaladiePro.element = 'chartByMaladiePro';
            Morris.Bar(configMaladiePro);

            // Par accident de travail
            var  conifgAccident = {
                data: <?= json_encode($byAccident) ?>,
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Nombre arrêts'],
                fillOpacity: 0.6,
                hideHover: 'auto',
                behaveLikeLine: true,
                resize: true,
                pointFillColors:['#ffffff'],
                pointStrokeColors: ['black'],
                lineColors:['gray','red']
            };
            conifgAccident.element = 'chartByAccident';
            Morris.Bar(conifgAccident);


            // Par maladie contagieuse
            var  configMaladieCon = {
                data: <?= json_encode($byMaladieCon) ?>,
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Nombre arrêts'],
                fillOpacity: 0.6,
                hideHover: 'auto',
                behaveLikeLine: true,
                resize: true,
                pointFillColors:['#ffffff'],
                pointStrokeColors: ['black'],
                lineColors:['gray','red']
            };
            configMaladieCon.element = 'chartByMaladieContagieuse';
            Morris.Bar(configMaladieCon);




        });
    </script>

    <script>

        $(document).ready(function(){
            $('#siteSelected').change(function () {

                    var siteSelected=$(this).val();
                    var div=$(this).parent();
                    var op=" ";

                    var url = '{!!URL::to('findProjet')!!}/'+siteSelected;
                    params = new FormData();
                    params.append( 'id', siteSelected);

                    var config = {
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    };
                    axios.get(url, params, config)
                    .then(function (response) {
                        let data = response.data;

                        $('#projetSelected').html('');
                        for(var i=0;i<data.length;i++){
                            $("#projetSelected").append('<option value="' + data[i].id + '">' + data[i].designation + '</option>');
                        }
                        $("#projetSelected").trigger('change');
y
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
		    });
        });



    </script>
    
    <script src="{{ asset("assets/js/scripts/prescrire.js") }}"></script>
    <script src="{{ asset("assets/js/scripts/rechercher.js") }}"></script>
    <script src="{{ asset("assets/js/recherche.js") }}"></script>
@stop
