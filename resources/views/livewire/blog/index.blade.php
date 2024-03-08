<div class="flex flex-col xl:flex-row gap-2 text-base-100">
    <!-- Content -->
    <div class="card bg-gray-200 card-side basis-2/3 shadow-xl overflow-auto">
        <div class="card-body">
            <!-- Form -->
            <!-- Content -->
            <div class="flex justify-between items-center mx-4 gap-x-9">
                <!-- Dropdown -->
                <div class="border-l-8 border-primary px-4 py-4 my-2 bg-gray-500 w-fit shadow-md">
                    <h1 class="text-xl text-slate-50 font-bold">Data Blog</h1>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <!-- Select -->
                    <div class="flex justify-end gap-y-1">
                        <div class="self-end">
                            <select wire:model="perPage" wire:change="$refresh" class="select select-primary w-full rounded-md bg-gray-100">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                    </div>
                    <!-- Search Input -->
                    <div class="flex flex-col gap-y-1">
                        <div class="relative">
                            <input type="text" wire:model.debounce.50ms="search" wire:keydown.enter="refreshSearch" class="input input-primary bg-gray-100 border border-gray-300 px-3 py-1 mt-2 rounded-md" placeholder="Cari...">
                            <i class="fas fa-search text-lg my-1  absolute top-1/2 transform -translate-y-1/2 right-4 rounded-sm"></i>
                        </div>
                        <!-- Role Select -->
                        {{-- <div>
                            <select class="select select-primary w-full rounded-md bg-gray-100" wire:model="selectedRole" wire:change="refreshSearch">
                                <option value="">Pilih Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>                                    
                                @endforeach
                            </select>
                        </div> --}}
                    </div>
                </div>
            </div>
            <!-- Table -->
            <table class="table text-base">
                <!-- Head -->
                <thead class="text-base text-base-100">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data -->
                    @if ($data->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center">Data tidak ditemukan.</td>
                        </tr>
                    @else
                    @foreach ($data as $blog)
                    <tr>
                        <td>{{ $data->firstItem() + $loop->index }}</td>
                        <td>{{ $blog->judul }}</td>
                        <td>{{ $blog->user->name }}</td>
                        <td>{{ $blog->created_at }}</td>
                        <td>
                            <!-- Dropdown -->
                            <div class="dropdown">
                                <div tabindex="0" role="button" class="btn btn-xs rounded-md btn-neutral m-1"><i
                                        class="fas fa-eye"></i></div>
                                <ul tabindex="0"
                                    class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-fit">
                                    <li class="my-1">
                                        <a href="{{ route('profile.edit', $blog->id) }}"
                                            class="btn btn-xs rounded-md btn-success">
                                            <i class="far fa-id-card text-base"></i>
                                        </a>
                                    </li>
                                    <li class="my-1">
                                        <a wire:click.prevent="updateAksiId({{ $blog->id }})"
                                            wire:key="{{ $blog->id }}"
                                            class="btn btn-xs rounded-md btn-primary">
                                            <i class="fas fa-edit text-base"></i>
                                        </a>
                                    </li>

                                    <li class="my-1">
                                        <button class="btn btn-xs rounded-md bg-red-900" wire:key="{{ $blog->id }}" wire:click="$dispatch('openModal', { component: 'blog.delete', arguments: { blog: {{ $blog->id }} }})">
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
            <!-- Pagination -->
            <div class="my-5">
                {{ $data->links('livewire.pagination-custom', ['paginatorName' => 'blog_']) }}
            </div>
        </div>
    </div>
    <!-- Sidebar -->
    <div class="basis-1/3">
        @if ($update)
        @include('livewire.blog.edit')
        @else
        @include('livewire.blog.create')
        @endif
    </div>
</div>
