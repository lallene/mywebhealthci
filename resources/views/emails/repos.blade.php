@component('mail::message')
<style>
    *{
        font-family: "Poppins", sans-serif !important
    }
</style>

Bonjour,


Nous vous informons que <b> {{$agent->prenom}} {{$agent->nom}}</b> , <b>{{$agent->iris}}</b> du projet <b>  {{$agent->Projet->designation}}</b>  a reçu, ce jour,  <b> {{ $dateConsul}}</b> un repos pour cause de maladie.
Cet arrêt de travail sera effectué sur site.


    Vous trouverez ci-dessous les informations concernant cet arrêt :


•            Date de début :<b> {{$dateDebut}}</b>

•            Date de fin :<b> {{$dateFin}}</b>

•            Nombre d’heures de l’arrêt : <b>{{$hours}}:{{$minutes}} min</b>.

•            Date de reprise du travail :<b> {{$dateReprise}}</b>

•            Délivré par un médecin interne : <b> {{$consultation->Medecin->name;}}</b>



<i>Pour toute information complémentaire, nous vous remercions de bien vouloir vous rapprocher de votre médecin d’entreprise ou HR Business Partner.</i><br><br>



Cordialement,<br>
<b><h3>Votre Team RH Côte d'Ivoire</h3></b>


@endcomponent
