@if ($paginator->hasPages())
    <nav class="d-flex justify-content-between align-items-center bg-white rounded p-3 mt-4">
        <div class="d-none d-sm-block">
            <p class="text-muted mb-0">
                عرض
                <span class="fw-bold">{{ $paginator->firstItem() }}</span>
                إلى
                <span class="fw-bold">{{ $paginator->lastItem() }}</span>
                من أصل
                <span class="fw-bold">{{ $paginator->total() }}</span>
                سجل
            </p>
        </div>

        <ul class="pagination mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link border-0 bg-light" aria-hidden="true">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link border-0" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link border-0 bg-light">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link border-0">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link border-0" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link border-0" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link border-0 bg-light" aria-hidden="true">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
