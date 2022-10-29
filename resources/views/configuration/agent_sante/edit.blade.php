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
                        <form method="post" class="row" action="{{ route($link.'.update', $item->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input id="nom" type="text" class="form-control" required name="nom" value="{{ $item->nom }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="prenom">Prenoms</label>
                                    <input id="prenom" type="text" class="form-control" required name="prenom" value="{{ $item->prenom }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Emails</label>
                                    <input id="email" type="text" class="form-control" required name="email" value="{{ $item->email }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="contact">Contacts</label>
                                    <input id="contact" type="text" class="form-control" required name="contact" value="{{ $item->contact }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="contact">Site</label>
                                    <select name="site_id" class="form-control select2" id="site_id">
                                        <?php
                                            foreach ($foreigns as $foreign) {
                                                ?>
                                                <option <?= ($item->site_id == $foreign->id) ? "selected" : "" ?> value="{{ $foreign->id }}">{{ $foreign->designation }}</option>
                                                <?php
                                                }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 text-center">
                                <a href="{{ route("home") }}" class="btn btn-danger"><i class="fa fa-close"></i> Annuler</a>
                                <button class="btn btn-primary"><i class="fa fa-save"></i> Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
