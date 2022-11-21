<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $selected = [];
    public $all = false;

    public function selectAll()
    {
        if ($this->all) {
            $this->selected = User::whereNotIn('id', [auth()->user()->id])->get()->pluck('id');
        } else {
            $this->selected = [];
        }
    }
    public function multiDelete()
    {
        // dd($this->selected);
        if (is_array($this->selected)) {
            foreach ($this->selected as $id) {
                $book = User::findOrFail($id);

                $book != null ? $book->delete() : null;
            }
        }

        $this->selected = [];

        $this->resetPage();
    }
    public function deleteUser(User $user)
    {
        $user->delete();
    }
    public function render()
    {
        $users = User::when($this->search, function ($query) {
            return $query->where('name', 'ilike', '%' . $this->search . '%')
                ->orWhere('email', 'ilike', '%' . $this->search . '%');
        })->paginate(10);
        return view('livewire.user.index', [
            'users' => $users,
        ]);
    }
}
