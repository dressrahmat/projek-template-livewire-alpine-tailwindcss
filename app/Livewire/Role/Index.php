<?php

namespace App\Livewire\Role;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination;

    public $name;

    public $search = '';

    public $nameId;

    public $id;

    public $selectedPermissions = [];

    public $selectedPermissionIds = [];

    public $update = false;

    // Validation Rules
    protected $rules = [
        'name' => 'required',
    ];

    public function resetFields()
    {
        $this->name = '';
        $this->selectedPermissions = '';
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
            // Create Rumah Makan
            $role = Role::create([
                'name' => $this->name,
                'created_at' => now(), // Set waktu saat ini
            ]);

            // Filter izin yang dipilih
            $selectedPermissionIds = array_keys(array_filter($this->selectedPermissions));

            // Attach Permissions to Role
            if (! empty($selectedPermissionIds)) {
                $permissions = Permission::whereIn('id', $selectedPermissionIds)->get();
                $role->syncPermissions($permissions);
            }

            // Set Flash Message
            session()->flash('success', 'Role Berhasil Dibuat!!');
            // Reset Form Fields After Creating Category
            $this->resetFields();
            $this->dispatch('refresh');
        } catch (\Exception $e) {
            // Set Flash Message
            session()->flash('error', 'Something goes wrong while creating role!!');
            // Reset Form Fields After Creating Category
            $this->resetFields();
        }
    }

    public function update()
    {
        $this->update = true;
    }

    public function updateAksiId($id = null)
    {
        $role = Role::findOrFail($id);
        $this->nameId = $role->name;
        $this->id = $role->id;

        // Ambil izin dari peran
        $permissions = $role->permissions;

        // Inisialisasi array kosong untuk menyimpan ID izin yang dipilih
        $selectedPermissionIds = [];

        // Loop melalui setiap izin dan tambahkan ID-nya ke dalam array selectedPermissionIds
        foreach ($permissions as $permission) {
            $selectedPermissionIds[$permission->id] = true;
        }

        // Atur properti $selectedPermissions untuk menandai izin yang dipilih
        $this->selectedPermissionIds = $selectedPermissionIds;

        $this->update = true;
    }

    public function edit()
    {
        $role = Role::find($this->id);

        try {
            // Perbarui nama peran
            $role->update([
                'name' => $this->nameId,
            ]);

            // Filter izin yang dipilih
            $selectedPermissionIds = array_keys(array_filter($this->selectedPermissionIds));

            // Attach Permission to Role
            if (! empty($selectedPermissionIds)) {
                $permissions = Permission::whereIn('id', $selectedPermissionIds)->get();
                $role->syncPermissions($permissions);
            } else {
                // Jika tidak ada izin yang dipilih, sinkronkan peran dengan izin kosong
                $role->syncPermissions([]);
            }

            // Set Flash Message
            session()->flash('success', 'Role Updated Successfully!!');

            // Reset fields and cancel edit mode
            $this->cancel();
            $this->dispatch('refresh');
        } catch (\Exception $e) {
            session()->flash('error', 'Something goes wrong while updating role!!');
            $this->cancel();
        }
    }

    public function addPermission()
    {
        $this->validate([
            'selectedPermission' => 'required|exists:permissions,id',
        ]);

        $permission = Permission::find($this->selectedPermission);
        $role = Role::find($this->id);
        $role->givePermissionTo($permission->name);

        session()->flash('success', 'Permission berhasil ditambahkan ke dalam role.');

        $this->reset('selectedPermission');
    }

    public function delete($id)
    {
        try {
            // Lakukan operasi penghapusan data sesuai dengan $deleteId
            Role::findOrFail($id)->delete();

            // Setelah penghapusan berhasil, atur pesan sukses
            session()->flash('success', 'Role successfully deleted.');
            $this->dispatch('refresh');
        } catch (\Exception $e) {
            // Jika ada kesalahan saat penghapusan, atur pesan error
            session()->flash('error', 'Failed to delete role.');
        }
    }

    public function render()
    {
        $data = Role::where('name', 'like', '%'.$this->search.'%')
                ->paginate(5);
        $permissions = Permission::get();

        return view('livewire.role.index', compact(['data', 'permissions']));
    }
}
