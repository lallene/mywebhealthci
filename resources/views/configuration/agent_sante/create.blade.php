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
                                    <label for="nom">Nom</label>
                                    <input id="nom" type="text" class="form-control" required name="nom" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="prenom">Prenoms</label>
                                    <input id="prenom" type="text" class="form-control" required name="prenom" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Emails</label>
                                    <input id="email" type="text" class="form-control" required name="email" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="contact">Contacts</label>
                                    <input id="contact" type="text" class="form-control" required name="contact" value="">
                                </div>
                            </div>

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


                            <div class="col-sm-12 text-center">
                                <a href="{{ route("home") }}" class="btn btn-danger"><i class="fa fa-close"></i> Annuler</a>
                                <button class="btn btn-primary"><i class="fa fa-save"></i> Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
