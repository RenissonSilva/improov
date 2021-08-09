@if ($variavel->lastPage() > 1)
<ul class="pagination" id="{{ isset($idPagination)?$idPagination:'' }}" style="display:flex;justify-content:flex-end">
    <li class="{{ $classLi }} {{ $variavel->currentPage() == 1 ? ' disabled' : '' }}">
        <a class="{{ $classA }}" href="{{ $variavel->url(1) }}">Anterior</a>
    </li>
    @for ($i = 1; $i <= $variavel->lastPage(); $i++)
        <li class="{{ $classLi }} {{ $variavel->currentPage() == $i ? ' active' : '' }}">
            <a class="{{ $classA }}" href="{{ $variavel->url($i) }}">{{ $i }}</a>
        </li>
    @endfor
    <li class="{{ $classLi }} {{ $variavel->currentPage() == $variavel->lastPage() ? ' disabled' : '' }}">
        <a class="{{ $classA }}" href="{{ $variavel->url($variavel->currentPage() + 1) }}">Próximo</a>
    </li>
</ul>
@endif
