@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex py-5 justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <div class="relative inline-flex items-center text-gray-500"> </div>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center text-gray-500">
                <i class="fa-solid fa-arrow-left-long"></i>&nbsp;{!! __('vorher') !!}
            </a>
        @endif
        <div class="relative inline-flex items-center text-gray-500">{{$paginator->currentPage()}}</div>
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center text-gray-500">
                {!! __('weiter') !!}&nbsp;<i class="fa-solid fa-arrow-right-long"></i>
            </a>
        @else
            &nbsp; <div class="relative inline-flex items-center text-gray-500"> </div>
        @endif
    </nav>
@endif
