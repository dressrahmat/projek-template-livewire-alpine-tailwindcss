<div class="text-base-content z-40">
    <div class="bg-neutral flex justify-between items-center p-1 fixed inset-x-0">
        <!-- Logo -->
        <div class="flex items-center">
            <div :class="{'text-2xl': isOpen, 'hidden': !isOpen}" class=" w-1/2 text-base-content px-6 my-2">
                <p class="text-center">Simple Projek</p>
            </div>
            <button @click="isOpen = !isOpen" class="p-2 ml-3">
                <!-- Toggle -->
                <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16M4 12h16" />
                </svg>
                <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 8h5M15 8h5M4 16h16M4 12h16" />
                </svg>
            </button>
        </div>

        <!-- Navbar -->
        <div :class="{'w-10/12': isOpen, 'w-11/12': !isOpen}" class="flex justify-between transition-all duration-500">
            <p class="font-bold">Simple Projek
                <span class="font-normal block">Jadikan sistem manajemen instansi anda menjadi lebih optimal dan efisien
                    dengan Simple Projek</span>
            </p>

            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        @if (auth()->user()->profile)
                        <img alt="Tailwind CSS Navbar component"
                            src="{{asset(auth()->user()->profile->photo_profile)}}" />
                        @else
                        <img alt="Tailwind CSS Navbar component"
                            src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                        @endif
                    </div>
                </div>
                <ul tabindex="0"
                    class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                    <li>
                        <a href="{{route('akun.edit')}}" class="justify-between">
                            Akun
                        </a>
                    </li>
                    <li>
                        <a href="{{route('profile.edit', auth()->user()->id)}}" class="justify-between">
                            Profile
                        </a>
                    </li>
                    <li>
                        <!-- Logout Button -->
                        <form action="{{ route('logout') }}" method="POST" class="mr-4">
                            @csrf
                            <button type="submit"
                                >Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
