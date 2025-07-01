<div class="paginacion-container" id="paginacion">
    @if ($usuarios->onFirstPage())
        <span class="paginacion-btn paginacion-disabled"><i class="fa-solid fa-arrow-left"></i></span>
    @else
        <a href="{{ $usuarios->previousPageUrl() }}" class="paginacion-btn paginacion-active"><i class="fa-solid fa-arrow-left"></i></a>
    @endif

    @for ($i = 1; $i <= $usuarios->lastPage(); $i++)
        @if ($i == $usuarios->currentPage())
            <span class="paginacion-btn paginacion-current">{{ $i }}</span>
        @else
            <a href="{{ $usuarios->url($i) }}" class="paginacion-btn paginacion-number">{{ $i }}</a>
        @endif
    @endfor

    @if ($usuarios->hasMorePages())
        <a href="{{ $usuarios->nextPageUrl() }}" class="paginacion-btn paginacion-active"><i class="fa-solid fa-arrow-right"></i></a>
    @else
        <span class="paginacion-btn paginacion-disabled"><i class="fa-solid fa-arrow-right"></i></span>
    @endif
</div>
