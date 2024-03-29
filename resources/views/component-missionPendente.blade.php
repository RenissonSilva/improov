<tbody id="tbody-mission-pendente">
    @if ($my_missions->isEmpty())
        <b class="text-center my-5 grey-text h4">Nenhuma missão criada</b>
    @endif
    @foreach ($my_missions as $mission)
        @if ($mission->level_mission == null || $mission->level_mission == Auth::user()->level)
            <tr id="tr-{{ $mission->id }}">
                <th class="row nm th-switch valign-wrapper">
                    <div class="switch">
                        @if($mission->criador != null)
                        <label>
                            <input id="{{ $mission->id }}" class="toggle-mission" data-tipo="criada"
                                    {{ $mission->is_activeMission == "S" ? 'checked' : '' }} type="checkbox">
                            <span class="lever"></span>
                        </label>
                        @else
                            <span class="badge" style="background-color:#8B64EC; color:white; margin-right:3px" > Nível {{ $mission->level_mission }}</span>
                        @endif
                    </div>
                    <span id="mission_name-{{ $mission->id }}"
                        class="mission_name">{{ $mission->name }}</span>
                    <input type="hidden" id="repeat_mission-{{ $mission->id }}"
                        value="{{ $mission->repeat_mission ?? null }}">
                </th>
                <th class="right-align">
                    @if ($mission->points == null)
                        {{-- @if ($mission->completed == 0) --}}
                        <input type="hidden" id="enable_repeat_mission"
                        value="{{ $mission->is_activeMission != "S" ? 'disabled' : '' }}"


                            >
                        <button class="btn-floating btn mr-2 newpgreen tooltipped"
                            data-position="top" data-html="true" data-tooltip="Concluir missão"
                            onclick="missaoConcluida({{ $mission->id }})"
                            id="m{{ $mission->id }}"
                                {{ $mission->is_activeMission != "S" ? 'disabled' : '' }}><i class="material-icons">check</i>
                        </button>
                        {{-- @endif --}}
                        <button class="btn-floating btn modal-trigger mr-2 newpurple tooltipped"
                            data-position="top" data-html="true" data-tooltip="Editar"
                            onclick="modalEditMission(this)" href="#modal-edit-mission"
                            id="{{ $mission->id }}" data-name="{{ $mission->name }}"><i
                                class="material-icons">edit</i>
                        </button>
                        <button class="btn-floating btn newred modal-trigger tooltipped"
                            data-position="top" data-html="true" data-tooltip="Excluir"
                            data-id="{{ $mission->id }}" onclick="modalRemoveMission(this)"
                            href="#modal-delete-mission" id="{{ $mission->idMissionUser }}">
                            <i class="material-icons">delete</i>
                        </button>
                    @endif
                </th>
            </tr>
        @endif
    @endforeach
</tbody>
