<?php
session_start();
include ("../model/config.php");
include ("../model/DAO.php");
include("../model/cobrancas.php");
include("../model/cobrancasDAO.php");
include("../model/cliente.php");

$tipoFuncionario= $_SESSION['tipo_funcionario'];

if($tipoFuncionario == 1){
$configDB = new ConfigBD;
$conn = $configDB->getConfig();

//lista de todas as Cobranças efetuadas
$CobrancasDAO = new CobrancasDAO;
$lista = $CobrancasDAO->cobrancasEfetuadas();

$listadeCobrancas = json_encode($lista);

print_r($listadeCobrancas);
}
else{

    $idfuncionario = $_SESSION['id_funcionario'];

    $configDB = new ConfigBD;
    $conn = $configDB->getConfig();

    //lista de cobrancas efetuadas por um funcionario especifico
    $CobrancasDAO = new CobrancasDAO;
    $lista = $CobrancasDAO->cobrancasEfetuadasFunc($idfuncionario);

    $listadeCobrancas = json_encode($lista);


    print_r($listadeCobrancas);

}

?>