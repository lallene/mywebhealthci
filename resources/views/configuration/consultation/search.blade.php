@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>{{ $titre }}</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <div class="form-group row">
                                <label class="offset-md-2 col-md-1 form-label pt-1" for="iris">IRIS</label>
                                <div class="col-md-3">
                                    <input id="iris" type="number" class="form-control w-100" required name="iris">
                                </div>

                                <div class="col-sm-2 text-center">
                                    <button class="btn btn-primary w-100" id="searchIris"><i class="fa fa-search"></i> Rechercher</button>
                                </div>

                                <div class="col-sm-2 text-center">
                                    <a href="{{ route("home") }}" class="btn btn-danger w-100"><i class="fa fa-close"></i> Annuler</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="nom" class="form-label">Nom </label>
                                    <input type="text" class="form-control" id="nom" readonly>
                                </div>
                                <div class="col-md-7">
                                    <label for="prenom" class="form-label">Prémons</label>
                                    <input type="text" class="form-control" id="prenom" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="sexe" class="form-label">Sexe</label>
                                    <input type="text" class="form-control" id="sexe" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="dateNaissance" class="form-label">Date Embauche</label>
                                    <input type="text" class="form-control" id="dateEmbauche" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="projet" class="form-label">Projet</label>
                                    <input type="text" class="form-control" id="projet" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="fonction" class="form-label">Fonction</label>
                                    <input type="text" class="form-control" id="fonction" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="service" class="form-label">Emploi</label>
                                    <input type="text" class="form-control" id="emploi" readonly>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-sm-6 text-right">
                                    <a href="#" class="btn btn-primary" disabled id="reception">
                                        <i class="fa fa-save"></i>
                                        Reception Justificatif
                                    </a>
                                </div>
                                <div class="col-sm-6 text-left">
                                    <a href="#" class="btn btn-success" disabled id="demarrer">
                                        <i class="fa fa-heartbeat"></i>
                                        Démarrer la consultation
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="url" value="{{ URL::to('/') }}/getAgent/">
    <input type="hidden" id="id" value="{{ URL::to('/') }}/consulter/">
    <input type="hidden" id="id_reception" value="{{ URL::to('/') }}/reception/">
@stop
@section('script')
    <script src="{{ asset("assets/js/scripts/rechercher.js") }}"></script>
@stop

