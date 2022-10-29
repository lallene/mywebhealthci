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
                        <form method="post" class="row" action="{{ route('maladie_prof.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="intitule">Intitulé</label>
                                    <input id="intitule" type="text" class="form-control" required name="intitule" value="">
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

