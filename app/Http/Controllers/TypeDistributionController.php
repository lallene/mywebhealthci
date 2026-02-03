<?php

namespace App\Http\Controllers;

use App\Models\TypeDistribution;
use Illuminate\Http\Request;

class TypeDistributionController extends Controller
{
    public function index()
    {
        return response()->json(TypeDistribution::all());
    }

    public function store(Request $request)
    {
        $type = TypeDistribution::create($request->all());
        return response()->json($type, 201);
    }

    public function update(Request $request, TypeDistribution $typeDistribution)
    {
        $typeDistribution->update($request->all());
        return response()->json($typeDistribution);
    }

    public function destroy(TypeDistribution $typeDistribution)
    {
        $typeDistribution->delete();
        return response()->json(null, 204);
    }
}
