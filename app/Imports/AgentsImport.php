<?php

namespace App\Imports;

use App\Models\Agent;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class AgentsImport implements ToModel, WithChunkReading, WithHeadingRow, SkipsOnError
{


    public function model(array $row)
    {

        $subFonctionId = DB::table('sub_fonctions')->where('intitule', $row['business_title'] ?? null)->value('id') ?? 113;
        $email =  $row['work_email'];
        $projetId = DB::table('projets')->where('msa_id', $row['msa_id'] ?? null)->value('id') ?? 113;
        $emploiId = DB::table('emplois')->where('designation', $row['intitule_de_la_fonction'] ?? null)->value('id') ?? 53;
        $contractId = DB::table('contrats')->where('designation', $row['contract_type'] ?? null)->value('id') ?? 5;
        $societeId = DB::table('societes')->where('designation', $row['location_code'] ?? null)->value('id') ?? 4;

       // dd($row, $societeId);

        $dateInsertion = Carbon::now()->format('Y-m-d');
        $matricule_du_salarie = $row['matricule_du_salarie'] ?? null;

       // dd($matricule_du_salarie);

        if (!$matricule_du_salarie) {
            Log::warning('Ignoring row without matricule:', $row);
            return;
        }




        // Gestion de la date d'embauche
        $dateDebutContrat = isset($row['date_dembauche']) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_dembauche'])->format('Y-m-d') : null;

        // Vérification des champs obligatoires
        $nom = $row['nom'] ?? null;
        $prenom = $row['prenom'] ?? null;

        if (is_null($nom) || is_null($prenom)) {
            Log::warning('Ignoring row with null nom or prenom:', $row);
            return;
        }


        Log::info('Processing row:', $row);



        // Transaction pour assurer l'intégrité des données
        DB::transaction(function () use ($row, $subFonctionId, $email, $matricule_du_salarie, $projetId, $emploiId, $contractId, $societeId, $dateDebutContrat, $dateInsertion, $nom, $prenom) {
            try {
                $agent = DB::table('agents')->where('Matricule_salarie', $matricule_du_salarie)->first();
               // dd($agent, $row);
                if ($agent === null) {
                    // Création d'un nouvel agent
                    $newagent = new Agent([
                        'Matricule_salarie' => $matricule_du_salarie,
                        'iris' => $matricule_du_salarie,
                        'projet_id' => $projetId,
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'sousfonction_id' => $subFonctionId,
                        'emploi_id' => $emploiId,
                        'contrat_id' => $contractId,
                        'dateembauche' => $dateDebutContrat,
                        'societe_id' => $societeId,
                        'dateInsertion' => $dateInsertion,
                        'email_agent' => $email,
                        'work_email' => $row['work_email'] ?? null,
                        'responsable' => $row['manager_level_01_employee_id'] ?? null,

                    ]);
                    $newagent->save();
                    Log::info('Agent created:', $newagent->toArray());
                } else {
                    // Mise à jour de l'agent existant
                    DB::table('agents')->where('Matricule_salarie', $matricule_du_salarie)->update([
                        'projet_id' => $projetId,
                        'emploi_id' => $emploiId,
                        'responsable' => $row['manager_level_01_employee_id'] ?? null,
                        'contrat_id' => $contractId,
                        'societe_id' => $societeId,
                        'work_email' => $row['work_email'] ?? null,
                        'dateInsertion' => $dateInsertion,
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'email_agent' =>  $row['work_email'] ?? null,
                        'sousfonction_id' => $subFonctionId,

                    ]);
                    Log::info('Agent updated:', ['Matricule_salarie' => $matricule_du_salarie]);
                }
            } catch (\Exception $e) {
                // Gestion des erreurs
                Log::error('Error processing row:', ['error' => $e->getMessage(), 'row' => $row]);
                throw $e; // Rejette la transaction pour tout problème rencontré
            }
        });
    }




    public function headingRow(): int
    {
        return 1;
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function onError(\Throwable $e)
    {
        // Gestion des erreurs
    }
}
