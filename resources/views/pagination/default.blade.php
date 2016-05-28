@if ($paginator->lastPage() > 1)
    <ul class="pagination">
        <?php
            $pagination = generatePaginationSequence($paginator->currentPage(), $paginator->lastPage());
        ?>
        <li>
            @if($paginator->currentPage() > 1)
                 <a href="{{ $paginator->url($paginator->currentPage() -1) }}"><i class="align-icon material-icons">chevron_left</i></a>
            @else
                <i class="align-icon material-icons">chevron_left</i>
            @endif
        </li>
        @foreach($pagination as $paginationitem)
            <li>
                @if("[" . $paginator->currentPage() . "]" !== $paginationitem)
                    <a class="no-linkstyle" href="{{ $paginator->url($paginationitem) }}">{{ $paginationitem }}</a>
                @else
                    {{ $paginationitem }}
                @endif
            </li>
        @endforeach
       <li>
            @if($paginator->currentPage() < $paginator->lastPage())
                 <a href="{{ $paginator->url($paginator->currentPage() +1) }}"><i class="align-icon material-icons">chevron_right</i></a>
            @else
                <i class="align-icon material-icons">chevron_right</i>
            @endif
        </li>
    </ul>
@endif