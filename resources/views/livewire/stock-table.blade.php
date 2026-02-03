<div>
    <!-- Barre de recherche -->
    <div class="row mb-3">
        <div class="col-md-12">
            <input type="text" class="form-control" placeholder="Rechercher..." wire:model="search">
        </div>
    </div>

    <!-- Boutons de filtre -->
    <div class="row mb-3">
        <div class="col-md-12 text-center">
            <button wire:click="updatedFilterStock('epuise')" class="btn btn-danger">Afficher Médicaments Épuisés</button>
            <button wire:click="updatedFilterStock('disponible')" class="btn btn-success">Afficher Médicaments Disponibles</button>
            <button wire:click="updatedFilterStock('')" class="btn btn-secondary">Afficher Tous les Médicaments</button>
        </div>
    </div>

    <!-- Tableau des stocks -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Famille</th>
                    <th>Quantité Initiale</th>
                    <th>Dispo Site 1</th>
                    <th>Dispo Site 2</th>
                    <th>Dispo Site 3</th>
                    <th>Global Utilisé</th>
                    <th>Global Disponible</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stocks as $stock)
                    <tr>
                        <td>{{ $stock->stock_id }}</td>
                        <td>{{ $stock->medication_name }}</td>
                        <td>{{ $stock->famille_medicament }}</td>
                        <td>{{ $stock->stock_global_initial }}</td>
                        <td>{{ $stock->stock_site_1 }}</td>
                        <td>{{ $stock->stock_site_2 }}</td>
                        <td>{{ $stock->stock_site_3 }}</td>
                        <td>{{ $stock->stock_global_utilise }}</td>
                        <td>{{ $stock->stock_site_1 + $stock->stock_site_2 + $stock->stock_site_3 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        {{ $stocks->links() }}
    </div>
</div>
