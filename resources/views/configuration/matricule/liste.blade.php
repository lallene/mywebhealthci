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
                            <form action="/importmatricule" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-3 ">
                                        <label for="formFile" class="form-label">La liste des matricules(**.xlsx,.xls,.csv**)  <br>**  Iris /  Matricle **</label>
                                        <input class="form-control" type="file" id="formFile" name="matricule_file" accept=".xlsx,.xls,.csv" required>
                                        <br>
                                        <button type="submit" class="btn btn-success ">Téléverser</button>
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
                                    <th>#</th>
                                    <th>Iris</th>
                                    <th>Matricule</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($matricules)){
                                            $i = 0;
                                            foreach ($matricules as $matricule) {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= $matricule->Agent->iris ?></td>
                                                    <td><?= $matricule->matricule ?></td>
                                                    <td class="text-center">
                                                        <div class="dropdown_section">
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="{{route($link.'.edit', $matricule->id)}}">Modifier</a>
                                                                    <form action="{{ route($link.'.destroy', $matricule->id) }}" method="POST">
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
