@extends('layouts.app')

@section('content')
    <div class="card border-warning mb-3 col-6" style="margin: 0 auto; float: none;margin-bottom: 10px;">
        <div class="card-header"><b>Manutenção no Cadastro de Temporada</b></div>
        <div class="card-body">
            <h5 class="card-title">Informe o nome da temporada</h5>
            <form action="{{ route('adicionar_season') }}" method="POST">
                @csrf

                <div class="row g-6 align-items-center">
                    <div class="col-10">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" name="name" id="name" aria-hidden="true"
                                required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o fa-lg"
                                    aria-hidden="true"></i>Salvar</button>
                            <a class="btn btn-danger" href="{{ route('home') }}" role="button"><i class="fa fa-ban fa-lg"
                                    aria-hidden="true"></i>Cancelar</a>
                        </div>
                    </div>
                </div>
            </form>

            @if (isset($msgadd))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert"><i class="fa fa-info fa-lg"
                        aria-hidden="true"></i>{{ $msgadd }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (isset($msgreerr))
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert"><i
                        class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i>{{ $msgreerr }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

        </div>
    </div>
@endsection
