@php
    $pagination = $paginator->lastPage();
    $paginationCurrent = $paginator->currentPage();
    $sub = $pagination - $paginationCurrent;
@endphp

@if ($pagination > 1)
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-template d-flex justify-content-center">
            <li class="page-item {{ ($paginationCurrent == 1) ? 'disabled' : NULL }}">
                <a href="{{ $paginator->url($paginationCurrent - 1) }}" class="page-link"> <i class="fas fa-angle-left"></i>></a>
            </li>

            @if ($pagination <= 3)
                @for ($i = 1; $i <= $pagination; $i++)
                    <li class="page-item">
                        <a href="{{ $paginator->url($i) }}" class="page-link {{ ($paginationCurrent == $i) ? 'active' : NULL }}">{{ $i }}</a>
                    </li>
                @endfor
            @else
                @if ($paginationCurrent == 1)
                    @for ($i = 1; $i <= ($paginationCurrent + 4); $i++)
                        <li class="page-item">
                            <a href="{{ $paginator->url($i) }}" class="page-link {{ ($paginationCurrent == $i) ? 'active' : NULL }}">{{ $i }}</a>
                        </li>
                    @endfor
                @elseif ($sub < 4)      
                    @for ($i = ($paginationCurrent - 1); $i <= $pagination; $i++)
                        <li class="page-item">
                            <a href="{{ $paginator->url($i) }}" class="page-link {{ ($paginationCurrent == $i) ? 'active' : NULL }}">{{ $i }}</a>
                        </li>
                    @endfor
                @else
                    @for ($i = ($paginationCurrent - 1); ($i <= ($paginationCurrent + 3) && $i <= $pagination); $i++)
                        <li class="page-item">
                            <a href="{{ $paginator->url($i) }}" class="page-link {{ ($paginationCurrent == $i) ? 'active' : NULL }}">{{ $i }}</a>
                        </li>
                    @endfor
                @endif    
            @endif

            <li class="page-item {{ ($paginationCurrent == $pagination) ? 'disabled' : NULL }}"><a href="{{ $paginator->url($paginationCurrent + 1) }}" class="page-link"> <i class="fas fa-angle-right"></i></a></li>
        </ul>
    </nav>
@endif
