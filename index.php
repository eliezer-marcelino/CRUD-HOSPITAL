<?php
include_once "./app/conexao/Conexao.php";
include_once "./app/dao/PacienteDAO.php";
include_once "./app/model/Paciente.php";

//instancia as classes
$paciente = new Paciente();
$pacientedao = new PacienteDAO();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    
    <title>CRUD - Paciente Hospital</title>
    <style>
        .menu,
        thead {
            background-color: #bbb !important;
        }

        .row {
            padding: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-light menu">
        <div class="container">
            <a class="navbar-brand" href="#">
                CRUD - Paciente Hospital
            </a>
        </div>
    </nav>
    <div class="container">
        <form action="app/controller/PacienteController.php" method="POST">
            <div class="row">
                <div class="col-md-3">
                    <label>Nome</label>
                    <input type="text" name="nome" value="" autofocus class="form-control" require />
                </div>
                <div class="col-md-5">
                    <label>CPF</label>
                    <input type="text" name="cpf" value="" class="form-control" require />
                </div>
                <div class="col-md-2">
                    <label>Data Nasci.</label>
                    <input type="text" name="dataNascimento" value="" class="form-control" require />
                </div>
                <div class="col-md-2">
                    <label>Situação</label>
                    <select name="situacao" class="form-control">
                      <option value="0">SELECIONE</option>
                      <option value="1">De boa</option>
                      <option value="2">Emergência</option>
                      <option value="3">Crítico</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <br>
                    <button class="btn btn-primary" type="submit" name="cadastrar">Cadastrar</button>
                </div>
            </div>
        </form>
        <hr>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Data Nasc.</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pacientedao->read() as $paciente) : ?>
                        <tr>
                            <td><?= $paciente->getIdPaciente() ?></td>
                            <td><?= $paciente->getNome() ?></td>
                            <td><?= $paciente->getCpf() ?></td>
                            <td><?= $paciente->getDataNascimento() ?></td>
                            <td>
                                <?php if ($paciente->getSituacao() == 0) : ?>
                                    Não selecionado
                                <?php elseif ($paciente->getSituacao() == 1) : ?>
                                    De boa
                                <?php elseif ($paciente->getSituacao() == 2) : ?>
                                    Emergência
                                <?php else : ?>
                                    Crítico
                                <?php endif ?>
                            </td>                                
                            <td class="text-center">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editar-<?= $paciente->getIdPaciente() ?>">Editar</button>

                                <a href="app/controller/PacienteController.php?del=<?= $paciente->getIdPaciente() ?>">
                                <button class="btn  btn-danger btn-sm" type="button">Excluir</button>
                                </a>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="editar-<?= $paciente->getIdPaciente() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="app/controller/PacienteController.php" method="POST">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label>Nome</label>
                                                    <input type="text" name="nome" value="<?= $paciente->getNome() ?>" class="form-control" require />
                                                </div>
                                                <div class="col-md-7">
                                                    <label>CPF</label>
                                                    <input type="text" name="cpf" value="<?= $paciente->getCpf() ?>" class="form-control" require />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Data Nascimento</label>
                                                    <input type="data" name="dataNascimento" value="<?= $paciente->getDataNascimento() ?>" class="form-control" require />
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Situação</label>
                                                    <select name="situacao" class="form-control">
                                                        <?php if ($paciente->getSituacao() == 0) : ?>
                                                            <option value="0" selected>SELECIONE</option>
                                                            <option value="1">De boa</option>
                                                            <option value="2">Emergência</option>
                                                            <option value="3">Crítico</option>
                                                        <?php elseif ($paciente->getSituacao() == 1) : ?>
                                                            <option value="0">SELECIONE</option>
                                                            <option value="1" selected>De boa</option>
                                                            <option value="2">Emergência</option>
                                                            <option value="3">Crítico</option>
                                                        <?php elseif ($paciente->getSituacao() == 2) : ?>
                                                            <option value="0">SELECIONE</option>
                                                            <option value="1">De boa</option>
                                                            <option value="2" selected>Emergência</option>
                                                            <option value="3">Crítico</option>
                                                        <?php else : ?>
                                                            <option value="0">SELECIONE</option>
                                                            <option value="1">De boa</option>
                                                            <option value="2">Emergência</option>
                                                            <option value="3" selected>Crítico</option>
                                                        <?php endif ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <br>
                                                    <input type="hidden" name="idPaciente" value="<?= $paciente->getIdPaciente() ?>" />
                                                    <button class="btn btn-primary" type="submit" name="editar">Cadastrar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>