<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consommation des Médicaments</title>

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Bootstrap CSS (si nécessaire pour le style) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

    <div class="container mt-5">
        <h2 class="text-center">Consommation des Médicaments</h2>

        <!-- Tableau -->
        <table id="medicamentTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du Médicament</th>
                    <th>Stock Initial</th>
                    <th>Quantité Utilisée</th>
                    <th>Stock Restant</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $medicament)
                    <tr>
                        <td>{{ $medicament->id }}</td>
                        <td>{{ $medicament->name }}</td>
                        <td>{{ number_format($medicament->stock_initial, 0, ',', ' ') }}</td>
                        <td>{{ number_format($medicament->quantite_utilisee, 0, ',', ' ') }}</td>
                        <td>{{ number_format($medicament->stock_restant, 0, ',', ' ') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Bootstrap JS (si nécessaire pour le style) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        // Initialisation de DataTables
        $(document).ready(function() {
            $('#medicamentTable').DataTable(); // Applique DataTables au tableau
        });
    </script>
</body>
</html>
