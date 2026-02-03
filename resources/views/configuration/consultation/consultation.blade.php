@extends('layouts.app')
<link rel="stylesheet" href="{{ asset("assets/css/recherche.css") }}" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


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
        <style>
            /* Style du titre */
            .page_title h2 {
                font-size: 30px;
                font-weight: bold;
                color: #343a40;
                letter-spacing: 1px;
                text-transform: uppercase;
            }
        
            /* Bouton avec effet de survol */
            .btn-modal {
                background-color: #198754; 
                color: white;
                font-size: 18px;
                border: none;
                padding: 12px 30px;
                border-radius: 30px;
                transition: all 0.3s ease;
            }
        
            .btn-modal:hover {
                background-color: #155d44;
                transform: translateY(-3px); /* Léger effet de flottement */
            }
        
            .btn-modal:focus {
                outline: none;
            }
        
            /* Aligner le titre et le bouton */
            .col-md-9 {
                font-size: 30px;
                font-weight: 700;
            }
        </style>
        <style>
            /* Limiter la largeur des éléments sélectionnés dans Select2 */
            .select2-selection__rendered {
                line-height: 30px !important; /* Hauteur du texte */
                max-width: 100% !important; /* Limiter la largeur maximale à 100% */
                white-space: nowrap !important; /* Empêcher le texte de se découper sur plusieurs lignes */
                overflow: hidden !important; /* Masquer le texte qui dépasse */
                text-overflow: ellipsis !important; /* Ajouter des points de suspension si le texte dépasse */
            }

            /* Style du champ Select2 */
            .select2-container {
                width: 100% !important; /* Assurer que Select2 occupe toute la largeur disponible */
            }

            .select2-selection {
                height: 40px !important; /* Hauteur du champ */
                padding: 5px 10px !important; /* Espacement intérieur pour rendre le champ plus spacieux */
                font-size: 16px !important; /* Taille du texte */
                border-radius: 8px !important; /* Bords arrondis */
                border: 2px solid #ddd !important; /* Bordure gris clair */
                max-width: 100% !important; /* Limiter la largeur du champ */
            }

            /* Style des options du Select2 */
            .select2-results__option {
                padding: 10px !important; /* Espacement intérieur pour les options */
            }

            .select2-results__option[aria-selected=true] {
                background-color: #174650 !important; /* Couleur d'arrière-plan lorsqu'une option est sélectionnée */
                color: white !important; /* Couleur du texte sélectionné */
            }

            /* Amélioration du style pour le label */
            .motif_consultation label {
                font-size: 16px !important;
                color: #f9f9f9 !important;
                font-weight: 300;
            }

            /* Ajouter un espace entre le champ et le label */
            .motif_consultation {
                margin-bottom: 20px !important;
            }

            .select2-container--default .select2-search--inline .select2-search__field {
                background: transparent;
                border: none;
                outline: 0;
                box-shadow: none;
                -webkit-appearance: textfield;
                color:white;
            }

            /* Style du conteneur Select2 */
            .select2-container--default .select2-selection--multiple {
                border: 2px solid #ffffff !important; /* Bordure grise pour le champ multiple */
                background-color: #174650 !important; /* Couleur d'arrière-plan claire */
                height: 95px !important;
            }

            /* Style du champ de texte dans Select2 */
            .select2-selection__choice {
                background-color: #cc3262 !important; /* Couleur d'arrière-plan pour les éléments sélectionnés */
                color: white !important; /* Couleur du texte */
                padding: 5px 10px !important; /* Espacement intérieur */
                border-radius: 4px !important; /* Bords arrondis */
                margin-right: 5px !important; /* Espacement entre les éléments sélectionnés */
            }

            /* Style de la zone de recherche dans Select2 */
            .select2-search__field {
                height: 30px !important; /* Hauteur du champ de recherche */
                font-size: 16px !important; /* Taille du texte dans le champ de recherche */
                padding: 5px !important; /* Espacement intérieur */
            }

            /* Style pour les options survolées dans Select2 */
            .select2-results__option--highlighted {
                background-color: #007bff !important; /* Fond bleu pour l'option survolée */
                color: white !important; /* Texte blanc pour l'option survolée */
            }

            /* Réduire la largeur des éléments sélectionnés dans le champ */
            .select2-selection__choice {
                max-width: 80px !important; /* Limiter la largeur des éléments sélectionnés */
                overflow: hidden !important; /* Masquer l'excédent */
                text-overflow: ellipsis !important; /* Ajouter des points de suspension si nécessaire */
            }

            /* Ajout d'une bordure de focus personnalisée pour Select2 */
            .select2-selection--multiple:focus {
                border-color: #007bff !important; /* Couleur de la bordure lorsque le champ est focus */
                box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25) !important; /* Ombre autour du champ focus */
            }

            /* Amélioration générale de la mise en page */
            .motif_consultation {
                margin-bottom: 30px !important; /* Espacement pour éviter que les éléments ne soient trop proches */
            }

            .motif_consultation span {
                font-size: 14px !important;
                color: #fbf7f7 !important;
            }

            /* Style pour le titre de la section */
            .section-title {
                font-size: 24px !important;
                font-weight: bold !important;
                color: #333 !important;
                margin-bottom: 20px !important;
                text-align: center; /* Centrer le titre */
                border-bottom: 2px solid #007bff !important; /* Ajouter une ligne sous le titre */
                padding-bottom: 10px;
            }

        </style>
            <div class="row column_title">
                <div class="col-md-12">
                    <div class="page_title row mb-4">
                        <h2 class="col-md-9 text-uppercase font-weight-bold" style="font-size: 30px; color: #343a40;">
                            Consultation du collaborateur
                        </h2>
                        <div class="col-md-3 text-end">
                            <button class="btn btn-primary btn-modal"
                                    data-toggle="modal"
                                    data-target="#fsModal"
                                    style="background-color: #198754; color: white; font-size: 18px; border: none; padding: 12px 30px; border-radius: 30px; transition: all 0.3s ease;">
                                Historique du collaborateur
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <section class="section dashboard row">
                    <!-- Right side columns -->
                    <form class="col-md-12" method="post" id="myForm" action="{{ route($link.'.store') }}">
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
                                                    <button class="accordion-button collapsed accordiontt" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                                                        INFORMATION DU COLLABORATEUR
                                                    </button>
                                                </h2>
                                                <div id="collapseEight" class="accordion-collapse collapse show" aria-labelledby="headingEight" data-bs-parent="#headingEight">
                                                    <div class="accordion-body row g-4 contact-form1 ">
                                                        @csrf                                                       
                                                        <div class="col-md-3">
                                                            <div class="input-container focus">
                                                                <input type="text" class="input" id="workday" value="{{ $agent->Matricule_salarie }}" readonly disabled>
                                                                <label for="workday">Workday ID</label>
                                                                <span>Workday ID<</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="input-container focus">
                                                                <input type="text" class="input" id="nom" value="{{ $agent->nom. ' '.$agent->prenom }}" readonly disabled>
                                                                <label for="nom">Nom & Prénom(s)</label>
                                                                <span>Nom & Prénom(s)</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="input-container focus">
                                                                <input type="text" class="input" id="projet" value="{{ $agent->Projet->designation }}"  disabled>
                                                                <label for="projet">Projet/service</label>
                                                                <span>Projet/service</span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="input-container focus">
                                                                <input type="text" class="input" id="contrat" value="{{ $agent->Contrat->designation }}" disabled>
                                                                <label for="contrat">Type de contrat</label>
                                                                <span>Type de contrat</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="input-container focus">
                                                                <input type="text" class="input" id="sexe" value="{{ $agent->dateembauche }}"  disabled>
                                                                <label for="dateEmbauche">Date d'embauche</label>
                                                                <span>Date d'embauche</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="input-container focus">
                                                                <input type="text" class="input" id="emploi" value="{{ $agent->SousFonction->intitule }}" name="emploi" disabled>
                                                                <label for="emploi">Fonction</label>
                                                                <span>Fonction</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingSeven">
                                                    <button class="accordion-button accordiontt" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapsSeven">
                                                        CONSULTATION
                                                    </button>
                                                </h2>
                                                <div id="collapseSeven" class="accordion-collapse collapse show " aria-labelledby="collapseSeven" data-bs-parent="#headingSeven">
                                                    <div class="row g-3 accordion-body ">
                                                        <fieldset class="col-12 contact-form">
                                                            <legend>Constantes</legend>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="input-container focus">
                                                                        <input type="numeric" class="input" step="any" id="poids" name="poids" >
                                                                        <label for="poids">Poids</label>
                                                                        <span>Poids</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="input-container focus">
                                                                        <input type="numeric" class="input" step="any" id="poul" name="poul"  >
                                                                        <label for="poul">Pouls</label>
                                                                        <span>Pouls</span>
                                                                   </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="input-container focus ">
                                                                        <input type="numeric" class="input" step="any" id="temperature" name="temperature" >
                                                                        <label for="temperature">Température</label>
                                                                        <span>Température</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="input-container focus ">
                                                                        <input type="text" class="input" step="any" id="tension" name="tension" placeholder="...../....">
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
                                                                        <select class="input" name="accident" id="accident">
                                                                            <option value="oui">Oui</option>
                                                                            <option value="non" selected>Non</option>
                                                                        </select>
                                                                        <label for="accident">Accident de travail</label>
                                                                        <span>Accident de travail</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="input-container focus">
                                                                        <select class="input" name="soinadministre" id="soinadministre">
                                                                            <option value="oui">Oui</option>
                                                                            <option value="non" selected>Non</option>
                                                                        </select>
                                                                        <label for="soinadministre">Soin administré</label>
                                                                        <span>Soin administré</span>
                                                                    </div>
                                                                </div>

                                                               

                                                                <div class="col-md-3">
                                                                    <div class="input-container focus">
                                                                        <select class="input" name="maladie_contagieuse" id="maladie_contagieuse">
                                                                            <option value="oui">Oui</option>
                                                                            <option value="non" selected >Non</option>
                                                                        </select>
                                                                        <label for="maladie_contagieuse">Maladie contagieuse</label>
                                                                        <span>Maladie contagieuse</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="input-container focus">
                                                                        <select class="input" name="maladie_prof" id="maladie_prof">
                                                                            <option value="oui">Oui</option>
                                                                            <option value="non" selected >Non</option>
                                                                        </select>
                                                                        <label for="maladie_prof">Maladie professionnelle</label>
                                                                        <span>Maladie professionnelle</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <div class=" motif_consultation focus">
                                                                        <label for="motif_consultation_id">Motif de consultation</label>
                                                                        <div class="select2-container">
                                                                            <select name="motif_consultation_id[]" id="motif_consultation_id"  multiple>
                                                                                @foreach ($motifs as $motif)
                                                                                    <option value="{{ $motif->id }}" style="color:white">{{ $motif->intitule }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                                
                                                            </div>
                                                        </fieldset>

                                                        <fieldset class="col-12 contact-form">
                                                            <legend>Arrêt Maladie</legend>

                                                            <div class="row">
                                                                <div class="col-md-4 " >
                                                                    <div class="input-container focus">
                                                                    <select name="siteConsultation" class=" input" id="siteConsultation"  >
                                                                        <?php
                                                                            foreach ($sites as $ss) {
                                                                                ?>
                                                                                     <option <?= ($ss->id == $agent->Projet->Site->id )? "selected" : "" ?>   value="{{$ss->id }}">{{ $ss->designation }}</option>
    
                                                                                <?php
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                        <label for="siteConsultation">Site de consultation</label>
                                                                        <span>Site de consultation</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="input-container focus">
                                                                        <select class="input" name="arretMaladie" id="arretMaladie">
                                                                            <option value="oui">Oui</option>
                                                                            <option value="non" selected>Non</option>
                                                                            <option value="repos" >Repos</option>
                                                                            <option value="Analyse externe" >Analyse externe</option>
                                                                        </select>
                                                                        <label for="arretMaladie">Arrêt maladie</label>
                                                                        <span>Arrêt maladie</span>
                                                                    </div>

                                                                </div>

                                                                <div class="col-md-4   arretMaladieSwitch d-none">
                                                                    <div class="input-container focus">
                                                                        <input type="integer"  class="input " name="duree_arret" id="duree_arret" value="0">
                                                                        <label for="dateConsultation">Durée arrêt  (heure)</label>
                                                                        <span>Durée arrêt  (heure)</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4  repos d-none focus">
                                                                    <div class="input-container focus">
                                                                        <input type="numeric" class="input" name="repos" id="repos" value="0">
                                                                        <label for="repos">Repos (minutes)</label>
                                                                        <span>Repos (minutes)</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4  analyseExterne d-none focus">
                                                                    <div class="input-container focus">
                                                                        <input type="numeric" class="input" name="analyseExterne" id="analyseExterne" value="0">
                                                                        <label for="analyseExterne">Analyse Externe (heure)</label>
                                                                        <span>Analyse Externe (heure)</span>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="input-container arretMaladieSwitch  d-none focus">
                                                                        <input type="text" class="input" disabled id="enJours" value="0">
                                                                        <input type="hidden" class="input" id="enJours2" value="0">
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
                                                                        <input type="date" class="input" readonly id="dateReprise" value="<?= date('Y-m-d') ?>" name="dateReprise">
                                                                        <label for="dateReprise">Date de reprise</label>
                                                                        <span>Date de reprise</span>
                                                                    <div>
                                                                </div>
                                                            </div>

                                                            </div>
                                                        </fieldset>

                                                        <fieldset class="col-12 contact-form">
                                                            <legend>Covid 19</legend>

                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="input-container focus">
                                                                        <select class="input" name="testCovid" id="testCovid">
                                                                            <option value="Positif" >Positif</option>
                                                                            <option value="Negatif" selected>Negatif</option>
                                                                        </select>
                                                                        <label for="dateConsultation">Test Covid-19</label>
                                                                        <span>Test Covid-19</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="input-container focus">
                                                                        <select class="input" name="vaccin_covid" id="vaccinCovid">
                                                                            <option value="oui" >Oui</option>
                                                                            <option value="non" selected>Non</option>
                                                                        </select>
                                                                        <label for="vaccinCovid">Vacciné Covid-19</label>
                                                                        <span>Vacciné Covid-19</span>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="input-container focus">
                                                                        <select class="input" name="doseVaccinCovid" id="doseVaccinCovid">
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
                                                        <input type="hidden" id="agent_id" value="{{ $agent->id }}">

                                                        <fieldset class="col-12 contact-form">
                                                            <legend>Observations</legend>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="input-container focus">
                                                                        <textarea class="input" rows="3" id="observation" name="observation"></textarea>
                                                                        <label for="observation">Observations</label>
                                                                        <span>Observations</span>
                                                                    </div>


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

                                                            <table class="table table-striped table-responsive-sm table-bordered " id="Tabletrack">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="20%">Date</th>
                                                                        <th width="10%">Site</th>
                                                                        <th width="30%">Durée</th>
                                                                        <th width="40%">Corps médical</th>
                                                                   </tr>
                                                                    </thead>
                                                                <tbody>
                                                                <?php
                                                                    if(isset($arrets)){
                                                                        foreach ($arrets as $arret) {

                                                                                ?>
                                                                                <tr>
                                                                                    <td><?= date('d/m/Y', strtotime($arret->created_at)) ?></td>
                                                                                    <td><?= $arret->siteConsultation ?></td>
                                                                                    <td><?=  strlen(floor($arret->duree_arret  / 60))  < 2   ? "0".floor($arret->duree_arret  / 60) : floor($arret->duree_arret  / 60) ?> : <?= strlen(($arret->duree_arret  -   floor($arret->duree_arret  / 60) * 60)) < 2 ? "0".($arret->duree_arret  -   floor($arret->duree_arret  / 60) * 60) : ($arret->duree_arret  -   floor($arret->duree_arret  / 60) * 60)?> mm</td>
                                                                                    <td><?= $arret->name ?></td>
                                                                                </tr>
                                                                                <?php

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
                                        <div class="accordion" id="accordionOrdonnace">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingFive">
                                                    <button class="accordion-button accordiontt" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                                        ORDONNANCE DU COLLABORATEUR
                                                    </button>
                                                </h2>
                                                <div id="collapseFive" class="accordion-collapse collapse show" aria-labelledby="headingFive" data-bs-parent="#accordionOrdonnace">
                                                    <div class="accordion-body" id="prescription">
                                                        <fieldset class="contact-form">
                                                            <legend>Prescription</legend>
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="input-container focus">
                                                                                <input type="text" id="searchmedoc" class="input search-input" placeholder="Rechercher un médicament" list="medicamentListUnique">
                                                                                <datalist id="medicamentListUnique">
                                                                                    <!-- Les options seront ajoutées dynamiquement ici -->
                                                                                </datalist>
                                                                                <label for="searchmedoc">Recherche</label>
                                                                                <span>Recherche</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="input-container focus">
                                                                                <input type="text" id="medicamentPrescrit" class="input" >
                                                                                <label for="medicamentPrescrit">Médicament</label>
                                                                                <span>Médicament</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
        
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="input-container focus">
                                                                                <input type="number" class="input" id="qteMedoc" readonly>
                                                                                <label for="qteMedoc">Quantité en stock</label>
                                                                                <span>Quantité en stock</span>
                                                                            </div>
        
                                                                        </div>
                                                                    </div>
                                                                </div>
        
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="input-container focus">
                                                                                <input type="number" class="input" id="quantite_prescite" min="1">
                                                                                <label for="quantite_prescite">Quantité prescrite</label>
                                                                                <span>Quantité prescrite</span>
                                                                            </div>
        
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
        
                                                            <table class="table table-striped table-responsive-sm table-bordered" id="addedMedocsTable">
                                                                <thead>
                                                                <tr>
                                                                    <th width="40%">Medicament</th>
                                                                    <th width="20%">Qté</th>
                                                                    <th width="30%">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="addedMedocsTable">
        
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
                        <input type="hidden" name="medicaments" id="medicaments" value="">
                        <div class="col-md-12 text-center">
                            <a  id="save" onclick="test()" class="btn btn-primary btn-modal" data-toggle="modal" data-target="#fsModal1" style="background-color: #198754; color:white; font-size:23; border:none">Enregistrer</a>
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
        aria-hidden="true" style=" min-width: 89vw; top: 9%; height: 87%; left: 132px;" >
        <!-- dialog -->
        <div class="modal-dialog" style="min-width: 87vw">

            <!-- content -->
            <div class="modal-content">
                <!-- header -->
                <div class="modal-header">
                    <h1 id="myModalLabel"
                    class="modal-title">
                    Historique des Consultations de {{ $agent->nom." ".$agent->prenom }} </h1>
                </div>
            <!-- header -->

            <!-- body -->
                <div class="modal-body">
                    <table class="table table-striped table-bordered" id="Tablehisto">
                        <thead>
                            <tr>
                                <th>Date Consultation</th>
                                <th>Motif</th>
                                <th>Consulté Par</th>
                                <th>Arrêt Maladie</th>
                                <th>Durée arrêt maladie</th>
                                <th>Date début arrêt Maladie</th>
                                <th>Médicaments</th>
                                <th>Observation</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($historiquesagents as $consultation)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($consultation['created_at'])->format('d/m/Y') }}</td>
                                    <td>{{ $consultation['motif_consultation'] }}</td>
                                    <td>{{ $consultation['medecin'] }}</td>
                                    <td>{{ ucfirst($consultation['typeArrêt']) }}</td>
                                    <td>{{ $consultation['duree_arret'] ?? '-' }}</td>
                                    <td>{{ $consultation['debutArret'] ? \Carbon\Carbon::parse($consultation['debutArret'])->format('d/m/Y') : '-' }}</td>
                                    <td>
                                        @if(is_array($consultation['medicaments']))
                                            @if(count($consultation['medicaments']) > 0)
                                                <ul>
                                                    @foreach($consultation['medicaments'] as $medicament)
                                                        <li>{{ $medicament['medicament_name'] }} - {{ $medicament['qte'] }} {{ $medicament['qte'] > 1 ? 'doses' : 'dose' }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <span>Aucun médicament prescrit</span>
                                            @endif
                                        @else
                                            <span>{{ $consultation['medicaments'] }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $consultation['observation'] }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            <!-- body -->

            <!-- footer -->
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary"
                            data-dismiss="modal">
                        Fermer
                    </button>
                </div>
        <!-- footer -->
            </div>
        </div>
    </div>


    <div id="fsModal1"
        class="modal animated bounceIn modal-lg"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel"
        aria-hidden="true" style=" left: 22%; top: 9%; height: 80%; " >

        <!-- dialog -->
        <div class="modal-dialog" >
            <!-- content -->
            <div class="modal-content">
                <!-- header -->
                <div class="modal-header">
                    <h1 id="myModalLabel"
                    class="modal-title">
                     Fiche consultation de {{ $agent->nom." ".$agent->prenom }}
                    </h1>
                </div>
        <!-- header -->
        <!-- body -->

                <div class="modal-body">
                    <fieldset class="col-12 contact-form" style="height:80%">
                        <p id="demo"></p>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-container focus">
                                    <input id="arretMaladie1"  class="input" disabled>
                                    <label for="arretMaladie1">Arrêt maladie</label>
                                    <span>Arrêt maladie</span>
                                </div>
                            </div>
                            <div class="col-md-4   arretMaladieSwitch d-none ">
                                <div class="input-container focus">
                                    <input type="number" class="input" name="duree_arret" id="duree_arret1"  disabled>
                                    <label for="dateConsultation">Durée arrêt  (en minutes)</label>
                                    <span>Durée arrêt  (en minutes)</span>
                                </div>
                            </div>
                            <div class="col-md-4  d-none ">
                                <div class="input-container arretMaladieSwitch  focus">
                                    <input type="text" class="input" disabled id="enJours1"  disabled>
                                    <input type="hidden" class="input" id="enJours2">
                                    <label for="enJours">Durée arrêt maladie (en minutes)</label>
                                    <span>Durée arrêt maladie (en minutes)</span>
                                </div>
                            </div>

                            <div class="col-md-4 arretMaladieSwitch d-none ">
                                <div class="input-container focus">
                                <input type="date" class="input"  id="debutArret1" value=""  name="debutArret"  disabled>
                                <label for="debutArret">Date de début </label>
                                <span>Date de début </span>
                            </div>
                            </div>
                            <div class="col-md-4 arretMaladieSwitch d-none ">
                                <div class="input-container focus">
                                <input type="date" class="input" id="dateReprise1" name="dateReprise"  disabled>
                                <label for="dateReprise">Date de reprise</label>
                                <span>Date de reprise</span>
                            </div>
                            </div>
                            <div class="col-md-4  repos d-none  focus">
                                <div class="input-container focus">
                                    <input type="number" class="input" name="repos" id="repos1"  disabled>
                                    <label for="repos">Repos (minutes)</label>
                                    <span>Repos (minutes)</span>
                                </div>
                            </div>
                            <div class="col-md-4  analyseExterne d-none   focus">
                                <div class="input-container focus">
                                    <input type="number" class="input"  id="analyseExterne1"  disabled>
                                    <label for="analyseExterne1">Analyse Externe (heure)</label>
                                    <span>Analyse Externe (heure)</span>
                                </div>
                            </div>
                        </div>

                    </fieldset>
                    <div class="p-3 mb-2 bg-warning text-dark"  style="border-raduis:2%; font-family: Helvetica; font-weight:300;  font-size:20px;   font-style: italic;">
                        Merci de bien vérifier les valeurs ci-dessus, car vous ne pourrez plus les modifier après validation, voulez-vous vraiment les sauvegarder ?</div>
                    </div>
        <!-- body -->
        <!-- footer -->
                <div class="modal-footer" style="  padding-top: 0;">
                    <button  class="btn btn-outline-success" data-dismiss="modal" onclick="formConsul();">  Enregister</button>
                    <a class="btn btn-outline-danger"  data-dismiss="modal">  Annuler  </a>
                </div>
    <!-- footer -->
            </div>
        </div>
    </div>

    
@stop
@section('script')
<!-- Script pour Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById("searchmedoc");
    const medicamentPrescritInput = document.getElementById("medicamentPrescrit"); // Assurez-vous que cet élément existe
    const qteMedocInput = document.getElementById("qteMedoc");
    const quantitePrescriteInput = document.getElementById("quantite_prescite");
    const dataList = document.getElementById("medicamentListUnique");
    const addedMedocsTableBody = document.querySelector("#addedMedocsTable tbody");
    const prescrireButton = document.getElementById("prescrire");
    const medicamentsInput = document.getElementById("medicaments");  // Champ caché pour les médicaments

    // Fonction pour collecter les médicaments et mettre à jour le champ caché
    function updateMedicamentsInput() {
        const medicaments = [];

        addedMedocsTableBody.querySelectorAll("tr").forEach(row => {
            const medicament = row.querySelector("td[name='medicament[]']").textContent;
            const quantity = row.querySelector("td[name='quantity[]']").textContent;
            const medicamentId = row.querySelector("td[name='medicament[]']").getAttribute("data-id"); // Récupérer l'ID du médicament

            medicaments.push({ medicament, quantity, medicamentId });  // Ajouter l'ID ici
        });

        // Log de ce qui est collecté
        console.log("Médicaments collectés : ", medicaments);

        // Mise à jour du champ caché avec les médicaments
        medicamentsInput.value = JSON.stringify(medicaments);
        console.log("Valeur du champ caché 'medicaments' : ", medicamentsInput.value);
    }

    // Vérifiez si l'élément medicamentPrescritInput existe avant de l'utiliser
    if (medicamentPrescritInput) {
        prescrireButton.addEventListener("click", function () {
            const medicament = medicamentPrescritInput.value.trim();  // Utilisation de medicamentPrescritInput ici
            const quantity = parseInt(quantitePrescriteInput.value, 10);
            const stockDisponible = parseInt(qteMedocInput.value, 10);

            if (isNaN(quantity) || quantity < 1 || quantity > stockDisponible) {
                alert(`Veuillez entrer une quantité valide (entre 1 et ${stockDisponible}).`);
                return;
            }

            const existingMedoc = Array.from(addedMedocsTableBody.querySelectorAll("tr td:first-child"))
                .some(td => td.textContent === medicament);

            if (existingMedoc) {
                alert("Ce médicament est déjà ajouté.");
                return;
            }

            // Récupérer l'option sélectionnée pour obtenir l'ID
            const selectedOption = Array.from(dataList.options).find(option => option.value === medicament);
            const medicamentId = selectedOption ? selectedOption.getAttribute("data-id") : null;

            if (!medicamentId) {
                alert("Médicament introuvable.");
                return;
            }

            const row = document.createElement("tr");
            row.innerHTML = `
                <td name="medicament[]" data-id="${medicamentId}">${medicament}</td>
                <td name="quantity[]">${quantity}</td>
                <td>
                    <button type="button" class="btn btn-danger remove-btn btn-sm">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            `;

            // Ajouter la ligne à la table
            addedMedocsTableBody.appendChild(row);

            // Mettre à jour le champ caché avec les médicaments après l'ajout de la ligne
            updateMedicamentsInput();

            // Réinitialiser les champs après l'ajout
            searchInput.value = "";
            medicamentPrescritInput.value = "";
            qteMedocInput.value = "";
            quantitePrescriteInput.value = "";
            prescrireButton.disabled = true;
        });
    } else {
        console.error("L'élément medicamentPrescritInput n'a pas été trouvé !");
    }

    // Mise à jour du champ caché à chaque suppression de médicament
    document.addEventListener("click", function (event) {
        if (event.target.closest(".remove-btn")) {
            const row = event.target.closest("tr");
            row.remove();

            // Mettre à jour le champ caché après la suppression
            updateMedicamentsInput();
        }
    });
});


</script>


<script>
    $(document).ready(function() {
        $('#motif_consultation_id').select2({
            allowClear: true, // Permet la suppression de la sélection
            placeholder: "Sélectionnez un motif", // Ajoute un texte indicatif
        });

        // Modifier la couleur du texte avec du CSS
        $('.select2-selection').css('color', 'white'); 
    });
</script>



<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#Tabletrack').DataTable(); // ID correct du tableau
    });
