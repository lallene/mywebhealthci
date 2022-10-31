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
                                        if(isset($items)){
                                            $i = 0;
                                            foreach ($items as $item) {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td><?= $item->iris ?></td>
                                                    <td><?= $item->nom. ' ' .$item->prenom ?></td>
                                                    <td><?= ($item->sexe == 'M') ? 'Masculin' : 'Feminin' ?></td>
                                                    <td><?= $item->Projet->designation ?></td>
                                                    <td><?= $item->Emploi->designation ?></td>
                                                    <td><?= $item->sub_fonction->intitule ?></td>
                                                    <td><?= $item->Societe->designation ?></td>
                                                    <td><?= !is_null($item->manager) ? $item->Manager->nom.' '.$item->Manager->prenom : '-' ?></td>
                                                    <td class="text-center">
                                                        <div class="dropdown_section">
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="{{route($link.'.edit', $item->id)}}">Modifier</a>
                                                                    <form action="{{ route($link.'.destroy', $item->id) }}" method="POST">
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
