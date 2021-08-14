<tbody id="tbody-mission-concluida">
    @if ($missoesConcluidas->isEmpty())
        <b class="text-center my-5 grey-text h4" id="nenhuma-mission-criada">Nenhuma missão concluída</b>
    @endif
    @foreach ($missoesConcluidas as $missaoConcluida)
        @if ($missaoConcluida->level_mission == null || $missaoConcluida->level_mission == Auth::user()->level)
            <tr id="tr-{{ $missaoConcluida->id }}">
                <th style="padding:9px 20px !important">
                    <span id="mission_name-{{ $missaoConcluida->id }}"
                        class="mission_name">
                        <div data-tooltip="{{ $missaoConcluida->criador == null ? "Missão do sistema" : "Missão criada pelo usuário" }}"
                            data-position="top" data-html="true" class="waves-effect waves-light tooltipped">
                            @if($missaoConcluida->criador == null)
                                {{-- <i class="fa fa-cog fa-xs tooltiped" style="margin-right:8px"></i> --}}
                                <span class="badge" style="background-color:#8B64EC; color:white; margin-right:3px" > Nível {{ $missaoConcluida->level_mission }}</span>
                            @else
                                <i class="fa fa-user-circle fa-xs tooltiped" style="margin-right:8px"></i>
                            @endif
                        </div>

                        {{ $missaoConcluida->name }}
                    </span>
                </th>
                <th class="right-align" style="font-size: 14px;color:#565656">Data de conclusão: {{ \Carbon\Carbon::parse($missaoConcluida->updated_at)->format('d/m/Y H:i') }}</th>
            </tr>
        @endif
    @endforeach
</tbody>
