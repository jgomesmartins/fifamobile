@extends('layouts.app')
@section('content')
    <script src="{{ asset('js/core-dashboard.js') }}"></script>
    <div class="card border-warning mb-3 col-11" style="margin: 0 auto; float: none;margin-bottom: 10px;">
        <div class="card-header"><b>{{ __('DashBoard') }} </b></div>
        <div class="card-body">

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fa fa-futbol-o fa-lg" aria-hidden="true"></i>{{ __('Partidas Realizadas') }}
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @include('dashboard\dashboard-matches')
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <i class="fa fa-globe fa-lg" aria-hidden="true"></i>{{ __('Resumo Temporadas') }}
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @include('dashboard\dashboard-seasons')
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <i class="fa fa-calendar fa-lg" aria-hidden="true"></i>{{ __('Resumo Dia') }}
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="accordion-body">
                                @include('dashboard\dashboard-day')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card-footer text-muted">
            {{ config('app.name', 'Laravel') . ' Versão ' . config('app.version') }}
        </div>
    </div>
@endsection
