<?php

namespace App\Http\Livewire\User;

use App\Helpers\Helpers;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $email, $name, $profilePhoto;

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
    ];

    public function updatedProfilePhoto()
    {
        $this->validate([
            'profilePhoto' => 'image',
        ]);
    }

    public function deleteProfilePhoto()
    {
        $this->profilePhoto = null;
    }

    public function create()
    {
        $attr = $this->validate();

        $attr['password'] = bcrypt('password');

        $attr['profile_photo_path'] = $this->profilePhoto != null ? Helpers::storeFile($this->profilePhoto, 'profile-photo') : null;

        User::create($attr);

        return redirect()->route('user.index')
            ->with('success', 'User Created Successfully.');
    }

    public function render()
    {
        return view('livewire.user.create');
    }
}
