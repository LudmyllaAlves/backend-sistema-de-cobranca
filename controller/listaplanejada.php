<?php
session_set_cookie_params(['httponly' => true]);
session_start();
include ("../model/config.php");
include ("../model/DAO.php");
include("../model/cobrancas.php");
include("../model/cobrancasDAO.php");
include("../model/cliente.php");

$tipoFuncionario = $_SESSION['tipo_funcionario'];

    if($tipoFuncionario != 1){
    $idFuncionario = $_SESSION['id_funcionario'];

    $configDB = new ConfigBD;
    $conn = $configDB->getConfig();
    //Lista de cobranca de um cobrador especifico
    $cobrancasDAO = new CobrancasDAO;
    $lista = $cobrancasDAO->cobrancasPlanejadas($idFuncionario);

    $listadeCobrancas= json_encode($lista);

    print($listadeCobrancas);
    }
    else{
        echo "Lista não pode ser exibida";
    }
?>



