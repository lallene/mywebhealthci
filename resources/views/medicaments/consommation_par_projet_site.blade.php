@extends('layouts.app')
  <!-- recherche css -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <link rel="stylesheet" href="{{ asset("assets/css/recherche.css") }}" />
  <link rel="stylesheet" href="{{ asset("assets/css/recherche.css") }}" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous" ></script>
    <script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">


@section('content')
<style>

  .contact-form5 {
    color: white !important;
    background-color: #174650;
    position: relative;
    HEIGHT: 83PX;
    padding: 12PX;
    width: 61%;
    margin-bottom: 12PX;
  }
 </style>
    <div class="container-fluid">

        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Consommation par Projet et Site</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header" style="
                    background-color: #174650;">
                        <div class="row">
                            <div class="col-sm-12 text-right pb-2">
                                <a href="{{ route('export.medicaments.csv') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Export</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Médicament</th>
                                    <th>Consommation</th>
                                </tr>
                                </thead>
                                <tbody id="tbody">
                                    <?php
                                    if(isset($medicaments)){
                                        $i = 0;
                                        foreach ($medicaments as $medicament) {

                                            $i++;
                                            ?>
                                            <tr>
                                                <td>{{ $medicament['nom'] }}</td>
                                                <td>{{ $medicament['consommation'] }}</td>
                                                
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
         <!-- Bouton pour exporter les données -->
 

    </div>
    <script src="{{ asset("assets/js/scripts/agent.js") }}"></script>

@section('script')

    <script src="{{ asset("assets/js/scripts/rechercher.js") }}"></script>
    <script src="{{ asset("assets/js/recherche.js") }}"></script>
@stop




@stop




