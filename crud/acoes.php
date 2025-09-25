<?php
session_start();
require 'conexao.php';


if (isset($_POST['create_usuario'])) {
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
    $senha_hash = isset($_POST['senha']) ? password_hash(trim($_POST['senha']), PASSWORD_DEFAULT) : '';

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha_hash')";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = "Usuário criado com sucesso!";
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro ao criar usuário: " . mysqli_error($conexao);
        header('Location: index.php');
        exit();
    }
}


if (isset($_POST['update_usuario'])) {
    $usuario_id = mysqli_real_escape_string($conexao, $_POST['usuario_id']);
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
    $senha = trim($_POST['senha']);

    $sql = "UPDATE usuarios SET nome = '$nome', email = '$email'";

    if (!empty($senha)) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $sql .= ", senha = '$senha_hash'";
    }

    $sql .= " WHERE id = '$usuario_id'";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = "Usuário atualizado com sucesso!";
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar usuário: " . mysqli_error($conexao);
        header('Location: index.php');
        exit();
    }
}


if (isset($_POST['delete_usuario'])) {
    $usuario_id = mysqli_real_escape_string($conexao, $_POST['delete_usuario']);

    $sql = "DELETE FROM usuarios WHERE id = '$usuario_id'";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = "Usuário excluído com sucesso!";
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro ao excluir usuário: " . mysqli_error($conexao);
        header('Location: index.php');
        exit();
    }
}
?>