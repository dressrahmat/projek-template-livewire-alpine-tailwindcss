<div class="mb-2">
    <form wire:submit.prevent="update" enctype="multipart/form-data" class="grid grid-cols-2 gap-4">
        <div class="card card-side bg-gray-200 shadow-xl">
            <div class="card-body">
                @if (session()->has('success'))
                <div x-data="{ showNotification: true }" x-show="showNotification"
                    x-init="setTimeout(() => showNotification = false, 5000)">
                    <!-- Notifikasi disini -->
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                </div>
                @endif

                @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
                @endif
                <div class="grid grid-cols-2 gap-x-2">
                    <!-- Nama Depan -->
                    <div class="mb-2">
                        <label class="form-control">
                            <span class="label-text text-base-100 mb-2">Nama Depan</span>
                            <input type="text" wire:model.defer="nama_depan" placeholder="Masukkan nama depan"
                                class="input input-bordered rounded-lg bg-gray-100 text-gray-900 input-accent @error('nama_depan') border-red-500 @enderror"
                                autofocus />
                            @error('nama_depan') <span class="error text-red-500">{{ $message }}</span> @enderror
                        </label>
                    </div>

                    <!-- Nama Belakang -->
                    <div class="mb-2">
                        <label class="form-control">
                            <span class="label-text text-base-100 mb-2">Nama Belakang</span>
                            <input type="text" wire:model.defer="nama_belakang" placeholder="Masukkan nama belakang"
                                class="input input-bordered rounded-lg bg-gray-100 text-gray-900 input-accent @error('nama_belakang') border-red-500 @enderror" />
                            @error('nama_belakang') <span class="error text-red-500">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-x-2">
                    <!-- Tanggal Lahir -->
                    <div class="mb-2">
                        <label class="form-control">
                            <span class="label-text text-base-100 mb-2">Tanggal Lahir</span>
                            <input type="date" wire:model.defer="tanggal_lahir"
                                class="input input-bordered rounded-lg bg-gray-100 text-gray-900 input-accent @error('tanggal_lahir') border-red-500 @enderror" />
                            @error('tanggal_lahir') <span class="error text-red-500">{{ $message }}</span> @enderror
                        </label>
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="mb-2">
                        <label class="form-control">
                            <span class="label-text text-base-100 mb-2">Nomor Telepon</span>
                            <input type="tel" wire:model.defer="nomor_telepon" placeholder="Masukkan nomor telepon"
                                class="input input-bordered rounded-lg bg-gray-100 text-gray-900 input-accent @error('nomor_telepon') border-red-500 @enderror" />
                            @error('nomor_telepon') <span class="error text-red-500">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>


                <div class="grid grid-cols-2 gap-x-2">
                    <!-- Status Pernikahan -->
                    <div class="mb-2">
                        <label class="form-control">
                            <span class="label-text text-base-100 mb-2">Status Pernikahan</span>
                            <select wire:model.defer="status_pernikahan" name="status_pernikahan" id="status_pernikahan"
                                class="select select-bordered rounded-lg bg-gray-100 text-gray-900 select-accent @error('status_pernikahan') border-red-500 @enderror">
                                <option value="">Pilih Status Pernikahan</option>
                                <option value="lajang">Lajang</option>
                                <option value="menikah">Menikah</option>
                                <option value="cerai">Cerai</option>
                            </select>
                            @error('status_pernikahan') <span class="error text-red-500">{{ $message }}</span> @enderror
                        </label>
                    </div>

                    <!-- Pendidikan Terakhir -->
                    <div class="mb-2">
                        <label class="form-control">
                            <span class="label-text text-base-100 mb-2">Pendidikan Terakhir</span>
                            <input type="text" wire:model.defer="pendidikan_terakhir"
                                placeholder="Masukkan pendidikan terakhir"
                                class="input input-bordered rounded-lg bg-gray-100 text-gray-900 input-accent @error('pendidikan_terakhir') border-red-500 @enderror" />
                            @error('pendidikan_terakhir') <span class="error text-red-500">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-x-2">
                    <!-- Jenis Kelamin -->
                    <div class="mb-2">
                        <label class="form-control">
                            <span class="label-text text-base-100 mb-2">Jenis Kelamin</span>
                            <select wire:model.defer="jenis_kelamin" name="jenis_kelamin" id="jenis_kelamin"
                                class="select select-bordered rounded-lg bg-gray-100 text-gray-900 select-accent @error('jenis_kelamin') border-red-500 @enderror">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="pria">Pria</option>
                                <option value="wanita">Wanita</option>
                            </select>
                            @error('jenis_kelamin') <span class="error text-red-500">{{ $message }}</span> @enderror
                        </label>
                    </div>

                    <!-- Agama -->
                    <div class="mb-2">
                        <label class="form-control">
                            <span class="label-text text-base-100 mb-2">Agama</span>
                            <select wire:model.defer="agama" name="agama" id="agama"
                                class="select select-bordered rounded-lg bg-gray-100 text-gray-900 select-accent @error('agama') border-red-500 @enderror">
                                <option value="">Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                            @error('agama') <span class="error text-red-500">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-x-2">
                    <!-- Provinsi -->
                    <div class="mb-2">
                        <label class="form-control">
                            <span class="label-text text-base-100 mb-2">Provinsi</span>
                            <select wire:model.defer="provinsi"
                                class="select select-bordered rounded-lg bg-gray-100 text-gray-900 select-accent @error('provinsi') border-red-500 @enderror">
                                <option value="">Pilih Provinsi</option>
                                <!-- Tambahkan opsi untuk provinsi -->
                            </select>
                            @error('provinsi') <span class="error text-red-500">{{ $message }}</span> @enderror
                        </label>
                    </div>

                    <!-- kota -->
                    <div class="mb-2">
                        <label class="form-control">
                            <span class="label-text text-base-100 mb-2">Kota</span>
                            <select wire:model.defer="kota"
                                class="select select-bordered rounded-lg bg-gray-100 text-gray-900 select-accent @error('kota') border-red-500 @enderror">
                                <option value="">Pilih Kota</option>
                                <!-- Tambahkan opsi untuk kota -->
                            </select>
                            @error('kota') <span class="error text-red-500">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="mb-2">
                    <label class="form-control">
                        <span class="label-text text-base-100 mb-2">Alamat</span>
                        <textarea wire:model.defer="alamat" placeholder="Masukkan alamat"
                            class="textarea textarea-bordered rounded-lg bg-gray-100 text-gray-900 textarea-accent @error('alamat') border-red-500 @enderror"></textarea>
                        @error('alamat') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </label>
                </div>

            </div>
        </div>

        <div class="card card-side bg-gray-200 shadow-xl">
            <div class="card-body">
                <!-- Upload photo_profile -->
                <div class="mb-2">
                    <label class="form-control">
                        <span class="label-text text-base-100 mb-2">Upload photo_profile</span>
                        <div class="mb-2 relative">
                            <label for="photo_profile" class="cursor-pointer flex items-center justify-center">
                                <!-- Background untuk gambar yang diunggah -->
                                <div class="shadow-lg w-1/2 h-56 rounded-lg flex items-center justify-center bg-cover bg-center"
                                    style="background-image: url('{{ $photo_profile instanceof \Livewire\TemporaryUploadedFile ? $photo_profile->temporaryUrl() : (isset($profile) && $profile->photo_profile ? asset($profile->photo_profile) : asset('assets/images/input-photo.png')) }}');">
                                    <!-- Icon untuk memilih gambar -->
                                    @if (!$photo_profile)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    @endif
                                </div>
                            </label>
                            <!-- Input file yang disembunyikan -->
                            <input type="file" id="photo_profile" wire:model="photo_profile" accept="image/*"
                                class="file-input hidden">
                        </div>
                    </label>
                </div>
                
                
                <!-- Bio -->
                <div class="mb-2">
                    <label class="form-control">
                        <span class="label-text text-base-100 mb-2">Bio</span>
                        <textarea wire:model.defer="bio" placeholder="Masukkan bio"
                            class="textarea textarea-bordered rounded-lg bg-gray-100 text-gray-900 textarea-accent @error('bio') border-red-500 @enderror"></textarea>
                        @error('bio') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </label>
                </div>
                

                <!-- Amanah -->
                <div class="mb-2">
                    <label class="form-control">
                        <span class="label-text text-base-100 mb-2">Amanah</span>
                        <input type="text" rows="4" wire:model.defer="amanah" placeholder="Masukkan amanah"
                            class="input input-bordered rounded-lg bg-gray-100 text-gray-900 input-accent @error('amanah') border-red-500 @enderror" />
                        @error('amanah') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary w-full text-lg">Daftar</button>
                </div>
            </div>
        </div>
    </form>
</div>
