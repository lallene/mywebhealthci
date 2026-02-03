@extends('layouts.app')

<!-- Liens CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/recherche.css') }}" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@section('content')
    <div class="container-fluid">
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
                width: 60% !important; /* Assurer que Select2 occupe toute la largeur disponible */
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
                background-color: #007bff !important; /* Couleur d'arrière-plan lorsqu'une option est sélectionnée */
                color: white !important; /* Couleur du texte sélectionné */
            }

            /* Amélioration du style pour le label */
            .motif_consultation label {
                font-size: 16px !important;
                color: #333 !important;
                font-weight: bold !important;
            }

            /* Ajouter un espace entre le champ et le label */
            .motif_consultation {
                margin-bottom: 20px !important;
            }

            /* Style du conteneur Select2 */
            .select2-container--default .select2-selection--multiple {
                border: 1px solid #ccc !important; /* Bordure grise pour le champ multiple */
                background-color: #f9f9f9 !important; /* Couleur d'arrière-plan claire */
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

        <div class="card">
            <div class="card-body">
                <!-- Titre de la section -->
                <div class="section-title">
                    Motif de Consultation
                </div>

                <!-- Default Accordion -->
                <div class="accordion" id="accordionOrdonnace">
                    <div class="col-md-10">
                        <div class="motif_consultation focus">
                            <div class="select2-container">
                                <select name="motif_consultation_id[]" id="motif_consultation_id" multiple>
                                    <option value="1">text 1</option>
                                    <option value="2">text 2</option>
                                    <option value="3">text 3</option>
                                    <option value="4">text 4</option>
                                    <option value="5">text 5</option>
                                    <option value="6">text 6</option>
                                    <option value="7">text 7</option>
                                    <option value="8">text 8</option>
                                </select>
                            </div>
                            <span>Motif de consultation</span>
                        </div>
                    </div>
                </div><!-- End Default Accordion Example -->
            </div>
        </div>
    </div>
@stop

@section('script')
<!-- Script pour Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#motif_consultation_id').select2({
            placeholder: "Choisissez un ou plusieurs motifs de consultation", // Texte du placeholder
            allowClear: true, // Option pour permettre la suppression de la sélection
            // width: '100%' // Forcer Select2 à occuper toute la largeur disponible
        });
    });
</script>
@stop
