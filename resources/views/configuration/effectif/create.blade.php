@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>{{ $titre }}</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" class="row" action="{{ route($link.'.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="iris">IRIS</label>
                                    <input id="iris" type="number" class="form-control" required name="iris" value="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="entite">Entité</label>
                                    <input id="entite" type="text" class="form-control" required name="entite" value="WHCIV">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="societe_id">Société</label>
                                    <select name="societe_id" class="form-control select2" id="societe_id">
                                        <?php
                                        if(isset($societes)){
                                        foreach ($societes as $societe) {
                                        ?>
                                        <option value="{{ $societe->id }}">{{ $societe->designation }}</option>
                                        <?php
                                        }
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sexe">Sexe</label>
                                    <select name="sexe" class="form-control" id="sexe">
                                        <option value="M">Masculin</option>
                                        <option value="F">Feminin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input id="nom" type="text" class="form-control" required name="nom" value="">
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="prenom">Prénom(s)</label>
                                    <input id="prenom" type="text" class="form-control" required name="prenom" value="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dateembauche">Date d'embauche</label>
                                    <input id="dateembauche" type="date" class="form-control" required name="dateembauche" value="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projet_id">Projet</label>
                                    <select name="projet_id" id="projet_id" class="form-control select2">
                                        <?php
                                            if(isset($projets)){
                                                foreach ($projets as $projet) {
                                                    ?>
                                                    <option value="{{ $projet->id }}">{{ $projet->designation }}</option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="manager">Manager</label>
                                    <select name="manager" id="manager" class="form-control select2">
                                        <?php
                                            if(isset($managers)){
                                                foreach ($managers as $manager) {
                                                    ?>
                                                    <option value="{{ $manager->iris }}">{{ $manager->nom.' '.$manager->prenom }}</option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="emploi_id">Emploi</label>
                                    <select name="emploi_id" id="emploi_id" class="form-control select2">
                                        <?php
                                        if(isset($emplois)){
                                        foreach ($emplois as $emploi) {
                                        ?>
                                        <option value="{{ $emploi->id }}">{{ $emploi->designation }}</option>
                                        <?php
                                        }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sousfonction_id">Sous Fonction</label>
                                    <select name="sousfonction_id" id="sousfonction_id" class="form-control select2">
                                        <?php
                                        if(isset($sousfonctions)){
                                        foreach ($sousfonctions as $sousfonction) {
                                        ?>
                                        <option value="{{ $sousfonction->id }}">{{ $sousfonction->intitule }}</option>
                                        <?php
                                        }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="contrat_id">Contrat</label>
                                    <select name="contrat_id" id="contrat_id" class="form-control select2">
                                        <?php
                                        if(isset($contrats)){
                                        foreach ($contrats as $contrat) {
                                        ?>
                                        <option value="{{ $contrat->id }}">{{ $contrat->designation }}</option>
                                        <?php
                                        }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 text-center">
                                <a href="{{ route("effectif.index") }}" class="btn btn-danger"><i class="fa fa-close"></i> Annuler</a>
                                <button class="btn btn-primary"><i class="fa fa-save"></i> Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
