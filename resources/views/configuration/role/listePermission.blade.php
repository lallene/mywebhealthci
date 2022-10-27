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
                                <a href="{{ URL::to('profil/addPermission/'.$role->id) }}" class="btn btn-primary"><i class="fa fa-plus"></i> Accorder Autorisation</a>
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
                                    <th>Designation</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($permissions)){
                                            $i = 0;
                                            foreach ($permissions as $permission) {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= $permission->name ?></td>
                                                    <td class="text-center">
                                                        <a class="btn btn-warning" href="{{ URL::to('profil/revoquer/'.$role->id.'/'.$permission->id) }}">Revoquer Permission</a>
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