@extends('layouts.app')

@section('content')
<div class="container">
    <meta name="user-id" content="{{ auth()->user()->id }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <h1 class="text-center mb-4 text-primary display-5 fw-bold">💊 Gestion du stock des Médicaments</h1>

    <!-- Tableau des médicaments -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">📋 Liste des Médicaments</h5>
            <table class="table table-hover mt-3" id="stockTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Famille</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Seuil d'alerte Global</th>
                        <th scope="col">Utilisateur</th>
                        <th scope="col">Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Les lignes seront insérées ici par JS -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
async function fetchStocks() {
    try {
        const response = await fetch('/mywebhealthci/api/stocks');
        if (!response.ok) throw new Error('Erreur lors du chargement des médicaments');
        const data = await response.json();

        const mainTableBody = document.querySelector('#stockTable tbody');
        mainTableBody.innerHTML = '';

        // Construire toutes les lignes en une seule fois
        let rowsHtml = '';
        data.forEach(stock => {
            // Formater la date en local (exemple simple)
            const dateFormatted = new Date(stock.created_at).toLocaleDateString('fr-FR', {
                year: 'numeric', month: '2-digit', day: '2-digit',
                hour: '2-digit', minute: '2-digit'
            });

            rowsHtml += `
            <tr>
                <td>${stock.stock_id}</td>
                <td>${stock.medication_name}</td>
                <td>${stock.famille_medicament}</td>
                <td>${stock.qte}</td>
                <td>${stock.seuil}</td>
                <td>${stock.user_name}</td>
                <td>${dateFormatted}</td>
                <td>
                    <button class="btn btn-danger" onclick="deleteStock(${stock.stock_id})">
                        Supprimer
                    </button>
                </td>
            </tr>`;
        });
        mainTableBody.innerHTML = rowsHtml;

    } catch (error) {
        console.error('Erreur:', error);
        alert('Une erreur inattendue s\'est produite lors du chargement des médicaments.');
    }
}

async function deleteStock(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce médicament ?')) {
        try {
            const response = await fetch(`/mywebhealthci/api/stocks/${id}`, {
                method: 'DELETE',
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (response.ok) {
                alert("Médicament supprimé !");
                fetchStocks();
            } else {
                alert("Impossible de supprimer le médicament.");
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert('Une erreur est survenue.');
        }
    }
}

// Chargement initial
fetchStocks();
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection
