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
                            <form class=" "  method="post" action="{{ route('justificatif_externe.store') }}" enctype="multipart/form-data">

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
                                                <div class="col-md-0">
                                                    <input type="number" class="form-control " id="validationDefault01" name="agent_id"  value ="{{ $agent->id }}"  required hidden>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="validationDefault01" class="form-label">Iris</label>
                                                    <input type="number" class="form-control" id="validationDefault01" name=""  value ="{{ $agent->iris }}"  required disabled >
                                                </div>
                                                <div class="col-md-3">
                                                <label for="validationDefault02" class="form-label">Nom </label>
                                                <input type="text" class="form-control" id="validationDefault02"  value ="{{ $agent->nom }}" required disabled>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="validationDefault02" class="form-label">Prémons</label>
                                                    <input type="text" class="form-control" id="validationDefault02" value ="{{ $agent->prenom }}" required disabled>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="validationDefault03" class="form-label">Sexe</label>
                                                    <input type="text" class="form-control" id="validationDefault03" required value ="{{ $agent->sexe }}" required disabled>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault01" class="form-label">Site</label>
                                                    <input type="number" class="form-control" id="validationDefault01" name="site_id"   value ="{{ $agent->projet->site->id }} "  required disabled>
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



                                                <fieldset class="col-12">
                                                <legend>Arrêt Maladie</legend>

                                                    <div class="row">
                                                        <div class="col-md-3">
                                                        <label for="validationDefault03" class="form-label">Durée d'arrêt maladie en heure</label>
                                                        <select class="form-select" name="duree_arret">
                                                            <?php
                                                                for ($i=1; $i<=24; $i++)
                                                                {
                                                                    ?>
                                                                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="validationDefault03" class="form-label">Durée d'arrêt maladie en jours</label>
                                                            <input type="number" class="form-control " id="validationDefault03"  value =""  name="nbre_jours" required>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="validationDefault03" class="form-label">Nombre de jours de traitement
                                                            </label>
                                                            <input type="integer" class="form-control " id="validationDefault03"    name="nbre_jours">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="validationDefault03" class="form-label">Date de début de l'arrêt
                                                            </label>
                                                            <input type="date" class="form-control" id="validationDefault03"  name ="date_dbt_arret" >
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="validationDefault03" class="form-label">Date de reprise du Travail
                                                            </label>
                                                            <input type="date" class="form-control" id="validationDefault03"  value =""   name="date_repise_trvl">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="validationDefault03" class="form-label">Justificatif valide </label>
                                                            <select class="form-select" name="justif_valide" id="">
                                                                <option value="1"  selected>oui</option>
                                                                <option value="0" >non</option>
                                                                <option value="en attente" >en attente de validation</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label for="validationDefault03" class="form-label">Motif du rejet </label>
                                                            <select class="form-select" name="motif_rejet" id="">
                                                                <option value="Pièce incomplètes"  selected>Pièce incomplètes</option>
                                                                <option value="authenticite" > Doute sur l'authenticité</option>
                                                                <option value="Hors délai de 72H" >Hors délai de 72H</option>
                                                                <option value="Hors délai de 72H" >non conforme</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="validationDefault03" class="form-label">Assuré(e)</label>
                                                            <select class="form-select" name="assurance" id="">
                                                                <option value="1">Oui</option>
                                                                <option value="0" selected>Non</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="col-12">
                                                <legend>Consultation </legend>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="validationDefault03" class="form-label">Motif de consultation externe </label>
                                                            <select name="motif_consultation_externe_id" class="form-control select2" id="motif_consultation_id">
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
                                                            <label for="validationDefault03" class="form-label">Medecin Externe</label>
                                                            <input type="text" class="form-control" id="validationDefault03"  value ="" name="medecin_externe" >
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="validationDefault03" class="form-label">Hôpital/Clinique Externe</label>
                                                            <input type="text" class="form-control" id="validationDefault03"  value ="" name="clinique_externe" >
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label for="validationDefault03" class="form-label">Repise de service</label>
                                                            <select class="form-select" name="repris_service" id="">
                                                                <option value="1" selected>apte</option>
                                                                <option value="0" >inapte</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="col-12">
                                                <legend>Traitement externe</legend>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="validationDefault03" class="form-label">Reprise de bulletin de sortie</label>
                                                            <select class="form-select" name="billet_sortie" id="">
                                                                <option value="1" >Oui</option>
                                                                <option value="0" selected>Non</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label for="validationDefault03" class="form-label">Motif de consultation </label>
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
                                            </form>
                                        </div>
                                        </div>
                                        </div>
                                </div><!-- End Default Accordion Example -->
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
