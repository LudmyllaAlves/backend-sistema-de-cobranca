<?php
session_start();
    include ("../model/config.php");
    include ("../model/DAO.php");
    include ("../model/cliente.php");
    include ("../model/clienteDAO.php");
    include ("../model/funcionariosDAO.php");
    include("../model/cobrancasDAO.php");
    include("../model/cobrancas.php");
    include("../model/comprasDAO.php");
    include("../model/compras.php");

$configDB = new ConfigBD;
$conn = $configDB->getConfig();

$comprasDAO = new ComprasDAO;

$nomeCliente = $_POST['nomecliente'];
$nomeCobrador = $_POST['nomecobradores'];
$total= $comprasDAO->corrigirString($_POST['calculado']);
$valorPlanejado =$comprasDAO->corrigirValores($_POST['valor_planejado']);
$dataPrevista = $_POST['data_prevista'];

$clienteDAO = new ClienteDAO;
$idCliente = $clienteDAO->getIdCliente($nomeCliente);

$funcionarioDAO = new FuncionariosDAO;
$idCobrador = $funcionarioDAO->getIdCobrador($nomeCobrador);

$cobrancasDAO = new CobrancasDAO;
$clienteCobrado = $cobrancasDAO->getCobrancaIdCliente($idCliente);

if($_SESSION['tipo_funcionario'] = 1){
    if(isset($_POST['cadastrar'])){
        if($valorPlanejado > $total ){
            echo("<script>
                window.location.href = 'http://localhost:8080/planejarcobranca'
                alert('Valor planejado maior que o valor calculado " ) ;
            echo ("');</script>");
            
        }else{
            if($idCliente != $clienteCobrado){
                $planejar = $cobrancasDAO->PlanejarCobranca($idCliente, $idCobrador, $valorPlanejado, $dataPrevista);
                echo("<script>
                    window.location.href = 'http://localhost:8080/planejarcobranca'
                    alert('Cobrança Planejada com sucesso! " ) ;
                echo ("');</script>");
                
            }else{                
                echo("<script>
                    window.location.href = 'http://localhost:8080/planejarcobranca'
                    alert('Este cliente já tem um cobrança pendente " ) ;
                echo ("');</script>");
            }
            
        }
    }
}else{
    echo("<script>
        window.location.href = 'http://localhost:8080/'
        alert('Tipo de Funcionario Logado não tem permissão para realizar está função " ) ;
    echo ("');</script>");
}
?>

