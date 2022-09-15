@php
use App\Models\Season;
@endphp
<div class="container">
    <div class="row align-items-start">
        <div class="col-md-6">
            <form action="" class="">
                <fieldset>
                    <legend>{{ __('Partidas realizadas') }}</legend>
                    <div class="row align-items-start mb-2">
                        <div class="col">
                            <label for="idseasons" class="form-label">{{ __('Temporada') }}</label>
                            <select id="idseasons" class="form-select">
                                <option value="0"> {{ __('--Seleciona a temporada --') }}</option>
                                @foreach (Season::all() as $item)
                                    <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label for="dtmatches" class="form-label">{{ __('Temporada') }}</label>
                            <input type="text" id="dtmatches" name="dtmatches" class="form-control"
                                placeholder="Informe a data no calendário" readonly>
                            <div class="invalid-feedback">
                                Data é obrigatório.
                            </div>
                        </div>
                    </div>

                    <button type="button" id="btnDashPartidaRealizada" class="btn btn-primary"><i
                            class="fa fa-list-ul fa-lg" aria-hidden="true"></i>Listar</button>
                </fieldset>

            </form>
        </div>
        <div id="msgErro"></div>
    </div>
    <hr />

    <table id="table-matches" class="display" style="width:100%">
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
                <th scope="col">{{ __('Excluir') }}</th>
            </tr>
        </thead>
    </table>

</div>


<!-- Modal ModalDelete -->
<div class="modal fade" id="ModalDelete" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">{{ 'Excluir Resultado Selecionado?' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form>
                    @csrf

                    <div class="container">

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="idSeason" class="col-form-label">ID:</label>
                                    <input readonly type="text" class="form-control" name='idSeason' id="idSeason">
                                </div>

                                <div class="mb-3">
                                    <label for="idTeama" class="col-form-label">Time A</label>
                                    <input readonly type="text" class="form-control" name='idTeama' id="idTeama">
                                </div>

                                <div class="mb-3">
                                    <label for="GolTeama" class="col-form-label">Gols Time A</label>
                                    <input readonly type="text" class="form-control" name='GolTeama' id="GolTeama">
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
                                    <input readonly type="text" class="form-control" name='idTeamb' id="idTeamb">
                                </div>

                                <div class="mb-3">
                                    <label for="GolTeamb" class="col-form-label">Gols Time B</label>
                                    <input readonly type="text" class="form-control" name='GolTeamb' id="GolTeamb">
                                </div>

                                <input readonly type="text" hidden class="form-control" name='DataSeason'
                                    id="DataSeason">

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                                        class="fa fa-ban fa-lg" aria-hidden="true"></i>Cancelar</button>
                                <button type="button" id="btn-delete-dash" data-bs-dismiss="modal"
                                    class="btn btn-danger"><i class="fa fa-trash-o fa-lg"
                                        aria-hidden="true"></i>Excluir</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
