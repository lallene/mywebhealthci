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
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-12 text-right pb-2">
                                <a href="{{ route($link.".create") }}" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter</a>
                                <a href="{{ route("home") }}" class="btn btn-danger"><i class="fa fa-plus"></i> Quitter</a>
                            </div>
                            <form action="/import" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-3 ">
                                        <label for="formFile" class="form-label">La liste des effectifs(**.xlsx,.xls,.csv**)</label>
                                        <input class="form-control" type="file" id="formFile" name="agent_file" accept=".xlsx,.xls,.csv" required>
                                        <br>
                                        <button type="submit" class="btn btn-success ">Upload</button>
                                    </div>

                                    <div class="col-6">
                                        <p class="fw-bold">**Entité / Société /Matricule IRIS / Projet_Service / Nom / Prénom**</p>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Iris</th>
                                    <th>Nom & Prénom</th>
                                    <th>Sexe</th>
                                    <th>Projet</th>
                                    <th>Emploi</th>
                                    <th>Sous Fonction</th>
                                    <th>Contrat</th>
                                    <th>Societe</th>
                                    <th>Manager</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($agents)){
                                            $i = 0;
                                            foreach ($agents as $agent) {

                                                $i++;
                                                ?>
                                                <tr>
                                                    <td><?= $agent->iris ?></td>
                                                    <td><?= $agent->nom. ' ' .$agent->prenom ?></td>
                                                    <td><?= ($agent->sexe == 'M') ? 'Masculin' : 'Feminin' ?></td>
                                                    <td><?= $agent->Projet->designation ?></td>
                                                    <td><?= $agent->Emploi->designation ?></td>
                                                    <td><?= $agent->SousFonction->intitule ?></td>
                                                    <td><?= $agent->Contrat->designation ?></td>
                                                    <td><?= $agent->Societe->designation ?></td>
                                                    <td><?= !is_null($agent->Manager) ? $agent->Manager->nom.' '.$agent->Manager->prenom : '-' ?></td>
                                                    <td class="text-center">
                                                        <div class="dropdown_section">
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="{{route($link.'.edit', $agent->id)}}">Modifier</a>
                                                                    <form action="{{ route($link.'.destroy', $agent->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="dropdown-item">Supprimer</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
