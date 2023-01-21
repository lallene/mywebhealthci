@component('mail::message')
<style>
    *{
        font-family: "Poppins", sans-serif !important
    }
</style>

Bonjour,


L'arrêt de travail comportant les informations ci-dessous, a été placé sous le statut ‘en attente de validation’ car nous n'avons pas reçu toutes les informations nécessaires permettant sa validation.

Nous vous prions donc de transmettre ces informations manquantes à votre médecin d’entreprise sous un délai de quatre semaines à compter de la date de consultation où cet arrêt a été présenté.

Passé ce délai, l’arrêt sera automatiquement rejeté par notre système et votre absence sera considérée comme injustifiée.


•        Iris du collaborateur concerné : <b>{{$agent->iris}}</b>

•        Prénoms, NOM du collaborateur concerné : <b> {{$agent->prenom}} {{$agent->nom}}</b>

•        Date de début de l’arrêt : <b> {{$dateDebut}}</b>

•        Nombre total de jours de l’arrêt :  <b>{{$nbreJour}}</b> jours.

•        Date de reprise du travail : <b> {{$dateReprise}}</b>.

•        Délivré par un médecin {{$consultation->typeConsultation}}  @if ($consultation->typeConsultation =='Externe') {{$consultation->nomMedecin}}  de l’établissement de santé <b>{{$consultation->designationCentreExterne}}</b> @endif<br>


<i>Pour toute information complémentaire, nous vous remercions de bien vouloir vous rapprocher de votre médecin d’entreprise ou HR Business Partner.</i><br><br>


Cordialement,<br>



Votre Team RH Côte d’Ivoire


@endcomponent


