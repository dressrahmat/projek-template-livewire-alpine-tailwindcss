<?php

namespace App\Livewire\Blog;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';

    public $update = false;

    // Validation Rules
    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required',
    ];

    public function mount()
    {
        $this->id = auth()->user()->id;
    }

    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function refreshSearch()
    {
        $this->updatingSearch();
    }

    public function cancel()
    {
        $this->update = false;
        $this->resetFields();
    }

    public function store()
    {
        // Validate Form Request
        $this->validate();
        try {
            // Create User
            $user = Blog::create([
                
            ]);

            // Set Flash Message
            session()->flash('success', 'User Successfully Created!!');

            // Reset Form Fields After Creating User
            $this->cancel();
        } catch (\Exception $e) {
            // Set Flash Message
            session()->flash('error', 'Something goes wrong while creating user!!');
            // Reset Form Fields After Creating User
            $this->resetFields();
        }
    }

    public function update()
    {
        $this->update = true;
    }

    public function updateAksiId($id = null)
    {
        $user = User::findOrFail($id);
        $this->nameId = $user->name;
        $this->emailId = $user->email;
        $this->passwordId = $user->password;
        $this->id = $user->id;

        $this->update = true;
    }

    public function edit()
    {
        $user = User::find($this->id);

        try {
            // Update user information
            $userData = [
                'name' => $this->nameId,
                'email' => $this->emailId,
            ];

            // Check if password is not empty, then update password
            if (! empty($this->passwordId)) {
                $userData['password'] = bcrypt($this->passwordId);
            }

            $user->update($userData);
            
            // Set Flash Message
            session()->flash('success', 'User Updated Successfully!!');

            // Reset fields and cancel edit mode
            $this->cancel();
            $this->dispatch('$refresh');
        } catch (\Exception $e) {
            session()->flash('error', 'Something goes wrong while updating user!!');
            $this->cancel();
        }
    }

    public function render()
    {
        $query = Blog::query();

        if (! empty($this->search)) {
            $query->where(function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%');
            });
        }

        $data = $query->paginate($this->perPage);

        return view('livewire.blog.index', compact(['data']));
    }
}

