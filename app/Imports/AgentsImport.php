<?php

namespace App\Imports;

use App\Models\Agent;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AgentsImport implements  ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{

    public function model(array $row)
    {
        $iris = DB::table('agents')->where('iris', $row['matricule_iris'])->first();
        $email_agent = DB::table('agents')->where('email_agent', $row['business_e_mail'])->first();


        $projet= DB::table('projets')->where('designation', $row['projetservice'])->first();
        $emploi= DB::table('emplois')->where('designation', $row['emploi'])->first();
        $sousfonction= DB::table('sub_fonctions')->where('intitule', $row['sub_fonction'])->first();
        $contrat = DB::table('contrats')->where('designation', $row['type_contrat'])->first();
        $societe= DB::table('societes')->where('designation', $row['societe'])->first();
        $dateNaissance= \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_naissance'])->format('Y-m-d');
        $dateembauche= \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_debut_contrat'])->format('Y-m-d');
        if ($row['sexe'] == 'Masc.'){      $sexe = "M"; }else{       $sexe ="F";   };
        if ($iris == null ){
            if(!$row['matricule_iris']== null and $email_agent == null){
                return new Agent([
                    'entite'=>$row['entite'],
                    'iris'=>$row['matricule_iris'],
                    'projet_id'=> $projet->id,
                    'nom'=>$row['nom'],
                    'prenom'=>$row['prenom'],
                    'emploi_id'=>$emploi->id,
                    'dateNaissance'=>$dateNaissance,
                    'sexe'=>$sexe,
                    'sousfonction_id'=> $sousfonction->id,
                    'manager'=>$row['manager_hierarchique'],
                    'contrat_id'=> $contrat->id,
                    'dateembauche'=> $dateembauche,
                    'societe_id'=>$societe->id,
                    'email_agent'=>$row['business_e_mail']
                ]);
            }

        }elseif (!$email_agent == null and !$email_agent == null){
            $agent = Agent::find($iris->id);
            $agent->projet_id = $projet->id;
            $agent->emploi_id = $emploi->id;
            $agent->sousfonction_id = $sousfonction->id;
            $agent->manager = $row['manager_hierarchique'];
            $agent->contrat_id =  $contrat->id;
            $agent->societe_id =  $societe->id;

            try{
                $agent->save();

            }catch (\Exception $e){
                echo'e';
                return redirect()->route('effectif.index');
            }
        }
    }
    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 3000;
    }

}
