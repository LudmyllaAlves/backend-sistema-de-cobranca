<?php
include ("../model/config.php");
include ("../model/DAO.php");
include ("../model/compras.php");
include ("../model/comprasDAO.php");

$configDB = new ConfigBD;
$conn = $configDB->getConfig();

//lista de todas as compras
$comprasDAO = new ComprasDAO;
$lista = $comprasDAO->getCompras();

$listadeCompras = json_encode($lista);


print($listadeCompras);
?>
