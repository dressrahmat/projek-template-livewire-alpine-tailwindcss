@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <div class="flex justify-between items-center">
            {{-- Description --}}
            <div class="text-sm text-gray-500">
                Menampilkan {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} dari {{ $paginator->total() }} hasil
            </div>

            {{-- Page Number Links --}}
            <ul class="flex items-center">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md select-none">
                        <span aria-hidden="true">&larr;</span>
                    </li>
                @else
                    <li>
                        <button wire:click="previousPage"
                                wire:loading.attr="disabled"
                                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="@lang('pagination.previous')">&larr;</button>
                    </li>
                @endif

                {{-- Page Number Links --}}
                @foreach ($elements as $element)
                    {{-- Array of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-500 bg-white border border-gray-300 cursor-default rounded-md select-none">{{ $page }}</li>
                            @elseif ($page == 1 || $page == $paginator->lastPage() || abs($page - $paginator->currentPage()) < 2)
                                <li>
                                    <button wire:click="gotoPage({{ $page }})"
                                            wire:loading.attr="disabled"
                                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">{{ $page }}</button>
                                </li>
                            @elseif (($page == $paginator->currentPage() - 2 && $page != 1) || ($page == $paginator->currentPage() + 2 && $page != $paginator->lastPage()))
                                <li class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default rounded-md select-none">...</li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <button wire:click="nextPage"
                                wire:loading.attr="disabled"
                                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="@lang('pagination.next')">&rarr;</button>
                    </li>
                @else
                    {{-- Page Number Links --}}
                    <li>
                        <button wire:click="gotoPage({{ $paginator->lastPage() }})"
                                wire:loading.attr="disabled"
                                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="@lang('pagination.last')">Halaman Terakhir</button>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
@endif
