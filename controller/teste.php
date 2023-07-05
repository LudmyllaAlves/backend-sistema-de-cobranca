<?php
include('../model/config.php');
include("../model/DAO.php");
include('../model/cliente.php');
include('../model/cobrancas.php');
include('../model/funcionarios.php');
include('../model/clienteDAO.php');
include('../model/funcionariosDAO.php');
include('../model/cobrancasDAO.php');
include('../model/compras.php');
include('../model/comprasDAO.php');
$comprasDAO = new ComprasDAO;

/*

$valorPago = 1000;
$idCobranca = 179;

$configDB = new ConfigBD;
$conn = $configDB->getConfig();

$idCliente = 7851515;
//pega o id da compra
$idCompra = 1552;

$comprasDAO = new ComprasDAO;
$valorPagoDaCompra = $comprasDAO->valorPagoCompra($idCompra);
//pega o valor da compra
$valorDaCompra = $comprasDAO->valorTotalDaCompra($idCompra);

$SaldoDaCompra=$comprasDAO->subtrair($valorPagoDaCompra,$valorDaCompra);

$somaCompras = $comprasDAO->somarCompras($idCliente);
$somaPago = $comprasDAO->somarValorPago($idCliente);
$calcular = $comprasDAO->resultado($somaCompras, $somaPago);





if ($calcular != 0){
    $sobrou = $comprasDAO->subtrair($SaldoDaCompra,$valorPago);
    
    while($sobrou > 0){
    $cobrancasDAO = new CobrancasDAO;
    $NovoidCompra = $cobrancasDAO->getIdCompra($idCliente);
    $NovovalorPagoDaCompra = $comprasDAO->valorPagoCompra($NovoidCompra);
//pega o valor da compra
    $NovovalorDaCompra = $comprasDAO->valorTotalDaCompra($idCompra);

    $NovoSaldoDaCompra=$comprasDAO->subtrair($NovovalorPagoDaCompra,$NovovalorDaCompra);

    $sobrou = $comprasDAO->subtrair( $NovoSaldoDaCompra, $valorPago);

    
    //$sobrou = $resto ;
    
    //print $sobrou;
    return $sobrou;

    //echo "Compra paga";*/
    //}
    //echo " Não entra no while";
    /*
}else{
    echo "Execução realizado com sucesso";
}

/*
$query = ("UPDATE cobranca SET valor_pago = $valorPago WHERE id_cobranca= '".$idCobranca."'");
$cobrado = mysqli_query($conn, $query);
$query3 =("UPDATE `cobranca` SET cobranca_efetuada = 1 WHERE id_cobranca= '".$idCobranca."'");
$concluir = mysqli_query($conn, $query3);
$query6 = "UPDATE compras SET valor_pago = compras.valor_pago + $valorPago WHERE id_compras= '".$idCompra."'";
$pagarUmaCompra = mysqli_query($conn, $query6);
$query2= "UPDATE `compras` SET pago = 1 WHERE id_compras= '".$idCompra."'";
$pagou = mysqli_query($conn, $query2);
*/
//valordacompra
/*

$idcliente = 7851515;
$valorCompra = $comprasDAO->somarCompras($idcliente);
$valorPago = $comprasDAO->somarValorPago($idcliente);
$calcular = $comprasDAO-> calcularValor($valorCompra,$valorPago);
$valorPago= $_POST['valor'];

$valorCorrigido = $comprasDAO->corrigirValores($calcular);

var_dump(($valorCorrigido)) ;
/*
$query = "UPDATE `compras` SET valor_pago = $valorPago WHERE id_compra= 1552"
*/
$sobrou = "-72.40";
$SaldoDaCompra= "652.80";

$sobrou = $comprasDAO->subtrair3( $sobrou, -$SaldoDaCompra);

var_dump($sobrou);
?>