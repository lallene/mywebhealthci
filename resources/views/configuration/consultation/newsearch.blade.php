

<!-- resources/views/agents.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Barre de recherche -->
    <div class="form-group search-bar">
        <input type="text" id="search" class="form-control search-input" placeholder="Rechercher par Iris, Nom ou Matricule" style="margin-top: 22px;">
    </div>

    <!-- Tableau des agents -->
    <div id="agentsTableWrapper" class="table-responsive">
        <table class="table" id="agentsTable">
            <thead>
                <tr style="font-size: 20px; color: #1d4851; font-weight: 900;">
                    <th scope="col">Matricule</th>
                    <th scope="col">Site</th>
                    <th scope="col">Nom & Prénoms</th>
                    <th scope="col">Projet</th>
                    <th scope="col">Fonction</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Les résultats seront affichés ici -->
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Style du conteneur principal */
    .container {
        margin-top: 30px;
        padding: 30px;
        max-width: 800px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
        margin-left: auto;
        margin-right: auto;
    }



    /* Style de la barre de recherche */
    .search-bar {
        margin-bottom: 20px;
        text-align: center;
    }

    .search-input {
        width: 60%;
        margin: 0 auto;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Style pour le conteneur du tableau */
    #agentsTableWrapper {
        margin-top: 20px;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #ddd;
        background-color: #f8f9fa;
        padding: 10px;
    }

    /* Style pour le tableau */
    #agentsTable {
        border-collapse: collapse;
        width: 100%;
        background-color: #ffffff;
    }

    /* Style pour les en-têtes de tableau */
    #agentsTable thead th {
        background-color: #007bff;
        color: #ffffff;
        padding: 12px;
        text-align: center;
        border-bottom: 2px solid #0056b3;
        font-weight: bold; /* Texte en gras pour les titres */
    }

    /* Style pour les lignes du tableau */
    #agentsTable tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    #agentsTable tbody tr:nth-child(even) {
        background-color: #ffffff;
    }

    #agentsTable tbody td {
        padding: 12px;
        border-bottom: 1px solid #dee2e6;
        text-align: center;
    }

    /* Style pour les boutons d'action */
    .btn {
        display: inline-block;
        padding: 6px 12px;
        font-size: 14px;
        font-weight: 400;
        border-radius: 4px;
        text-align: center;
        text-decoration: none;
    }

    .btn-primary {
        color: #fff;
        background-color: #007bff;
        border: 1px solid #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .btn-secondary {
        color: #fff;
        background-color: #6c757d;
        border: 1px solid #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #4e555b;
    }

    /* Style pour les messages dans le tableau */
    #agentsTable tbody td[colspan] {
        text-align: center;
        font-style: italic;
        color: #6c757d;
        padding: 20px;
    }
</style>
@endsection


@section('styles')
<style>
    /* Style du conteneur principal */
    .container {
        margin-top: 30px;
        padding: 30px;
        max-width: 800px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
        margin-left: auto;
        margin-right: auto;
    }

    /* Style pour le titre personnalisé */
    /* Style de la barre de recherche */
    .search-bar {
        margin-bottom: 20px;
        text-align: center;
    }

    .search-input {
        width: 60%;
        margin: 0 auto;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Style pour le conteneur du tableau */
    #agentsTableWrapper {
        margin-top: 20px;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #ddd;
        background-color: #f8f9fa;
        padding: 10px;
    }

    /* Style pour le tableau */
    #agentsTable {
        border-collapse: collapse;
        width: 100%;
        background-color: #ffffff;
    }

    /* Style pour les en-têtes de tableau */
    #agentsTable thead th {
        background-color: #007bff;
        color: #ffffff;
        padding: 12px;
        text-align: center;
        border-bottom: 2px solid #0056b3;
        font-weight: 600;
    }

    /* Style pour les lignes du tableau */
    #agentsTable tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    #agentsTable tbody tr:nth-child(even) {
        background-color: #ffffff;
    }

    #agentsTable tbody td {
        padding: 12px;
        border-bottom: 1px solid #dee2e6;
        text-align: center;
    }

    /* Style pour les boutons d'action */
    .btn {
        display: inline-block;
        padding: 6px 12px;
        font-size: 14px;
        font-weight: 400;
        border-radius: 4px;
        text-align: center;
        text-decoration: none;
    }

    .btn-primary {
        color: #fff;
        background-color: #007bff;
        border: 1px solid #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .btn-secondary {
        color: #fff;
        background-color: #6c757d;
        border: 1px solid #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #4e555b;
    }

    /* Style pour les messages dans le tableau */
    #agentsTable tbody td[colspan] {
        text-align: center;
        font-style: italic;
        color: #6c757d;
        padding: 20px;
    }
</style>


@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.0/dist/perfect-scrollbar.min.js"></script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search');
    const agentsTableBody = document.querySelector('#agentsTable tbody');
    let currentPage = 1;
    let isLoading = false;
    let hasMore = true;

    function fetchAgents(search = '', page = 1) {
        fetch(`/mywebhealthci/api/agents?search=${encodeURIComponent(search)}&page=${page}`)
            .then(response => response.json())
            .then(data => {
                if (data.data.length > 0) {
                    data.data.forEach(agent => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td >${agent.Matricule_salarie}</td>
                            <td>${agent.projet.site_id || 'Non spécifié'}</td>
                            <td>${agent.nom} ${agent.prenom}</td>
                            <td>${agent.projet.designation || 'Non spécifié'}</td>
                            <td>${agent.sousfonction.intitule || 'Non spécifié'}</td>

                            <td>
                                <a href="/mywebhealthci/consulter/${agent.id}" class="btn btn-primary">Consulter</a>
                                <a href="/mywebhealthci/reception/${agent.id}" class="btn btn-secondary">Réception</a>
                            </td>
                        `;
                        agentsTableBody.appendChild(row);
                    });
                    currentPage++;
                } else {
                    hasMore = false;
                }
                isLoading = false;
            })
            .catch(error => {
                console.error('Erreur:', error);
                isLoading = false;
            });
    }

    function onScroll() {
        if (window.innerHeight + window.scrollY >= document.documentElement.scrollHeight) {
            if (!isLoading && hasMore) {
                isLoading = true;
                fetchAgents(searchInput.value, currentPage);
            }
        }
    }

    window.addEventListener('scroll', onScroll);

    function debounce(func, wait) {
        let timeout;
        return function (...args) {
            const context = this;
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(context, args), wait);
        };
    }

    const debouncedFetchAgents = debounce((searchValue) => {
        currentPage = 1;
        agentsTableBody.innerHTML = '';
        hasMore = true;
        fetchAgents(searchValue, currentPage);
    }, 300);

    searchInput.addEventListener('input', function () {
        const searchValue = this.value;
        debouncedFetchAgents(searchValue);
    });

    // Chargement initial des agents
    fetchAgents('', currentPage);
});

</script>
@endsection
