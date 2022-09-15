@php
use App\Models\Season;
@endphp

<div class="container">
    <div class="row align-items-start">
        <div class="col">
            <form action="" class="">
                <fieldset>
                    <legend>{{ __('Resumo temporadas') }}</legend>
                    <div class="row align-items-start mb-2">
                        <div class="col-md-3">
                            <label for="idseasonsdash" class="form-label">{{ __('Temporada') }}</label>
                            <select id="idseasonsdash" class="form-select">
                                <option value="0"> {{ __('--Seleciona a temporada --') }}</option>
                                @foreach (Season::all() as $item)
                                    <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <button type="button" id="btnDashResumodashSeasons" name="btnDashResumodashSeasons"
                        class="btn btn-danger"><i class="fa fa-list-ul fa-lg" aria-hidden="true"></i>Listar</button>
                </fieldset>
            </form>
        </div>
    </div>
    <hr />
    <table id="table-matches-seasons" class="display" style="width:100%">
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

</div>
