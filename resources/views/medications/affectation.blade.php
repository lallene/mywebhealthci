@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4 text-primary display-5 fw-bold">💊 Gestion des Médicaments</h1>

    <!-- Premier tableau avec Site 1, Site 2, Site 3 -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">📄 Gestion des stocks par site</h5>
            <table class="table table-hover mt-3" id="siteMedicationTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 10%;">ID</th>
                        <th scope="col" style="width: 25%;">Nom</th>
                        <th scope="col" style="width: 10%;" class="text-center">Quantité</th>
                        <th scope="col" style="width: 10%;" class="text-center" >Site 1</th>
                        <th scope="col" style="width: 10%;" class="text-center" >Site 2</th>
                        <th scope="col" style="width: 10%;" class="text-center">Site 3</th>
                        <th scope="col" style="width: 10%;" class="text-center" >Stock</th>
                        <th scope="col" style="width: 15%;" class="text-center" >Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contenu généré dynamiquement -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Deuxième tableau classique des médicaments -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">📋 Liste des Médicaments</h5>
            <table class="table table-hover mt-3" id="medicationTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Famille</th>
                        <th scope="col">Sites</th>
                        <th scope="col">Nbre comprimés</th>
                        <th scope="col">Seuil d'alerte</th>
                        <th scope="col">Utilisateur</th>
                        <th scope="col">Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contenu généré dynamiquement -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    async function fetchSiteMedications() {
        try {
            const response = await fetch('/mywebhealthci/api/medications'); // Données pour le tableau des sites
            if (!response.ok) throw new Error('Erreur lors du chargement des stocks par site');
            const data = await response.json();

            const siteTableBody = document.querySelector('#siteMedicationTable tbody');
            siteTableBody.innerHTML = '';

            data.forEach(medication => {
                const siteRow = `<tr>
                    <td>${medication.id}</td>
                    <td >${medication.name}</td>
                    <td class="text-center">${medication.stock_quantity}</td>
                    <td ><input type="number" class="form-control text-center" value="${medication.site1 || 0}" onchange="updateSiteStock(${medication.id}, 'site1', this.value)" ></td>
                    <td ><input type="number" class="form-control text-center" value="${medication.site2 || 0}" onchange="updateSiteStock(${medication.id}, 'site2', this.value)" </td>
                    <td><input type="number" class="form-control text-center" value="${medication.site3 || 0}" onchange="updateSiteStock(${medication.id}, 'site3', this.value)" ></td>
                    <td><input type="number" class="form-control text-center" value="${medication.stock || 0}" onchange="updateSiteStock(${medication.id}, 'site3', this.value)" ></td>

                    <td>
                        <button class="btn btn-success btn-sm" onclick="saveSiteStock(${medication.id})">
                            <i class="fas fa-save"></i> Sauvegarder
                        </button>
                    </td>
                </tr>`;
                siteTableBody.innerHTML += siteRow;
            });
        } catch (error) {
            console.error('Erreur:', error);
            alert('Une erreur inattendue s\'est produite lors du chargement des stocks par site.');
        }
    }

    async function fetchMedications() {
        try {
            const response = await fetch('/mywebhealthci/api/stocks'); // Données pour le tableau des médicaments
            if (!response.ok) throw new Error('Erreur lors du chargement des médicaments');
            const data = await response.json();

            const mainTableBody = document.querySelector('#medicationTable tbody');
            mainTableBody.innerHTML = '';

            data.forEach(medication => {
                const mainRow = `<tr>
                    <td>${medication.id}</td>
                    <td>${medication.name}</td>
                    <td>${medication.stock_quantity}</td>
                    <td>${medication.tablet_count}</td>
                    <td>${medication.unit_price}</td>
                    <td>${medication.supplier}</td>
                    <td>${medication.famille_medicament}</td>
                    <td>
                        
                        <button class="btn btn-danger btn-sm" onclick="deleteMedication(${medication.id})">
                            <i class="fas fa-trash-alt"></i> Supprimer
                        </button>
                    </td>
                </tr>`;
                mainTableBody.innerHTML += mainRow;
            });
        } catch (error) {
            console.error('Erreur:', error);
            alert('Une erreur inattendue s\'est produite lors du chargement des médicaments.');
        }
    }

    async function updateSiteStock(id, site, value) {
        console.log(`Stock mis à jour pour ${site} : ${value} (Médicament ID: ${id})`);
    }

    async function saveSiteStock(id) {
        alert(`Les stocks pour le médicament ID ${id} ont été sauvegardés.`);
    }

    async function deleteMedication(id) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce médicament ?')) {
            try {
                const response = await fetch(`/mywebhealthci/api/medications/${id}`, { method: 'DELETE' });
                if (!response.ok) throw new Error('Erreur lors de la suppression');
                fetchMedications();
            } catch (error) {
                console.error('Erreur:', error);
                alert('Erreur lors de la suppression du médicament.');
            }
        }
    }

    // Charger les deux tableaux
    fetchMedications();
    fetchSiteMedications();
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection
