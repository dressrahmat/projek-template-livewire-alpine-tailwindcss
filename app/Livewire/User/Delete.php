<?php

namespace App\Livewire\User;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class Delete extends ModalComponent
{
    public User $user;

    public function delete()
    {
        $this->user->delete();
        session()->flash('success', 'User successfully deleted.');

        return redirect()->route('user.index');
    }

    public function render()
    {
        return view('livewire.user.delete');
    }
}
