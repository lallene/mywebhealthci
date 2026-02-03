@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4 text-primary display-5 fw-bold">📦 Gestion des Types de Distribution</h1>

    <!-- Formulaire pour ajouter ou modifier un type de distribution -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title mb-4">📝 Ajouter / Modifier un Type de Distribution</h5>
            <form id="typeForm" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nom du type de distribution</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-plus-circle"></i> Ajouter
                </button>
            </form>
        </div>
    </div>

    <!-- Liste des types de distribution -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">📋 Liste des Types de Distribution</h5>
            <table class="table table-hover mt-3" id="typeTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Les types de distribution seront ajoutés ici via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Fonction pour récupérer et afficher les types de distribution
    function fetchTypes() {
        fetch('/mywebhealthci/api/type-distributions')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.querySelector('#typeTable tbody');
                tableBody.innerHTML = ''; // Réinitialiser le tableau
                data.forEach(type => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${type.id}</td>
                        <td>${type.name}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editType(${type.id}, '${type.name}')">
                                <i class="fas fa-edit"></i> Modifier
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteType(${type.id})">
                                <i class="fas fa-trash-alt"></i> Supprimer
                            </button>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            });
    }

    document.getElementById('typeForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Empêcher la soumission normale du formulaire

        const name = document.getElementById('name').value;
        const editId = this.dataset.editId; // Vérifie si on est en mode modification

        let url = '/mywebhealthci/api/type-distributions';
        let method = 'POST';

        // Si on est en mode modification, changer URL et méthode
        if (editId) {
            url = `/mywebhealthci/api/type-distributions/${editId}`;
            method = 'PUT';
        }

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ name })
        })
        .then(response => response.json())
        .then(() => {
            fetchTypes(); // Rafraîchir la liste après ajout ou modification
            document.getElementById('name').value = ''; // Réinitialiser le champ
            document.querySelector('button[type="submit"]').innerHTML = '<i class="fas fa-plus-circle"></i> Ajouter';
            delete this.dataset.editId; // Supprimer l'ID d'édition
        })
        .catch(error => console.error('Erreur:', error));
    });

    // Fonction pour pré-remplir le formulaire pour la modification
    function editType(id, name) {
        document.getElementById('name').value = name;
        document.querySelector('button[type="submit"]').innerHTML = '<i class="fas fa-sync-alt"></i> Mettre à jour';
        document.getElementById('typeForm').dataset.editId = id; // Stocker l'ID pour la mise à jour
    }

    // Fonction pour supprimer un type de distribution
    function deleteType(id) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce type de distribution ?')) {
            fetch(`/mywebhealthci/api/type-distributions/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(() => {
                fetchTypes(); // Rafraîchir la liste après suppression
            })
            .catch(error => console.error('Erreur:', error));
        }
    }

    // Charger les types de distribution au chargement de la page
    document.addEventListener('DOMContentLoaded', fetchTypes);
</script>

<!-- Ajout des icônes FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection
