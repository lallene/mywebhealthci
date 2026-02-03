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
        HEIGHT: 350PX;
      }
      .contact-form5 {
        color: white !important;
        background-color: #174650;
        position: relative;
        border-radius: 12PX;
        HEIGHT: 83PX;
        padding: 12PX;
        width: 102%;
        margin-bottom: 12PX;
        LEFT: -16px;
      }
     </style>
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>RECHERCHEE AVANCEE</h2>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="contact-form4">
                <form action="{{ route('advance_search') }}" method="GET">
                    <div class="">
                        <span class="circle one"></span>
                        <span class="circle two"></span>
                        <span class="circle three"></span>
                        <span class="circle four"></span>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <div class="input-container focus">
                                <label for="datedebut">Date de début </label>
                                  <input type="date" class="input" id="datedebut" value="<?= ($test != null) ? $SaveDateDebut :  date('Y-m-d')  ?>" placeholder=""  name="datedebut" >
                                  <span>Date de début</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-container focus">
                                <label for="datefin">Date de fin </label>
                                <input type="date" class="input"  id="datefin" value="<?= ($test != null) ? $SaveDateFin :  date('Y-m-d')  ?>"  name="datefin" >
                                <span>Date de fin</span>
                                </div>
                            </div>
                            <div class="col-md-2 ">
                                <div class="input-container focus">
                                    <select name="siteConsultation" class="input" id="siteConsultation">
                                        <option value="all">Tous les Sites</option>
                                        <?php
                                            foreach ($sites as $site) {
                                                ?>
                                                <option <?= ($_GET['siteConsultation'] == $site->id )? "selected" : "" ?>  value="{{ $site->id }}">{{ $site->designation }}</option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    <label for="siteConsultation">Site de consultation </label>
                                    <span>Site de consultation</span>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="input-container focus">
                                    <select name="projet" class="input" id="projet">
                                        <option value="all">Tous les Projets</option>
                                        <?php
                                            foreach ($projets as $projet) {
                                                ?>
                                                <option <?= ($_GET['projet'] == $projet->id )? "selected" : "" ?>   value="{{ $projet->id }}">{{ $projet->designation }}</option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    <label for="siteConsultation">Les projets </label>
                                    <span>Les projets</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-container focus">
                                    <select class="input" name="typeConsultation" id="typeConsultation">
                                        <option <?= ($_GET['typeConsultation'] == "all") ? "selected" : "" ?> value="all">Tous</option>
                                        <option <?= ($_GET['typeConsultation'] == "Interne") ? "selected" : "" ?> value="Interne">Interne</option>
                                        <option <?= ($_GET['typeConsultation'] == "Externe" )? "selected" : "" ?> value="Externe"  >Externe</option>
                                    </select>
                                    <label for="typeConsultation">Type de consultation</label>
                                    <span>Type de consultation</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-container focus">
                                    <select class="input" name="typeArrêt" id="typeArrêt">
                                        <option <?= ($_GET['typeArrêt'] == "all") ? "selected" : "" ?> value="all">Tous les types arrets</option>
                                        <option <?= ($_GET['typeArrêt'] == "oui") ? "selected" : "" ?> value="oui" >Oui</option>
                                        <option <?= ($_GET['typeArrêt'] == "non") ? "selected" : "" ?> value="non" >Non</option>
                                        <option <?= ($_GET['typeArrêt'] == "repos") ? "selected" : "" ?>value="repos" >Repos</option>
                                        <option <?= ($_GET['typeArrêt'] == "Analyse externe") ? "selected" : "" ?> value="Analyse externe" >Analyse externe</option>
                                        <option <?= ($_GET['typeArrêt'] == "en attente") ? "selected" : "" ?> value="en attente" >En Attentes</option>
                                    </select>
                                    <label for="typeArrêt">Type d'ârret</label>
                                    <span>Type d'ârret</span>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="input-container motif_consultation focus">
                                    <select name="motif_consultation" class="input" id="motif_consultation">
                                        <option value="all">Tous les motifs</option>
                                        <?php
                                        foreach ($motifs as $motif) {
                                        ?>

                                        <option  <?= ($_GET['motif_consultation'] == $motif->intitule)? "selected" : "" ?>   value="{{ $motif->id }}">{{ $motif->intitule }}</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label for="motif_consultation">Motif de consultation</label>
                                    <span>Motif de consultation</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-container focus ">
                                    <select class=" input " name="motifRejet" id="motifRejet">
                                        <option  <?= ($_GET['motifRejet'] == "all") ? "selected" : "" ?>  value="all">Tous</option>
                                        <option <?= ($_GET['motifRejet'] == "Pièce incomplètes") ? "selected" : "" ?> value="Pièce incomplètes"  >Pièces incomplètes</option>
                                        <option <?= ($_GET['motifRejet'] == "Doute sur l'authenticité") ? "selected" : "" ?> value="Doute sur l'authenticité" > Doute sur l'authenticité</option>
                                        <option <?= ($_GET['motifRejet'] == "Hors délai de 72H") ? "selected" : "" ?> value="Hors délai de 72H" >Hors délai de 72H</option>
                                        <option <?= ($_GET['motifRejet'] == "Non conforme") ? "selected" : "" ?> value="Non conforme" >Non conforme</option>
                                    </select>
                                    <label for="motifRejet">Motif du rejet</label>
                                    <span>Motif du rejet</span>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="input-container focus">
                                    <select name="medecinInterne" class="input" id="medecinInterne">
                                        <option value="all">Tous les médécins internes</option>
                                        <?php
                                            if(isset($medecinInterne)){
                                                foreach ($medecinInterne as $medecinInterne) {
                                                ?>
                                                <option <?= ($_GET['medecinInterne'] == $medecinInterne->name)? "selected" : "" ?>   value="{{ $medecinInterne->id }}">{{ $medecinInterne->name }}</option>
                                                <?php
                                            }
                                            }
                                        ?>
                                    </select>
                                    <label for="medecinInterne">Les médécins internes </label>
                                    <span>Les médécins internes</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-container focus">
                                    <select class="input" name="accidentPro" id="accidentPro">
                                        <option <?= ($_GET['accidentPro'] == "all") ? "selected" : "" ?> value="all">Tous</option>
                                        <option <?= ($_GET['accidentPro'] == "oui") ? "selected" : "" ?> value="oui">Oui</option>
                                        <option <?= ($_GET['accidentPro'] == "non" )? "selected" : "" ?> value="non"  >Non</option>
                                    </select>
                                    <label for="accidentPro">Accident de travail</label>
                                    <span>Accident de travail</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-container focus">

                                    <select class="input" name="contagieuse" id="contagieuse">
                                        <option <?= ($_GET['contagieuse'] == "all") ? "selected" : "" ?> value="all">Toutes</option>
                                        <option <?= ($_GET['contagieuse'] == "oui") ? "selected" : "" ?> value="oui" >Oui</option>
                                        <option <?= ($_GET['contagieuse'] == "non") ? "selected" : "" ?> value="non"  >Non</option>
                                    </select>
                                <label for="contagieuse">Maladie contagieuse</label>
                                <span>Maladie contagieuse</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-container focus">
                                <select class="input" name="prof" id="prof">
                                    <option <?= ($_GET['prof'] == "all") ? "selected" : "" ?> value="all">Tous</option>
                                    <option <?= ($_GET['prof'] == "oui") ? "selected" : "" ?> value="oui" >Oui</option>
                                    <option <?= ($_GET['prof'] == "non") ? "selected" : "" ?> value="non"  >Non</option>
                                </select>
                                <label for="prof">Maladie professionnelle</label>
                                <span>Maladie professionnelle</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-container focus">
                                    <select class="input" name="testCovid" id="testCovid">
                                        <option <?= ($_GET['testCovid'] == "all") ? "selected" : "" ?> value="all">Tous</option>
                                        <option <?= ($_GET['testCovid'] == "Positif") ? "selected" : "" ?> value="Positif" >Positif</option>
                                        <option <?= ($_GET['testCovid'] == "Negatif") ? "selected" : "" ?> value="Negatif" >Negatif</option>
                                    </select>
                                    <label for="testCovid">Test Covid-19</label>
                                    <span>Test Covid-19</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-success col-auto" type="submit" style="   margin: 20PX;  width: 20%;">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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
                            <input type="numeric" class=" input " id="nbre_consultation"  name="nbre_consultation"  value="{{$hours}} h {{$mins}}m " disabled >
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

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="row">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-12 text-right pb-2">
                        <form action="{{ route('rapportsearch') }}" method="GET">
                            <input type="text" name="SaveDateDebut"  value="{{ $SaveDateDebut }}" hidden >
                            <input type="text" name="SaveDateFin"  value="{{ $SaveDateFin }}" hidden>
                            <input type="text" name="SaveSite"  value="{{  $SaveSite  }}" hidden>
                            <input type="text" name="SaveProjet"  value="{{ $SaveProjet }}" hidden>
                            <input type="text" name="SaveMedecin"  value="{{ $SaveMedecin }}" hidden>
                            <input type="text" name="SaveContagieuse"  value="{{ $SaveContagieuse }}" hidden>
                            <input type="text" name="SaveCentreExtene"  value="{{$SaveCentreExtene }}" hidden>
                            <input type="text" name="SaveProf"  value="{{  $SaveProf}}" hidden>
                            <input type="text" name="SaveTypeArret"  value="{{  $SaveTypeArret }}" hidden>
                            <input type="text" name="SaveAccidentPro"  value="{{ $SaveAccidentPro }}" hidden>
                            <input type="text" name="SaveMotifConsul"  value="{{  $SaveMotifConsul }}" hidden>
                            <input type="text" name="SaveMotifRejet"  value="{{ $SaveMotifRejet }}" hidden>
                            <input type="text" name="SaveMedocAdm"  value="{{$SaveMedocAdm }}" hidden>
                            <input type="text" name="SaveTraitAdmin"  value="{{  $SaveTraitAdmin }}" hidden>
                            <input type="text" name="SaveCovid"  value="{{    $SaveCovid }}" hidden>
                            <input type="text" name="SaveTypeConsul"  value="{{ $SaveTypeConsul }}" hidden>
                            <input type="text" name="SaveMedecinExterne"  value="{{ $SaveMedecinExterne }}" hidden>
                            <button class="btn btn-primary" type="submit" style=" margin: 20PX;" ><i class="fa fa-plus" ></i> Export</button>
                            <a href="{{ route("home") }}" class="btn btn-danger"><i class="fa fa-plus"></i> Quitter</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Date de consultation</th>
                            <th>Site Consultation</th>
                            <th>Projet</th>
                            <th>Medecin</th>
                            <th>Type de consul</th>
                            <th>statut Jusificatif</th>
                            <th>debut d'arret</th>
                            <th>reprise service</th>
                            <th>durée Arrêt</th>
                            <th>Motif de rejet</th>
                            <th>Medecin Externe</th>
                            <th>Hôpital/Clinique Externe</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($data)){
                                    $i = 0;
                                    foreach ($data as $consul) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td>{{ $consul->dateConsultation }}</td>
                                            <td>{{ $consul->Site->designation }}</td>
                                            <td>{{ $consul->Projet->designation }}</td>
                                            <td>{{ $consul->Medecin->name }}</td>
                                            <td>{{ $consul->typeConsultation }}</td>
                                            <td>{{ $consul->typeArrêt }}</td>
                                            <td>{{ $consul->debutArret }}</td>
                                            <td>{{ $consul->dateReprise }}</td>
                                            <td>{{ $consul->duree_arret }}</td>
                                            <td>{{ $consul->motifRejet }}</td>
                                            <td>{{ $consul->nomMedecin }}</td>
                                            <td>{{ $consul->designationCentreExterne }}</td>
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

