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
                    <h2>{{ $titre }}</h2>
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
                                <a href="{{ route($link.".create") }}" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter</a>
                                <a href="{{ route("home") }}" class="btn btn-danger"><i class="fa fa-plus"></i> Quitter</a>
                            </div>
                            <form action="{{ route('import_agent') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-3 ">
                                        <label for="formFile" class="form-label">La liste des effectifs(**.xlsx,.xls,.csv**)</label>
                                        <input class="form-control" type="file" id="formFile" name="agent_file" accept=".xlsx,.xls,.csv" required>
                                        <br>
                                        <button type="submit" class="btn btn-success ">Upload</button>
                                    </div>

                                    <div class="col-6">
                                        <p class="fw-bold">**Entité / Société /Matricule IRIS / Projet_Service / Nom / Prénom**</p>
                                    </div>

                                </div>


                            </form>

                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="Tableeffectif" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Sites</th>
                                    <th>Matricule</th>
                                    <th>Nom & Prénom</th>
                                    <th>Email</th>
                                    <th>Projet</th>
                                    <th>Emploi</th>
                                    <th>Responsable</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="tbody">
                                    <?php
                                    if(isset($agents)){
                                        $i = 0;
                                        foreach ($agents as $agent) {

                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?= $agent->site ?></td>
                                                <td><?= $agent->Matricule_salarie ?></td>
                                                <td><?= $agent->nom. ' ' .$agent->prenom ?></td>
                                                <td><?= $agent->work_email ?></td>
                                                <td><?= $agent->projet ?></td>
                                                <td><?= $agent->contrat ?></td>
                                                <td>{{ $agent->responsable_nom ? $agent->responsable_nom . ' ' . $agent->responsable_prenom : 'Non défini' }}</td>

                                                <td class="text-center">
                                                    <div class="dropdown_section">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{route($link.'.edit', $agent->id)}}">Modifier</a>
                                                                <form action="{{ route($link.'.destroy', $agent->id) }}" method="POST">
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
    <script src="{{ asset("assets/js/scripts/agent.js") }}"></script>

@section('script')
<script>
    $(document).ready(function () {
        $('#Tableeffectif').DataTable(); // ID correct du tableau
    });
</script>
    <script src="{{ asset("assets/js/scripts/rechercher.js") }}"></script>
    <script src="{{ asset("assets/js/recherche.js") }}"></script>
@stop




@stop