</script>
<script>
    $(document).ready(function () {
        $('#Tablehisto').DataTable(); // ID correct du tableau
    });
</script>

<script>

    function updateSelectionCount() {
        // Récupérer le nombre d'options sélectionnées
        var selectedOptions = document.getElementById('motif_consultation_id').selectedOptions;
        var selectionCount = selectedOptions.length;
        
        // Afficher le nombre d'options sélectionnées
        var countText = selectionCount === 0 ? 'Aucun motif sélectionné' : selectionCount + ' motifs sélectionnés';
        document.getElementById('selection-count').innerText = countText;
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const agentId = @json($agent->id); // Injection sécurisée
        const searchInput = document.getElementById("searchmedoc");
        const medicamentPrescritInput = document.getElementById("medicamentPrescrit");
        const qteMedocInput = document.getElementById("qteMedoc");
        const quantitePrescriteInput = document.getElementById("quantite_prescite");
        const dataList = document.getElementById("medicamentListUnique");
        const addedMedocsTableBody = document.querySelector("#addedMedocsTable tbody");
        const prescrireButton = document.getElementById("prescrire");

        // 🔁 Fonction pour récupérer les médicaments selon la recherche
        function fetchMedocs(search) {
            fetch(`/mywebhealthci/stock-disponible/${agentId}?search=${encodeURIComponent(search)}`)
                .then(response => {
                    const contentType = response.headers.get("content-type");
                    if (contentType && contentType.includes("application/json")) {
                        return response.json();
                    } else {
                        throw new Error("La réponse n'est pas un JSON");
                    }
                })
                .then(data => {
                    if (Array.isArray(data.data)) {
                        dataList.innerHTML = "";
                        console.log('Médicaments disponibles:', data);

                        data.data.forEach(medoc => {
                            const option = document.createElement("option");
                            option.value = medoc.name;
                            option.setAttribute("data-id", medoc.id);
                            option.setAttribute("data-stock", medoc.stock);
                            dataList.appendChild(option);
                        });

                        prescrireButton.disabled = data.data.length === 0;
                    } else {
                        console.error("Format de données inattendu :", data);
                    }
                })
                .catch(async error => {
                    const raw = await (error?.response?.text?.() || "Pas de réponse brute");
                    console.error("Erreur JSON :", error.message, raw);
                    alert("Erreur lors de la récupération des médicaments. Veuillez réessayer.");
                });
        }

        // 🔍 Écoute des frappes dans le champ de recherche
        searchInput.addEventListener("keyup", function () {
            const searchValue = this.value.trim();
            if (searchValue.length >= 2) {
                fetchMedocs(searchValue);
            } else {
                dataList.innerHTML = "";
                prescrireButton.disabled = true;
            }
        });

        // 🧠 Mise à jour des champs selon le médicament choisi
        searchInput.addEventListener("change", function () {
            let selectedOption = Array.from(dataList.options).find(option => option.value === this.value);
            if (selectedOption) {
                medicamentPrescritInput.value = selectedOption.value;
                qteMedocInput.value = selectedOption.getAttribute("data-stock");
                prescrireButton.disabled = false;
            } else {
                medicamentPrescritInput.value = "";
                qteMedocInput.value = "";
                prescrireButton.disabled = true;
            }
        });

        // ➕ Ajout du médicament dans le tableau
        prescrireButton.addEventListener("click", function () {
            const medicament = medicamentPrescritInput.value.trim();
            const quantity = parseInt(quantitePrescriteInput.value, 10);
            const stockDisponible = parseInt(qteMedocInput.value, 10);

            if (!medicament) return;

            if (isNaN(quantity) || quantity < 1 || quantity > stockDisponible) {
                alert(`Veuillez entrer une quantité valide (entre 1 et ${stockDisponible}).`);
                return;
            }

            const exists = Array.from(addedMedocsTableBody.querySelectorAll("tr td:first-child"))
                .some(td => td.textContent === medicament);

            if (exists) {
                alert("Ce médicament est déjà ajouté.");
                return;
            }

            const row = document.createElement("tr");
            row.innerHTML = `
                <td name="medicament[]">${medicament}</td>
                <td name="quantity[]">${quantity}</td>
                <td>
                    <button type="button" class="btn btn-danger remove-btn btn-sm">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            `;

            row.style.opacity = "0";
            addedMedocsTableBody.appendChild(row);
            setTimeout(() => {
                row.style.transition = "opacity 0.3s ease-in-out";
                row.style.opacity = "1";
            }, 10);

            // Reset des champs
            searchInput.value = "";
            medicamentPrescritInput.value = "";
            qteMedocInput.value = "";
            quantitePrescriteInput.value = "";
            prescrireButton.disabled = true;
        });

        // ❌ Suppression d’un médicament
        document.addEventListener("click", function (event) {
            if (event.target.closest(".remove-btn")) {
                const row = event.target.closest("tr");
                row.style.transition = "opacity 0.3s ease-in-out";
                row.style.opacity = "0";
                setTimeout(() => row.remove(), 300);
            }
        });
    });
