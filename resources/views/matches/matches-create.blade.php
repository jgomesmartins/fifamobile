@extends('layouts.app')

@section('content')
    <?php
    $idteamareq = 0;
    $idteambreq = 0;
    $idseasonreq = 0;
    $dateseason = '';
    ?>

    @if (Session::has('seasonsrequest'))
        <?php $seasonrea = session()->get('seasonsrequest');
        
        $dtarr = explode('-', $seasonrea['data_partida']);
        
        $idteamareq = $seasonrea['team_id_a'];
        $idteambreq = $seasonrea['team_id_b'];
        $idseasonreq = $seasonrea['season_id'];
        $dateseason = $dtarr[2] . '/' . $dtarr[1] . '/' . $dtarr[0];
        
        ?>
    @endif

    <script>
        $(function() {

            $("#dataSeason").datepicker({
                showOn: "button",
                buttonImage: "../img/icons8-calendário-24.png",
                buttonImageOnly: true,
                dateFormat: 'dd/mm/yy',
                closeText: "Fechar",
                prevText: "&#x3C;Anterior",
                nextText: "Próximo&#x3E;",
                currentText: "Hoje",
                monthNames: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto",
                    "Setembro", "Outubro", "Novembro", "Dezembro"
                ],
                monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out",
                    "Nov", "Dez"
                ],
                dayNames: ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira",
                    "Sexta-feira", "Sábado"
                ],
                dayNamesShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
                dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
                weekHeader: "Sm",
                firstDay: 1
            });

        });
    </script>

    <div class="card border-warning mb-3 col-10" style="margin: 0 auto; float: none;margin-bottom: 10px;">
        <div class="card-header"><b>Incluir resultado de partidas</b></div>
        <div class="card-body">
            <div class="container">
                <div class="row align-items-start">
                    <div class="col-md-8">
                        <form action="{{ route('adicionar_matches') }}" id="frmSeasonAdd" method="POST">
                            @csrf
                            <fieldset>
                                <legend>Informe o resultado da partida</legend>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label for="SelectSeason" class="form-label">Temporada</label>
                                            <select id="SelectSeason" name="SelectSeason" class="form-select">
                                                <option value={{ __('0') }}>{{ __('-- Selecione a temporada --') }}
                                                </option>
                                                <?php foreach ($seasons as $season) {?>
                                                <option <?php if ($idseasonreq == $season->id) {
                                                    echo 'selected';
                                                } ?> value={{ $season->id }}>{{ $season->name }}
                                                </option>
                                                <?php } ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Temporada é obrigatório.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label for="dataSeason" class="form-label">Data da partida</label>
                                            <input type="text" id="dataSeason" value="{{ $dateseason }}"
                                                name="dataSeason" class="form-control"
                                                placeholder="Informe a data no calendário" readonly>
                                            <div class="invalid-feedback">
                                                Data é obrigatório.
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label for="SelectTeamA" class="form-label">Time A</label>
                                            <select id="SelectTeamA" name="SelectTeamA" class="form-select">
                                                <option value={{ __('0') }}>{{ __('-- Selecione o time A --') }}
                                                </option>
                                                <?php foreach ($teams as $team) {?>
                                                <option <?php if ($idteamareq == $team->id) {
                                                    echo 'selected';
                                                } ?> value={{ $team->id }}> {{ $team->name }}
                                                </option>
                                                <?php } ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                TIme A é obrigatório.
                                            </div>
                                        </div>
                                        <div class="mb-1">
                                            <label for="golteam-a" class="form-label">Gols time A</label>
                                            <input type="number" name="golteam_a" id="golteam_a" class="form-control">
                                            <div class="invalid-feedback" id="qtdetimaa">
                                                Quantidade é obrigatório.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label for="SelectTeamB" class="form-label">Time B</label>
                                            <select id="SelectTeamB" name="SelectTeamB" class="form-select">
                                                <option value={{ __('0') }}>{{ __('-- Selecione o time B --') }}
                                                </option>
                                                <?php foreach ($teams as $team) {?>
                                                <option <?php if ($idteambreq == $team->id) {
                                                    echo 'selected';
                                                } ?> value={{ $team->id }}>{{ $team->name }}
                                                </option>
                                                <?php } ?>
                                            </select>
                                            <div class="invalid-feedback" id="msgerrtimeb">
                                                TIme B é obrigatório.
                                            </div>
                                        </div>
                                        <div class="mb-1">
                                            <label for="goltea-b" class="form-label">Gols time B</label>
                                            <input type="number" name="golteam_b" id="golteam_b" class="form-control">
                                            <div class="invalid-feedback" id="qtdetimab">
                                                Quantidade é obrigatório.
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" id="btnSaveSeason" class="btn btn-primary mt-2"><i
                                        class="fa fa-floppy-o fa-lg" aria-hidden="true"></i>Salvar</button>
                            </fieldset>
                        </form>

                        @if (Session::has('message'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert"><i
                                    class="fa fa-info fa-lg" aria-hidden="true"></i>{!! session()->get('message') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (Session::has('message_err'))
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert"><i
                                    class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i>{!! session()->get('message_err') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>

                    <div class="col">
                        @if (Session::has('resumorequest'))
                            <fieldset>
                                <legend>Resumo dos times</legend>
                                <table class="table bg-light table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Time</th>
                                            <th scope="col">Total Gols</th>
                                            <th scope="col">Qtd Vitória</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $loops = 0;
                                            $namelider = '';
                                            $qtWinneTMP = -1;
                                            $forloop = 0;
                                            $empate = false;
                                        @endphp
                                        @foreach (session()->get('resumorequest') as $resumorequest)
                                            @if ($forloop === 1)
                                                @if ($resumorequest->qtd_winner === $qtWinneTMP)
                                                    @php
                                                        $empate = true;
                                                    @endphp
                                                @endif
                                            @endif

                                            @if ($empate)
                                            @break
                                        @endif

                                        @php
                                            $forloop++;
                                        @endphp

                                        @php
                                            $qtWinneTMP = $resumorequest->qtd_winner;
                                            $namelider = $resumorequest->name_team;
                                        @endphp
                                    @endforeach

                                    @foreach (session()->get('resumorequest') as $resumorequest)
                                        <tr>
                                            <td class="text-center align-middle">
                                                {{ $resumorequest->name_team }}</td>
                                            <td class="text-center align-middle"> {{ $resumorequest->sum_gols }}</td>
                                            <td class="text-center align-middle"> {{ $resumorequest->qtd_winner }}
                                            </td>
                                            <td>
                                                @if ($loops === 0 && $resumorequest->qtd_winner > 0 && !$empate)
                                                    <img width="32" height="32" src="../img/trophy.png"
                                                        alt="lider">
                                                @endif
                                            </td>

                                        </tr>
                                        @php
                                            $loops++;
                                        @endphp
                                    @endforeach

                                </tbody>
                            </table>
                            <legend>Empates</legend>
                            <div class="bg-light w-auto h-50 p-3">
                                <h5 class="mt-2">{{ _('Total: ') }}
                                    @if (Session::has('totalempates'))
                                        {{ session()->get('totalempates')[0]->total_empates }}
                                </h5>
                    @endif

                </div>


                </fieldset>
                @endif
            </div>

        </div>
    </div>
    <hr />

    <table id='table-matches' class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Jogo</th>
                <th scope="col">Temporada</th>
                <th scope="col">Dt. Partida</th>
                <th scope="col">Time A</th>
                <th scope="col">Gols Time A</th>
                <th scope="col">Time B</th>
                <th scope="col">Gols Time B</th>
                <th scope="col">Usuário</th>
                <th scope="col">Excluir</th>
            </tr>
        </thead>
        <tbody>
            @if (Session::has('matches'))
                <?php foreach ( session()->get('matches' ) as $matche) { ?>
                <tr>
                    <td>{{ $matche->id }}</td>
                    <td>{{ $matche->name_season }}</td>
                    <td>{{ $matche->data_partida }}</td>
                    <td>{{ $matche->name_teama }}
                        @if ($matche->resultado_a > $matche->resultado_b)
                            <img width="16" height="16" src="../img/trophy.png" alt="lider">
                        @endif
                    </td>
                    <td class="text-center">{{ $matche->resultado_a }}</td>
                    <td>{{ $matche->name_teamb }}
                        @if ($matche->resultado_a < $matche->resultado_b)
                            <img width="16" height="16" src="../img/trophy.png" alt="lider">
                        @endif
                    </td>
                    <td class="text-center">{{ $matche->resultado_b }}</td>
                    <td>{{ $matche->name_user }}</td>
                    <td><a data-bs-toggle='modal' data-bs-target='#ModalDelete' href=""><i
                                class='fa fa-trash fa-lg' aria-hidden='true'></i></a></td>
                </tr>
                <?php } ?>
            @endif

        </tbody>
    </table>
</div>

<!-- Modal ModalDelete -->
<div class="modal fade" id="ModalDelete" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Excluir Resultado Selecionado?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('delete_matches') }}" method="POST">
                    @csrf

                    <div class="container">

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="idSeason" class="col-form-label">ID:</label>
                                    <input readonly type="text" class="form-control" name='idSeason'
                                        id="idSeason">
                                </div>

                                <div class="mb-3">
                                    <label for="idTeama" class="col-form-label">Time A</label>
                                    <input readonly type="text" class="form-control" name='idTeama'
                                        id="idTeama">
                                </div>

                                <div class="mb-3">
                                    <label for="GolTeama" class="col-form-label">Gols Time A</label>
                                    <input readonly type="text" class="form-control" name='GolTeama'
                                        id="GolTeama">
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="nameSeason" class="col-form-label">Temporada</label>
                                    <input readonly type="text" class="form-control" name='nameSeason'
                                        id="nameSeason">
                                </div>

                                <div class="mb-3">
                                    <label for="idTeamb" class="col-form-label">Time B</label>
                                    <input readonly type="text" class="form-control" name='idTeamb'
                                        id="idTeamb">
                                </div>

                                <div class="mb-3">
                                    <label for="GolTeamb" class="col-form-label">Gols Time B</label>
                                    <input readonly type="text" class="form-control" name='GolTeamb'
                                        id="GolTeamb">
                                </div>

                                <input readonly type="text" hidden class="form-control" name='DataSeason'
                                    id="DataSeason">


                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                                        class="fa fa-ban fa-lg" aria-hidden="true"></i>Cancelar</button>
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o fa-lg"
                                        aria-hidden="true"></i>Excluir</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

</div>
@endsection
