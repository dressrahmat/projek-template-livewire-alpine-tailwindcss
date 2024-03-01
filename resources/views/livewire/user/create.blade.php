<div>
    <div class="card card-side bg-gray-200 shadow-xl">
        <div class="card-body">
            <div class="border-l-8 border-primary px-4 py-4 my-2 bg-gray-500 w-fit shadow-md">
                <h1 class="text-xl text-slate-50 font-bold">Tambah User</h1>
            </div>
            <!-- Tambah User Form -->
            <form wire:submit.prevent="store">
                <!-- Nama User -->
                <div class="mb-2">
                    <label class="form-control">
                        <span class="label-text text-base-100 py-2">Nama User</span>
                        <input type="text" wire:model="name" placeholder="Masukkan nama user"
                            class="input input-primary rounded-md bg-gray-100 text-base-100 @error('name') border-red-500 @enderror"
                            autofocus />
                        @error('name') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </label>
                </div>

                <!-- Email User -->
                <div class="mb-2">
                    <label class="form-control">
                        <span class="label-text text-base-100 py-2">Email User</span>
                        <input type="email" wire:model="email" placeholder="Masukkan email user"
                            class="input input-primary rounded-md bg-gray-100 text-base-100 @error('email') border-red-500 @enderror" />
                        @error('email') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </label>
                </div>

                <!-- Password User -->
                <div class="mb-2">
                    <label class="form-control">
                        <span class="label-text text-base-100 py-2">Password User</span>
                        <input type="password" wire:model="password" placeholder="Masukkan password user"
                            class="input input-primary rounded-md bg-gray-100 text-base-100 @error('password') border-red-500 @enderror" />
                        @error('password') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </label>
                </div>

                <!-- Role User -->
                <div class="mb-2">
                    <label class="form-control">
                        <span class="label-text text-base-100 py-2">Role User</span>
                        <!-- Daftar role di sini -->
                        <div class="flex flex-col space-y-2">
                            @foreach($roles as $role)
                            <label class="inline-flex items-center">
                                <input type="checkbox" wire:model="selectedRoles.{{ $role->id }}" value="{{ $role->id }}" class="form-checkbox">
                                <span class="ml-2">{{ $role->name }}</span>
                            </label>
                            @endforeach
                        </div>
                        @error('selectedRoles') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col gap-y-3 mt-2">
                    <button type="submit" class="btn btn-primary w-[98%]">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
