<style>
    table{
        font-family: Arial;
         font-size: 10px;
         text-align: justify;
    }
</style>
<table style="color:brown; font-weight: 900;">
    <thead>
    <tr>
        <th style="font-weight: 900; " >Extraction du  {{date('d-m-Y', strtotime($datedebut))}}  au {{date('d-m-Y', strtotime($datefin))}} du collaborateur {{ $name }} Workay: {{ $workday }}</th>
    </tr>
    <tr>
        <th style=" font-weight: 900;  background-color :gray; font-family:Arial, Helvetica, sans-serif; ">Date de consultation</th>
        <th style=" font-weight: 900;  background-color :gray; font-family:Arial, Helvetica, sans-serif; ">Site consultation</th>
        <th style=" font-weight: 900;  background-color :gray; font-family:Arial, Helvetica, sans-serif; ">Medecin</th>
        <th style=" font-weight: 900;  background-color :gray; font-family:Arial, Helvetica, sans-serif; ">Type de consultation</th>
        <th style=" font-weight: 900;  background-color :gray; font-family:Arial, Helvetica, sans-serif; ">statut Jusificatif</th>
        <th style=" font-weight: 900;  background-color :gray; font-family:Arial, Helvetica, sans-serif; ">debut d'arret</th>
        <th style=" font-weight: 900;  background-color :gray; font-family:Arial, Helvetica, sans-serif; ">reprise service</th>
        <th style=" font-weight: 900;  background-color :gray; font-family:Arial, Helvetica, sans-serif; ">durée Arrêt</th>
        <th style=" font-weight: 900;  background-color :gray; font-family:Arial, Helvetica, sans-serif; ">Motif de rejet</th>
        <th style=" font-weight: 900;  background-color :gray; font-family:Arial, Helvetica, sans-serif; ">Medecin Externe</th>
        <th style=" font-weight: 900;  background-color :gray; font-family:Arial, Helvetica, sans-serif; ">Hôpital/Clinique Externe</th>
        <th style=" font-weight: 900;  background-color :gray; font-family:Arial, Helvetica, sans-serif; ">Accident Travail</th>
        <th style=" font-weight: 900;  background-color :gray; font-family:Arial, Helvetica, sans-serif; ">Maladie professionnelle</th>

    </tr>

    </thead>
    <tbody>
    @foreach($invoices as $data)
        <tr>
            <td style=" font-weight: normal;  text-align:justify; font-family:Arial, Helvetica, sans-serif;  ">{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
            <td style=" font-weight: normal;  text-align:justify; font-family:Arial, Helvetica, sans-serif;  ">{{ $data->Site->designation}}</td>
            <td style=" font-weight: normal;  text-align:justify; font-family:Arial, Helvetica, sans-serif;  ">{{ $data->Medecin->name}}</td>
            <td style=" font-weight: normal;  text-align:justify; font-family:Arial, Helvetica, sans-serif;  ">{{ $data->typeConsultation }}</td>
            <td style=" font-weight: normal;  text-align:justify; font-family:Arial, Helvetica, sans-serif;  "><?= $data->typeArrêt === "oui"? "arret maladie" : $data->typeArrêt ?></td>
            <td style=" font-weight: normal;  text-align:justify; font-family:Arial, Helvetica, sans-serif;  "><?= ($data->typeArrêt== "repos" or $data->typeArrêt == "Analyse externe") ? \PhpOffice\PhpSpreadsheet\Shared\Date::dateTimeToExcel($data->created_at) :date("d/m/Y ", strtotime($data->debutArret))?></td>
            <td style=" font-weight: normal;  text-align:justify; font-family:Arial, Helvetica, sans-serif;  "><?= ($data->typeArrêt == "repos" ) ? \PhpOffice\PhpSpreadsheet\Shared\Date::dateTimeToExcel($data->created_at->addMinutes($data->duree_arret)) : date("d/m/Y ", strtotime($data->dateReprise)) ?></td>
            <td style=" font-weight: normal;  text-align:justify; font-family:Arial, Helvetica, sans-serif;  "><?=  ($data->typeArrêt == "repos" ) ? \PhpOffice\PhpSpreadsheet\Shared\Date::dateTimeToExcel($data->created_at->addMinutes($data->duree_arret)): ($data->debutArret == $data->dateReprise) ? date("d/m/Y ", strtotime($data->dateReprise)) : date("d/m/Y ", strtotime($data->dateReprise) - 1) ?></td>
            <td style=" font-weight: normal;  text-align:justify; font-family:Arial, Helvetica, sans-serif;  ">{{ $data->motifRejet }}</td>
            <td style=" font-weight: normal;  text-align:justify; font-family:Arial, Helvetica, sans-serif;  ">{{ $data->nomMedecin }}</td>
            <td style=" font-weight: normal;  text-align:justify; font-family:Arial, Helvetica, sans-serif;  ">{{ $data->designationCentreExterne }}</td>
            <td style=" font-weight: normal;  text-align:justify; font-family:Arial, Helvetica, sans-serif;  ">{{ $data->accidentPro }}</td>
            <td style=" font-weight: normal;  text-align:justify; font-family:Arial, Helvetica, sans-serif;  ">{{ $data->maladie_prof }}</td>
        </tr>
    @endforeach
    </tbody>
</table>


