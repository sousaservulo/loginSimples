<?php
session_start();
include('conexaoLogin.php');
session_start();



// caso o campo usuario ou senha estiverem vazios, vai ser redirecionado para a pagina inicial.
if ((empty($_POST['username'])) || (empty($_POST['password']))) {
    header('location: index.php');
    exit();
} 

// função mysqli_real_escape_string faz validações afim de evitar ataques de sql injections
$usuario = mysqli_real_escape_string($conexao, $_POST['username']);
$senha = mysqli_real_escape_string($conexao, $_POST['password']);

// seleciona todos os dados no banco/ validando se os dados são iguais
$query = "select * from usuario where user = '{$usuario}' and senha = '{$senha}'";

// executa a query acima
$result = mysqli_query($conexao, $query);

//informa o numero de linhas dos resultados na tabela-linha, onde o row == 0, não esta autenticado e o row ==1, esta autenticado.
$row = mysqli_num_rows($result);

if ($row ==1){
    $_SESSION['usuario'] = $usuario;
    header('Location: cadastro.php');
    exit();
} else{
    header('Location: index.html');
    
    exit();
}
