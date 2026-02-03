@extends('layouts.app')

@section('content')
<div class="container">
    <meta name="user-id" content="{{ auth()->user()->id }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <h1 class="text-center mb-4 text-primary display-5 fw-bold">💊 Suivi global des stocks de Médicaments</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title">📋 Tableau de stock des médicaments</h5>
                <div class="form-group mb-0">
                    <label for="filterUser" class="form-label">Filtrer par responsable :</label>
                    <select id="filterUser" class="form-select">
                        <option value="">Tous</option>
                    </select>
                </div>
            </div>

            <table class="table table-hover mt-2" id="mergedStockTable">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Famille</th>
                        <th>Site 1</th>
                        <th>Site 2</th>
                        <th>Site 3</th>
                        <th>Total Global</th>
                        <th>Responsable</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<script>
const tableBody = document.querySelector('#mergedStockTable tbody');
const filterSelect = document.getElementById('filterUser');

async function fetchStocks() {
    try {
        const response = await fetch('/mywebhealthci/api/stocks');
        if (!response.ok) throw new Error('Erreur lors du chargement des stocks');

        const data = await response.json();
        populateUserFilter(data);
        renderTable(data);
    } catch (error) {
        console.error(error);
    }
}

function populateUserFilter(data) {
    const users = [...new Set(data.map(item => item.user_name).filter(Boolean))];

    // Nettoyer le select sauf "Tous"
    filterSelect.querySelectorAll('option:not(:first-child)').forEach(opt => opt.remove());

    users.forEach(user => {
        const option = document.createElement('option');
        option.value = user;
        option.textContent = user;
        filterSelect.appendChild(option);
    });
}

function renderTable(data) {
    const selectedUser = filterSelect.value;
    const filtered = selectedUser ? data.filter(item => item.user_name === selectedUser) : data;

    tableBody.innerHTML = '';

    filtered.forEach(stock => {
        const total = (parseInt(stock.stock_site_1) || 0) +
                      (parseInt(stock.stock_site_2) || 0) +
                      (parseInt(stock.stock_site_3) || 0);

        const row = `<tr>
            <td>${stock.stock_id}</td>
            <td>${stock.medication_name}</td>
            <td>${stock.famille_medicament}</td>
            <td>${stock.stock_site_1}</td>
            <td>${stock.stock_site_2}</td>
            <td>${stock.stock_site_3}</td>
            <td>${total}</td>
            <td>${stock.user_name}</td>
            <td>${stock.created_at}</td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="deleteStock(${stock.stock_id})">Supprimer</button>
            </td>
        </tr>`;
        tableBody.innerHTML += row;
    });
}

async function deleteStock(id) {
    if (confirm('Supprimer ce médicament ?')) {
        try {
            const response = await fetch(`/mywebhealthci/api/stocks/${id}`, {
                method: 'DELETE',
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (response.ok) {
                fetchStocks();
            } else {
                alert("Erreur lors de la suppression.");
            }
        } catch (error) {
            console.error(error);
            alert("Erreur réseau.");
        }
    }
}

filterSelect.addEventListener('change', fetchStocks);
fetchStocks();
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
