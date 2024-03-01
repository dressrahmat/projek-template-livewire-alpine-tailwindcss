<div>
    <div class="card card-side bg-gray-200 shadow-xl">
        <div class="card-body">
            <div class="border-l-8 border-primary px-4 py-4 my-2 bg-gray-500 w-fit shadow-md">
                <h1 class="text-xl text-slate-50 font-bold">Tambah Role</h1>
            </div>
            <!-- Tambah Role Form -->
            <form wire:submit.prevent="store">
                <!-- Nama Role -->
                <div class="mb-2">
                    <label class="form-control">
                        <span class="label-text text-base-100 py-2">Nama Role</span>
                        <input type="text" wire:model="name" placeholder="Masukkan nama role"
                            class="input input-primary bg-gray-100 rounded-md text-base-100 @error('name') border-red-500 @enderror"
                            autofocus />
                        @error('name') <span class="error text-red-500">{{ $message }}</span> @enderror
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
                                <input type="checkbox" wire:model="selectedPermissions.{{ $permission->id }}"
                                    value="{{ $permission->id }}" class="form-checkbox">
                                <span class="ml-2">{{ $permission->name }}</span>
                            </label>
                            @endforeach
                        </div>
                        @error('selectedPermissions') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col gap-y-3 mt-2">
                    <button type="submit" class="btn btn-primary rounded-md w-[98%]">Tambah</button>
                </div>
            </form>

        </div>
    </div>
</div>
