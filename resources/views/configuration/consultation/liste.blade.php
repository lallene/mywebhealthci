@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Consultation Agent</h2>
                </div>
            </div>
        </div>
        <section class="section dashboard">
            <div class="row" >

                <div class="col-lg-3">

                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">HISTORIQUE AGENT</h5>

                            <!-- Default Accordion -->
                            <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Track Agent #1
                                </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <form>
                                        <div class="row mb-3">
                                        <label for="inputText" class="col-sm-12 col-form-label">Date Vérif</label>
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
                                        <label for="inputPassword" class="col-sm-12 col-form-label">Dern. Arrêt</label>
                                        <div class="col-sm-12">
                                            <input type="date" class="form-control" value ="29/10/2022" disabled>
                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                        <label for="inputNumber" class="col-sm-12 col-form-label">Nbre Jours</label>
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
                                        <label for="inputDate" class="col-sm-12 col-form-label">Motif Cons</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value ="Paludisme" disabled>
                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputDate" class="col-sm-12 col-form-label">Médoc 1</label>
                                            <div class="col-sm-12">
                                            <input type="text" class="form-control" value ="medoc 1" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputDate" class="col-sm-12 col-form-label">Médoc 2</label>
                                            <div class="col-sm-12">
                                            <input type="text" class="form-control" value ="medoc 2" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputDate" class="col-sm-12 col-form-label">Médoc 3</label>
                                            <div class="col-sm-12">
                                            <input type="text" class="form-control" value ="medoc 3" disabled>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Track Agent #2
                                </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <form>
                                        <div class="row mb-3">
                                        <label for="inputText" class="col-sm-12 col-form-label">Date Vérif</label>
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
                                        <label for="inputPassword" class="col-sm-12 col-form-label">Dern. Arrêt</label>
                                        <div class="col-sm-12">
                                            <input type="date" class="form-control" value ="29/10/2022" disabled>
                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                        <label for="inputNumber" class="col-sm-12 col-form-label">Nbre Jours</label>
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
                                        <label for="inputDate" class="col-sm-12 col-form-label">Motif Cons</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value ="Paludisme" disabled>
                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputDate" class="col-sm-12 col-form-label">Médoc 1</label>
                                            <div class="col-sm-12">
                                            <input type="text" class="form-control" value ="medoc 1" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputDate" class="col-sm-12 col-form-label">Médoc 2</label>
                                            <div class="col-sm-12">
                                            <input type="text" class="form-control" value ="medoc 2" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputDate" class="col-sm-12 col-form-label">Médoc 3</label>
                                            <div class="col-sm-12">
                                            <input type="text" class="form-control" value ="medoc 3" disabled>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Track Agent #3
                                </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <form>
                                    <div class="row mb-3">
                                    <label for="inputText" class="col-sm-12 col-form-label">Date Vérif</label>
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
                                    <label for="inputPassword" class="col-sm-12 col-form-label">Dern. Arrêt</label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" value ="29/10/2022" disabled>
                                    </div>
                                    </div>
                                    <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-12 col-form-label">Nbre Jours</label>
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
                                    <label for="inputDate" class="col-sm-12 col-form-label">Motif Cons</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" value ="Paludisme" disabled>
                                    </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputDate" class="col-sm-12 col-form-label">Médoc 1</label>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" value ="medoc 1" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputDate" class="col-sm-12 col-form-label">Médoc 2</label>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" value ="medoc 2" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputDate" class="col-sm-12 col-form-label">Médoc 3</label>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" value ="medoc 3" disabled>
                                        </div>
                                    </div>
                                </form>
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
                            <h5 class="card-title">INFORMATION AGENT</h5>

                                <!-- Default Accordion -->
                                <div class="accordion" id="accordionExample1">

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSeven">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapsSeven">
                                            CONSTANCE
                                        </button>
                                        </h2>
                                        <div >
                                        <div >
                                            <form class="row g-3 accordion-body">
                                                <div class="col-md-2">
                                                <label for="validationDefault01" class="form-label">Poids</label>
                                                <input type="text" class="form-control" id="validationDefault01"   value ="67 KG"  required>
                                                </div>
                                                <div class="col-md-3">
                                                <label for="validationDefault02" class="form-label">Pouls</label>
                                                <input type="text" class="form-control" id="validationDefault02"  value ="55 bpm" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault02" class="form-label">Température</label>
                                                    <input type="text" class="form-control" id="validationDefault02" value ="37,8 °C" required>
                                                </div>
                                                <div class="col-md-4">
                                                <label for="validationDefault03" class="form-label">Tension Art</label>
                                                <input type="text" class="form-control" id="validationDefault03" required value ="115/75 mm Hg" required>
                                                </div>

                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingEight">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                        INFORMATION AGENT
                                    </button>
                                    </h2>
                                    <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample1">
                                    <div class="accordion-body">
                                        <form class="row g-4 accordion-body">
                                            <div class="col-md-3">
                                            <label for="validationDefault01" class="form-label">IRIS</label>
                                            <input type="number" class="form-control" id="validationDefault01"   value ="126774"  required disabled>
                                            </div>
                                            <div class="col-md-3">
                                            <label for="validationDefault02" class="form-label">Nom </label>
                                            <input type="text" class="form-control" id="validationDefault02"  value ="ACHI" required disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationDefault02" class="form-label">Prémons</label>
                                                <input type="text" class="form-control" id="validationDefault02" value ="LALLENE CEDRIC" required disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="validationDefault03" class="form-label">Sexe</label>
                                                <input type="text" class="form-control" id="validationDefault03" required value ="M" required disabled>
                                            </div>
                                            <div class="col-md-4">
                                            <label for="validationDefault03" class="form-label">Date Nais</label>
                                            <input type="text" class="form-control" id="validationDefault03" required value ="13/03/1994" required disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="validationDefault03" class="form-label">Age</label>
                                                <input type="nunber" class="form-control" id="validationDefault03" required value ="28" required disabled>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="validationDefault03" class="form-label">Contrat</label>
                                                <input type="text" class="form-control" id="validationDefault03" required value ="CDD" required disabled>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="validationDefault03" class="form-label">Assuré</label>
                                                <input type="text" class="form-control" id="validationDefault03" required value ="NON" required disabled>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="validationDefault03" class="form-label">Projet</label>
                                                <input type="text" class="form-control" id="validationDefault03" required value ="IT" required disabled>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="validationDefault03" class="form-label">Fonction</label>
                                                <input type="text" class="form-control" id="validationDefault03" required value ="Support Fonctionnel" required disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationDefault03" class="form-label">Service</label>
                                                <input type="text" class="form-control" id="validationDefault03" required value ="TECHNIQUE" required disabled>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="validationDefault03" class="form-label">Date d'embauche</label>
                                                <input type="text" class="form-control" id="validationDefault03" required value ="09/08/2021" required disabled>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="validationDefault03" class="form-label">Ancienneté</label>
                                                <input type="text" class="form-control" id="validationDefault03" required value ="09/08/2021" required disabled>
                                            </div>

                                            <div class="col-md-5">
                                                <label for="validationDefault03" class="form-label">N+1 Patient</label>
                                                <input type="text" class="form-control" id="validationDefault03" required value ="Evard Diouho" required disabled>
                                            </div>

                                        </form>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSeven">
                                        <button   class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="true" aria-controls="collapse">
                                            FICHE DE CONSULTATION
                                        </button>
                                        </h2>
                                        <div>
                                        <div class="">
                                            <form class="row g-4 accordion-body">
                                                <div class="col-md-3">
                                                <label for="validationDefault01" class="form-label">Statut du patient</label>
                                                <select class="form-select" class="form-select"name="statut_patient" id="">
                                                    <option value="interne">interne</option>
                                                    <option value="externe" selected>Externe</option>
                                                </select>
                                                </div>
                                                <div class="col-md-3">
                                                <label for="validationDefault02" class="form-label">Accident de Travail </label>
                                                    <select class="form-select" class="form-select"name="accident_travail" id="">
                                                        <option value="1">Oui</option>
                                                        <option value="0" selected>Non</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault02" class="form-label">Traitement administré</label>
                                                    <select class="form-select" class="form-select"name="traitement_adm" id="">
                                                        <option value="1" selected>Oui</option>
                                                        <option value="0">Non</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault02" class="form-label">Medoc administré</label>
                                                    <select class="form-select" class="form-select"name="medoc_adm" id="">
                                                        <option value="1" selected>Oui</option>
                                                        <option value="0">Non</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Arrêt <br>maladie</label>
                                                    <select class="form-select" class="form-select"name="arret_maladie_recue" id="">
                                                        <option value="1" selected>Oui</option>
                                                        <option value="0">Non</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                <label for="validationDefault03" class="form-label">Durée Arret maladie</label>
                                                <select class="form-select" class="form-select"name="duree_arret">
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
                                                    <label for="validationDefault03" class="form-label">Date de reprise
                                                    </label>
                                                    <input type="date" class="form-control" id="validationDefault03"  value =""   name="date_repise_trvl">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Nombre de jours</label>
                                                    <input type="number" class="form-control" id="validationDefault03"  value =""  name="nbre_jours" >
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Billet <br>de sortie</label>
                                                    <select class="form-select" class="form-select"name="billet_sortie" id="">
                                                        <option value="1" >Oui</option>
                                                        <option value="0" selected>Non</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Test <br> Covid-19</label>
                                                    <select class="form-select" class="form-select"name="covid" id="">
                                                        <option value="1" >Positif</option>
                                                        <option value="0" selected>Negatif</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Repise de service</label>
                                                    <select class="form-select" class="form-select"name="repris_service" id="">
                                                        <option value="1" selected>apte</option>
                                                        <option value="0" >inapte</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Vacciné Covid-19</label>
                                                    <select class="form-select" class="form-select"name="vaccin_covid" id="">
                                                        <option value="1" >oui</option>
                                                        <option value="0" selected>non</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Dose de vaccin recue</label>
                                                    <select class="form-select" class="form-select"name="vaccin_covid" id="">
                                                        <option value="1" >oui</option>
                                                        <option value="2" selected>non</option>
                                                        <option value="3" >non</option>
                                                        <option value="4" >non</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="validationDefault03" class="form-label">Observation du patient</label>
                                                    <input type="texterea" class="form-control" id="validationDefault03"  value ="" name="observation" >
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

                <div class="col-lg-3">

                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">ORDONNANCE AGENT</h5>

                    <!-- Default Accordion -->
                    <div class="accordion" id="accordionExample2">
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                            Medoc Agent #1
                          </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse show" aria-labelledby="headingFour" data-bs-parent="#accordionExample2">
                          <div class="accordion-body">
                            <form>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-12 col-form-label">Type de medoc</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" value ="Comprimé" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-12 col-form-label">Nom du médoc</label>
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
                                    <label for="inputNumber" class="col-sm-12 col-form-label">Nb Jours</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" value ="medecin 1" disabled>
                                    </div>
                                </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Medoc Agent #2
                          </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample2">
                          <div class="accordion-body">
                            <form>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-12 col-form-label">Type de medoc</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" value ="Comprimé" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-12 col-form-label">Nom du médoc</label>
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
                                    <label for="inputNumber" class="col-sm-12 col-form-label">Nb Jours</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" value ="medecin 1" disabled>
                                    </div>
                                </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSix">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            Medoc Agent #3
                          </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample2">
                          <div class="accordion-body">
                            <form>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-12 col-form-label">Type de medoc</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" value ="Comprimé" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-12 col-form-label">Nom du médoc</label>
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
                                    <label for="inputNumber" class="col-sm-12 col-form-label">Nb Jours</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" value ="medecin 1" disabled>
                                    </div>
                                </div>
                            </form>
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
    </div>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
@stop
@section('script')
    <script>
        $( document ).ready(function() {
            $('#sidebarCollapse').trigger('click');
        });
    </script>
@stop

