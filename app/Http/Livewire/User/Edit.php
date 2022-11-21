<?php

namespace App\Http\Livewire\User;

use App\Helpers\Helpers;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public User $user;
    public $profilePhoto;


    protected function rules()
    {
        return [
            'user.name' => ['required', 'string', 'max:255'],
            'user.email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class . ',email,' . $this->user->id],
        ];
    }

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

    public function update()
    {
        $this->validate();

        if ($this->profilePhoto != null) {
            $this->user->profile_photo_path != null
                ? Storage::delete($this->user->profile_photo_path) : null;
            $this->user->profile_photo_path = Helpers::storeFile($this->profilePhoto, 'profile-photo');
        }

        $this->user->save();

        $this->profilePhoto = null;

        session()->flash('updated', 'Updated Successfully');
    }

    public function render()
    {
        return view('livewire.user.edit');
    }
}
