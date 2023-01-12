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
                                <form action="/importsubfonction" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-3 ">
                                            <label for="formFile" class="form-label">La liste des sous-fonctions(**.xlsx,.xls,.csv**) <br>** Sous-focntion / Fonction **</label>
                                            <input class="form-control" type="file" id="formFile" name="subfonction_file" accept=".xlsx,.xls,.csv" required>
                                            <br>
                                            <button type="submit" class="btn btn-success ">Upload</button>
                                        </div>

                                        <div class="col-6">
                                            <p class="fw-bold"></p>

                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sous-fonction</th>
                                    <th>Fonction</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($subfonctions)){
                                            $i = 0;
                                            foreach ($subfonctions as $subfonction) {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= $subfonction->intitule ?></td>
                                                    <td><?= $subfonction->fonction->intitule ?></td>
                                                    <td class="text-center">
                                                        <div class="dropdown_section">
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="{{route($link.'.edit', $subfonction->id)}}">Modifier</a>
                                                                    <form action="{{ route($link.'.destroy', $subfonction->id) }}" method="POST">
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
