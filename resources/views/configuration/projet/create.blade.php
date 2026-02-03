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

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="site_id">Site</label>
                                    <select name="site_id" class="form-control select2" id="site_id">
                                        <?php
                                            foreach ($foreigns as $foreign) {
                                                ?>
                                                <option value="{{ $foreign->id }}">{{ $foreign->designation }}</option>
                                                <?php
                                                }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="designation">Désignation</label>
                                    <input id="designation" type="text" class="form-control" required name="designation" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="dltsuperviseur">DLT MANAGER</label>
                                    <input id="dltsuperviseur" type="email" class="form-control" required name="dltsuperviseur" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea id="description" class="form-control" cols="30" rows="5" name="description"></textarea>
                                </div>
                            </div>

                            <div class="col-sm-12 text-center">
                                <a href="{{ route("projet.index") }}" class="btn btn-danger"><i class="fa fa-close"></i> Annuler</a>
                                <button class="btn btn-primary"><i class="fa fa-save"></i> Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
