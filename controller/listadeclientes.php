<?php

include ("../model/config.php");
include ("../model/DAO.php");
include ("../model/cliente.php");
include ("../model/clienteDAO.php");
include("../model/compras.php");
include("../model/comprasDAO.php");

    $configDB = new ConfigBD;
    $conn = $configDB->getConfig();

    $clienteDAO = new ClienteDAO;
    $lista = $clienteDAO->selecionarClientes();

    $listadeClientes = json_encode($lista);

    print_r($listadeClientes);

?>