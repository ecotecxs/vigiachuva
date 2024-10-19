<?php
$nome = $_POST['nome'];
$email = $_POST['email'];
$data = $_POST['data'];
$senha = $_POST['senha'];

include 'conexao.php';

$insert = "INSERT INTO tb_user VALUES (NULL, '$nome', '$email', '$senha', '$data')";

$query = mysqli_query($conexao, $insert);

echo "Inserido com sucesso";

?>