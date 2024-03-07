<div >
    <div class="flex flex-col xl:flex-row gap-2 text-base-100">
        <div class="card bg-gray-200 card-side basis-2/3 shadow-xl overflow-auto">
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
                    <div class="border-l-8 border-primary px-4 py-4 my-2 bg-gray-500 w-fit shadow-md">
                        <h1 class="text-xl text-slate-50 font-bold">Data User</h1>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex justify-end gap-y-1">
                            <div class="self-end">
                                <select wire:model="perPage" class="select select-primary w-full rounded-md bg-gray-100" wire:change="refreshSearch">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-col gap-y-1">
                            <div class="relative">
                                <input type="text" wire:model.debounce.50ms="search" wire:keyup="refreshSearch"
                                    class="input input-primary bg-gray-100 border border-gray-300 px-3 py-1 mt-2 rounded-md" placeholder="Cari...">
                                    <i class="fas fa-search text-lg my-1  absolute top-1/2 transform -translate-y-1/2 right-4 rounded-sm"></i>
                            </div>
                            <div>
                                <select class="select select-primary w-full rounded-md bg-gray-100" wire:model="selectedRole" wire:change="refreshSearch">
                                    <option value="">Pilih Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>                                    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table text-base">
                    <!-- head -->
                    <thead class="text-base text-base-100">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                        @else
                        @foreach ($data as $user)
                        <tr>
                            <td>{{ $data->firstItem() + $loop->index }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ implode(', ', $user->getRoleNames()->toArray()) }}</td>
                            <td>
                                <div class="dropdown">
                                    <div tabindex="0" role="button" class="btn btn-xs rounded-md btn-neutral m-1"><i
                                            class="fas fa-eye"></i></div>
                                    <ul tabindex="0"
                                        class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-fit">
                                        <li class="my-1">
                                            <a href="{{ route('profile.edit', $user->id) }}"
                                                class="btn btn-xs rounded-md btn-success">
                                                <i class="far fa-id-card text-base"></i>
                                            </a>
                                        </li>
                                        <li class="my-1">
                                            <a wire:click.prevent="updateAksiId({{ $user->id }})"
                                                wire:key="{{ $user->id }}"
                                                class="btn btn-xs rounded-md btn-primary">
                                                <i class="fas fa-edit text-base"></i>
                                            </a>
                                        </li>

                                        <li class="my-1">
                                            <button class="btn btn-xs rounded-md bg-red-900" wire:key="{{ $user->id }}" wire:click="$dispatch('openModal', { component: 'user.delete', arguments: { user: {{ $user->id }} }})">
                                                <i class="fas fa-trash-alt text-base"></i>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="my-5">
                    {{ $data->links('livewire.pagination-custom', ['paginatorName' => 'user_' . $id]) }}
                </div>
            </div>
        </div>
        <div class="basis-1/3">
            @if ($update)
            @include('livewire.user.edit')
            @else
            @include('livewire.user.create')
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