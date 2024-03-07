<div class="card mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
    <div class="card-body text-base-100">
        <h3 class="text-lg leading-6 font-medium">
            Hapus {{ $user->name }}
        </h3>
        <div class="mt-2">
            <p class="text-sm text-gray-500">
                Apakah anda yakin untuk menghapus data ini ?
            </p>
        </div>
        <div class="mt-4 flex justify-center">
            <button wire:click="delete" class="mx-2 px-4 py-2 bg-red-500 text-white font-semibold rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">Ya</button>
            <button wire:click="closeModal" class="mx-2 px-4 py-2 bg-gray-300 text-gray-700 font-semibold rounded-md hover:bg-gray-400 focus:outline-none focus:bg-gray-400">Tidak</button>
        </div>
    </div>
</div>
