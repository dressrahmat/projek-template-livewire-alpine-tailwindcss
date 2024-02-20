<div :class="{'w-20 pt-10': !isOpen, 'w-44 pt-20 ': isOpen}"
    class="bg-neutral text-white shadow z-30 transition-width duration-300 fixed inset-y-0">
    <!-- Sidebar Content -->
    <ul class="menu">
        <li class="py-2 text-base bg-transparent">
            <a href="#"="flex items-center px-4 py-2 my-1 text-gray-200 {{ request()->routeIs('#') ? 'bg-gray-700' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 002 2h2a1 1 0 002-2zm-3 4a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                </svg>
                <span class="ml-2" x-show="isOpen">Dashboard</span>
            </a>
        </li>
        <li class="py-2 text-base bg-transparent">
            <a href="#"
                class="flex items-center px-4 py-2 my-1 text-gray-200 {{ request()->routeIs('#') ? 'bg-gray-700' : '' }}">
                <i class="fa fa-solid fa-mosque"></i>
                <span class="ml-2" x-show="isOpen">Masjid</span>
            </a>
        </li>
        <li class="py-2 text-base bg-transparent">
            <details>
                <summary class="bg-transparent">
                    <i class="fa fa-solid fa-toolbox"></i>
                    <span class="ml-2" x-show="isOpen">Setting</span>
                </summary>
                <ul :class="{'ml-4 mt-2': isOpen, '-ml-2 mt-2': !isOpen}">
                    <li><a href="{{route('permission.index')}}"
                            class="flex items-center px-4 py-2 my-1 text-gray-200 {{ request()->routeIs('permission.index') ? 'bg-gray-700' : '' }}">
                            <i class="fas fa-file-contract"></i>
                            <span class="ml-2" x-show="isOpen">Permission</span>
                        </a>
                    </li>
                    <li><a href="{{route('role.index')}}"
                            class="flex items-center px-4 py-2 my-1 text-gray-200 {{ request()->routeIs('role.index') ? 'bg-gray-700' : '' }}">
                            <i class="fas fa-plus-circle"></i>
                            <span class="ml-2" x-show="isOpen">Role</span>
                        </a>
                    </li>
                    <li><a href="{{route('user.index')}}" class="flex items-center px-4 py-2 my-1 text-gray-200 {{ request()->routeIs('user.index') ? 'bg-gray-700' : '' }}">
                        <i class="fas fa-user"></i>
                        <span class="ml-2" x-show="isOpen">User</span>
                    </a>
                </li>
                </ul>
            </details>
        </li>
    </ul>
</div>
