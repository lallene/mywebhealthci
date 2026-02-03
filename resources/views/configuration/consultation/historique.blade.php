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
                            <a href="{{ route($link.".index") }}" class="btn btn-primary"><i class="fa fa-plus"></i> Consultation</a>
                            <a href="{{ route("home") }}" class="btn btn-danger"><i class="fa fa-times"></i> Quitter</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Date de consultation</th>
                                    <th>Site</th>
                                    <th>Projet</th>
                                    <th>Workday ID</th>
                                    <th>Nom & Prénom</th>
                                    <th>Sexe</th>
                                    <th>Type Consultation</th>
                                    <th>Type d'arrêt</th>
                                    <th>Durée</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
                                    <th>Médecin</th>
                                    <th>Observation</th>
                                    @role('Ressources Humaines')
                                    <th>Actions</th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($consultations))
                                    @foreach ($consultations as $consultation)
                                        <tr>
                                            <td>{{ $consultation->created_at }}</td>
                                            <td>{{ $consultation->siteConsultation }}</td>
                                            <td>{{ $consultation->projet->designation }}</td>
                                            <td>{{ $consultation->agent->Matricule_salarie }}</td>
                                            <td>{{ $consultation->agent->nom }} {{ $consultation->agent->prenom }}</td>
                                            <td>{{ $consultation->sexe == 'M' ? 'Masculin' : 'Feminin' }}</td>
                                            <td>{{ $consultation->typeConsultation }}</td>
                                            <td>{{ $consultation->typeArrêt }}</td>
                                            <td>
                                                @php
                                                    $heures = str_pad(floor($consultation->duree_arret / 60), 2, "0", STR_PAD_LEFT);
                                                    $minutes = str_pad($consultation->duree_arret % 60, 2, "0", STR_PAD_LEFT);
                                                @endphp
                                                {{ $heures }} : {{ $minutes }}
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($consultation->debutArret)) }}</td>
                                           <td>
                                                @php
                                                    try {
                                                        if ($consultation->typeArrêt == "repos") {
                                                            // On s'assure que c'est bien un objet Carbon avant de l'envoyer à Excel
                                                            $date = Carbon\Carbon::parse($consultation->created_at)->addMinutes((int)$consultation->duree_arret);
                                                            $dateToDisplay = \PhpOffice\PhpSpreadsheet\Shared\Date::dateTimeToExcel($date);
                                                        } else {
                                                            $dateReprise = Carbon\Carbon::parse($consultation->dateReprise);
                                                            
                                                            $dateToDisplay = ($consultation->debutArret == $consultation->dateReprise)
                                                                ? $dateReprise->format("d/m/Y")
                                                                : $dateReprise->subDay()->format("d/m/Y");
                                                        }
                                                    } catch (\Exception $e) {
                                                        $dateToDisplay = "N/A"; // Évite le crash si la date est mal formée
                                                    }
                                                @endphp
                                                {{ $dateToDisplay }}
                                            </td>
                                            <td>{{ $consultation->medecin->name }}</td>
                                            <td>{{ $consultation->observation }}</td>
                                            @role('Ressources Humaines')
                                            <td>
                                                <form action="{{ route($link.'.destroy', $consultation->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette consultation ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                            @endrole
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@stop
