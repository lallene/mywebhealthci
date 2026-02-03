@extends('layouts.app')

<!-- recherche css -->
<link rel="stylesheet" href="{{ asset("assets/css/recherche.css") }}" />

@section('content')
<style>
    .contact-form4 {
        background-color: #174650;
        position: relative;
        border-radius: 12px;
        top: 36px;
        height: 120px;
    }
    .contact-form5 {
        color: white !important;
        background-color: #174650;
        position: relative;
        border-radius: 12px;
        height: 84px;
        padding: 12px;
        width: 102%;
        margin-bottom: 12px;
        left: -16px;
    }
</style>

<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>EXTRACTION DES CONSULTATIONS</h2>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="contact-form4">
            <form action="{{ route('rapport_search') }}" method="GET">
                <div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <div class="input-container focus">
                                <input type="date" class="input" id="datededebut" name="datededebut"
                                       value="{{ request('datededebut', date('Y-m-d', strtotime('-3 days'))) }}">
                                <label for="datededebut">Date de début</label>
                                <span>Date de début</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-container focus">
                                <input type="date" class="input" id="datedefin" name="datedefin"
                                       value="{{ request('datedefin', date('Y-m-d')) }}">
                                <label for="datedefin">Date de fin</label>
                                <span>Date de fin</span>
                            </div>
                        </div>
                        <div class="col justify-content-end">
                            <button class="btn btn-success col-auto" type="submit" style="width: 20%; margin: 20px;">Rechercher</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <form action="{{ route('rapportsend') }}" method="GET" class="d-inline">
                        <input name="from" type="hidden" value="{{ $from }}">
                        <input name="to" type="hidden" value="{{ $to }}">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-file-pdf"></i> Export PDF</button>
                    </form>

                    <button type="button" class="btn btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#sendEmailModal">
                        <i class="fa fa-envelope"></i> Envoyer par mail
                    </button>

                    <a href="{{ route('home') }}" class="btn btn-secondary ms-2"><i class="fa fa-times"></i> Quitter</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>PROJET</th>
                                    <th>WORKDAY ID</th>
                                    <th>NOM-PRENOM</th>
                                    <th>TYPE D'ARRÊT</th>
                                    <th>DURÉE</th>
                                    <th>DATE DÉBUT</th>
                                    <th>DATE REPRISE</th>
                                    <th>SITE CONSULTATION</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <!-- Données injectées par JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'envoi d'email -->
<div class="modal fade" id="sendEmailModal" tabindex="-1" aria-labelledby="sendEmailLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('sendMailWitchExecel') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendEmailLabel">Envoi du rapport par mail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">Adresse e-mail</label>
                        <input type="email" class="form-control" name="email" required>
                        <input type="hidden" name="from" value="{{ $from }}">
                        <input type="hidden" name="to" value="{{ $to }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const from = "{{ $from }}";
        const to = "{{ $to }}";

        fetch(`/mywebhealthci/api/consultations?from=${from}&to=${to}`)
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('table-body');
                tbody.innerHTML = '';
                data.forEach((item, index) => {
                    const dureeHeures = Math.floor(item.duree_arret / 60);
                    const dureeMinutes = item.duree_arret % 60;
                    const dureeFormat = `${dureeHeures.toString().padStart(2, '0')} : ${dureeMinutes.toString().padStart(2, '0')} Min`;

                    const debut = new Date(item.debutArret).toLocaleDateString();
                    const reprise = new Date(item.dateReprise).toLocaleDateString();

                    const row = `<tr>
                        <td>${index + 1}</td>
                        <td>${item.projet}</td>
                        <td>${item.workday_id}</td>
                        <td>${item.nom} ${item.prenom}</td>
                        <td>${item.typearret}</td>
                        <td>${dureeFormat}</td>
                        <td>${debut}</td>
                        <td>${reprise}</td>
                        <td>${item.siteConsultation}</td>
                    </tr>`;
                    tbody.insertAdjacentHTML('beforeend', row);
                });
            })
            .catch(error => console.error('Erreur lors du chargement des consultations:', error));
    });
</script>
@endsection
