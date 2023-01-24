@extends('layouts.app')
<link rel="stylesheet" href="{{ asset("assets/css/recherche.css") }}" />
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/modal.css') }}">
    <div class="container-fluid">

            <style>
                .contact-form {
                    background-color: #174650;
                    position: relative;
                    border-radius: 12PX;
                    TOP: -12PX;
                    HEIGHT: 100%;
                    LEFT: 1px;
                    width: 100%;
                }
                .contact-form1 {
                    background-color: #174650;
                    position: relative;
                    border-radius: 12PX;
                    TOP: 15PX;
                    HEIGHT: 100%;
                    LEFT: 12px;
                    width: 100%;
                }
                .accordion-body{
                    padding-left: 5px!important;
                    padding-right: 5px!important;
                }
                fieldset{
                border: 4px white solid;
                padding: .35em .625em .75em;
            }
            legend{
                border-bottom: none !important;
                margin-bottom: 0!important;
                width: auto;
                padding-right: 8px;
                top: -20px;
                background-color: white;
                position: relative;
                color: #174650;
                font-size: 20px;
            }
            .btvalidate{
                padding: 0.6rem 1.3rem;
                background-color: #fff;
                border: 2px solid #fafafa;
                font-size: 0.95rem;
                color: #174650;
                line-height: 1;
                border-radius: 25px;
                outline: none !important;
                cursor: pointer !important;
                transition: 0.3s;
                margin: 0;
            }
            .btvalidate:hover {
                background-color: #149279;
                color: #fff;
                }
                select {

                background-color: #174650 !important;

                }

                .accordiontt{
                    background-color: #cc3262 !important;
                    color: white !important;;
                    font-weight: bold !important;;
                }

                .accoradd{
                    TOP: 1PX;
                    width: 99%;
                    LEFT: 15px;
                    margin-bottom: 9PX;
                }

            </style>
            <div class="row column_title">
                <div class="col-md-12">
                    <div class="page_title row">
                        <h2 class="col-md-10">Consultation du collaborateur</h2>
                        <div class="col-md-2 text-right">
                            <button class="btn btn-primary btn-modal"
                                    data-toggle="modal"
                                    data-target="#fsModal">
                                Afficher le Tracker
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <section class="section dashboard row">
                    <!-- Right side columns -->
                    <form class="col-md-12" method="post" action="{{route('consultation.update', $consultation->id)}}">
                        @csrf
                        @method('PUT')

                        <input type="hidden" class="form-control" name="agent_id" value="{{ $consultation->Agent->id }}">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- Default Accordion -->
                                        <div class="accordion" id="accordionExample1">

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingSeven">
                                                    <button class="accordion-button accordiontt" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapsSeven">
                                                        CONSULTATION
                                                    </button>
                                                </h2>
                                                <div id="collapseSeven" class="accordion-collapse collapse show " aria-labelledby="collapseSeven" data-bs-parent="#headingSeven">
                                                       <div class="row g-3 accordion-body ">
                                                        <div class="contact-form accoradd row">
                                                            <div class="col-md-5  ">
                                                                <div class="input-container focus">
                                                                    <select name="natureReception" class="input" id="natureReception" >
                                                                        <?php
                                                                            foreach ($sites as $site) {
                                                                                ?>
                                                                                <option  value="{{ $site->id }}">{{ $site->designation }}</option>
                                                                                <?php
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                    <label for="natureReception">Site de consultation </label>
                                                                    <span>Site de consultation</span>
                                                                </div>
                                                            </div>
                                                            <?php
                                                                if($consultation->Agent->Contrat->designation == 'CDI'){
                                                                    ?>
                                                                    <div class="col-md-4 " id="matriculeAssuranceDiv">
                                                                        <div class="input-container focus">
                                                                            <input type="text" class="input" id="matriculeAssurance" name="matriculeAssurance" value="{{ $agent->iris }}" readonly disabled>
                                                                            <label for="matriculeAssurance">Matricule assurance</label>
                                                                            <span>Matricule assurance</span>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                        </div>


                                                        <fieldset class="col-12 contact-form">
                                                            <legend>Constantes</legend>

                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="input-container focus">
                                                                        <input type="numeric" class="input" step="any" id="poids" name="poids"  value="{{ $consultation->poids }}" disabled>
                                                                        <label for="poids">Poids</label>
                                                                        <span>Poids</span>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="input-container focus">
                                                                    <input type="numeric" class="input" step="any" id="poul" name="poul"  value="{{ $consultation->poul }}" disabled> 
                                                                    <label for="poul">Pouls</label>
                                                                    <span>Pouls</span>
                                                                </div>


                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="input-container focus ">
                                                                    <input type="numeric" class="input" step="any" id="temperature" name="temperature" value="{{ $consultation->temperature }}" disabled>
                                                                    <label for="temperature">Température</label>
                                                                    <span>Température</span>
                                                                </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="input-container focus ">
                                                                    <input type="text" class="input" step="any" id="tension" name="tension" placeholder="...../...." value="{{ $consultation->tension }}" disabled>
                                                                    <label for="tension">Tension Art</label>
                                                                    <span>Tension Art</span>
                                                                </div>

                                                                </div>
                                                            </div>

                                                        </fieldset>



                                                        <fieldset class="col-12 contact-form">
                                                            <legend>Diagnostique</legend>

                                                            <div class="row">


                                                                <div class="col-md-3">
                                                                    <div class="input-container focus">
                                                                        <select class="input" name="accident" id="accident" disabled>
                                                                            <option value="oui" >Oui</option>
                                                                            <option value="non" >Non</option>
                                                                            <option value="{{ $consultation->tension }}" selected>{{ $consultation->tension }}</option>
                                                                        </select>
                                                                        <label for="accident">Accident de travail</label>
                                                                        <span>Accident de travail</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="input-container focus">
                                                                        <select class="input" name="traitement" id="traitement" disabled>
                                                                            <option value="oui">Oui</option>
                                                                            <option value="non" >Non</option>
                                                                            <option value="{{ $consultation->traitement }}" selected>{{ $consultation->traitement }}</option>

                                                                        </select>
                                                                        <label for="traitement">Soin administré</label>
                                                                        <span>Soin administré</span>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="input-container focus">
                                                                        <select class="input" name="ordonnaceremise" id="ordonnaceremise" disabled>
                                                                            <option value="oui" >Oui</option>
                                                                            <option value="non" selected >Non</option>
                                                                            <option value="{{ $consultation->ordonnaceremise }}" selected>{{ $consultation->ordonnaceremise }}</option>
                                                                        </select>
                                                                        <label for="ordonnaceremise">Ordonnance remise</label>
                                                                        <span>Ordonnance remise</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="input-container focus">
                                                                        <select class="input" name="maladie_contagieuse" id="maladie_contagieuse" disabled>
                                                                            <option value="oui">Oui</option>
                                                                            <option value="non" >Non</option>
                                                                            <option value="{{ $consultation->maladie_contagieuse }}" selected>{{ $consultation->maladie_contagieuse }}</option>
                                                                        </select>
                                                                    <label for="maladie_contagieuse">Maladie contagieuse</label>
                                                                    <span>Maladie contagieuse</span>
                                                                </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="input-container focus">
                                                                    <select class="input" name="maladie_prof" id="maladie_prof" disabled>
                                                                        <option value="oui">Oui</option>
                                                                        <option value="non" >Non</option>
                                                                        <option value="{{ $consultation->maladie_prof }}" selected>{{ $consultation->maladie_prof }}</option>
                                                                    </select>
                                                                    <label for="maladie_prof">Maladie professionnelle</label>
                                                                    <span>Maladie professionnelle</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5 ">
                                                                    <div class="input-container motif_consultation focus">
                                                                        <select name="motif_consultation_id" class="input" id="motif_consultation_id">
                                                                            <?php
                                                                            foreach ($motifs as $motif) {
                                                                            ?>
                                                                           <option  value="{{ $motif->id }}">{{ $motif->intitule }}</option>

                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                        <label for="motif_consultation_id">Motif de consultation</label>
                                                                        <span>Motif de consultation</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 motif_consultation_autre  d-none focus" >
                                                                    <div class="input-container focus">
                                                                        <input type="text" class="input" name="motif_consultation_id" id="motif_consultation_id" value="">
                                                                        <label for="motif_consultation_id">Motif de consultation</label>
                                                                        <span>Motif de consultation</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="input-container focus">
                                                                    <select class="input" name="repriseService" id="repriseService" disabled>
                                                                        <option value="apte" selected>Apte</option>
                                                                        <option value="inapte">Inapte</option>
                                                                        <option value="{{ $consultation->repriseService }}" selected> {{ $consultation->maladie_prof }}</option>
                                                                    </select>
                                                                    <label for="repriseService">Reprise de service</label>
                                                                    <span>Reprise de service</span>
                                                                </div>
                                                                </div>

                                                                <div>

                                                                </div>

                                                            </div>

                                                        </fieldset>

                                                        <fieldset class="col-12 contact-form">
                                                            <legend>Arrêt Maladie</legend>

                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="input-container focus">
                                                                        <select class="input" name="arretMaladie" id="arretMaladie" >
                                                                            <option value="oui">Oui</option>
                                                                            <option value="non" selected>Non</option>
                                                                            <option value="repos" >Repos</option>
                                                                            <option value="{{ $consultation->arretMaladie }}" selected> {{ $consultation->arretMaladie }}</option>

                                                                        </select>
                                                                        <label for="arretMaladie">Arrêt maladie</label>
                                                                        <span>Arrêt maladie</span>
                                                                    </div>

                                                                </div>

                                                                <div class="col-md-4  arretMaladieSwitch d-none">
                                                                    <div class="input-container focus">
                                                                        <input type="numeric" class="input" name="duree_arret" id="duree_arret" value="{{ $consultation->duree_arret }}" >
                                                                        <label for="dateConsultation">Durée arrêt maladie (heure)</label>
                                                                        <span>Durée arrêt maladie (heure)</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4  repos d-none focus">
                                                                    <div class="input-container focus">
                                                                        <input type="numeric" class="input" name="repos" id="repos" value="{{ $consultation->repos }}" >
                                                                        <label for="repos">Repos (heure)</label>
                                                                        <span>Repos (heure)</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4  analyseExterne d-none focus">
                                                                    <div class="input-container focus">
                                                                        <input type="numeric" class="input" name="analyseExterne" id="analyseExterne" value="{{ $consultation->analyseExterne }}">
                                                                        <label for="analyseExterne">Analyse Externe (heure)</label>
                                                                        <span>Analyse Externe (heure)</span>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="input-container arretMaladieSwitch  d-none focus">
                                                                        <input type="text" class="input" disabled id="enJours" value="0" >
                                                                        <input type="hidden" class="input" id="enJours2" value="0"disabled>
                                                                        <label for="enJours">Durée arrêt maladie (en jour)</label>
                                                                        <span>Durée arrêt maladie (en jour)</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 d-none">
                                                                    <div class="input-container  d-none focus">
                                                                        <select class="input" name="nbrJour" id="nbrJour">
                                                                            <option value="Heure" selected>Heure</option>
                                                                        </select>
                                                                        <label for="nbrJour">en (heure/jour)</label>
                                                                        <span>en (heure/jour)</span>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4 arretMaladieSwitch d-none">
                                                                    <div class="input-container focus">
                                                                    <input type="date" class="input" min="<?= date('Y-m-d') ?>" id="debutArret" value="<?= date('Y-m-d') ?>"  name="debutArret" >
                                                                    <label for="debutArret">Date de début </label>
                                                                    <span>Date de début </span>
                                                                </div>
                                                                </div>
                                                                <div class="col-md-4 arretMaladieSwitch d-none">
                                                                    <div class="input-container focus">
                                                                    <input type="date" class="input" readonly id="dateReprise" value="<?= date('Y-m-d') ?>" name="dateReprise" >
                                                                    <label for="dateReprise">Date de reprise</label>
                                                                    <span>Date de reprise</span>
                                                                </div>
                                                                </div>
                                                                <div class="col-md-4 ">
                                                                    <div class="input-container focus arretMaladieSwitch d-none">
                                                                        <select name="motif_consultation_id" class="input" id="motif_consultation_id">
                                                                            <?php
                                                                            foreach ($motifs as $motif) {
                                                                            ?>
                                                                            <option  value="{{ $motif->id }}">{{ $motif->intitule }}</option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                        <label for="motif_consultation_id">Motif de consultation</label>
                                                                        <span>Motif de consultation</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>

                                                        <fieldset class="col-12 contact-form">
                                                            <legend>Covid 19</legend>

                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="input-container focus">
                                                                        <select class="input" name="testCovid" id="testCovid" disabled>
                                                                            <option value="Positif" >Positif</option>
                                                                            <option value="Negatif" selected>Negatif</option>
                                                                        </select>
                                                                        <label for="dateConsultation">Test Covid-19</label>
                                                                        <span>Test Covid-19</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="input-container focus">
                                                                        <select class="input" name="vaccin_covid" id="vaccinCovid" disabled>
                                                                            <option value="oui" >Oui</option>
                                                                            <option value="non" selected>Non</option>
                                                                        </select>
                                                                        <label for="vaccinCovid">Vacciné Covid-19</label>
                                                                        <span>Vacciné Covid-19</span>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="input-container focus">
                                                                        <select class="input" name="doseVaccinCovid" id="doseVaccinCovid" disabled>
                                                                            <option value="0" selected>0</option>
                                                                            <option value="1" >1</option>
                                                                            <option value="2" >2</option>
                                                                            <option value="3" >3</option>
                                                                            <option value="4" >4</option>
                                                                        </select>
                                                                        <label for="doseVaccinCovid">Dose de vaccin reçue</label>
                                                                        <span>Dose de vaccin reçue</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset >
                                                        <fieldset class="col-12 contact-form">
                                                            <legend>Observations</legend>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="input-container focus">
                                                                        <textarea class="input" rows="3" id="observation" name="observation" value="{{ $consultation->observation }}"></textarea>
                                                                        <label for="observation">Observations</label>
                                                                        <span>Observations</span>
                                                                    </div>


                                                                </div>

                                                                <div class="col-md-12 text-center">
                                                                    <button class="btvalidate" type="submit">Enregistrer</button>
                                                                </div>
                                                            </div>

                                                        </fieldset>


                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End Default Accordion Example -->

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">

                                <div class="card">
                                    <div class="card-body">
                                        <!-- Default Accordion -->
                                        <div class="accordion" id="accordionExample2">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingFour">
                                                    <button class="accordion-button accordiontt" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                                        TRACKER DU COLLABORATEUR
                                                    </button>
                                                </h2>
                                                <div id="collapseFour" class="accordion-collapse collapse show" aria-labelledby="headingFour" data-bs-parent="#accordionExample2">
                                                    <div class="accordion-body" id="prescription">

                                                        <fieldset class="mt-2">
                                                            <legend>Liste des arrêts</legend>

                                                            <table class="table table-striped table-responsive-sm table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="20%">Date</th>
                                                                        <th width="30%">Site</th>
                                                                        <th width="20%">Durée</th>
                                                                        <th width="30%">Corps médical</th>                                                                </tr>
                                                                    </thead>
                                                                <tbody>
                                                                <?php
                                                                    if(isset($onsultations) AND !empty($consultations)){
                                                                        foreach ($consultations as $consultation) {
                                                                            if($consultation->arretMaladie == 'oui'){
                                                                                ?>
                                                                                <tr>
                                                                                    <td><?= date('d/m/Y', strtotime($consultation->dateConsultation)) ?></td>
                                                                                    <td><?= $consultation->Site->designation ?></td>
                                                                                    <td><?= $consultation->duree_arret ?> <?= $consultation->duree_arret > 1 ? 'Heures' : 'Heure' ?></td>
                                                                                    <td><?= $consultation->Medecin->name ?></td>
                                                                                </tr>
                                                                                <?php
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                                </tbody>
                                                            </table>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End Default Accordion Example -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Left side columns -->


            </section>
    </div>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <style>
        #prescription .select2-container{
            height: 35px!important;
        }
    </style>

    <div id="fsModal"
         class="modal animated bounceIn modal-lg"
         tabindex="-1"
         role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true" style="min-width: 100vw; padding-left: 5vw">

        <!-- dialog -->
        <div class="modal-dialog" style="min-width: 90vw">

            <!-- content -->
            <div class="modal-content">

                <!-- header -->
                <div class="modal-header">
                    <h1 id="myModalLabel"
                        class="modal-title">
                        Historique des Consultations de {{ $consultation->Agent->nom." ".$consultation->Agent->prenom }}
                    </h1>
                </div>
                <!-- header -->

                <!-- body -->
                <div class="modal-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Date Consultation</th>
                                <th>Heure Consultation</th>
                                <th>Motif</th>
                                <th>Consulté Par</th>
                                <th>Arrêt Maladie</th>
                                <th>Durée arrêt maladie</th>
                                <th>Date debut arrêt Maladie</th>
                                <th>Medicament</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($agent->Consultations) AND !empty($agent->Consultations)){
                                    foreach ($agent->Consultations as $consultation) {
                                        ?>
                                        <tr>
                                            <td><?= date('d/m/Y', strtotime($consultation->created_at)) ?></td>
                                            <td><?= date('H:i:s', strtotime($consultation->created_at)) ?></td>
                                            <td><?= $consultation->MotifConsultation->intitule ?></td>
                                            <td><?= $consultation->Medecin->name ?></td>
                                            <td><?= ucfirst($consultation->arretMaladie) ?></td>
                                            <td><?= $consultation->arretMaladie == 'non' ? '-' : $consultation->duree_arret ?></td>
                                            <td><?= $consultation->arretMaladie == 'non' ? '-' : date('d/m/Y', strtotime($consultation->debutArret)) ?></td>
                                            <td>
                                                <?php
                                                    if(isset($consultation->Ordonnances) AND !empty($consultation->Ordonnances)){
                                                        ?>
                                                        <ul>
                                                        <?php
                                                            foreach ($consultation->Ordonnances as $ordonnance) {
                                                                ?>
                                                                <li><?= $ordonnance->qte.' '.$ordonnance->natureMedicament ?> (<?= $ordonnance->joursTraitement ?> <?= $ordonnance->joursTraitement > 1 ? 'Jours' : 'Jour' ?> de traitement)</li>
                                                                <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                        <?php
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- body -->

                <!-- footer -->
                <div class="modal-footer">
                    <button class="btn btn-primary btn-lg"
                            data-dismiss="modal">
                        <i class="fa fa-close"></i> Fermer Tracker
                    </button>
                </div>
                <!-- footer -->

            </div>
            <!-- content -->

        </div>
        <!-- dialog -->

    </div>

@stop
@section('script')
    <script>
        $( document ).ready(function() {
            $('#sidebarCollapse').trigger('click');
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="{{ asset("assets/js/scripts/prescrire.js") }}"></script>
    <script src="{{ asset("assets/js/scripts/interact.js") }}"></script>
    <script src="{{ asset("assets/js/recherche.js") }}"></script>
@stop

