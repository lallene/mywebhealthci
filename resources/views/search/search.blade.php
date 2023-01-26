<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-4">
<h3>Simple Search</h3><br>
<form action="{{ route('simple_search') }}" method="GET">
<div class="input-group mb-3">
<input type="text" class="form-control" placeholder="Type the name" aria-describedby="basic-addon2" name="search">
<div class="input-group-append">
<button class="btn btn-secondary" type="submit">Search</button>
</div>
</div>
</form>
<form action="{{ route('advance_search') }}" method="GET">
<h3>Advanced Search</h3><br>
<input type="text" name="name" class="form-control" placeholder="Person's name"><br>
<input type="text" name="address" class="form-control" placeholder="Address"><br>
<label>Range of Age</label>
<div class="input-container focus">
    <select name="natureReception" class="input" id="natureReception">
        <?php
            foreach ($sites as $site) {
                ?>
                <option  value="{{ $site->id }}">{{ $site->designation }}</option>
                <?php
            }
        ?>
    </select>
 <label for="natureReception">Site de consultation </label>
</div>
<div class="input-container focus">
    <select name="natureReception" class="input" id="natureReception">
        <?php
            foreach ($projets as $projet) {
                ?>
                <option  value="{{ $projet->id }}">{{ $projet->designation }}</option>
                <?php
            }
        ?>
    </select>
 <label for="natureReception">Projets </label>
</div>
<select class="select" multiple>
    <option value="maladie_contagieuse">Maladie contagieuse</option>
    <option value="maladie_prof">Maladie Professionnelle</option>
    <option value="accident">Accident de travail</option>
    <option value="accident">Médicament administré</option>
    <option value="accident">Traitement administré</option>
    <option value="vaccin_covid">Covid -19</option>
</select>
<label class="form-label select-label">Type de maladies</label>
<select class="select" multiple>
    <option value="maladie_contagieuse">Accepté</option>
    <option value="maladie_prof">Rejeté</option>
    <option value="accident">Repos</option>
    <option value="vaccin_covid">En Attente</option>
    <option value="vaccin_covid">Analyste externe</option>
</select>
<label class="form-label select-label">Type d'arrets</label>
<div class="input-group">
<input type="text" name="min_age" class="form-control" placeholder="Start Age">
<input type="text" name="max_age" class="form-control" placeholder="End of Age">
</div><br>
<input type="submit" value="Search" class="btn btn-secondary">
</form>
</div>
<div class="col-md-8">
<h3>La liste des consultations</h3>
<table class="table table-striped">
<tr>
<th>ID</th>
<th>Assurance</th>
<th>Accident Pro</th>
<th>durée Arrêt</th>
<th>debut d'arret</th>
<th>reprise service</th>
<th>maladie contagieuse</th>
<th>maladie prof</th>
<th>vaccin covid</th>
<th>motif de consultation</th>
<th>Medecin</th>
<th>date de consul</th>
<th>Type de consul</th>
<th>statut Jusificatif</th>
<th>Motif de rejet</th>
<th>Projet</th>
<th>Heure de repos</th>




</tr>
@foreach($data as $consul)
<tr>
<td>{{ $consul->id }}</td>
<td>{{ $consul->assurance }}</td>
<td>{{ $consul->accident }}</td>
<td>{{ $consul->duree_arret }}</td>
<td>{{ $consul->debutArret }}</td>
<td>{{ $consul->dateReprise }}</td>
<td>{{ $consul->maladie_contagieuse }}</td>
<td>{{ $consul->maladie_prof }}</td>
<td>{{ $consul->vaccin_covid }}</td>
<td>{{ $consul->motif_consultation_id }}</td>
<td>{{ $consul->user_id }}</td>
<td>{{ $consul->dateConsultation }}</td>
<td>{{ $consul->typeConsultation }}</td>
<td>{{ $consul->justificatifValide }}</td>
<td>{{ $consul->motifRejet }}</td>
<td>{{ $consul->projet_id }}</td>
<td>{{ $consul->repos }}</td>



</tr>
@endforeach
</table>
{{ $data->appends(request()->except('page'))->links() }}
</div>
</div>
</div>
</body>
</html>
