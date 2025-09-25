<?php
session_start();
require 'conexao.php';
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-4">
        <?php include('mensagem.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lista de Usuários
                            <a href="usuario-create.php" class="btn btn-primary float-end">Adicionar usuário</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Senha</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = 'SELECT * FROM usuarios';
                                $usuarios = mysqli_query($conexao, $sql);

                                if (mysqli_num_rows($usuarios) > 0) {
                                    foreach($usuarios as $usuario) {
                                ?>
                                <tr>
                                    <td><?= $usuario['id']; ?></td>
                                    <td><?= $usuario['nome']; ?></td>
                                    <td><?= $usuario['email']; ?></td>
                                    <td><?= $usuario['senha']; ?></td>
                                    <td>
                                        <a href="usuario-view.php?id=<?= $usuario['id']; ?>" class="btn btn-secondary btn-sm">Visualizar</a>
                                        <a href="usuario-edit.php?id=<?= $usuario['id']; ?>" class="btn btn-success btn-sm">Editar</a>
                                        <form action="code.php" method="POST" class="d-inline">
                                            <button type="submit" name="delete_usuario" value="<?= $usuario['id']; ?>" class="btn btn-danger btn-sm">
                                                Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php 
                                    }
                                } else {
                                    echo '<tr><td colspan="5"><h5>Nenhum usuário encontrado.</h5></td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</html>