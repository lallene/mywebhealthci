@extends('layouts.app')

   <!-- recherche css -->
   <link rel="stylesheet" href="{{ asset("assets/css/recherche.css") }}" />
@section('content')
     <style>
        .contact-form4 {
        background-color: #174650;
        position: relative;
        border-radius: 12PX;
        TOP: 36PX;
        HEIGHT: 220px;
      }
      .contact-form5 {
        color: white !important;
        background-color: #174650;
        position: relative;
        border-radius: 12PX;
        HEIGHT: 83PX;
        padding: 12PX;
        width: 105%;
        margin-bottom: 12PX;
        LEFT: -40px;
      }
     </style>
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>RECHERCHE IRIS </h2>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="contact-form4">
                <form action="{{ route("simple_search") }}" method="GET">
                    <div class="">
                        <span class="circle one"></span>
                        <span class="circle two"></span>
                        <span class="circle three"></span>
                        <span class="circle four"></span>
                        <div class="form-group row">
                            <label class="offset-md-2 col-md-1 form-label pt-1" for="workday_id"></label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="input-container focus">
                                    <input type="date" class="input" id="datedebut"  name="datedebut" value="<?= (isset($_GET['datedebut'] )) ? $_GET['datedebut']  : date('Y-m-d') ?>"  name="datedebut" >
                                    <label for="debutArret">Date de début </label>
                                    <span>Date de début </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-container focus">
                                    <input type="date" class="input"  id="datefin" value="<?= (isset($_GET['datefin'] )) ? $_GET['datefin']  : date('Y-m-d') ?>"  name="datefin" >
                                    <label for="debutArret">Date de fin </label>
                                    <span>Date de fin </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <div class="input-container focus">
                                    <input id="workday_id" type="number" name="workday_id" class="input" value= "<?= (isset($_GET['workday_id'] )) ? $_GET['workday_id']  : "" ?>"  required >
                                    <label for="">Workday ID</label>
                                    <span>Workday ID</span>
                                </div>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <button class="btn btn-primary w-100" type="submit" style="MARGIN-TOP: 20PX;" ><i class="fa fa-search" ></i> Rechercher</button>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="input-container focus">
                                        <input type="text" class="input" id="nom" name="name"  value="<?= ($test != null) ? $agent->nom . ' ' . $agent->prenom : "" ?>" readonly  disabled>
                                        <label for="nom">Nom</label>
                                        <span>Nom</span>
                                    </div>
                                </div>
                                
                               
                                <div class="col-md-2">
                                    <div class="input-container focus">
                                        <input type="text" class="input" id="dateEmbauche"  value="<?= ($test != null) ? $agent->dateembauche : "" ?>" readonly disabled>
                                        <label for="dateEmbauche">Date d'embauche</label>
                                        <span>Date d'embauche</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-container focus">
                                        <input type="text" class="input" id="projet" name="projet" value="<?= ($test != null) ? $agent->Projet->designation : "" ?>" readonly disabled>
                                        <label for="projet">Projet</label>
                                        <span>Projet</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-container focus">
                                        <input type="text" class="input" id="emploi" value="<?= ($test != null) ? $agent->SousFonction->intitule : "" ?>" readonly disabled>
                                        <label for="emploi">Fonction</label>
                                        <span>Fonction</span>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="contact-form5">
                <div class="row">

                    <div class="col-md-2">
                        <div class="input-container focus">
                            <input type="numeric" class=" input " id="nbre_consultation"  name="nbre_consultation" value="{{$nbre}}" disabled >
                            <label for="nomMedecin">Nombre de consultaions</label>
                            <span>Nombre de consultaions</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-container focus">
                            <input type="numeric" class=" input " id="nbre_consultation"  name="nbre_consultation"  value="{{$totalArretVailde}}" disabled >
                            <label for="nbre_consultation">Nombre d'arrêts validés'</label>
                            <span>Nombre d'arrêts validés</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-container focus">
                            <input type="numeric" class=" input " id="nbre_arret_valdie"  name="nbre_arret_valdie"  value="{{$totalArretrefuse}}" disabled >
                            <label for="nbre_arret_valdie">Nombre d'arrêts réjétés</label>
                            <span>Nombre d'arrêts réjétés</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-container focus">
                            <input type="numeric" class=" input " id="nbre_consultation"  name="nbre_consultation" value="{{$totalArretEnattente}}" disabled >
                            <label for="nomMedecin">Nombre d'arrêts en attente</label>
                            <span>Nombre d'arrêts en attente</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-container focus">
                            <input type="numeric" class=" input " id="nbre_consultation"  name="nbre_consultation"  value="{{$days}}{{$hours}}h " disabled >
                            <label for="nomMedecin">Nbres heures non travaillés</label>
                            <span>Nbres heures non travaillés</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-container focus">
                            <input type="numeric" class=" input " id="nbre_consultation"  name="nbre_consultation" value ="{{$totalArretInterne}}" disabled >
                            <label for="nomMedecin">Arrêts interne </label>
                            <span>Arrêts interne</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col-sm-12 text-right pb-2">
                    <form action="{{ route('simple_search_export') }}" method="GET">
                        <input type="text" name="SaveDateDebut"  value="<?= (isset($_GET['datedebut'] )) ? $_GET['datedebut']  : date('Y-m-d') ?>" hidden >
                        <input type="text" name="SaveDateFin"  value="<?= (isset($_GET['datefin'] )) ? $_GET['datefin']  : date('Y-m-d') ?>" hidden>
                        <input type="text" name="name"  value="<?= ($test != null) ? $agent->nom . ' ' . $agent->prenom : "" ?>" hidden>
                        <input type="text" name="projet"  value="<?= ($test != null) ? $agent->Projet->designation : "" ?>" hidden>
                        <input type="text" name="workday_id"  value="<?= (isset($_GET['search'] )) ? $_GET['search']  : "" ?>" hidden>


                        <input type="text" name="SaveAgent"  value="{{ $SaveAgent }}" hidden>
                        <button class="btn btn-primary" type="submit" style=" margin: 20PX;" ><i class="fa fa-plus "  ></i> Export</button>
                        <a href="{{ route("home") }}" class="btn btn-danger"><i class="fa fa-plus"></i> Quitter</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Date de consultation</th>
                                    <th>Site Consultation</th>
                                    <th>Medecin</th>
                                    <th>Type de consul</th>
                                    <th>statut Jusificatif</th>
                                    <th>debut d'arret</th>
                                    <th>reprise service</th>
                                    <th>durée Arrêt</th>
                                    <th>Motif de rejet</th>
                                    <th>Medecin Externe</th>
                                    <th>Hôpital/Clinique Externe</th>
                                    <th>Accident Travail</th>
                                    <th>maladie professionnelle</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($collaborateurs)){
                                            $i = 0;
                                            foreach ($collaborateurs as $consul) {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td>{{ $dateConsul}}</td>
                                                    <td>{{ $sites->designation}}</td>
                                                    <td>{{ $medecin->name}}</td>
                                                    <td>{{ $consul->typeConsultation }}</td>
                                                    <td>{{ $consul->typeArrêt }}</td>
                                                    <td>{{ $dateDebut }}</td>
                                                    <td>{{ $dateReprise }}</td>
                                                    <td>{{ $consul->duree_arret }}</td>
                                                    <td>{{ $consul->motifRejet ?? '-' }}</td>
                                                    <td>{{ $consul->nomMedecin ?? '-' }}</td>
                                                    <td>{{ $consul->designationCentreExterne ?? '-'  }}</td>
                                                    <td>{{ $consul->accidentPro ?? '-'  }}</td>
                                                    <td>{{ $consul->maladie_prof ?? '-' }}</td>
                                                </tr>

                                                <?php

                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
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
    <script src="{{ asset("assets/js/scripts/prescrire.js") }}"></script>

@stop

