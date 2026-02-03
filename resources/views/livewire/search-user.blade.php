<div>
    <input type="text" wire:model.debounce.300ms="search" placeholder="Rechercher un utilisateur..." class="form-control mb-3">

    <ul class="list-group">
        @foreach($users as $user)
            <li class="list-group-item">
                {{ $user->name }} - {{ $user->email }}
            </li>
        @endforeach
    </ul>

    <!-- Pagination -->
    {{ $users->links() }}
</div>
