@extends('layouts.app')

@section('content')
    <div class="card border-warning mb-2 col-7" style="margin: 0 auto; float: none;margin-bottom: 10px;">
        <div class="card-header"><b>Lista temporadas cadastrados</b></div>
        <div class="card-body">


            <table id='table-teams' class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($seasons as $season) {
                        echo "<tr><td><b>$season->id</b></td><td>$season->name</td>
                                  <td>
                                  <a data-bs-toggle='modal' data-bs-target='#ModalDelete' href='#'><i class='fa fa-trash fa-lg' aria-hidden='true'></i></a>
                                  <a data-bs-toggle='modal' data-bs-target='#ModalEdit' href='#'><i class='fa fa-pencil fa-lg' aria-hidden='true'></i></a>
                                  </td>
                                  </tr>";
                    }
                    ?>

                </tbody>
            </table>

        </div>
        <div class="card-footer">
            <p><b>Total de registros: <?php echo count($seasons); ?></b></p>
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

    <!-- Modal ModalDelete -->
    <div class="modal fade" id="ModalDelete" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Confirmação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-danger">Deseja realmente excluir a temporada selecionada?</h5>
                    <form action="{{ route('delete_season') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="id" class="col-form-label">ID:</label>
                            <input readonly type="text" class="form-control" name='id' id="id">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nome:</label>
                            <input readonly type="text" class="form-control" name='time' id="time">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                                    class="fa fa-ban fa-lg" aria-hidden="true"></i>Cancelar</button>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o fa-lg"
                                    aria-hidden="true"></i>Excluir</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal ModalDelete -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Editar Temporada</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('editar_season') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="id" class="col-form-label">ID:</label>
                            <input readonly type="text" class="form-control" name='id' id="idedit">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Time:</label>
                            <input type="text" class="form-control" name='time' id="timeedit">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                    class="fa fa-ban fa-lg" aria-hidden="true"></i>Cancelar</button>
                            <button type="submit" name="salvarAlteracao" class="btn btn-primary"><i
                                    class="fa fa-floppy-o fa-lg" aria-hidden="true"></i>Salvar</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
