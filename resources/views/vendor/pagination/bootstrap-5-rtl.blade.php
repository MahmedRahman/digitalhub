@if ($paginator->hasPages())
    <nav dir="rtl" aria-label="صفحات التنقل">
        <ul class="pagination justify-content-center align-items-center my-3">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link rounded-circle mx-1" aria-hidden="true">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link rounded-circle mx-1 hover-primary" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link bg-primary border-primary rounded-circle mx-1">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link text-dark rounded-circle mx-1 hover-primary" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link rounded-circle mx-1 hover-primary" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link rounded-circle mx-1" aria-hidden="true">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                </li>
            @endif
        </ul>

        <div class="d-flex justify-content-center align-items-center mt-2">
            <p class="text-muted small mb-0">
                {!! __('Showing') !!}
                <span class="fw-bold">{{ $paginator->firstItem() }}</span>
                {!! __('to') !!}
                <span class="fw-bold">{{ $paginator->lastItem() }}</span>
                {!! __('of') !!}
                <span class="fw-bold">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>
        </div>
    </nav>

    <style>
        .page-link {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            transition: all 0.2s ease;
        }
        .page-link:hover {
            background-color: var(--bs-primary);
            color: white !important;
        }
        .hover-primary:hover {
            background-color: var(--bs-primary) !important;
            color: white !important;
        }
    </style>
@endif
