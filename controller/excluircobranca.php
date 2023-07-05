<?php
include ("../model/config.php");
include ("../model/DAO.php");
include ("../model/cobrancas.php");
include ("../model/cobrancasDAO.php");

$idCobranca = $_POST['idCobranca'];

if(isset ($_POST['excluir'])){
    if($idCobranca > 0){
        $cobrancasDAO = new CobrancasDAO;
        $excluir = $cobrancasDAO->excluir($idCobranca);
        echo("<script>
        window.location.href = 'http://localhost:8080/gerenciarcobs'
        alert('Cobrança Excluida com sucesso " ) ;
        echo ("');</script>");
    }else{
        echo("<script>
        window.location.href = 'http://localhost:8080/gerenciarcobs'
        alert('Cobranca indisponivel " ) ;
        echo ("');</script>");
    }
}else{
    echo("<script>
        window.location.href = 'http://localhost:8080/gerenciarcobs'
        alert('Cobrança não excluida " ) ;
    echo ("');</script>");
}
?>