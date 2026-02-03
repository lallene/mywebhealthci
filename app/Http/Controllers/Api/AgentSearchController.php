<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agent;

class AgentSearchController extends Controller
{
    public function index(Request $request)
    {
        $query = Agent::query();

        // Option de recherche par iris, nom ou matricule
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('iris', 'like', "%{$search}%")
                  ->orWhere('nom', 'like', "%{$search}%")
                  ->orWhere('matricule', 'like', "%{$search}%");
        }

        $agents = $query->get();

        return response()->json($agents);
    }

}
