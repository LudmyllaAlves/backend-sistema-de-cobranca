<?php
session_start();
include ('../model/config.php');
include('../model/DAO.php');
include('../model/cliente.php');
include('../model/cobrancas.php');
include('../model/funcionarios.php');
include('../model/clienteDAO.php');
include('../model/funcionariosDAO.php');
include('../model/cobrancasDAO.php');
include('../model/compras.php');
include('../model/comprasDAO.php');

$idFuncionario = $_SESSION['id_funcionario'];

$idcompra = $_POST['codigo'];
$nomeCliente = $_POST['identidade'];
$valorDaCompra= str_replace(',','.',str_replace('.','',$_POST['valorcompra']));
$valorPago = str_replace(',','.',str_replace('.','',$_POST['valorpago']));
$dataHoraExec = $_POST['datahoraexec'];

//conexão

$configDB = new ConfigBD;
$conn = $configDB->getConfig();
//funçao cliente
$clientesDAO = new ClienteDAO;
$idCliente = $clientesDAO->getIdCliente($nomeCliente);

//função funcionarios
if($idFuncionario > 0){
    //verrifica o cliente
    if($idCliente >= 1){
        //função para calcular
            //verifica se o saldo é maior que o valor pago
            if($valorPago <= $valorDaCompra){
                //insere na tabela
                $cobrancasDAO = new CobrancasDAO;
                $inserirCobranca= $cobrancasDAO->inserirCobranca($idCliente, $idFuncionario, $valorPago, $dataHoraExec);
                if($idcompra >= 1){
                    $comprasDAO = new ComprasDAO;
                    $adicionarValor =  $comprasDAO->adicionarValorPago($valorPago,$idcompra);
                    
                    if($valorPago == $valorDaCompra){
                        $pagarCompra = $comprasDAO->concluirCompra($idcompra);
                    }
                        echo("<script>
                        window.location.href = 'http://localhost:8080/cobrancasavulsas'
                        alert('Cobrança paga com sucesso " ) ;
                        echo ("');</script>");
                }else{
                    echo("<script>
                    window.location.href = 'http://localhost:8080/cobrancasavulsas'
                    alert('Codigo da compra não existe " ) ;
                    echo ("');</script>");
                }
            }else{
            echo("<script>
                    window.location.href = 'http://localhost:8080/cobrancasavulsas'
                    alert('Valor pago maior que o valor da compra" ) ;
            echo ("');</script>");
            }
    }else{
        echo("<script>
            window.location.href = 'http://localhost:8080/cobrancasavulsas'
            alert('Este cliente não existe!!! " ) ;
        echo ("');</script>");
    }
}else{
    echo("<script>
        window.location.href = 'http://localhost:8080/'
        alert('Funcionario Logado não é o  mesmo que está tentado realizar a cobrança!!! " ) ;
    echo ("');</script>");
}
                
?>