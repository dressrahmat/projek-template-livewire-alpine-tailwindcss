<?php

namespace App\Livewire\Permission;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $name;

    public $nameId;

    public $id;

    public $update = false;

    // Validation Rules
    protected $rules = [
        'name' => 'required',
    ];

    public function resetFields()
    {
        $this->name = '';
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
            Permission::create([
                'name' => $this->name,
            ]);
            // Set Flash Message
            session()->flash('success', 'Permission Berhasil Dibuat!!');
            // Reset Form Fields After Creating Category
            $this->resetFields();
            $this->dispatch('refresh');
        } catch (\Exception $e) {
            // Set Flash Message
            session()->flash('error', 'Something goes wrong while creating permission!!');
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
        $permission = Permission::findOrFail($id);
        $this->nameId = $permission->name;
        $this->id = $permission->id;
        $this->update = true;
    }

    public function edit()
    {
        $permission = Permission::find($this->id);
        // Validate request
        $this->validate();
        try {
            // Update category
            $permission->fill([
                'name' => $this->name,
            ])->save();

            session()->flash('success', 'Permission Updated Successfully!!');

            $this->cancel();
            $this->dispatch('refresh');
        } catch (\Exception $e) {
            session()->flash('error', 'Something goes wrong while updating permission!!');
            $this->cancel();
        }
    }

    public function delete($id)
    {
        try {
            // Lakukan operasi penghapusan data sesuai dengan $deleteId
            Permission::findOrFail($id)->delete();

            // Setelah penghapusan berhasil, atur pesan sukses
            session()->flash('success', 'permission successfully deleted.');
            $this->dispatch('refresh');
        } catch (\Exception $e) {
            // Jika ada kesalahan saat penghapusan, atur pesan error
            session()->flash('error', 'Failed to delete permission.');
        }
    }

    public function render()
    {
        $data = Permission::where('name', 'like', '%'.$this->search.'%')
            ->paginate(5);

        return view('livewire.permission.index', compact(['data']));
    }
}
