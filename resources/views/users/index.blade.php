@extends('layouts.app')
<!-- recherche css -->
<link rel="stylesheet" href="{{ asset('assets/css/recherche.css') }}" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

@section('content')
<style>
    .contact-form4 {
        background-color: #174650;
        position: relative;
        border-radius: 12px;
        top: 36px;
        height: 120px;
    }
</style>
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2> LES UTILISATEURS</h2>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table id="usersTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            {{ $role->name }}<br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#usersTable').DataTable({
            pageLength: 30,
            lengthMenu: [[30, 60, 100, -1], [30, 60, 100, "Tout afficher"]],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json'
            }
        });
    });
</script>
@endsection
