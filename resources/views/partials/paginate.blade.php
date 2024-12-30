<div class="pagination">
    @if ($data->onFirstPage())
        <span class="disabled"><</span>
    @else
        <a href="{{ $data->previousPageUrl() }}"><</a>
    @endif

    @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
        @if ($page == $data->currentPage())
            <span class="active">{{ $page }}</span>
        @else
            <a href="{{ $url }}">{{ $page }}</a>
        @endif
    @endforeach

    @if ($data->hasMorePages())
        <a href="{{ $data->nextPageUrl() }}">></a>
    @else
        <span class="disabled">></span>
    @endif
</div>