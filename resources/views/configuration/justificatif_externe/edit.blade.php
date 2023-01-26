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
            .contact-form1{
                background-color: #174650;
                position: relative;
                border-radius: 12PX;
                TOP: -20PX;
                HEIGHT: 186PX;
                LEFT: 3px
            }
            .contact-form2{
                background-color: #174650;
                position: relative;
                border-radius: 12PX;
                TOP: -18PX;
                HEIGHT: 483PX;
                LEFT: 1px;
            }


        </style>
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Réception de justificatif du collaborateur</h2>
                </div>
            </div>
        </div>
        <section class="section dashboard">
            <div class="row " >
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                                <!-- Default Accordion -->
                            <form class=""  method="post" action="{{  route('justificatif_externe.update',  $consultation->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" class="form-control" name="agent_id" value="{{ $consultation->Agent->id }}">
                                <div class="accordion" id="headingEight">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingEight">
                                            <button class="accordion-button collapsed accordiontt" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                                INFORMATION DU COLLABORATEUR
                                            </button>
                                        </h2>

                                        <div id="collapseEight" class="accordion-collapse collapse show" aria-labelledby="headingEight" data-bs-parent="#headingEight">
                                            <div class="accordion-body row g-4  ">
                                                <fieldset class="col-12 contact-form1">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="input-container focus">
                                                                <input type="number" class="input" id="iris" value="{{ $consultation->Agent->iris }}" readonly disabled>
                                                                <label for="iris">Iris</label>
                                                                <span>Iris</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="input-container focus">
                                                                <input type="text" class="input" id="nom" value="{{ $consultation->Agent->nom. ' '.$consultation->Agent->prenom }}" readonly disabled>
                                                                <label for="nom">Nom & Prénom(s)</label>
                                                                <span>Nom & Prénom(s)</span>
                                                            </div>
                                                        </div>
        
                                                        <div class="col-md-2">
                                                            <div class="input-container focus">
                                                                <input type="text" class="input" id="dateNaissance" value="<?= date('d-m-Y', strtotime($consultation->Agent->dateNaissance)) ?>"  disabled>
                                                                <label for="dateNaissance">Date de Naissance</label>
                                                                <span>Date de Naissance</span>
                                                            </div>
                                                        </div>
        
                                                        <div class="col-md-2">
                                                            <div class="input-container focus">
                                                                <input type="text" class="input" id="sexe" value="<?= ($consultation->Agent->sexe == 'M') ? 'Masculin' : 'Feminin' ?>"  disabled>
                                                                <label for="sexe">Sexe</label>
                                                                <span>Sexe</span>
                                                            </div>
                                                        </div>
        
        
                                                        <div class="col-md-3">
                                                            <div class="input-container focus">
                                                                <input type="text" class="input" id="sexe" value="<?= ($consultation->Agent->dateembauche ) ?>"  disabled>
                                                                <label for="dateEmbauche">Date d'embauche</label>
                                                                <span>Date d'embauche</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="input-container focus">
                                                                <input type="text" class="input" id="emploi" value="{{ $consultation->Agent->Emploi->designation }}" disabled>
                                                                <label for="emploi">Fonction</label>
                                                                <span>Fonction</span>
                                                            </div>
                                                        </div>
        
                                                        <div class="col-md-2">
                                                            <div class="input-container focus">
                                                                <input type="text" class="input" id="contrat" value="{{ $consultation->Agent->Contrat->designation }}" disabled>
                                                                <label for="contrat">Type de contrat</label>
                                                                <span>Type de contrat</span>
                                                            </div>
                                                        </div>
        
                                                        <div class="col-md-3">
                                                            <div class="input-container focus">
                                                                <input type="text" class="input" id="manager" value="{{ $consultation->Agent->Manager->nom.' '.$consultation->Agent->Manager->prenom }}" disabled>
                                                                <label for="manager">Manager</label>
                                                                <span>Manager</span>
                                                            </div>
                                                        </div>
    
                                                    </div>

                                                </fieldset>
                                               
                                                
                                            </div>
                                        </div>
                                    </div>
                                   <div class="accordion-item align-self-center">
                                        <h2 class="accordion-header" id="headingNine">
                                            <button   class="accordion-button collapsed accordiontt" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                                                FICHE DE JUSTIFICATIF EXTERNE
                                            </button>
                                        </h2>
                                        <div>
                                            <div id="collapseNine" class="accordion-collapse collapse show " aria-labelledby="headingNine" data-bs-parent="#headingNine">
                                                <div class="row g-4 accordion-body ">

                                                    <fieldset class="col-12 contact-form2">
                                                      
                                                        <div class="row">
                                                            <div class="col-md-3 " >
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
                                                            <div class="col-md-3">
                                                                <div class="input-container focus" >
                                                                    <input type="date" class=" input " max="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" id="dateConsultation" required name="dateConsultation" value="{{ $consultation->dateConsultation }}" disabled>
                                                                    <label for="dateConsultation">Date consultation</label>
                                                                    <span>Date consultation</span>
                                                                </div>
    
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="input-container focus ">
                                                                    <select name="motif_consultation_id" class=" input " id="motif_consultation_id"   ?>">
                                                                        <?php
                                                                            foreach ($motifs as $motif) {
                                                                                ?>
                                                                                <option value="{{ $motif->id }}">{{ $motif->intitule }}</option>
                                                                                <?php
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                    <label for="motif_consultation_id">Motif de consultation externe</label>
                                                                    <span>Motif de consultation externe</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="input-container focus  ">
                                                                    <select class="input" name="repriseService" id="repriseService" disabled>
                                                                        <option value="apte" >Apte</option>
                                                                        <option value="inapte">Inapte</option>
                                                                        <option value=" {{ $consultation->repriseService }}" selected>{{ $consultation->repriseService }}</option>
                                                                    </select>
                                                                    <label for="repriseService">Reprise de service</label>
                                                                    <span>Reprise de service</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="input-container focus">
                                                                    <input type="text" class=" input " id="nomMedecin"  value="{{ $consultation->nomMedecin }}" required name="nomMedecin" style="border: 2px solid #dc3545" >
                                                                    <label for="nomMedecin">Médecin externe</label>
                                                                    <span>Médecin externe</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="input-container focus">
                                                                    <input type="text" class=" input " id="designationCentreExterne"  value="{{ $consultation->designationCentreExterne }}" required name="designationCentreExterne" style="border: 2px solid #dc3545" >
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

                                                            <div class="col-md-3">
                                                                <div class="input-container focus arretMaladieSwitch">
                                                                    <select class=" input" name="maladie_contagieuse" id="maladie_contagieuse" disabled>
                                                                        <option value="oui">Oui</option>
                                                                        <option value="non"  >Non</option>
                                                                        <option value="{{ $consultation->maladie_contagieuse }}" selected >{{ $consultation->maladie_contagieuse }}</option>                             
                                                                    </select>
                                                                    <label for="maladie_contagieuse">Maladie contagieuse</label>
                                                                    <span>Maladie contagieuse</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="input-container focus arretMaladieSwitch">
                                                                    <input type="numeric" class=" input " name="duree_arret" id="duree_arret" value="{{ $consultation->duree_arret }}" disabled>
                                                                    <label for="duree_arret">Durée arrêt maladie (en heures)</label>
                                                                    <span>Durée arrêt maladie (en heures)</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="input-container arretMaladieSwitch focus">
                                                                    <input type="text" class="input" disabled id="enJours" value="0">
                                                                    <input type="hidden" class="input" id="enJours2" value="0">
                                                                    <label for="enJours">Durée arrêt maladie (en jours)</label>
                                                                    <span>Durée arrêt maladie (en jours)</span>
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
                                                                    <input type="date" class=" input" id="debutArret" min="<?= date('Y-m-d') ?>" value="{{ $consultation->debutArret }}"  name="debutArret" >
                                                                    <label for="debutArret">Date de début</label>
                                                                    <span>Date de début</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="input-container focus arretMaladieSwitch">
                                                                    <input type="date" class=" input" id="dateReprise" value="{{ $consultation->dateReprise }}" name="dateReprise">
                                                                    <label for="dateReprise">Date de reprise</label>
                                                                    <span>Date de reprise</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="input-container focus repos d-none">
                                                                    <select class=" input " name="motifRejet" id="motifRejet">
                                                                        <option value="Pièce incomplètes"  selected>Pièces incomplètes</option>
                                                                        <option value="authenticite" > Doute sur l'authenticité</option>
                                                                        <option value="Hors délai de 72H" >Hors délai de 72H</option>
                                                                        <option value="Hors délai de 72H" >Non conforme</option>
                                                                    </select>
                                                                    <label for="motifRejet">Motif du rejet</label>
                                                                    <span>Motif du rejet</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="input-container focus">
                                                                    <textarea class=" input" rows="3" id="observation" name="observation" value="{{ $consultation->observation }}"></textarea>
                                                                    <label for="observation">Observations</label>
                                                                    <span>Observations</span>
                                                                </div>
                                                            </div>
                                                            <div class="d-grid gap-2 col-3 mx-auto">
                                                                <button class="btvalidate   " type="submit">Enregistrer</button>
                                                            </div>
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

@stop

