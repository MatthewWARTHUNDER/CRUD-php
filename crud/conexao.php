<?php
define('HOST', 'localhost');
define('USUARIO', 'root');
define('SENHA', 'root');
define('DB', 'crud_php');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Nao foi possivel conectar');

?>