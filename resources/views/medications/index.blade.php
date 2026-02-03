@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4 text-primary display-5 fw-bold">💊 Gestion des Médicaments</h1>

    <!-- Formulaire pour ajouter ou modifier un médicament -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title mb-4">📝 Ajouter / Modifier un Médicament</h5>
            <form id="medicationForm" method="POST" class="form-horizontal" data-edit-id="">
                @csrf
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <label for="name">Nom du médicament</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="stock_quantity">Quantité en stock</label>
                        <input type="number" name="stock_quantity" id="stock_quantity" class="form-control" required>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="expiration_date">Date d'expiration</label>
                        <input type="date" name="expiration_date" id="expiration_date" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <label for="supplier">Fournisseur</label>
                        <input type="text" name="supplier" id="supplier" class="form-control">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="supply_date">Date de fourniture</label>
                        <input type="date" name="supply_date" id="supply_date" class="form-control">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="unit_price">Prix unitaire</label>
                        <input type="number" name="unit_price" id="unit_price" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <label for="tablet_count">Nombre de comprimés</label>
                        <input type="number" name="tablet_count" id="tablet_count" class="form-control">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="distribution_type_id">Type de distribution</label>
                        <select name="distribution_type_id" id="distribution_type_id" class="form-control">
                            <!-- Les options seront ajoutées ici via JavaScript -->
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="famille_medicament">Famille de Médicament</label>
                        <select name="famille_medicament" id="famille_medicament" class="form-control">
                            <option value="Antibiotiques">Antibiotiques</option>
                            <option value="Analgésiques">Analgésiques</option>
                            <option value="Antiinflammatoires">Antiinflammatoires</option>
                            <option value="Antidouleurs">Antidouleurs</option>
                            <option value="Vitamines">Vitamines</option>
                            <option value="Antipaludiques">Antipaludiques</option>
                            <option value="Antiparasitaires">Antiparasitaires</option>
                            <option value="Antihistaminiques">Antihistaminiques</option>
                            <option value="Anticoagulants">Anticoagulants</option>
                            <option value="Anticonvulsivants">Anticonvulsivants</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-plus-circle"></i> Ajouter
                </button>
            </form>
           
            <div class="container">
                <h2>Importer des Médicaments</h2>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('medicaments.import.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">Choisir un fichier Excel :</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Importer</button>
                </form>
            </div>
          
        </div>
    </div>

    <!-- Liste des médicaments -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">📋 Liste des Médicaments</h5>
            <table class="table table-hover mt-3" id="medicationTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Nbre comprimés</th>
                        <th scope="col">Prix unitaire</th>
                        <th scope="col">Fournisseur</th>
                        <th scope="col">Famille medicaments</th>
                        <th scope="col">Date de Laivraison</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Les médicaments seront ajoutés ici via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
  

    // Fonction pour afficher un message d'erreur
    function showError(message) {
        alert(`Erreur : ${message}`);
    }

    // Fonction pour gérer les réponses API
    async function handleResponse(response) {
        if (!response.ok) {
            const textResponse = await response.text();
            try {
                const errorData = JSON.parse(textResponse);
                showError(errorData.message || 'Une erreur est survenue.');
            } catch (e) {
                showError(textResponse);
            }
            return false;
        }
        return true;
    }

    async function fetchMedications() {
        try {
            const response = await fetch('/mywebhealthci/api/medications');
            if (await handleResponse(response)) {
                const data = await response.json();
                const tableBody = document.querySelector('#medicationTable tbody');
                tableBody.innerHTML = ''; // Réinitialiser le tableau

                data.forEach(medication => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${medication.id}</td>
                        <td>${medication.name}</td>
                        <td>${medication.stock_quantity}</td>
                        <td>${medication.tablet_count}</td>
                        <td>${medication.unit_price}</td>
                        <td>${medication.supplier}</td>
                        <td>${medication.famille_medicament}</td>
                        <td>${medication.supply_date}</td>

                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editMedication(${medication.id})">
                                <i class="fas fa-edit"></i> Modifier
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteMedication(${medication.id})">
                                <i class="fas fa-trash-alt"></i> Supprimer
                            </button>
                            <button id="validateBtn-${medication.id}" 
                                    class="btn btn-success btn-sm ${medication.validation ? 'disabled' : ''}" 
                                    onclick="validateMedication(${medication.id})"
                                    ${medication.validation ? 'disabled' : ''}>
                                <i class="fas fa-check-circle"></i> Valider
                            </button>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            }
        } catch (error) {
            console.error('Erreur:', error);
            showError('Une erreur inattendue est survenue.');
        }
    }

    async function validateMedication(id) {

        try {
            const response = await fetch(`/mywebhealthci/api/medications/${id}/validate`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ validation: 1 })
            });

            if (await handleResponse(response)) {
                document.getElementById(`validateBtn-${id}`).classList.add('disabled');
                document.getElementById(`validateBtn-${id}`).setAttribute('disabled', 'true');
            }
        } catch (error) {
            console.error('Erreur:', error);
            showError('Erreur lors de la validation du médicament.');
        }
    }

    // Fonction pour récupérer et afficher les types de distribution
    async function fetchDistributionTypes() {
        try {
            const response = await fetch('/mywebhealthci/api/type-distributions');
            if (await handleResponse(response)) {
                const data = await response.json();
                const distributionSelect = document.getElementById('distribution_type_id');
                distributionSelect.innerHTML = ''; // Réinitialiser les options
                data.forEach(distribution => {
                    const option = document.createElement('option');
                    option.value = distribution.id;
                    option.textContent = distribution.name;
                    distributionSelect.appendChild(option);
                });
            }
        } catch (error) {
            console.error('Erreur:', error);
            showError('Erreur lors de la récupération des types de distribution.');
        }
    }

    // Fonction pour pré-remplir le formulaire pour la modification
    async function editMedication(id) {
        try {
            const response = await fetch(`/mywebhealthci/medication/${id}`);
            if (await handleResponse(response)) {
                const data = await response.json();
                if (data) {
                    document.getElementById('name').value = data.name || '';
                    document.getElementById('stock_quantity').value = data.stock_quantity || '';
                    document.getElementById('expiration_date').value = data.expiration_date || '';
                    document.getElementById('supplier').value = data.supplier || '';
                    document.getElementById('supply_date').value = data.supply_date || '';
                    document.getElementById('unit_price').value = data.unit_price || '';
                    document.getElementById('tablet_count').value = data.tablet_count || '';
                    document.getElementById('distribution_type_id').value = data.distribution_type_id || '';
                    document.getElementById('famille_medicament').value = data.famille_medicament || '';
                    const form = document.getElementById('medicationForm');
                    form.dataset.editId = id;
                    document.querySelector('button[type="submit"]').innerHTML = '<i class="fas fa-sync-alt"></i> Mettre à jour';
                }
            }
        } catch (error) {
            console.error('Erreur:', error);
            showError('Erreur lors de la récupération du médicament.');
        }
    }

    // Soumettre le formulaire
    document.getElementById('medicationForm').addEventListener('submit', async function(event) {
        event.preventDefault(); // Empêcher la soumission normale du formulaire
        const submitButton = this.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> En cours...';

        const formData = new FormData(this);
        const medicationData = {
            name: formData.get('name'),
            stock_quantity: Number(formData.get('stock_quantity')),
            expiration_date: formData.get('expiration_date'),
            supplier: formData.get('supplier'),
            supply_date: formData.get('supply_date'),
            unit_price: formData.get('unit_price'),
            tablet_count: formData.get('tablet_count'),
            distribution_type_id: formData.get('distribution_type_id'),
            famille_medicament: formData.get('famille_medicament')
        };

        const editId = this.dataset.editId;
        let url = '/mywebhealthci/api/medications';
        let method = 'POST';

        if (editId) {
            url = `/mywebhealthci/api/medications/${editId}`;
            method = 'PUT';
        }

        try {
            const response = await fetch(url, {
                method: method,
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(medicationData)
            });

            if (await handleResponse(response)) {
                fetchMedications();
                this.reset();
                this.dataset.editId = '';
                submitButton.innerHTML = '<i class="fas fa-plus-circle"></i> Ajouter';
            }
        } catch (error) {
            console.error('Erreur:', error);
            showError('Une erreur inattendue s\'est produite.');
        } finally {
            submitButton.disabled = false;
        }
    });

    

    // Supprimer un médicament
    async function deleteMedication(id) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce médicament ?')) {
            try {
                const response = await fetch(`/mywebhealthci/api/medications/${id}`, { method: 'DELETE' });
                if (await handleResponse(response)) {
                    fetchMedications();
                }
            } catch (error) {
                console.error('Erreur:', error);
                showError('Erreur lors de la suppression du médicament.');
            }
        }
    }

    // Charger les données initiales
    fetchDistributionTypes();
    fetchMedications();
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection
