<div>
    <div class="card card-side shadow-xl col-span-2">
        <div class="card-body">
            <div class="border-l-8 border-accent px-4 py-4 my-2 bg-gray-100  shadow-md">
                <h1 class="text-xl font-bold">Edit Role</h1>
            </div>
            <form wire:submit.prevent="edit">
                <!-- Nama Role -->
                <div>
                    <label class="form-control">
                        <span class="label-text text-base-100">Nama Role</span>
                        <input type="text" wire:model="nameId" placeholder="Masukkan nama role"
                            class="input bg-base-content input-bordered input-accent @error('nameId') border-red-500 @enderror"
                            autofocus />
                        @error('nameId') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </label>
                </div>
            
                <!-- Permission -->
                <div class="mb-2">
                    <label class="form-control">
                        <span class="label-text text-base-100 py-2">Permission</span>
                        <!-- Daftar permission di sini -->
                        <div class="flex flex-col space-y-2">
                            @foreach($permissions as $permission)
                            <label class="inline-flex items-center">
                                <input type="checkbox" wire:model="selectedPermissionIds.{{ $permission->id }}" value="{{ $permission->id }}" class="form-checkbox">
                                <span class="ml-2">{{ $permission->name }}</span>
                            </label>
                            @endforeach
                        </div>
                        @error('selectedPermissions') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </label>
                </div>
            
                <!-- Submit Button -->
                <div class="flex flex-col gap-y-3 mt-2">
                    <button type="submit" class="btn btn-primary w-[98%]">Update</button>
                    <button wire:click.prevent="cancel()" class="btn btn-secondary w-[98%]">Cancel</button>
                </div>
            </form>
            
        </div>
    </div>
</div>