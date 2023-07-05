<?php
session_start();

include ("../model/config.php");
include ("../model/DAO.php");
include ("../model/funcionariosDAO.php");

$_SESSION['nome'] = $_POST["nome"];
$_SESSION['senha'] = $_POST["senha"];


$funcionarioDAO = new FuncionariosDAO();
$configDB = new ConfigBD;
$conn = $configDB->getConfig();


$idFuncionario= $funcionarioDAO->validarLogin($_SESSION['nome'], $_SESSION['senha']);
$_SESSION['id_funcionario'] = $idFuncionario;

$tipofunc = $funcionarioDAO->validarTipo($_SESSION['id_funcionario']);
$_SESSION ['tipo_funcionario'] = $tipofunc;


if ($_SESSION['id_funcionario'] >= 1){                                                                                           
    //echo "usuario logado";

    if($_SESSION['tipo_funcionario'] != 1){
        echo("<script>
        window.location.href = 'http://localhost:8080/homecobrador'
        alert('Bem-vindo   " ) ;
        echo($_SESSION['nome']);
        echo ("');</script>");
    }else {
        echo("<script>
        window.location.href = 'http://localhost:8080/homeadmin'
        alert('Bem-vindo  " ) ;
        echo($_SESSION['nome']);
        echo ("');</script>");
    }
    

}else{ 
    echo( "<script language='javascript' type='text/javascript'>
    alert('Usuario não encontrado'); 
    window.location.href = 'http://localhost:8080';
    </script>");
}
?>