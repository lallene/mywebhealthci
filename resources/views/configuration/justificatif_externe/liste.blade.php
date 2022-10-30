@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Justificatif externe Agent</h2>
                </div>
            </div>
        </div>
        <section class="section dashboard">
            <div class="row" >
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">RECEPTION DE JUSTIFICATIF AGENT</h5>

                                <!-- Default Accordion -->
                                <div class="accordion" id="accordionExample1">


                                    <div class="accordion-item align-self-center">
                                        <h2 class="accordion-header" id="headingSeven">
                                        <button   class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="true" aria-controls="collapse">
                                            FICHE DE CONSULTATION
                                        </button>
                                        </h2>
                                        <div>
                                        <div class="">
                                            <form class="row g-4 accordion-body">
                                                <div class="col-md-3">
                                                    <label for="validationDefault01" class="form-label"></label>
                                                    <select class="form-select" name="statut_patient" id="">
                                                        <option value="interne">interne</option>
                                                        <option value="externe" selected>Externe</option>
                                                    </select>
                                                    </div>
                                                <div class="col-md-3">
                                                <label for="validationDefault01" class="form-label">statut patient</label>
                                                <select class="form-select" name="statut_patient" id="">
                                                    <option value="interne">interne</option>
                                                    <option value="externe" selected>Externe</option>
                                                </select>
                                                </div>
                                                <div class="col-md-3">
                                                <label for="validationDefault02" class="form-label">Accident de Travail </label>
                                                    <select class="form-select" name="accident_travail" id="">
                                                        <option value="1">Oui</option>
                                                        <option value="0" selected>Non</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault02" class="form-label">Traitement administré</label>
                                                    <select class="form-select" name="traitement_adm" id="">
                                                        <option value="1" selected>Oui</option>
                                                        <option value="0">Non</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault02" class="form-label">Medoc administré</label>
                                                    <select class="form-select" name="medoc_adm" id="">
                                                        <option value="1" selected>Oui</option>
                                                        <option value="0">Non</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Arrêt maladie</label>
                                                    <select class="form-select" name="arret_maladie_recue" id="">
                                                        <option value="1" selected>Oui</option>
                                                        <option value="0">Non</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                <label for="validationDefault03" class="form-label">Durée Arret maladie</label>
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
                                                    <label for="validationDefault03" class="form-label">Date de début de l'arrêt
                                                    </label>
                                                    <input type="date" class="form-control" id="validationDefault03"  name ="date_dbt_arret"  >
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Date de reprise du Travail
                                                    </label>
                                                    <input type="date" class="form-control" id="validationDefault03"  value =""   name="date_repise_trvl">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Nombre de jours</label>
                                                    <input type="number" class="form-control" id="validationDefault03"  value =""  name="nbre_jours" >
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Billet de sortie</label>
                                                    <select class="form-select" name="billet_sortie" id="">
                                                        <option value="1" >Oui</option>
                                                        <option value="0" selected>Non</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Test Covid-19</label>
                                                    <select class="form-select" name="covid" id="">
                                                        <option value="1" >Positif</option>
                                                        <option value="0" selected>Negatif</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Repise de service</label>
                                                    <select class="form-select" name="repris_service" id="">
                                                        <option value="1" selected>apte</option>
                                                        <option value="0" >inapte</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Vacciné Covid-19</label>
                                                    <select class="form-select" name="vaccin_covid" id="">
                                                        <option value="1" >oui</option>
                                                        <option value="0" selected>non</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Dose de vaccin recue</label>
                                                    <select class="form-select" name="vaccin_covid" id="">
                                                        <option value="1" >oui</option>
                                                        <option value="2" selected>non</option>
                                                        <option value="3" >non</option>
                                                        <option value="4" >non</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Clinique Externe</label>
                                                    <input type="text" class="form-control" id="validationDefault03"  value ="" name="clinique_externe" >
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Medecin Externe</label>
                                                    <input type="text" class="form-control" id="validationDefault03"  value ="" name="medecin_externe" >
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Justificatif valide </label>
                                                    <select class="form-select" name="justif_valide" id="">
                                                        <option value="1"  selected>oui</option>
                                                        <option value="0" >non</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Motif du rejet </label>
                                                    <select class="form-select" name="motif_rejet" id="">
                                                        <option value="Pièce incomplètes"  selected>Pièce incomplètes</option>
                                                        <option value="authenticite" > Doute sur l'authenticité</option>
                                                        <option value="Hors délai de 72H" >Hors délai de 72H</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Duplicatat suite validation </label>
                                                    <select class="form-select" name="duplicat_suite_valide" id="">
                                                        <option value="1"  selected>oui</option>
                                                        <option value="0" >non</option>
                                                    </select>
                                                </div>
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
