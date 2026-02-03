@component('mail::message')
<style>
    *{
        font-family: "Poppins", sans-serif !important
    }
</style>
@component('mail::message')

Bonjour,

Nous vous informons que **{{ $agent->prenom }} {{ $agent->nom }}**, **{{ $agent->Matricule_salarie }}** du projet **{{ $agent->Projet->designation }}** a reçu, ce jour **{{ $dateConsul }}**, un repos pour cause de maladie.
Cet arrêt de travail sera effectué sur site.

Vous trouverez ci-dessous les informations concernant cet arrêt :

- **Date de début** : {{ $consultation->created_at->format('d/m/Y H:i') }}

- **Date de fin** :
  {{ $consultation->created_at->copy()->addMinutes($consultation->duree_arret)->format('d/m/Y H:i') }}

- **Nombre d’heures de l’arrêt** :
  {{ str_pad(floor($consultation->duree_arret / 60), 2, '0', STR_PAD_LEFT) }} :
  {{ str_pad($consultation->duree_arret % 60, 2, '0', STR_PAD_LEFT) }}

- **Date de reprise du travail** :
  {{ $consultation->created_at->copy()->addMinutes($consultation->duree_arret + 5)->format('d/m/Y H:i') }}

- **Délivré par un médecin interne** : {{ $consultation->Medecin->name }}

---

*Pour toute information complémentaire, nous vous remercions de bien vouloir vous rapprocher de votre médecin d’entreprise ou HR Business Partner.*

Cordialement,
**Votre Team RH Côte d'Ivoire**

@endcomponent
