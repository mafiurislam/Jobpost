@if ($paginator->hasPages())
<nav aria-label="Page navigation" class="custom-pagination-nav d-flex flex-column align-items-center w-100">
    <!-- Results Counter Badge -->
    <div class="pagination-info mb-3 text-secondary small fw-semibold bg-white px-3 py-1 rounded-pill border shadow-sm">
        Showing <span class="fw-bold text-dark">{{ $paginator->firstItem() }}</span> to <span class="fw-bold text-dark">{{ $paginator->lastItem() }}</span> of <span class="fw-bold text-dark">{{ $paginator->total() }}</span> results
    </div>

    <!-- Pagination Pill Buttons -->
    <ul class="pagination pagination-custom gap-2 mb-0 flex-wrap justify-content-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">
                    <i class="fas fa-chevron-left me-1"></i> <span class="d-none d-sm-inline">Prev</span>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="fas fa-chevron-left me-1"></i> <span class="d-none d-sm-inline">Prev</span>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link active">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    <span class="d-none d-sm-inline me-1">Next</span> <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">
                    <span class="d-none d-sm-inline me-1">Next</span> <i class="fas fa-chevron-right"></i>
                </span>
            </li>
        @endif
    </ul>
</nav>
@endif
