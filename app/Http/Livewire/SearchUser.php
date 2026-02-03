<?php

namespace App\Http\Livewire;
// app/Http/Livewire/SearchUser.php

use App\Models\User;
use Livewire\Component;

class SearchUser extends Component
{
    public $search = '';

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->paginate(10); // Paginé avec 10 utilisateurs par page

        return view('livewire.search-user', [
            'users' => $users
        ]);
    }


}
