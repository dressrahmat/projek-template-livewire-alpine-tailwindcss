@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="flex justify-between">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md select-none">
                    <span aria-hidden="true">&larr;</span>
                </li>
            @else
                <li>
                    <button wire:click="gotoPage({{ $paginator->currentPage() - 1 }})"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" rel="prev" aria-label="@lang('pagination.previous')">&larr;</button>
                </li>
            @endif

            {{-- Page Number Links --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default rounded-md select-none">{{ $element }}</li>
                @endif

                {{-- Array of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($paginator->currentPage() <= 2 || $paginator->lastPage() - $paginator->currentPage() <= 1 || abs($paginator->currentPage() - $page) < 2)
                            @if ($page == $paginator->currentPage())
                                <li class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-500 bg-white border border-gray-300 cursor-default rounded-md select-none">{{ $page }}</li>
                            @else
                                <li>
                                    <button wire:click="gotoPage({{ $page }})"
                                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">{{ $page }}</button>
                                </li>
                            @endif
                        @elseif ($paginator->currentPage() > 2 && $loop->first)
                            <li class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default rounded-md select-none">...</li>
                        @elseif ($paginator->lastPage() - $paginator->currentPage() > 1 && $loop->last)
                            <li class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default rounded-md select-none">...</li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <button wire:click="gotoPage({{ $paginator->currentPage() + 1 }})"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" rel="next" aria-label="@lang('pagination.next')">&rarr;</button>
                </li>
            @else
                <li class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md select-none">
                    <span aria-hidden="true">&rarr;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
