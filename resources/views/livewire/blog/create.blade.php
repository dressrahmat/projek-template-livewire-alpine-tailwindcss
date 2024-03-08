<div>
    <div class="card card-side bg-gray-200 shadow-xl">
        <div class="card-body">
            <div class="border-l-8 border-primary px-4 py-4 my-2 bg-gray-500 w-fit shadow-md">
                <h1 class="text-xl text-slate-50 font-bold">Tambah Blog</h1>
            </div>
            <!-- Tambah Blog Form -->
            <form wire:submit.prevent="store">
                <!-- Judul Blog -->
                <div class="mb-2">
                    <label class="form-control">
                        <span class="label-text text-base-100 py-2">Judul</span>
                        <input type="text" wire:model="judul" placeholder="Masukkan judul blog"
                            class="input input-primary rounded-md bg-gray-100 text-base-100 @error('judul') border-red-500 @enderror"
                            autofocus />
                        @error('judul') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </label>
                </div>

                <!-- Konten Blog -->
                <div class="mb-2">
                    <label class="form-control">
                        <span class="label-text text-base-100 py-2">Konten</span>
                        <!-- Gunakan Trix Editor untuk konten -->
                        <trix-editor wire:model="konten" class="rounded-md bg-gray-100 text-base-100"></trix-editor>
                        @error('konten') <span class="error text-red-500">{{ $message }}</span> @enderror
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
