<tr class="{{ isset($classes) ? $classes :'' }}">
    @foreach($nomeColunas as $k => $v)
        <th style="width: {{$tamanhoColunas[$k]}}">{{$v}}</th>
    @endforeach
</tr>
