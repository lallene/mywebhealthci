@extends('layouts.app')
<link rel="stylesheet" href="{{ asset("assets/css/recherche.css") }}" />
@section('content')
    <div class="container-fluid">
        <style>
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


        </style>
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>RECEPTION DE JUSTIFICATIF DU COLLABORATEUR</h2>
                </div>
            </div>
        </div>
        <section class="section dashboard">
            <div class="row " >
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">


                                <!-- Default Accordion -->
                            <form class=""  method="post" action="{{  route('justificatif_externe.store') }}" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" name="agent_id" value="{{ $agent->id }}">
                                <div class="accordion" id="headingEight">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingEight">
                                            <button class="accordion-button collapsed accordiontt" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                                INFORMATION DU COLLABORATEUR
                                            </button>
                                        </h2>

                                        <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#headingEight">
                                            <div class="accordion-body row g-4 contact-form ">
                                                @csrf
                                                <div class="col-md-2">
                                                    <div class="input-container focus">
                                                        <input type="number" class="input" id="iris" value="{{ $agent->iris }}" readonly disabled>
                                                        <label for="iris">Iris</label>
                                                        <span>Iris</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="input-container focus">
                                                        <input type="text" class="input" id="nom" value="{{ $agent->nom. ' '.$agent->prenom }}" readonly disabled>
                                                        <label for="nom">Nom & Prénom(s)</label>
                                                        <span>Nom & Prénom(s)</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="input-container focus">
                                                        <input type="text" class="input" id="dateNaissance" value="<?= date('d-m-Y', strtotime($agent->dateNaissance)) ?>"  disabled>
                                                        <label for="dateNaissance">Date de Naissance</label>
                                                        <span>Date de Naissance</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="input-container focus">
                                                        <input type="text" class="input" id="sexe" value="<?= ($agent->sexe == 'M') ? 'Masculin' : 'Feminin' ?>"  disabled>
                                                        <label for="sexe">Sexe</label>
                                                        <span>Sexe</span>
                                                    </div>
                                                </div>


                                                <div class="col-md-3">
                                                    <div class="input-container focus">
                                                        <input type="text" class="input" id="sexe" value="<?= ($agent->dateembauche ) ?>"  disabled>
                                                        <label for="dateEmbauche">Date d'embauche</label>
                                                        <span>Date d'embauche</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-container focus">
                                                        <input type="text" class="input" id="emploi" value="{{ $agent->Emploi->designation }}" disabled>
                                                        <label for="emploi">Fonction</label>
                                                        <span>Fonction</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="input-container focus">
                                                        <input type="text" class="input" id="contrat" value="{{ $agent->Contrat->designation }}" disabled>
                                                        <label for="contrat">Type de contrat</label>
                                                        <span>Type de contrat</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="input-container focus">
                                                        <input type="text" class="input" id="manager" value="{{ $agent->Manager->nom.' '.$agent->Manager->prenom }}" disabled>
                                                        <label for="manager">Manager</label>
                                                        <span>Manager</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   <div class="accordion-item align-self-center">
                                        <h2 class="accordion-header" id="headingNine">
                                            <button   class="accordion-button collapsed accordiontt" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                                                FICHE DE JUSTIFICATIF
                                            </button>
                                        </h2>
                                        <div>
                                            <div id="collapseNine" class="accordion-collapse collapse show " aria-labelledby="headingNine" data-bs-parent="#headingNine">
                                                <div class="row g-4 accordion-body ">

                                                    <fieldset class="col-12 contact-form">
                                                        <legend>Consultation Externe</legend>

                                                        <div class="col-md-12 row mb-2 mt-2 " >
                                                            <div class="input-container focus">
                                                            <select name="natureReception" class=" input" id="natureReception"  >
                                                                <?php
                                                                    foreach ($sites as $site) {
                                                                        ?>
                                                                        <option  value="{{ $site->id }}">{{ $site->designation }}</option>

                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                                <label for="natureReception">Site de consultation</label>
                                                                <span>Site de consultation</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="input-container focus">
                                                                    <input type="date" class=" input " max="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" id="dateConsultation" required name="dateConsultation"  >
                                                                    <label for="dateConsultation">Date consultation</label>
                                                                    <span>Date consultation</span>
                                                                </div>

                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="input-container focus ">
                                                                    <select name="motif_consultation_id" class=" input " id="motif_consultation_id"   ?>">
                                                                        <?php
                                                                            foreach ($foreigns as $foreign) {
                                                                                ?>
                                                                                <option value="{{ $foreign->id }}">{{ $foreign->intitule }}</option>
                                                                                <?php
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                    <label for="motif_consultation_id">Motif de consultation externe</label>
                                                                    <span>Motif de consultation externe</span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="input-container focus">
                                                                    <input type="text" class=" input " id="nomMedecin" required name="nomMedecin" style="border: 2px solid #dc3545" >
                                                                    <label for="nomMedecin">Medecin externe</label>
                                                                    <span>Medecin externe</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="input-container focus">
                                                                    <input type="text" class=" input " id="designationCentreExterne" required name="designationCentreExterne" style="border: 2px solid #dc3545" >
                                                                    <label for="designationCentreExterne">Hôpital/clinique externe</label>
                                                                    <span>Hôpital/clinique externe</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="input-container focus">
                                                                    <select class="input " name="justificatifValide" id="justificatifValide">
                                                                        <option value="oui"  selected>oui</option>
                                                                        <option value="non" >non</option>
                                                                        <option value="en attente" >en attente de validation</option>
                                                                    </select>
                                                                    <label for="justificatifValide">Justificatif valide</label>
                                                                    <span>Justificatif valide</span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="input-container focus">
                                                                    <select class=" input" name="motifRejet" id="motifRejet">
                                                                        <option value="Pièce incomplètes"  selected>Pièce incomplètes</option>
                                                                        <option value="authenticite" > Doute sur l'authenticité</option>
                                                                        <option value="Hors délai de 72H" >Hors délai de 72H</option>
                                                                        <option value="Hors délai de 72H" >non conforme</option>
                                                                    </select>
                                                                    <label for="motifRejet">Motif du rejet</label>
                                                                    <span>Motif du rejet</span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <div class="input-container focus arretMaladieSwitch ">
                                                                    <select class="input" name="repriseService" id="repriseService">
                                                                        <option value="apte" selected>Apte</option>
                                                                        <option value="inapte">Inapte</option>
                                                                    </select>
                                                                    <label for="repriseService">Reprise de service</label>
                                                                    <span>Reprise de service</span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="input-container focus arretMaladieSwitch">
                                                                    <select class=" input" name="maladie_contagieuse" id="maladie_contagieuse">
                                                                        <option value="oui">Oui</option>
                                                                        <option value="non" selected >Non</option>
                                                                    </select>
                                                                    <label for="maladie_contagieuse">Maladie contagieuse</label>
                                                                    <span>Maladie contagieuse</span>
                                                                </div>

                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="input-container focus arretMaladieSwitch">
                                                                    <input type="number" class=" input " name="duree_arret" id="duree_arret">
                                                                    <label for="duree_arret">Durée arrêt maladie (en heure)</label>
                                                                    <span>Durée arrêt maladie (en heure)</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="input-container arretMaladieSwitch focus">
                                                                    <input type="text" class="input" disabled id="enJours" value="0">
                                                                    <input type="hidden" class="input" id="enJours2" value="0">
                                                                    <label for="enJours">Durée arrêt maladie (en jour)</label>
                                                                    <span>Durée arrêt maladie (en jour)</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 d-none">
                                                                <div class="input-container focus arretMaladieSwitch">
                                                                    <select class=" input" name="nbrJour" id="nbrJour">
                                                                        <option value="Heure" selected>Heure</option>
                                                                    </select>
                                                                    <label for="nbrJour">en (heure/jour)</label>
                                                                    <span>en (heure/jour)</span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="input-container focus arretMaladieSwitch">
                                                                    <input type="date" class=" input" id="debutArret" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>"  name="debutArret" >
                                                                    <label for="debutArret">Date de début</label>
                                                                    <span>Date de début</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="input-container focus arretMaladieSwitch">
                                                                    <input type="date" class=" input" id="dateReprise" value="<?= date('Y-m-d') ?>" name="dateReprise">
                                                                    <label for="dateReprise">Date de reprise</label>
                                                                    <span>Date de reprise</span>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </fieldset>

                                                    <fieldset class="col-12 contact-form">
                                                        <legend>Observations</legend>
                                                        <div class="row">


                                                            <div class="col-md-12">

                                                            <div class="col-md-12">
                                                                <div class="input-container ">
                                                                    <textarea class=" input" rows="3" id="observation" name="observation"></textarea>
                                                                    <label for="observation">Observations</label>
                                                                    <span>Observations</span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <button class="btvalidate  " type="submit">Enregistrer</button>
                                                        </div>

                                                    </fieldset>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="{{ asset("assets/js/scripts/interact.js") }}"></script>
    <script src="{{ asset("assets/js/recherche.js") }}"></script>
    <script>
        $( document ).ready(function() {
            $('#sidebarCollapse').trigger('click');
        });


    </script>

    <script>


            document.getElementById('designationCentreExterne').addEventListener('input', event => {
            if (document.getElementById('designationCentreExterne').value === '') {
                document.getElementById('designationCentreExterne').style.border = '2px solid #dc3545';
            } else {
                document.getElementById('designationCentreExterne').style.border = '2px solid #fafafa';
            }
            });

            document.getElementById('nomMedecin').addEventListener('input', event => {
            if (document.getElementById('nomMedecin').value === '') {
                document.getElementById('nomMedecin').style.border = '2px solid #dc3545';
            } else {
                document.getElementById('nomMedecin').style.border = '2px solid #fafafa';
            }
            });

            document.getElementById('motifRejet').addEventListener('input', event => {
            if (document.getElementById('motifRejet').value === '') {
                document.getElementById('motifRejet').style.border = '2px solid #dc3545';
            } else {
                document.getElementById('motifRejet').style.border = '2px solid #fafafa';
            }
            });

            document.getElementById('duree_arret').addEventListener('input', event => {
            if (document.getElementById('duree_arret').value === '') {
                document.getElementById('duree_arret').style.border = '2px solid #dc3545';
            } else {
                document.getElementById('duree_arret').style.border = '2px solid #fafafa';
            }
            });



    </script>
@stop

