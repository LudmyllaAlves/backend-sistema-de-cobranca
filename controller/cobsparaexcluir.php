<?php
session_start();
include ("../model/config.php");
include ("../model/DAO.php");
include ("../model/cobrancas.php");
include ("../model/cobrancasDAO.php");
include("../model/cliente.php");

$tipoFuncionario = $_SESSION['tipo_funcionario'];

if ($tipoFuncionario == 1){

    $configDB = new ConfigBD;
    $conn = $configDB->getConfig();
    
    $cobrancasDAO = new cobrancasDAO;
    $lista = $cobrancasDAO->listaExcluir();
    
    $listadeCobranca = json_encode($lista);
    
    print_r($listadeCobranca);
}


?>