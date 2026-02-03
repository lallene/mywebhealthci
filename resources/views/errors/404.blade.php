@extends('layouts.app')

@section('title', '404 - Page non trouvée')

@section('content')
<div style="display: flex; align-items: center; justify-content: center; min-height: 80vh; background-color: #f4f6f8;">
    <div style="text-align: center; padding: 40px;">
        <img src="https://illustrations.popsy.co/white/resistance-band.svg" alt="Page non trouvée"
             style="width: 250px; max-width: 100%; margin-bottom: 30px;">
        <h1 style="font-size: 80px; margin-bottom: 10px; color: #174650;">404</h1>
        <p style="font-size: 20px; color: #555; margin-bottom: 30px;">
            Désolé, la page que vous recherchez est introuvable.
        </p>
        <a href="{{ route('dashboard') }}"
           style="display: inline-block; padding: 12px 25px; background-color: #174650; color: #fff;
           text-decoration: none; border-radius: 8px; font-weight: 600;">
            Retour à l’accueil
        </a>
    </div>
</div>
@endsection
