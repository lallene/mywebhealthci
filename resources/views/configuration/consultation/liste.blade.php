@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <form>
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
                        <h2>Consultation du collaborateur</h2>
                    </div>
                </div>
            </div>
            <section class="section dashboard">
                <div class="row" >

                    <div class="col-lg-3">

                            <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">HISTORIQUE DU COLLABORATEUR</h6>

                                <!-- Default Accordion -->
                                <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Track #1
                                    </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">

                                            <div class="row mb-3">
                                            <label for="inputText" class="col-sm-12 col-form-label">Date de dernière consultation</label>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control" value ="30/10/2022" disabled>
                                            </div>
                                            </div>
                                            <div class="row mb-3">
                                            <label for="inputEmail" class="col-sm-12 col-form-label">Nbre Arrêt</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" value ="4" disabled>
                                            </div>
                                            </div>
                                            <div class="row mb-3">
                                            <label for="inputPassword" class="col-sm-12 col-form-label">Date de dernier arrêt</label>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control" value ="29/10/2022" disabled>
                                            </div>
                                            </div>
                                            <div class="row mb-3">
                                            <label for="inputNumber" class="col-sm-12 col-form-label">Nombre de jours</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" value ="3" disabled>
                                            </div>
                                            </div>
                                            <div class="row mb-3">
                                            <label for="inputNumber" class="col-sm-12 col-form-label">Delivré par</label>
                                            <div class="col-sm-12">
                                                <input class="form-control" type="text" value ="medecin 1" disabled>
                                            </div>
                                            </div>
                                            <div class="row mb-3">
                                            <label for="inputDate" class="col-sm-12 col-form-label">Motif consultation</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" value ="Paludisme" disabled>
                                            </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputDate" class="col-sm-12 col-form-label">Medicament 1</label>
                                                <div class="col-sm-12">
                                                <input type="text" class="form-control" value ="medoc 1" disabled>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputDate" class="col-sm-12 col-form-label">Medicament 2</label>
                                                <div class="col-sm-12">
                                                <input type="text" class="form-control" value ="medoc 2" disabled>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputDate" class="col-sm-12 col-form-label">Medicament 3</label>
                                                <div class="col-sm-12">
                                                <input type="text" class="form-control" value ="medoc 3" disabled>
                                                </div>
                                            </div>

                                    </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Track #2
                                    </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                            <div class="row mb-3">
                                            <label for="inputText" class="col-sm-12 col-form-label">Date de dernière consultation</label>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control" value ="30/10/2022" disabled>
                                            </div>
                                            </div>
                                            <div class="row mb-3">
                                            <label for="inputEmail" class="col-sm-12 col-form-label">Nombre d'arrêts reçus (EX/IN)</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" value ="4" disabled>
                                            </div>
                                            </div>
                                            <div class="row mb-3">
                                            <label for="inputPassword" class="col-sm-12 col-form-label">Date de dernier arrêt</label>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control" value ="29/10/2022" disabled>
                                            </div>
                                            </div>
                                            <div class="row mb-3">
                                            <label for="inputNumber" class="col-sm-12 col-form-label">Nombre de jours</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" value ="3" disabled>
                                            </div>
                                            </div>
                                            <div class="row mb-3">
                                            <label for="inputNumber" class="col-sm-12 col-form-label">Delivré par</label>
                                            <div class="col-sm-12">
                                                <input class="form-control" type="text" value ="medecin 1" disabled>
                                            </div>
                                            </div>
                                            <div class="row mb-3">
                                            <label for="inputDate" class="col-sm-12 col-form-label">Motif consultation</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" value ="Paludisme" disabled>
                                            </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputDate" class="col-sm-12 col-form-label">Medicament 1</label>
                                                <div class="col-sm-12">
                                                <input type="text" class="form-control" value ="medoc 1" disabled>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputDate" class="col-sm-12 col-form-label">Medicament 2</label>
                                                <div class="col-sm-12">
                                                <input type="text" class="form-control" value ="medoc 2" disabled>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputDate" class="col-sm-12 col-form-label">Medicament 3</label>
                                                <div class="col-sm-12">
                                                <input type="text" class="form-control" value ="medoc 3" disabled>
                                                </div>
                                            </div>

                                    </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Track #3
                                    </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row mb-3">
                                        <label for="inputText" class="col-sm-12 col-form-label">Date de dernière consultation</label>
                                        <div class="col-sm-12">
                                            <input type="date" class="form-control" value ="30/10/2022" disabled>
                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                        <label for="inputEmail" class="col-sm-12 col-form-label">Nombre d'arrêts reçus (EX/IN)</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" value ="4" disabled>
                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                        <label for="inputPassword" class="col-sm-12 col-form-label">Date de dernier arrêt</label>
                                        <div class="col-sm-12">
                                            <input type="date" class="form-control" value ="29/10/2022" disabled>
                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                        <label for="inputNumber" class="col-sm-12 col-form-label">Nombre de jours</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" value ="3" disabled>
                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                        <label for="inputNumber" class="col-sm-12 col-form-label">Delivré par</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" type="text" value ="medecin 1" disabled>
                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                        <label for="inputDate" class="col-sm-12 col-form-label">Motif consultationultation</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value ="Paludisme" disabled>
                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputDate" class="col-sm-12 col-form-label">Médicament 1</label>
                                            <div class="col-sm-12">
                                            <input type="text" class="form-control" value ="medoc 1" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputDate" class="col-sm-12 col-form-label">Médicament 2</label>
                                            <div class="col-sm-12">
                                            <input type="text" class="form-control" value ="medoc 2" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputDate" class="col-sm-12 col-form-label">Médicament 3</label>
                                            <div class="col-sm-12">
                                            <input type="text" class="form-control" value ="medoc 3" disabled>
                                            </div>
                                        </div>

                                    </div>
                                    </div>
                                </div>
                                </div><!-- End Default Accordion Example -->

                            </div>
                            </div>
                        </div>

                    <!-- Right side columns -->

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">INFORMATION DU COLLABORATEUR</h6>

                                    <!-- Default Accordion -->
                                    <div class="accordion" id="accordionExample1">

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingEight">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                                    INFORMATION DU COLLABORATEUR
                                                </button>
                                            </h2>
                                            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample1">
                                                <div class="accordion-body">
                                                    <div class="row g-4 accordion-body">

                                                        <div class="col-md-2">
                                                            <label for="iris" class="form-label">Iris</label>
                                                            <input type="number" class="form-control" id="iris" value="{{ $agent->iris }}" disabled>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <label for="nom" class="form-label">Nom & Prénom(s)</label>
                                                            <input type="text" class="form-control" id="nom" value="{{ $agent->nom. ' '.$agent->prenom }}" disabled>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label for="sexe" class="form-label">Sexe</label>
                                                            <input type="text" class="form-control" id="sexe" value="<?= ($agent->sexe == 'M') ? 'Masculin' : 'Feminin' ?>"  disabled>
                                                        </div>


                                                        <div class="col-md-2">
                                                            <label for="iris" class="form-label">Site</label>
                                                            <input type="number" class="form-control" id="iris" value="{{ $agent->projet->site->id }}" disabled>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <label for="emploi" class="form-label">Emploi</label>
                                                            <input type="text" class="form-control" id="emploi" value="{{ $agent->Emploi->designation }}" disabled>
                                                        </div>

                                                        <div class="col-md-5">
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
                                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="collapseSeven" data-bs-parent="#accordionExample1">
                                                <div class="row g-3 accordion-body">
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
                                                                <div class="col-md-3">
                                                                    <label for="assurance" class="form-label">Assuré</label>
                                                                    <select class="form-control" name="assurance" id="assurance">
                                                                        <option value="nom" selected>Non</option>
                                                                        <option value="oui">Oui</option>
                                                                    </select>
                                                                </div>
                                                            <div class="col-md-3">
                                                                <label for="accident" class="form-label">Accident de travail </label>
                                                                <select class="form-control" name="accident" id="accident">
                                                                    <option value="1">Oui</option>
                                                                    <option value="0" selected>Non</option>
                                                                </select>
                                                            </div>


                                                            <div class="col-md-3">
                                                                <label for="traitement" class="form-label">Traitement</label>
                                                                <select class="form-control" name="traitement" id="traitement">
                                                                    <option value="1" selected>Oui</option>
                                                                    <option value="0">Non</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="medicament" class="form-label">Medicament</label>
                                                                <select class="form-control" name="medicament" id="medicament">
                                                                    <option value="1" selected>Oui</option>
                                                                    <option value="0">Non</option>
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
                                                                    <option value="1">Oui</option>
                                                                    <option value="0" selected>Non</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="validationDefault03" class="form-label">Motif de consultation </label>
                                                                <select name="motif_consultation_id" class="form-control select2" id="motif_consultation_id">
                                                                    <?php
                                                                        foreach ($motifs as $motif) {
                                                                            ?>
                                                                            <option  value="{{ $motif->id }}">{{ $motif->intitule }}</option>
                                                                            <?php
                                                                            }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label for="duree_arret" class="form-label">Durée arrêt maladie en heure</label>
                                                                <select { width:30px; height:30px; } class="form-control" name="duree_arret" id="duree_arret">
                                                                    <?php
                                                                        for ($i=1; $i<=24; $i++){
                                                                            ?>
                                                                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="nbrJour" class="form-label">Durée arrêt maladie en jours</label>
                                                                <input type="number" class="form-control" id="nbrJour" name="nbrJour" >
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="debutArret" class="form-label">Date de début </label>
                                                                <input type="date" class="form-control" id="debutArret"  name ="debutArret" >
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="dateReprise" class="form-label">Date de reprise</label>
                                                                <input type="date" class="form-control" id="dateReprise" name="dateReprise">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="billetSortie" class="form-label">Bulletin de sortie</label>
                                                                <select class="form-control" name="billetSortie" id="billetSortie">
                                                                    <option value="1" >Oui</option>
                                                                    <option value="0" selected>Non</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="repriseService" class="form-label">Repise de service</label>
                                                                <select class="form-control" name="repriseService" id="repriseService">
                                                                    <option value="1" selected>apte</option>
                                                                    <option value="0">inapte</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="repriseService" class="form-label">Maladie contagieuse</label>
                                                                <select class="form-control" name="maladie_contagieuse_id" id="repriseService">
                                                                    <option value="1" selected>oui</option>
                                                                    <option value="0" selected >non</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="repriseService" class="form-label">Maladie professionnelle</label>
                                                                <select class="form-control" name="maladie_prof_id" id="repriseService">
                                                                    <option value="1" selected>oui</option>
                                                                    <option value="0" selected >non</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="repriseService" class="form-label">Traitement administré</label>
                                                                <select class="form-control" name="traitement_adm" id="repriseService">
                                                                    <option value="1" selected>oui</option>
                                                                    <option value="0" selected >non</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                    </fieldset>

                                                    <fieldset class="col-12">
                                                        <legend>Covid 19</legend>

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for="vaccinCovid" class="form-label">Vacciné Covid-19</label>
                                                                <select class="form-control" name="vaccinCovid" id="vaccinCovid">
                                                                    <option value="1" >oui</option>
                                                                    <option value="0" selected>non</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <label for="testCovid" class="form-label">Test Covid-19</label>
                                                                <select class="form-control" name="testCovid" id="testCovid">
                                                                    <option value="1" >Positif</option>
                                                                    <option value="0" selected>Negatif</option>
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

                                                    <div class="col-md-3">
                                                        <button class="btn btn-primary right " type="submit">Enregistrer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End Default Accordion Example -->

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">

                    <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">ORDONNANCE DU COLLABORATEUR</h6>

                        <!-- Default Accordion -->
                        <div class="accordion" id="accordionExample2">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                Médicament #1
                            </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse show" aria-labelledby="headingFour" data-bs-parent="#accordionExample2">
                            <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label for="inputEmail" class="col-sm-12 col-form-label">Type de médicament</label>
                                        <select name="type" class="form-control select2" id="type">
                                            <option value="Comprimé">Comprimé</option>
                                            <option value="Injection">Injection</option>
                                            <option value="Géllule">Géllule</option>
                                            <option value="Sachet">Sachet</option>
                                            <option value="Suppositoire">Suppositoire</option>
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPassword" class="col-sm-12 col-form-label">Nom du médicament</label>
                                        <div class="col-sm-12">
                                            <input type="text"  name="designation[]" class="form-control" value ="Paluvar" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputNumber" class="col-sm-12 col-form-label">Quantité</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="quantie[]" class="form-control" value ="2" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputNumber" class="col-sm-12 col-form-label">Nombre de jours de traitement</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" type="text" value ="medecin 1" disabled>
                                        </div>
                                    </div>

                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Médicament #2
                            </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample2">
                            <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label for="inputEmail" class="col-sm-12 col-form-label">Type de médicament</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value ="Comprimé" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPassword" class="col-sm-12 col-form-label">Nom du médicament</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value ="Paluvar" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputNumber" class="col-sm-12 col-form-label">Quantité</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" value ="2" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputNumber" class="col-sm-12 col-form-label">Nombre de jours de traitement</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" type="text" value ="medecin 1" disabled>
                                        </div>
                                    </div>

                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                Médicament #3
                            </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample2">
                            <div class="accordion-body">

                                    <div class="row mb-3">
                                        <label for="inputEmail" class="col-sm-12 col-form-label">Type de médicament</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value ="Comprimé" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPassword" class="col-sm-12 col-form-label">Nom du médicament</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value ="Paluvar" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputNumber" class="col-sm-12 col-form-label">Quantité</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" value ="2" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputNumber" class="col-sm-12 col-form-label">Nombre de jours de traitement</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" type="text" value ="medecin 1" disabled>
                                        </div>
                                    </div>

                            </div>
                            </div>
                        </div>
                        </div><!-- End Default Accordion Example -->

                    </div>
                    </div>

                </div>

                    <!-- Left side columns -->

                </div>
            </section>
        </form>
    </div>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


@stop
@section('script')
    <script>
        $( document ).ready(function() {
            $('#sidebarCollapse').trigger('click');
        });
    </script>
@stop

