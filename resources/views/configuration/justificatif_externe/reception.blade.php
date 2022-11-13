@extends('layouts.app')

@section('content')
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
                <div class="page_title">
                    <h2>Justificatif externe du collaborateur</h2>
                </div>
            </div>
        </div>
        <section class="section dashboard">
            <div class="row" >
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">RECEPTION DE JUSTIFICATIF DU COLLABORATEUR </h6>

                                <!-- Default Accordion -->
                            <form class=""  method="post" action="{{ route('justificatif_externe.store') }}" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" name="agent_id" value="{{ $agent->id }}">
                                <div class="accordion" id="accordionExample1">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingEight">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                                INFORMATION DU COLLABORATEUR
                                            </button>
                                        </h2>
                                        <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample1">
                                            <div class="accordion-body row g-4">
                                                @csrf
                                                <div class="col-md-2">
                                                    <label for="iris" class="form-label">Iris</label>
                                                    <input type="number" class="form-control" id="iris" value="{{ $agent->iris }}" disabled>
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="nom" class="form-label">Nom & Prénom(s)</label>
                                                    <input type="text" class="form-control" id="nom" value="{{ $agent->nom. ' '.$agent->prenom }}" disabled>
                                                </div>

                                                <div class="col-md-2">
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
                                   <div class="accordion-item align-self-center">
                                        <h2 class="accordion-header" id="headingSeven">
                                            <button   class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="true" aria-controls="collapse">
                                                FICHE DE JUSTIFICATIF
                                            </button>
                                        </h2>
                                        <div>
                                            <div class="">
                                                <div class="row g-4 accordion-body ">

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
                                                        <legend>Consultation Externe</legend>

                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <label for="dateConsultation" class="form-label">Date Consultation</label>
                                                                <input type="date" class="form-control" max="<?= date('Y-m-d') ?>" id="dateConsultation" required name="dateConsultation" >
                                                            </div>

                                                            <div class="col-md-2">
                                                                <label for="motif_consultation_id" class="form-label">Motif de consultation externe </label>
                                                                <select name="motif_consultation_id" class="form-control select2" id="motif_consultation_id">
                                                                    <?php
                                                                        foreach ($foreigns as $foreign) {
                                                                            ?>
                                                                            <option value="{{ $foreign->id }}">{{ $foreign->intitule }}</option>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <label for="nomMedecin" class="form-label">Medecin Externe</label>
                                                                <input type="text" class="form-control" id="nomMedecin" required name="nomMedecin" >
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label for="designationCentreExterne" class="form-label">Hôpital/Clinique Externe</label>
                                                                <input type="text" class="form-control" id="designationCentreExterne" required name="designationCentreExterne" >
                                                            </div>

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
                                                                    <div class="col-md-2">
                                                                        <label for="matriculeAssurance" class="form-label">Matricule Assurance</label>
                                                                        <input type="text" class="form-control" id="matriculeAssurance" name="matriculeAssurance" >
                                                                    </div>
                                                                    <?php
                                                                }
                                                            ?>

                                                            <div class="col-md-2">
                                                                <label for="maladie_contagieuse" class="form-label">Maladie contagieuse</label>
                                                                <select class="form-control" name="maladie_contagieuse" id="maladie_contagieuse">
                                                                    <option value="oui">Oui</option>
                                                                    <option value="non" selected >Non</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label for="duree_arret" class="form-label">Durée arrêt maladie (en heure)</label>
                                                                <input type="number" class="form-control" name="duree_arret" id="duree_arret">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label for="enJours" class="form-label">En Jour</label>
                                                                <input type="text" class="form-control" disabled id="enJours">
                                                            </div>
                                                            <div class="col-md-2 d-none">
                                                                <label for="nbrJour" class="form-label">en (heure/jour)</label>
                                                                <select class="form-control" name="nbrJour" id="nbrJour">
                                                                    <option value="Heure" selected>Heure</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label for="debutArret" class="form-label">Date de début </label>
                                                                <input type="date" class="form-control" id="debutArret"  name="debutArret" >
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="dateReprise" class="form-label">Date de reprise</label>
                                                                <input type="date" class="form-control" id="dateReprise" name="dateReprise">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="justificatifValide" class="form-label">Justificatif valide </label>
                                                                <select class="form-select" name="justificatifValide" id="justificatifValide">
                                                                    <option value="oui"  selected>oui</option>
                                                                    <option value="non" >non</option>
                                                                    <option value="en attente" >en attente de validation</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label for="motifRejet" class="form-label">Motif du rejet </label>
                                                                <select class="form-select" name="motifRejet" id="motifRejet">
                                                                    <option value="Pièce incomplètes"  selected>Pièce incomplètes</option>
                                                                    <option value="authenticite" > Doute sur l'authenticité</option>
                                                                    <option value="Hors délai de 72H" >Hors délai de 72H</option>
                                                                    <option value="Hors délai de 72H" >non conforme</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label for="repriseService" class="form-label">Reprise de service</label>
                                                                <select class="form-control" name="repriseService" id="repriseService">
                                                                    <option value="apte" selected>Apte</option>
                                                                    <option value="inapte">Inapte</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </fieldset>

                                                    <fieldset class="col-12">
                                                        <legend>Traitement externe</legend>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label for="billet_sortie" class="form-label">Reprise de bulletin de sortie</label>
                                                                <select class="form-select" name="billet_sortie" id="billet_sortie">
                                                                    <option value="1" >Oui</option>
                                                                    <option value="0" selected>Non</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label for="nouvelleConsultation" class="form-label">Motif de consultation </label>
                                                                <select name="nouvelleConsultation" class="form-control select2" id="nouvelleConsultation">
                                                                    <?php
                                                                        foreach ($foreigns as $foreign) {
                                                                            ?>
                                                                            <option value="{{ $foreign->id }}">{{ $foreign->intitule }}</option>
                                                                            <?php
                                                                            }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label for="validationDefault03" class="form-label">Duplicatat suite validation </label>
                                                                <select class="form-select" name="duplicat_suite_valide" id="">
                                                                    <option value="1"  >oui</option>
                                                                    <option value="0" selected>non</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="observation" class="form-label">Observation du patient</label>
                                                                <textarea class="form-control" rows="3" id="observation" name="observation"></textarea>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="col-md-3">
                                                        <button class="btn btn-primary right " type="submit">Enregistrer</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                   </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
@stop
@section('script')
    <script>
        $( document ).ready(function() {
            $('#sidebarCollapse').trigger('click');
        });

        function SplitTime(numberOfHours){
            var Days=Math.floor(numberOfHours/24);
            var Remainder=numberOfHours % 24;
            var Hours=Math.floor(Remainder);
            var Minutes=Math.floor(60*(Remainder-Hours));
            return({"Days":Days,"Hours":Hours,"Minutes":Minutes})
        }

        $('#duree_arret').change(function () {
            let qte = $(this).val();
            $('#enJours').val(SplitTime(qte))
        });

    </script>
@stop

