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
                                    <label for="fonction_id">Fonction</label>
                                    <select name="fonction_id" class="form-control select2" id="fonction_id">
                                        <?php
                                            foreach ($foreigns as $foreign) {
                                                ?>
                                                <option <?= ($item->fonction_id == $foreign->id) ? "selected" : "" ?> value="{{ $foreign->id }}">{{ $foreign->intitule }}</option>
                                                <?php
                                                }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="intitule">Sous-fonction</label>
                                    <input id="intitule" type="text" class="form-control" required name="intitule" value="{{ $item->intitule }}">
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
