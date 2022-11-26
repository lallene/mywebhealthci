@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/modal.css') }}">
    <div class="container-fluid">

            <style>
                .accordion-body{
                    padding-left: 5px!important;
                    padding-right: 5px!important;
                }
                fieldset{
                    border: 1px red solid;
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

                    <form class="col-md-12" method="post" action="{{ route($link.'.store') }}">
                        @csrf
                        <input type="hidden" class="form-control" name="agent_id" value="{{ $agent->id }}">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- Default Accordion -->
                                        <div class="accordion" id="accordionExample1">

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingEight">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                                        INFORMATION DU COLLABORATEUR
                                                    </button>
                                                </h2>
                                                <div id="collapseEight" class="accordion-collapse collapse " aria-labelledby="headingEight" data-bs-parent="#accordionExample1">
                                                    <div class="accordion-body">
                                                        <div class="row g-4 accordion-body">

                                                            <div class="col-md-2">
                                                                <label for="iris" class="form-label">Iris</label>
                                                                <input type="number" class="form-control" id="iris" value="{{ $agent->iris }}" disabled>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="nom" class="form-label">Nom & Prénom(s)</label>
                                                                <input type="text" class="form-control" id="nom" value="{{ $agent->nom. ' '.$agent->prenom }}" disabled>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label for="dateNaissance" class="form-label">Date de Naissance</label>
                                                                <input type="text" class="form-control" id="dateNaissance" value="<?= date('d-m-Y', strtotime($agent->dateNaissance)) ?>"  disabled>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label for="sexe" class="form-label">Sexe</label>
                                                                <input type="text" class="form-control" id="sexe" value="<?= ($agent->sexe == 'M') ? 'Masculin' : 'Feminin' ?>"  disabled>
                                                            </div>


                                                            <div class="col-md-2">
                                                                <label for="iris" class="form-label">Site</label>
                                                                <input type="text" class="form-control" id="iris" value="{{ $agent->projet->site->designation }}" disabled>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="emploi" class="form-label">Emploi</label>
                                                                <input type="text" class="form-control" id="emploi" value="{{ $agent->Emploi->designation }}" disabled>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label for="contrat" class="form-label">Type de Contrat</label>
                                                                <input type="text" class="form-control" id="contrat" value="{{ $agent->Contrat->designation }}" disabled>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label for="manager" class="form-label">Manager</label>
                                                                <input type="text" class="form-control" id="manager" value="{{ $agent->Manager->nom.' '.$agent->Manager->prenom }}" disabled>
                                                            </div>



                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingSeven">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapsSeven">
                                                        CONSULTATION
                                                    </button>
                                                </h2>
                                                <div id="collapseSeven" class="accordion-collapse collapse show" aria-labelledby="collapseSeven" data-bs-parent="#accordionExample1">
                                                    <div class="row g-3 accordion-body">

                                                        <div class="col-md-12 row mb-2 mt-2">
                                                            <label for="natureReception" class="form-label">Site de consultation </label>
                                                            <select name="natureReception" class="form-control w-100" id="natureReception">
                                                                <?php
                                                                    foreach ($sites as $site) {
                                                                        ?>
                                                                        <option  value="{{ $site->id }}">{{ $site->designation }}</option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <fieldset class="col-12">
                                                            <legend>Constantes</legend>

                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label for="poids" class="form-label">Poids</label>
                                                                    <input type="number" class="form-control" step="any" id="poids" name="poids" required>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="poul" class="form-label">Pouls</label>
                                                                    <input type="number" class="form-control" step="any" id="poul" name="poul" required>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="temperature" class="form-label">Température</label>
                                                                    <input type="number" class="form-control" step="any" id="temperature" name="temperature" required>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="tension" class="form-label">Tension Art</label>
                                                                    <input type="number" class="form-control" step="any" id="tension" name="tension" required>
                                                                </div>
                                                            </div>

                                                        </fieldset>



                                                        <fieldset class="col-12">
                                                            <legend>Diagnostique</legend>

                                                            <div class="row">

                                                                <div class="col-md-2">
                                                                    <label for="assurance" class="form-label">Assuré</label>
                                                                    <select class="form-control" name="assurance" id="assurance">
                                                                        <option value="non" selected>Non</option>
                                                                        <option value="oui">Oui</option>
                                                                    </select>
                                                                </div>

                                                                <?php
                                                                if($agent->Contrat->designation == 'CDI'){
                                                                ?>
                                                                <div class="col-md-3 d-none" id="matriculeAssuranceDiv">
                                                                    <label for="matriculeAssurance" class="form-label">Matricule Assurance</label>
                                                                    <input type="text"  class="form-control" readonly id="matriculeAssurance" name="matriculeAssurance" >
                                                                </div>
                                                                <?php
                                                                }
                                                                ?>
                                                                <div class="col-md-2">
                                                                    <label for="accident" class="form-label">Accident de travail </label>
                                                                    <select class="form-control" name="accident" id="accident">
                                                                        <option value="oui">Oui</option>
                                                                        <option value="non" selected>Non</option>
                                                                    </select>
                                                                </div>


                                                                <div class="col-md-2">
                                                                    <label for="traitement" class="form-label">Traitement</label>
                                                                    <select class="form-control" name="traitement" id="traitement">
                                                                        <option value="oui" selected>Oui</option>
                                                                        <option value="non">Non</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="medicament" class="form-label">Médicament</label>
                                                                    <select class="form-control" name="medicament" id="medicament">
                                                                        <option value="oui">Oui</option>
                                                                        <option value="non" selected>Non</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </fieldset>





                                                        <fieldset class="col-12">
                                                            <legend>Arrêt Maladie</legend>

                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label for="arretMaladie" class="form-label">Arrêt maladie</label>
                                                                    <select class="form-control" name="arretMaladie" id="arretMaladie">
                                                                        <option value="oui">Oui</option>
                                                                        <option value="non" selected>Non</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-5 row">
                                                                    <label for="motif_consultation_id" class="form-label">Motif de consultation </label>
                                                                    <select name="motif_consultation_id" class="form-control select2 w-100" id="motif_consultation_id">
                                                                        <?php
                                                                        foreach ($motifs as $motif) {
                                                                        ?>
                                                                        <option  value="{{ $motif->id }}">{{ $motif->intitule }}</option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-3 arretMaladieSwitch d-none">
                                                                    <label for="duree_arret" class="form-label">Durée arrêt maladie (heure)</label>
                                                                    <input type="number" class="form-control" name="duree_arret" id="duree_arret" value="0">
                                                                </div>
                                                                <div class="col-md-2 arretMaladieSwitch d-none">
                                                                    <label for="enJours" class="form-label">En Jour</label>
                                                                    <input type="text" class="form-control" disabled id="enJours" value="0">
                                                                    <input type="hidden" class="form-control" id="enJours2" value="0">
                                                                </div>
                                                                <div class="col-md-2 d-none">
                                                                    <label for="nbrJour" class="form-label">en (heure/jour)</label>
                                                                    <select class="form-control" name="nbrJour" id="nbrJour">
                                                                        <option value="Heure" selected>Heure</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-3 arretMaladieSwitch d-none">
                                                                    <label for="debutArret" class="form-label">Date de début </label>
                                                                    <input type="date" class="form-control" min="<?= date('Y-m-d') ?>" id="debutArret" value="<?= date('Y-m-d') ?>"  name="debutArret" >
                                                                </div>
                                                                <div class="col-md-3 arretMaladieSwitch d-none">
                                                                    <label for="dateReprise" class="form-label">Date de reprise</label>
                                                                    <input type="date" class="form-control" readonly id="dateReprise" value="<?= date('Y-m-d') ?>" name="dateReprise">
                                                                </div>
                                                                <div class="col-md-3 arretMaladieSwitch d-none">
                                                                    <label for="billetSortie" class="form-label">Bulletin de sortie</label>
                                                                    <select class="form-control" name="billetSortie" id="billetSortie">
                                                                        <option value="oui" >Oui</option>
                                                                        <option value="non" selected>Non</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="repriseService" class="form-label">Reprise de service</label>
                                                                    <select class="form-control" name="repriseService" id="repriseService">
                                                                        <option value="apte" selected>Apte</option>
                                                                        <option value="inapte">Inapte</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="maladie_contagieuse" class="form-label">Maladie contagieuse</label>
                                                                    <select class="form-control" name="maladie_contagieuse" id="maladie_contagieuse">
                                                                        <option value="oui">Oui</option>
                                                                        <option value="non" selected >Non</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="maladie_prof" class="form-label">Maladie professionnelle</label>
                                                                    <select class="form-control" name="maladie_prof" id="maladie_prof">
                                                                        <option value="oui">Oui</option>
                                                                        <option value="non" selected >Non</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="traitement_adm" class="form-label">Traitement administré</label>
                                                                    <select class="form-control" name="traitement_adm" id="traitement_adm">
                                                                        <option value="oui" >Oui</option>
                                                                        <option value="non" selected >Non</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </fieldset>

                                                        <fieldset class="col-12">
                                                            <legend>Covid 19</legend>

                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label for="testCovid" class="form-label">Test Covid-19</label>
                                                                    <select class="form-control" name="testCovid" id="testCovid">
                                                                        <option value="Positif" >Positif</option>
                                                                        <option value="Negatif" selected>Negatif</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label for="vaccinCovid" class="form-label">Vacciné Covid-19</label>
                                                                    <select class="form-control" name="vaccin_covid" id="vaccinCovid">
                                                                        <option value="oui" >Oui</option>
                                                                        <option value="non" selected>Non</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label for="doseVaccinCovid" class="form-label">Dose de vaccin recue</label>
                                                                    <select class="form-control" name="doseVaccinCovid" id="doseVaccinCovid">
                                                                        <option value="0" selected>0</option>
                                                                        <option value="1" >1</option>
                                                                        <option value="2" >2</option>
                                                                        <option value="3" >3</option>
                                                                        <option value="4" >4</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </fieldset>

                                                        <div class="col-md-12">
                                                            <label for="observation" class="form-label">Observation</label>
                                                            <textarea class="form-control" rows="3" id="observation" name="observation"></textarea>
                                                        </div>

                                                        <div class="col-md-12 text-center">
                                                            <button class="btn btn-primary btn-lg" type="submit">Enregistrer</button>
                                                        </div>
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
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
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
                                                                        <th width="30%">Agent de santé</th>                                                                </tr>
                                                                    </thead>
                                                                <tbody>
                                                                <?php
                                                                    if(isset($agent->Consultations) AND !empty($agent->Consultations)){
                                                                        foreach ($agent->Consultations as $consultation) {
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
                                <div class="card">
                                    <div class="card-body">
                                        <!-- Default Accordion -->
                                        <div class="accordion" id="accordionExample2">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingFive">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                                        ORDONNANCE DU COLLABORATEUR
                                                    </button>
                                                </h2>
                                                <div id="collapseFive" class="accordion-collapse collapse show" aria-labelledby="headingFive" data-bs-parent="#accordionExample2">
                                                    <div class="accordion-body" id="prescription">
                                                        <fieldset>
                                                            <legend>Prescription</legend>

                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <label for="typeMedicament" class="col-sm-12 col-form-label">Type de médicament</label>
                                                                        <div class="col-sm-12">
                                                                            <select name="typeMedicament_1" class="form-control" id="typeMedicamentPrescrit">
                                                                                <option value="Comprimé">Comprimé</option>
                                                                                <option value="Injection">Injection</option>
                                                                                <option value="Géllule">Géllule</option>
                                                                                <option value="Sachet">Sachet</option>
                                                                                <option value="Suppositoire">Suppositoire</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <label for="medicament" class="col-sm-12 col-form-label">Médicament</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" id="medicamentPrescrit" class="form-control w-100">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <label for="qte" class="col-sm-12 col-form-label">Quantité</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="number" class="form-control w-100" id="qteMedoc">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <label for="nbrJrs" class="col-sm-12 col-form-label">Nombre de jours</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="number" class="form-control w-100" id="nbrJrsPrescription">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12 text-center pt-2">
                                                                    <button class="btn btn-success" id="prescrire" type="button"><i class="fa fa-arrow-circle-o-down"></i> Ajouter à l'ordonnance</button>
                                                                </div>
                                                            </div>
                                                        </fieldset>



                                                        <fieldset class="mt-2">
                                                            <legend>Ordonnance</legend>

                                                            <table class="table table-striped table-responsive-sm table-bordered">
                                                                <thead>
                                                                <tr>
                                                                    <th width="25%">Type</th>
                                                                    <th width="40%">Medicament</th>
                                                                    <th width="10%">Qté</th>
                                                                    <th width="20%">Nb Jour</th>                                                                </tr>
                                                                </thead>
                                                                <tbody id="tbody">

                                                                </tbody>
                                                            </table>
                                                        </fieldset>

                                                        <div id="formulaire"></div>


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
                        Historique des Consultations de {{ $agent->nom." ".$agent->prenom }}
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
@stop

