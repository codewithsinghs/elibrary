<div class="pagination-down">
    <div class="d-flex align-items-center justify-content-between flex-wrap">
        <h4 class="sm-mb-0 mb-3">
            Showing <span>{{ $paginator->firstItem() }}-{{ $paginator->lastItem() }}</span> from
            <span>{{ $paginator->total() }}</span> data
        </h4>
        <ul>
            @if ($paginator->onFirstPage())
                <li><a href="javascript:void(0);"><i class="fas fa-chevron-left"></i></a></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a></li>
            @endif

            @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                <li><a href="{{ $url }}" class="{{ $page == $paginator->currentPage() ? 'active' : '' }}">{{ $page }}</a></li>
            @endforeach

            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a></li>
            @else
                <li><a href="javascript:void(0);"><i class="fas fa-chevron-right"></i></a></li>
            @endif
        </ul>
    </div>
</div>