<?php
include('../model/config.php');
include('../model/DAO.php');
include('../model/cobrancas.php');
include('../model/cobrancasDAO.php');
include('../model/compras.php');
include('../model/comprasDAO.php');

//conexão
$configDB = new ConfigBD;
$conn = $configDB->getConfig();

$comprasDAO = new ComprasDAO;

$idCobranca = $_POST['idCobranca'];
$valorPago = $comprasDAO->corrigirString($_POST['valorPago']);
$dataHoraExec = $_POST['dataHoraExec'];
$valorPlanejado = $comprasDAO->corrigirValores($_POST['valorPlanejado']);


$cobrancasDAO = new CobrancasDAO;

//pega o id do cliente
$idCliente = $cobrancasDAO->getIdCliente($idCobranca);
//pega o id da compra
$idCompra = $cobrancasDAO->getIdCompra($idCliente);

//calcula o valor total devedor de todas as compras
$somaCompras = $comprasDAO->somarCompras($idCliente);
$somaPago = $comprasDAO->somarValorPago($idCliente);
$calcular = $comprasDAO->corrigirValores($comprasDAO->resultado($somaCompras, $somaPago));

//pega o valor pago da primeira compra
$valorPagoDaCompra = $comprasDAO->corrigirValores($comprasDAO->valorPagoCompra($idCompra));
//pega o valor da compra
$valorDaCompra = $comprasDAO->corrigirValores($comprasDAO->valorTotalDaCompra($idCompra));

//subtrair o valor da compra com o valor já pago
$SaldoDaCompra= $comprasDAO->corrigirValores($comprasDAO->subtrair2($valorPagoDaCompra, $valorDaCompra));

//Verifica se o saldo devedor do cliente é maior ou igual ao valor pago

if($calcular >= $valorPago){
        //subtrai do saldo da compra o valor pago para saber se ela fica paga
        //resultado retornado = quanto ficou devendo
        $sobrou = $comprasDAO->corrigirValores($comprasDAO->subtrair2 ($SaldoDaCompra,$valorPago));
        if($sobrou == 0){
            
            $cobrado = $cobrancasDAO->adicionarValorPago($valorPago,$idCobranca);
            $data = $cobrancasDAO->adicionarData($dataHoraExec,$idCobranca);
            $cobPaga = $cobrancasDAO->cobrancaEfetuada($idCobranca);
            $pagarUmaCompra = $comprasDAO->adicionarValorPago($valorPago,$idCompra);
            $pagou = $comprasDAO->concluirCompra($idCompra);
            echo("<script>
            window.location.href = 'http://localhost:8080/realizarcobrancasplanejadas'
            alert('Cobrança efetuada com sucesso" ) ;
            echo ("');</script>");
            }else{
            //abate o valor na tabela de cobranca 
            if($sobrou < 0){
            
            $cobrado = $cobrancasDAO->adicionarValorPago($valorPago,$idCobranca);
            $realizar = $comprasDAO->adicionarValorPago($valorPago, $idCompra);
            $concluir = $cobrancasDAO->cobrancaEfetuada($idCobranca);
            $cobrado = $cobrancasDAO->adicionarData($dataHoraExec,$idCobranca);
            echo("<script>
                window.location.href = 'http://localhost:8080/realizarcobrancasplanejadas'
                alert('Cobrança efetuada com sucesso" ) ;
                echo ("');</script>");
            }
            else{
                
                $cobrado = $cobrancasDAO->adicionarValorPago($valorPago,$idCobranca);
                $data = $cobrancasDAO->adicionarData($dataHoraExec,$idCobranca);
                $concluir = $cobrancasDAO->cobrancaEfetuada($idCobranca);

                do{
                    
                    $pagarUmaCompra = $comprasDAO->alterarValorPago($valorDaCompra,$idCompra);
                    $pagou = $comprasDAO->concluirCompra($idCompra);
                    $idCompra = $cobrancasDAO->getIdCompra($idCliente);
                    $valorDaCompra = $comprasDAO->corrigirString($comprasDAO->valorTotalDaCompra($idCompra));
                    $valorPagoDaCompra= $comprasDAO->corrigirValores($comprasDAO->valorPagoCompra($idCompra));
                    $SaldoDaCompra =$comprasDAO->corrigirValores($comprasDAO->subtrair2($valorPagoDaCompra,$valorDaCompra));
                    
                    $sobrou =$comprasDAO->subtrair3($sobrou, $SaldoDaCompra);
                    
                    
                }while($sobrou >= $valorDaCompra);
                $valor = $comprasDAO->subtrair3($sobrou, -$valorDaCompra);
                $pagarCompra = $comprasDAO->adicionarValorPago($valor,$idCompra);
                
                echo("<script>
                window.location.href = 'http://localhost:8080/realizarcobrancasplanejadas'
                alert('Cobrança efetuada com sucesso" ) ;
                echo ("');</script>");
            }
            
    }
}else{      
    echo("<script>
        window.location.href = 'http://localhost:8080/realizarcobrancasplanejadas'
        alert('Cliente pagou mais do que devia" ) ;
        echo ("');</script>");
}




?>