<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RapportConsultationController extends Controller
{
    // Affiche la vue avec les dates de filtre
    public function index(Request $request)
    {
        $from = $request->input('datededebut', date('Y-m-d', strtotime('-3 days')));
        $to = $request->input('datedefin', date('Y-m-d'));

        return view('rapport', compact('from', 'to'));
    }

    // Retourne les consultations en JSON selon la période
    public function getConsultationsJson(Request $request)
    {
        $from = $request->query('from', date('Y-m-d', strtotime('-3 days')));
        $to = $request->query('to', date('Y-m-d'));

        $consultations = DB::table('consultations')
            ->whereDate('dateConsultation', '>=', $from)
            ->whereDate('dateConsultation', '<=', $to)
            ->join('projets', 'consultations.projet_id', '=', 'projets.id')
            ->join('agents', 'consultations.agent_id', '=', 'agents.id')
            ->select(
                'projets.designation as projet',
                'agents.Matricule_salarie as workday_id',
                'agents.prenom',
                'agents.nom',
                'consultations.typeArrêt as typearret',
                'consultations.duree_arret',
                'consultations.debutArret',
                'consultations.dateReprise',
                'consultations.siteConsultation'
            )
            ->get();

        return response()->json($consultations);
    }

    // Envoi du rapport par mail (avec fichier Excel généré en pièce jointe)
    public function sendReportByMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'from' => 'required|date',
            'to' => 'required|date',
        ]);

        $from = $request->input('from');
        $to = $request->input('to');
        $email = $request->input('email');

        // Requête pour récupérer les données
        $consultations = DB::table('consultations')
            ->whereDate('dateConsultation', '>=', $from)
            ->whereDate('dateConsultation', '<=', $to)
            ->join('projets', 'consultations.projet_id', '=', 'projets.id')
            ->join('agents', 'consultations.agent_id', '=', 'agents.id')
            ->select(
                'projets.designation as projet',
                'agents.Matricule_salarie as workday_id',
                'agents.prenom',
                'agents.nom',
                'consultations.typeArrêt as typearret',
                'consultations.duree_arret',
                'consultations.debutArret',
                'consultations.dateReprise',
                'consultations.siteConsultation'
            )
            ->get();

        // Générer un Excel (exemple simple CSV ici)
        $filename = 'rapport_consultations_'.$from.'_to_'.$to.'.csv';
        $filepath = storage_path('app/'.$filename);

        $handle = fopen($filepath, 'w+');
        // Header CSV
        fputcsv($handle, ['Projet', 'Workday ID', 'Nom', 'Prénom', 'Type d\'arrêt', 'Durée (min)', 'Date début', 'Date reprise', 'Site consultation']);
        // Data
        foreach ($consultations as $c) {
            fputcsv($handle, [
                $c->projet,
                $c->workday_id,
                $c->nom,
                $c->prenom,
                $c->typearret,
                $c->duree_arret,
                $c->debutArret,
                $c->dateReprise,
                $c->siteConsultation,
            ]);
        }
        fclose($handle);

        // Envoi du mail avec pièce jointe
        Mail::raw("Veuillez trouver en pièce jointe le rapport de consultations.", function ($message) use ($email, $filepath, $filename) {
            $message->to($email)
                    ->subject('Rapport des consultations')
                    ->attach($filepath, [
                        'as' => $filename,
                        'mime' => 'text/csv',
                    ]);
        });

        // Supprimer fichier après envoi
        unlink($filepath);

        return back()->with('success', 'Email envoyé avec succès à ' . $email);
    }
}
