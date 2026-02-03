@extends('layouts.app')
<link rel="stylesheet" href="{{ asset("assets/css/recherche.css") }}" />
@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/modal.css') }}">
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
            .contact-form {
                    background-color: #174650;
                    position: relative;
                    border-radius: 12PX;
                    TOP: -12PX;
                    HEIGHT: 100%;
                    LEFT: 1px;
                    width: 100%;
                }

        </style>
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Réception de justificatif du collaborateur</h2>
                </div>
            </div>
        </div>
        <section>
            <div class="accordion attente " id="accordionExample2">
                <div class="accordion-item">
                    <div id="collapseFour" class="accordion-collapse collapse show" aria-labelledby="headingFour" data-bs-parent="#accordionExample2">
                        <div class="accordion-body" id="prescription">
                            <fieldset class="mt-2">
                                <table class="table table-striped table-bordered" id="Tablehisto">
                                    <thead>
                                        <tr>
                                            <th>Date Consultation</th>
                                            <th>Medécin Ext</th>
                                            <th>Clinique Ext</th>
                                            <th>Motif d'arrêt</th>
                                            <th>Arrêt maladie</th>
                                            <th>Durée arrêt maladie</th>
                                            <th>Date début arrêt Maladie</th>
                                            <th>traité Par</th>
                                            <th>Observation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($historiquesagents as $consultation)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($consultation['created_at'])->format('d/m/Y') }}</td>
                                                <td>{{ $consultation['nomMedecin'] }}</td>
                                                <td>{{ $consultation['hopital'] }}</td>
                                                <td>{{ $consultation['motif_consultation'] }}</td>
                                                <td>{{ ucfirst($consultation['typeArrêt']) }}</td>
                                                <td>{{ $consultation['duree_arret'] ?? '-' }}</td>
                                                <td>{{ $consultation['debutArret'] ? \Carbon\Carbon::parse($consultation['debutArret'])->format('d/m/Y') : '-' }}</td>
                                                <td>{{ $consultation['medecinCNX'] }}</td>
                                                <td>{{ $consultation['observation'] }}</td>
            
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div><!-- End Default Accordion Example -->
        </section>
        <section class="section dashboard">
            <div class="row " >
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">


                                <!-- Default Accordion -->
                            <form class=""  id="myForm" method="post" action="{{  route('justificatif_externe.store') }}" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" name="agent_id" value="{{ $agent->id }}">
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
                                                        <div class="col-md-3">
                                                            <div class="input-container focus">
                                                                <input type="text" class="input" id="workday" value="{{ $agent->Matricule_salarie }}" readonly disabled>
                                                                <label for="workday">Workday ID</label>
                                                                <span>Workday ID<</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
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
                                                        <div class="col-md-4">
                                                            <div class="input-container focus">
                                                                <input type="text" class="input" id="emploi" value="{{ $agent->SousFonction->intitule }}" name="emploi" disabled>
                                                                <label for="emploi">Fonction</label>
                                                                <span>Fonction</span>
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
                                                                        foreach ($sites as $ss) {
                                                                            ?>
                                                                                 <option <?= ($ss->id == $agent->Projet->Site->id )? "selected" : "" ?>   value="{{$ss->id }}">{{ $ss->designation }}</option>

                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                                    <label for="natureReception">Site de consultation</label>
                                                                    <span>Site de consultation</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="input-container focus">
                                                                    <input type="date" class=" input "  value="<?= date('Y-m-d') ?>" id="dateConsultation" required name="dateConsultation"  >
                                                                    <label for="dateConsultation">Date consultation</label>
                                                                    <span>Date consultation</span>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="input-container focus ">
                                                                    <select name="motif_consultation_id" class=" input " id="motif_consultation_id"   ?>">
                                                                                 <option value="25">Aucun </option>
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
                                                            <div class="col-md-3 motif_consultation_autre  d-none focus" >
                                                                <div class="input-container focus">
                                                                    <input type="text" class="input" name="motif_consultation_autre" id="motif_consultation_autre" value="">
                                                                    <label for="motif_consultation_autre">Motif de consultation</label>
                                                                    <span>Motif de consultation</span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="input-container focus ">
                                                                    <select class=" input" name="maladie_contagieuse" id="maladie_contagieuse">
                                                                        <option value="oui">Oui</option>
                                                                        <option value="non" selected >Non</option>
                                                                    </select>
                                                                    <label for="maladie_contagieuse">Maladie contagieuse</label>
                                                                    <span>Maladie contagieuse</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="input-container focus">
                                                                    <input type="text" class=" input " id="nomMedecin" required name="nomMedecin" style="border: 5px solid rgb(204, 50, 98);" >
                                                                    <label for="nomMedecin">Médecin externe</label>
                                                                    <span>Médecin externe</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="input-container focus">
                                                                    <input type="text" class=" input " id="designationCentreExterne" required name="designationCentreExterne" style="border: 5px solid rgb(204, 50, 98); " >
                                                                    <label for="designationCentreExterne">Hôpital/clinique externe</label>
                                                                    <span>Hôpital/clinique externe</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="input-container focus">
                                                                    <select class="input " name="justificatifValide" id="justificatifValide" required>
                                                                        <option value="oui"  >oui</option>
                                                                        <option value="non" >non</option>
                                                                        <option value="en attente" >en attente de validation</option>
                                                                    </select>
                                                                    <label for="justificatifValide">Justificatif valide</label>
                                                                    <span>Justificatif valide</span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3 arretMaladieSwitch">
                                                                <div class="input-container focus ">
                                                                    <input type="number" class=" input " name="duree_arret" id="duree_arret" value="0" style="border: 5px solid rgb(204, 50, 98);">
                                                                    <label for="duree_arret">Durée arrêt maladie (en heures)</label>
                                                                    <span>Durée arrêt maladie (en heures)</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 arretMaladieSwitch">
                                                                <div class="input-container  focus">
                                                                    <input type="text" class="input" disabled id="enJours" value="0"  style="border: 5px solid  #198754;">
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

                                                            <div class="col-md-3 arretMaladieSwitch">
                                                                <div class="input-container focus ">
                                                                    <input type="date" class=" input" id="debutArret"  value=""  name="debutArret"  style="border: 5px solid rgb(204, 50, 98);">
                                                                    <label for="debutArret">Date de début</label>
                                                                    <span>Date de début</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 arretMaladieSwitch">
                                                                <div class="input-container focus ">
                                                                    <input type="date" class=" input" id="dateReprise" value="<?= date('Y-m-d') ?>" name="dateReprise"  style="border: 5px solid  #198754;">
                                                                    <label for="dateReprise">Date de reprise</label>
                                                                    <span>Date de reprise</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="input-container focus repos d-none">
                                                                    <select class=" input " name="motifRejet" id="motifRejet">
                                                                        <option value="Pièce incomplètes" >Pièces incomplètes</option>
                                                                        <option value="authenticite" > Doute sur l'authenticité</option>
                                                                        <option value="Hors délai de 72H" >Hors délai de 72H</option>
                                                                        <option value="Non conforme" >Non conforme</option>
                                                                    </select>
                                                                    <label for="motifRejet">Motif du rejet</label>
                                                                    <span>Motif du rejet</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="input-container focus">
                                                                    <textarea class=" input" rows="3" id="observation" name="observation"></textarea>
                                                                    <label for="observation">Observations</label>
                                                                    <span>Observations</span>
                                                                </div>
                                                            </div>
                                                            <div class="d-grid gap-2 col-3 mx-auto">
                                                                <a  id="save" onclick="test()" class="btn btn-primary btn-modal" data-toggle="modal" data-target="#fsModal1" style="background-color: #198754; color:white; font-size:23; border:none">Enregistrer</a>
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
               Fiche reception de justificatif de l'{{ $agent->nom." ".$agent->prenom }}
              </h1>
          </div>
  <!-- header -->
  <!-- body -->

          <div class="modal-body">
              <fieldset class="col-12 contact-form" style="height:80%">
                  <p id="demo"></p>
                  <div class="row">
                      <div class="col-md-4 ">
                          <div class="input-container focus">
                              <input  class="input" id="natureReception1"  disabled>
                              <label for="natureReception">Site de consultation </label>
                              <span>Site de consultation</span>
                          </div>
                      </div>
                      <div class="col-md-4">
                        <div class="input-container focus">
                            <input  class="input" id="justificatifValide1"  disabled>
                            <label for="justificatifValide">Justificatif valide</label>
                            <span>Justificatif valide</span>
                        </div>
                    </div>
                      <div class="col-md-4   arretMaladieSwitch ">
                          <div class="input-container focus">
                              <input type="number" class="input" name="duree_arret" id="duree_arret1"  disabled>
                              <label for="dateConsultation">Durée arrêt  (heure)</label>
                              <span>Durée arrêt  (heure)</span>
                          </div>
                      </div>
                      <div class="col-md-4  d-none ">
                          <div class="input-container arretMaladieSwitch  focus">
                              <input type="text" class="input" disabled id="enJours1"  disabled>
                              <input type="hidden" class="input" id="enJours2">
                              <label for="enJours">Durée arrêt maladie (en jour)</label>
                              <span>Durée arrêt maladie (en jour)</span>
                          </div>
                      </div>

                      <div class="col-md-4 arretMaladieSwitch ">
                          <div class="input-container focus">
                          <input type="date" class="input"  id="debutArret1" value=""  name="debutArret1"  disabled>
                          <label for="debutArret">Date de début </label>
                          <span>Date de début </span>
                      </div>
                      </div>
                      <div class="col-md-4 arretMaladieSwitch ">
                          <div class="input-container focus">
                          <input type="date" class="input" id="dateReprise1" name="dateReprise"  disabled>
                          <label for="dateReprise">Date de reprise</label>
                          <span>Date de reprise</span>
                      </div>
                      </div>

                    <div class="col-md-4">
                        <div class="input-container focus">
                            <input type="text" class=" input " id="nomMedecin1" required name="nomMedecin"  disabled>
                            <label for="nomMedecin">Médecin externe</label>
                            <span>Médecin externe</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-container focus">
                            <input type="text" class=" input " id="designationCentreExterne1" required name="designationCentreExterne" disabled >
                            <label for="designationCentreExterne">Hôpital/clinique externe</label>
                            <span>Hôpital/clinique externe</span>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="{{ asset("assets/js/scripts/interact.js") }}"></script>
    <script src="{{ asset("assets/js/recherche.js") }}"></script>
    <script>
        $( document ).ready(function() {
            $('#sidebarCollapse').trigger('click');
        });


    </script>
    <script>
        $(document).ready(function () {
            $('#Tablehisto').DataTable(); // ID correct du tableau
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
      var natureReception = document.getElementById("natureReception").value;
      document.getElementById("natureReception1").value  = natureReception;
      var justificatifValide = document.getElementById("justificatifValide").value;
      document.getElementById("justificatifValide1").value  = justificatifValide;

      var debutArret = document.getElementById("debutArret").value;
      document.getElementById("debutArret1").value  = debutArret;

      var nomMedecin = document.getElementById("nomMedecin").value;
      document.getElementById("nomMedecin1").value  = nomMedecin;

      var designationCentreExterne = document.getElementById("designationCentreExterne").value;
      document.getElementById("designationCentreExterne1").value  = designationCentreExterne;









      var duree_arret = document.getElementById("duree_arret").value;
      document.getElementById("duree_arret1").value  = duree_arret;
      var enJours = document.getElementById("enJours").value;
      document.getElementById("enJours1").value  = enJours;

      var dateReprise = document.getElementById("dateReprise").value;
      document.getElementById("dateReprise1").value  = dateReprise;
      var arretMaladie = document.getElementById("arretMaladie").value;
      document.getElementById("arretMaladie1").value  = arretMaladie;
      document.getElementById("motif_consultation_id1").value = document.getElementById("motif_consultation_id").value;
      document.getElementById("motif_consultation_autre1").value = document.getElementById("motif_consultation_autre").value;
      document.getElementById("repriseService1").value = document.getElementById("repriseService").value;
      document.getElementById("nbrJour1").value = document.getElementById("nbrJour").value;

    }
</script>

    <script>


            document.getElementById('designationCentreExterne').addEventListener('input', event => {
            if (document.getElementById('designationCentreExterne').value === '') {
                document.getElementById('designationCentreExterne').style.border = '5px solid #cc3262';
            } else {
                document.getElementById('designationCentreExterne').style.border = '5px solid  #198754';
            }
            });

            document.getElementById('nomMedecin').addEventListener('input', event => {
            if (document.getElementById('nomMedecin').value === '') {
                document.getElementById('nomMedecin').style.border = '5px solid #cc3262'
            } else {
                document.getElementById('nomMedecin').style.border = '5px solid  #198754';
            }
            });

            document.getElementById('duree_arret').addEventListener('input', event => {
            if (document.getElementById('duree_arret').value === '') {
                document.getElementById('duree_arret').style.border = '5px solid #cc3262'
            } else {
                document.getElementById('duree_arret').style.border = '5px solid  #198754';
            }
            });

            document.getElementById('debutArret').addEventListener('input', event => {
            if (document.getElementById('debutArret').value === '') {
                document.getElementById('debutArret').style.border = '5px solid #cc3262'
            } else {
                document.getElementById('debutArret').style.border = '5px solid  #198754';
            }
            });



    </script>
@stop

