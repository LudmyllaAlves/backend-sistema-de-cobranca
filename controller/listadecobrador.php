<?php
    header("Access-Control-Allow-Origin: *");
    include ("../model/config.php"); 
    include ("../model/DAO.php");
    include ("../model/funcionario_tipoFuncDAO.php");
    include ("../model/funcionariosDAO.php");

    $configDB = new ConfigBD;
    $conn = $configDB->getConfig();

    //lista de funcionarios tipo cobrador/2
    $funcionarioDAO = new FuncionariosDAO;
    $lista = $funcionarioDAO->selecionarfuncionario();
    
    $json = json_encode($lista);
    print_r($json);



?>