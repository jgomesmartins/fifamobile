<div class="container">
    <div class="row align-items-start">
        <div class="col">
            <form action="" class="">
                <fieldset>
                    <legend>{{ __('Partidas realizadas no dia') }}</legend>
                    <div class="row align-items-start mb-2">
                        <div class="col-md-6">
                            <label for="dtmatchesday" class="form-label">{{ __('Data') }}</label>
                            <input type="text" id="dtmatchesday" name="dtmatchesday" class="form-control"
                                placeholder="Informe a data no calendário" readonly>
                            <div class="invalid-feedback">
                                Data é obrigatório.
                            </div>
                        </div>
                    </div>
                    <button type="button" id="btnDashPartidaDay" class="btn btn-success"><i class="fa fa-list-ul fa-lg"
                            aria-hidden="true"></i>Listar</button>
                </fieldset>
            </form>
        </div>


        <div class="col" style="border-left: 1px solid rgb(180, 170, 170);">
            <form action="" class="">
                <fieldset>
                    <legend>{{ __('Resumo times') }}</legend>
                    <table id="table-matches-day-teams" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('Temporada') }}</th>
                                <th scope="col">{{ __('Time') }}</th>
                                <th scope="col">{{ __('Vitorias') }}</th>
                                <th scope="col">{{ __('Derrotas') }}</th>
                                <th scope="col">{{ __('Empates') }}</th>
                                <th scope="col">{{ __('Gols +') }}</th>
                                <th scope="col">{{ __('Gols -') }}</th>
                                <th scope="col">{{ __('Saldo Gols') }}</th>
                            </tr>
                        </thead>
                    </table>
                </fieldset>
            </form>
        </div>
    </div>
    <hr />

    <table id="table-matches-day" class="display" style="width:100%">
        <thead>
            <tr>
                <th scope="col">{{ __('Jogo') }}</th>
                <th scope="col">{{ __('Temporada') }}</th>
                <th scope="col">{{ __('Dt. Partida') }}</th>
                <th scope="col">{{ __('Time A') }}</th>
                <th scope="col">{{ __('Gols Time A') }}</th>
                <th scope="col">{{ __('Time B') }}</th>
                <th scope="col">{{ __('Gols Time B') }}</th>
                <th scope="col">{{ __('Usuário') }}</th>
            </tr>
        </thead>
    </table>

</div>
