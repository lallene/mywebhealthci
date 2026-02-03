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
                                <a href="{{ route('consultation.index')  }}" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter</a>
                                <a href="{{ route("home") }}" class="btn btn-danger"><i class="fa fa-plus"></i> Quitter</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>IRIS</th>
                                    <th>NOM</th>
                                    <th>PRENOM</th>
                                    <th>DATE D'ENREGISTREMENT</th>
                                    <th>DATE DEBUT ARRET</th>
                                    <th>DATE DE REPRISE</th>
                                    <th>NBRE DE JOURS</th>
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
                                                    <td><?= $i ?></td>
                                                    <td><?= $item->agent->iris ?></td>
                                                    <td><?= $item->agent->nom ?></td>
                                                    <td><?= $item->agent->prenom ?></td>
                                                    <td><?= $item->created_at ?></td>
                                                    <td><?= $item->debutArret ?></td>
                                                    <td><?= $item->dateReprise ?></td>
                                                    <td><?= $item->duree_arret ?></td>
                                                    <td class="text-center">
                                                        <div class="dropdown_section">
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#">Modifier</a>
                                                                    <form action="#" method="POST">
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
