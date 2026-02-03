@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('assets/css/recherche.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<style>
    .form-check-input:checked {
        background-color: #cc3262 !important;
        border-color: #cc3262 !important;
    }
    .bg-sucess {
        background-color: #1d4851!important;
    }
    .filter {
        background-color: white;
        box-shadow: 0px 0px 68px 3px #1d4851;
        width: 100%;
        border-radius: 6px;
        margin-left: 0px;
    }
    .title {
        padding: 25px 35px 22px 38px;
        position: relative;
        font-size: 32px;
        font-weight: bold;
        text-align: center;
    }
    .title h2 {
        color: #cc3262;
    }
    .contact-form5 {
        background-color: #174650 !important;
        position: relative;
        border-radius: 12px;
        height: 350px;
    }
    .aff {
        color: white !important;
    }
</style>

@section('content')
<div class="container-fluid">
    <!-- Formulaire -->
    <div class="row column_title mb-3 filter" style="background-color: #1d485147; margin: 0;">
        <div class="contact-form5">
            <div class="col align-self-center">
                <div class="title mb-0" style="box-shadow: none!important">
                    <span style="color:#F77F00">My</span>
                    <span style="color:#FFFFFF">Webhealth</span>
                    <span style="color:#009E60">CI CNX</span>
                </div>
            </div>
            <div>
                <form method="get" class="row" action="{{ route('filter') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-2">
                        <div class="input-container focus">
                            <input type="date" class="input" name="datedebut" id="datedebut"
                                value="{{ request()->get('datedebut', date('Y-m-d')) }}">
                            <label for="datedebut">Date de début</label>
                            <span>Date de début</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-container focus">
                            <input type="date" class="input" name="datefin" id="datefin"
                                value="{{ request()->get('datefin', date('Y-m-d')) }}">
                            <label for="datefin">Date de fin</label>
                            <span>Date de fin</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-container focus">
                            <select name="siteConsultation" class="input" id="siteSelected">
                                <option value="all" {{ request()->get('siteConsultation') == 'all' ? 'selected' : '' }}>Tous les sites</option>
                                <option value="1" {{ request()->get('siteConsultation') == '1' ? 'selected' : '' }}>Abidjan - Site 1</option>
                                <option value="2" {{ request()->get('siteConsultation') == '2' ? 'selected' : '' }}>Abidjan - Site 2</option>
                                <option value="3" {{ request()->get('siteConsultation') == '3' ? 'selected' : '' }}>Abidjan - Site 3</option>
                            </select>
                            <label for="siteConsultation">Site de consultation</label>
                            <span>Site de consultation</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-container focus">
                            <select name="projetSelected[]" class="input" id="projetSelected" multiple>
                                <option value="ALL" disabled selected>TOUS</option>
                                <!-- Remplir dynamiquement si besoin -->
                            </select>
                            <label for="projetSelected">Les projets</label>
                            <span>Les projets</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <button class="btn btn-success w-100" type="submit">Afficher</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Graphique -->
    <div class="row justify-content-center align-items-stretch g-4">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="container position-relative d-flex flex-column align-items-center mt-3 p-4 shadow rounded bg-white" style="min-height: 400px;">
                <div class="position-absolute top-0 end-0 mt-2 me-2 d-flex gap-2">
                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#zoomModal" onclick="showZoom('medicamentChart')" title="Zoomer">🔍</button>
                    <a href="{{ route('medicaments.consommation') }}" class="btn btn-outline-secondary btn-sm" title="Voir en plein écran">📄</a>
                </div>
                <h2 class="mb-4 text-center fw-bold text-dark">Consommation des Médicaments</h2>
                <canvas id="medicamentChart"></canvas>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
 document.addEventListener("DOMContentLoaded", function () {
    try {
        const ctx = document.getElementById('medicamentChart').getContext('2d');
        
        // Vérification des données envoyées par PHP
        const labels = {!! json_encode($medicamentLabels ?? []) !!};
        const data = {!! json_encode($consommationData ?? []) !!};
        
        console.log("Labels:", labels);  // Vérifie dans la console du navigateur
        console.log("Données:", data);   // Vérifie dans la console du navigateur

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,  // Données dynamiques
                datasets: [{
                    label: 'Quantité utilisée',
                    data: data,     // Données dynamiques
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    } catch (error) {
        console.error("Erreur dans Chart.js :", error);
    }
});
</script>
@stop
