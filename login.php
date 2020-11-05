<?php 
session_start();
    include('conexao.php'); //inclui no arquivo de conexao

    if(empty($_POST['usuario']) || empty($_POST['senha'])){
        header('Location: index.php'); //se o usuario digitou ou veio vazio retorna para index.php
        exit();
    }

    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']); //criada a variavel usuario passando a instancia da conexao e o campo digitado pelo usuario
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']); //criada a variavel usuario passando a instancia da conexao e o campo  digitado pelo usuario

    $query = "select usuario_id, usuario from usuario where usuario = '{$usuario}' and senha = md5('{$senha}')"; //realizar o select na tabela de usuarios
    
    $result = mysqli_query($conexao, $query); //monta e executa a query

    $row = mysqli_num_rows($result); //quantidade de linhas que essa query retornou

    if($row == 1){
        $_SESSION['usuario'] = $usuario;
        header('Location: painel.php');
        exit();
    }else{
        $_SESSION['nao_autenticado'] = true;
        header('Location: index.php');
        exit();
    }
?>