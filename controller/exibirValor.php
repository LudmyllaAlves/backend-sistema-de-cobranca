<?php
include ("../model/config.php");
include ("../model/DAO.php");
include ("../model/compras.php");
include ("../model/comprasDAO.php");
include("../model/cliente.php");
include("../model/clienteDAO.php");

$configDB = new ConfigBD;
$conn = $configDB->getConfig();

$nomecliente = $_POST['nomecliente'];


if($nomecliente){
    $clienteDAO = new ClienteDao();
    $idcliente = $clienteDAO->getIdCliente($nomecliente);
    $comprasDAO = new ComprasDAO;
    $valorCompra = $comprasDAO->somarCompras($idcliente);
    $valorPago = $comprasDAO->somarValorPago($idcliente);
    $calcular = $comprasDAO-> calcularValor($valorCompra,$valorPago);
    
    $valorTotal = json_encode($calcular);

    print($valorTotal);
    //header("http://localhost:8080/cobrar");
}else{
    echo "não post";
}
?>