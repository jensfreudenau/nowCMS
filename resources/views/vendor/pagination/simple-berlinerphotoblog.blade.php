@if ($paginator->hasPages())
    <div class="border-t-1 border-t-gray-400 text-sm text-black">
    <nav role="navigation" aria-label="Pagination Navigation" class="flex py-1 justify-between  ">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <div class="relative inline-flex items-center "> </div>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center dark:text-nord-9">
                 </i>&nbsp;{!! __('previous') !!}
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center dark:text-nord-9">
                {!! __('next') !!}&nbsp;
            </a>
        @else
            &nbsp; <div class="relative inline-flex items-center"> </div>
        @endif
    </nav>
    </div>
@endif
