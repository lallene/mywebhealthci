@extends('layouts.app')
<head>
    <meta charset="UTF-8">
    <title>Rapport Stock Médicaments par Projet</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
@section('content')
    <h2 class="mb-4">Répartition des médicaments par projet</h2>

    {{-- ✅ TABLEAU INTERACTIF --}}
    <div class="mb-5">
        <h4>Données détaillées</h4>
        <table id="medicationTable" class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Médicament</th>
                    <th>Projet</th>
                    <th>Quantité utilisée</th>
                    <th>Pourcentage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($flatData as $row)
                    <tr>
                        <td>{{ $row['medication_name'] }}</td>
                        <td>{{ $row['project'] }}</td>
                        <td>{{ $row['quantity_project'] }}</td>
                        <td>{{ $row['percentage_project'] }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- ✅ GRAPHIQUES PAR MÉDICAMENT --}}
    @php
        use Illuminate\Support\Str;
        $groupedData = collect($flatData)->groupBy('medication_name');
    @endphp

    <div>
        <h4>Visualisation par médicament</h4>
        @foreach ($groupedData as $medication => $data)
            <div class="card mb-5">
                <div class="card-body">
                    <h5 class="card-title">{{ $medication }}</h5>
                    <canvas id="chart-{{ Str::slug($medication, '-') }}" height="100"></canvas>
                </div>
            </div>

            <script>
                const ctx{{ Str::slug($medication, '') }} = document.getElementById("chart-{{ Str::slug($medication, '-') }}").getContext('2d');

                new Chart(ctx{{ Str::slug($medication, '') }}, {
                    type: 'pie',
                    data: {
                        labels: {!! json_encode($data->pluck('project')) !!},
                        datasets: [{
                            label: 'Quantité utilisée',
                            data: {!! json_encode($data->pluck('quantity_project')) !!},
                            backgroundColor: [
                                '#FF6384', '#36A2EB', '#FFCE56',
                                '#66BB6A', '#BA68C8', '#FF7043',
                                '#26C6DA', '#FFA726', '#8D6E63'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'right'
                            },
                            title: {
                                display: true,
                                text: 'Répartition des quantités par projet'
                            }
                        }
                    }
                });
            </script>
        @endforeach
    </div>
 @section('script')
    {{-- ✅ SCRIPTS JAVASCRIPT POUR DATATABLES --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <script>
        $(document).ready(function () {
            $('#medicationTable').DataTable({
                dom: 'Bfrtip',
                buttons: ['excelHtml5', 'pdfHtml5'],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json'
                }
            });
        });
    </script>

