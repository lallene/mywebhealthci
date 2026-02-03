@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4 text-primary">💊 Gestion du stock des Médicaments</h1>

    @forelse ($data as $dateGroup)
        <div class="mb-5">
            <h3>Date de livraison : <span class="text-info">{{ $dateGroup['supply_date'] }}</span></h3>

            @foreach ($dateGroup['medications'] as $medication)
                <div class="card mb-3 shadow-sm">
                    <div class="card-header bg-light">
                        <h4 class="mb-0">{{ $medication['medication_name'] }}</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Total stock :</strong> {{ $medication['total_stock'] }}</p>
                        <p><strong>Total utilisé :</strong> {{ $medication['total_used'] }}</p>
                        <p><strong>Stock disponible :</strong> {{ $medication['available_stock'] }}</p>

                        <h5>Sites :</h5>
                        <ul class="list-group">
                            @foreach ($medication['sites'] as $site)
                                <li class="list-group-item">
                                    <strong>{{ $site['site_name'] }}</strong> — Utilisé : {{ $site['used'] }}
                                    <ul class="mt-2">
                                        @foreach ($site['projects'] as $project)
                                            <li>{{ $project['projet_name'] }} : {{ $project['used'] }}</li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <p>Aucun stock disponible pour le moment.</p>
    @endforelse
</div>
@endsection
