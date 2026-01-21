@if ($paginator->hasPages())
<ul class="pagination">
    {{-- Prev --}}
    @if ($paginator->onFirstPage())
    <li class="page-item disabled"><span class="page-link">&lt;</span></li>
    @else
    <li class="page-item">
        <a class="page-link"
            href="{{ $paginator->appends(request()->query())->previousPageUrl() }}"
            rel="prev">&lt;</a>
    </li>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
    @if (is_string($element))
    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
    @endif

    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
    @else
    <li class="page-item">
        <a class="page-link"
            href="{{ $paginator->appends(request()->query())->url($page) }}">
            {{ $page }}
        </a>
    </li>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
    <li class="page-item">
        <a class="page-link"
            href="{{ $paginator->appends(request()->query())->nextPageUrl() }}"
            rel="next">&gt;</a>
    </li>
    @else
    <li class="page-item disabled"><span class="page-link">&gt;</span></li>
    @endif
</ul>
@endif