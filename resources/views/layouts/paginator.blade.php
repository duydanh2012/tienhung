@php
    $pagination = $paginator->lastPage();
    $paginationCurrent = $paginator->currentPage();
    $sub = $pagination - $paginationCurrent;
@endphp

<nav class="app-pagination">
    @if ($pagination > 1)
        <ul class="pagination justify-content-center">
            <li class="page-item {{ ($paginationCurrent == 1) ? 'disabled' : NULL }}">
                <a class="page-link" href="{{ $paginator->url($paginationCurrent - 1) }}" tabindex="-1" aria-disabled="true">Previous</a>
            </li>

            @if ($pagination <= 5)
                @for ($i = 1; $i <= $pagination; $i++)
                    <li class="page-item {{ ($paginationCurrent == $i) ? 'active' : NULL }}"><a class="page-link" href="{{ $paginator->url($i) }}">{{ ($i < 10) ? '0' . $i : $i }}</a></li>
                @endfor
            @else
                @if ($paginationCurrent == 1)
                    @for ($i = 1; $i <= ($paginationCurrent + 4); $i++)
                        <li class="page-item {{ ($paginationCurrent == $i) ? 'active' : NULL }}"><a class="page-link" href="{{ $paginator->url($i) }}">{{ ($i < 10) ? '0' . $i : $i }}</a></li>
                    @endfor
                @elseif ($sub < 4)
                    @for ($i = ($paginationCurrent - 1); $i <= $pagination; $i++)
                        <li class="page-item {{ ($paginationCurrent == $i) ? 'active' : NULL }}"><a class="page-link" href="{{ $paginator->url($i) }}">{{ ($i < 10) ? '0' . $i : $i }}</a></li>
                    @endfor
                @else
                    @for ($i = ($paginationCurrent - 1); ($i <= ($paginationCurrent + 3) && $i <= $pagination); $i++)
                        <li class="page-item {{ ($paginationCurrent == $i) ? 'active' : NULL }}"><a class="page-link" href="{{ $paginator->url($i) }}">{{ ($i < 10) ? '0' . $i : $i }}</a></li>
                    @endfor
                @endif
            @endif

            <li class="page-item {{ ($paginationCurrent == $pagination) ? 'disabled' : NULL }}">
                <a class="page-link" href="{{ $paginator->url($paginationCurrent + 1) }}">Next</a>
            </li>
        </ul>
    @endif    
</nav>