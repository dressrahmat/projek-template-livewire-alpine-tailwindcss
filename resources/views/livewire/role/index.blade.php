<div>
    <div class="flex gap-x-2 text-base-100">
        <div class="card card-side shadow-xl">
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
                <div class="flex justify-between items-center mx-4 gap-x-9">
                    <div class="border-l-8 border-accent px-4 py-4 my-2 bg-gray-100 shadow-md">
                        <h1 class="text-xl font-bold">Data Role</h1>
                    </div>
                    <div>
                        <input type="text" wire:model.debounce.50ms="search" wire:keyup="refreshSearch"
                            class="border border-gray-300 px-3 py-1 mt-2 rounded-md" placeholder="Cari...">
                    </div>
                </div>
                <table class="table text-base">
                    <!-- head -->
                    <thead class="text-lg text-base-100">
                        <tr>
                            <th>No</th>
                            <th>Role</th>
                            <th>Jumlah User</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->users->count() }}</td>
                            <td>
                                <a wire:click.prevent="show({{ $role->id }})" class="btn btn-xs btn-primary">Lihat Detail
                                </a>
                                <a wire:key="{{ $role->id }}" wire:click.prevent="updateAksiId({{ $role->id }})" class="btn btn-xs btn-success">Edit
                                </a>
                                <a class="btn btn-xs bg-red-300" type="button" wire:click.defer="delete({{ $role->id }})"
                                    wire:confirm="Are you sure you want to delete this post? {{ $role->id }}"
                                    wire:key="{{ $role->id }}">
                                    Delete post
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-5 w-1/2">
                    {{ $data->links('livewire.pagination-custom', ['paginatorName' => 'role_' . $id]) }}
                </div>
            </div>
        </div>
        <div>
            @if ($update)
            @include('livewire.role.edit')
            @else
            @include('livewire.role.create')
            @endif
        </div>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('refreshPage', function () {
            Livewire.emit('refresh');
        });
    });
</script>
@endpush