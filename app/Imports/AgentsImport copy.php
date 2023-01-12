<?php

namespace App\Imports;


use App\Models\Agent;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;


class AgentsImport implements  ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow, SkipsOnError
{



    public function model(array $row)
    {

        $projet= DB::table('projets')->where('designation', $row['projetservice'])->first();
        if ($projet == null ){ $row['projetservice'] = 47;}else{ $row['projetservice'] = $projet->id;};

        $emploi= DB::table('emplois')->where('designation', $row['emploi'])->first();
        if ($emploi == null ){ $row['emploi'] = 53;}else{ $row['emploi'] = $emploi->id;};

        $sousfonction= DB::table('sub_fonctions')->where('intitule', $row['sub_fonction'])->first();
        if ($sousfonction == null ){ $row['sub_fonction'] = 15;}else{ $row['sub_fonction'] = $sousfonction->id;};

        $contrat = DB::table('contrats')->where('designation', $row['type_contrat'])->first();
        if ($contrat == null ){ $row['type_contrat'] = 15;}else{ $row['type_contrat'] = $contrat->id;};

        $societe= DB::table('societes')->where('designation', $row['societe'])->first();
        if ($societe == null ){ $row['societe'] = 5;}else{ $row['societe'] = $societe->id;};

        $dateNaissance= \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_naissance'])->format('Y-m-d');
        $dateembauche= \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_debut_contrat'])->format('Y-m-d');
        if ($row['sexe'] == 'Masc.'){   $row['sexe'] = "M"; }else{       $row['sexe'] ="F";   };

        $iris = DB::table('agents')->where('iris', $row['matricule_iris'])->first();

        if ($iris == null ){
            if( !$row['matricule_iris'] == null){
                return new Agent([
                    'entite'=>$row['entite'],
                    'iris'=>$row['matricule_iris'],
                    'projet_id'=> $row['projetservice'],
                    'nom'=>$row['nom'],
                    'prenom'=>$row['prenom'],
                    'emploi_id'=>$row['emploi'],
                    'dateNaissance'=>$dateNaissance,
                    'sexe'=>$row['sexe'],
                    'sousfonction_id'=>$row['sub_fonction'],
                    'manager'=>$row['manager_hierarchique'],
                    'contrat_id'=> $row['type_contrat'],
                    'dateembauche'=> $dateembauche,
                    'societe_id'=>$row['societe'],
                    'email_agent'=>$row['business_e_mail']
                ]);

            }
            else{
                dd($row);
                $this->upsertColumns();

            }

        }  else{

            $agent = Agent::where( 'iris' ,'=', $row['matricule_iris'])->first();
            $agent->projet_id = $row['projetservice'];
            $agent->emploi_id = $row['emploi'];
            $agent->sousfonction_id = $row['sub_fonction'];
            $agent->manager = $row['manager_hierarchique'];
            $agent->contrat_id =  $row['type_contrat'];
            $agent->societe_id = $row['societe'];


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
        return 500;
    }

    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }

}
