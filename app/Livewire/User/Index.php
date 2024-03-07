<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';

    public $name;

    public $email;

    public $password;

    public $nameId;

    public $emailId;

    public $passwordId;

    public $id;

    public $selectedRoles = [];

    public $selectedRole;

    public $selectedRolesIds = [];

    public $update = false;

    // Validation Rules
    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required',
    ];

    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->selectedRoles = [];
        $this->selectedRole;
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
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);

            // Attach Roles to User
            $user->syncRoles(array_keys(array_filter($this->selectedRoles)));

            // Set Flash Message
            session()->flash('success', 'User Successfully Created!!');

            // Reset Form Fields After Creating User
            $this->cancel();
            $this->dispatch('refresh');
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

        // Ambil izin dari peran
        $roles = $user->roles;

        // Inisialisasi array kosong untuk menyimpan ID izin yang dipilih
        $selectedRolesIds = [];

        // Loop melalui setiap izin dan tambahkan ID-nya ke dalam array selectedRoleIds
        foreach ($roles as $role) {
            $selectedRolesIds[$role->id] = true;
        }

        // Atur properti $selectedRoles untuk menandai izin yang dipilih
        $this->selectedRolesIds = $selectedRolesIds;

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

            // Filter selected roles
            $selectedRoleIds = array_keys(array_filter($this->selectedRolesIds));

            // Attach Roles to User
            if (! empty($selectedRoleIds)) {
                $roles = Role::whereIn('id', $selectedRoleIds)->get();
                $user->syncRoles($roles);
            } else {
                // If no roles selected, sync with empty roles
                $user->syncRoles([]);
            }

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
        $query = User::query();
        $roles = Role::get();

        if (! is_null($this->selectedRole)) {
            $role = Role::where('name', $this->selectedRole)->first();
            if ($role) {
                $query->whereHas('roles', function ($q) use ($role) {
                    $q->where('id', $role->id);
                });
            }
        }

        if (! empty($this->search)) {
            $query->where(function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%');
            });
        }

        $data = $query->paginate($this->perPage);

        return view('livewire.user.index', compact(['data', 'roles']));
    }
}