</script>



<script>
        document.getElementById("save").addEventListener("click", function(event){
           event.preventDefault()
           var  formConsul= document.getElementById("myForm");

        });
    function formConsul() {
        var  formConsul= document.getElementById("myForm");
          formConsul.submit();
          console.log(formConsul);

   }

   function test() {
    // Récupérer les éléments par ID
    var natureReception = document.getElementById("natureReception");
    if (natureReception) document.getElementById("natureReception1").value = natureReception.value;

    var duree_arret = document.getElementById("duree_arret");
    if (duree_arret) document.getElementById("duree_arret1").value = duree_arret.value;

    var repos = document.getElementById("repos");
    if (repos) document.getElementById("repos1").value = repos.value;

    var analyseExterne = document.getElementById("analyseExterne");
    if (analyseExterne) document.getElementById("analyseExterne1").value = analyseExterne.value;

    var enJours = document.getElementById("enJours");
    if (enJours) document.getElementById("enJours1").value = enJours.value;

    var debutArret = document.getElementById("debutArret");
    if (debutArret) document.getElementById("debutArret1").value = debutArret.value;

    var dateReprise = document.getElementById("dateReprise");
    if (dateReprise) document.getElementById("dateReprise1").value = dateReprise.value;

    var arretMaladie = document.getElementById("arretMaladie");
    if (arretMaladie) document.getElementById("arretMaladie1").value = arretMaladie.value;


}
 

</script>
<script>
    $( document ).ready(function() {
        $('#sidebarCollapse').trigger('click');
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="{{ asset("assets/js/scripts/interact.js") }}"></script>
<script src="{{ asset("assets/js/recherche.js") }}"></script>
@stop

