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
                                    <label for="type">Type</label>
                                    <select name="type" class="form-control select2" id="type">
                                        <option <?= ($item->type == "Comprimé") ? "selected" : "" ?> value="Comprimé">Comprimé</option>
                                        <option <?= ($item->type == "Injection") ? "selected" : "" ?> value="Injection">Injection</option>
                                        <option <?= ($item->type == "Géllule") ? "selected" : "" ?> value="Géllule">Géllule</option>
                                        <option <?= ($item->type == "Sachet") ? "selected" : "" ?> value="Sachet">Sachet</option>
                                        <option <?= ($item->type == "Suppositoire") ? "selected" : "" ?> value="Suppositoire">Suppositoire</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="designation">Désignation</label>
                                    <input id="designation" type="text" class="form-control" required name="designation" value="{{ $item->designation }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="details">Detail</label>
                                    <textarea id="details" class="form-control" cols="30" rows="5" name="details">{{ $item->details }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="quantite">Quantité</label>
                                    <input id="quantite" type="number" class="form-control" required min="0" name="quantite" value="{{ $item->quantite }}">
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