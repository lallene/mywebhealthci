@extends('layouts.app')

   <!-- recherche css -->
   <link rel="stylesheet" href="{{ asset("assets/css/recherche.css") }}" />
@section('content')
    <div class="container-fluid">
        <span class="big-circle"></span>
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>{{ $titre }}</h2>
                </div>
            </div>
        </div>

        <div class="">
            <div class="col-md-12">
                <div class="">
                    <div class="contact-form">
                        <div class="">
                            <span class="circle one"></span>
                            <span class="circle two"></span>
                            <span class="circle three"></span>
                            <span class="circle four"></span>
                            <div class="form-group row">
                                <label class="offset-md-2 col-md-1 form-label pt-1" for="iris"></label>
                                <div class="col-md-3">
                                    <div class="input-container focus">
                                        <input id="iris" type="number" class="input" required name="iris">
                                        <label for="">Iris</label>
                                        <span>Iris</span>
                                    </div>
                                </div>

                                <div class="col-sm-2 text-center">
                                    <button class="btn btn-primary w-100" style="MARGIN-TOP: 20PX;" id="searchIris"><i class="fa fa-search" ></i> Rechercher</button>
                                </div>

                                <div class="col-sm-2 text-center">
                                    <a href="{{ route("home") }}" class="btn btn-danger w-100" style="MARGIN-TOP: 20PX;"><i class="fa fa-close"></i> Annuler</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <div class="input-container focus">
                                            <input type="text" class="input" id="nom" readonly  disabled>
                                            <label for="nom">Nom</label>
                                            <span>Nom</span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input-container focus">
                                            <input type="text" class="input" id="prenom" readonly disabled>
                                            <label for="prenom">Prénoms</label>
                                            <span>Prénoms</span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input-container focus">
                                            <input type="text" class="input" id="sexe" readonly disabled>
                                            <label for="sexe">Sexe</label>
                                            <span>Sexe</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <div class="input-container focus">
                                            <input type="text" class="input" id="dateEmbauche"  disabled>
                                            <label for="dateEmbauche">Date d'embauche</label>
                                            <span>Date d'embauche</span>
                                        </div>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input-container focus">
                                            <input type="text" class="input" id="projet" readonly disabled>
                                            <label for="projet">Projet</label>
                                            <span>Projet</span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <div class="input-container focus">
                                            <input type="text" class="input" id="emploi" readonly disabled>
                                            <label for="emploi">Fonction</label>
                                            <span>Fonction</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-sm-6 text-right">
                                    <a href="#" class="btn btn-primary" disabled id="reception">
                                        <i class="fa fa-save"></i>
                                        Reception justificatif
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
    <script src="{{ asset("assets/js/recherche.js") }}"></script>
@stop

