<?php
class ComprasDAO{
    public function getCompras(){
        //usado em: listaDeCompras
        $query = " SELECT * FROM compras";
        $dao = new DAO();
        $resultado = $dao->selecionarNLinhasSQL($query);
        
        $compras=array();

        while ($linha = mysqli_fetch_assoc($resultado)) {
            $compra= new Compras();
            $compra->idcompras = $linha["id_compras"];
            $compra->idcliente = $linha["id_cliente"];
            $compra->valor = $linha['valor'];
            $compra->valorPago = $linha["valor_pago"];
            $compra->pago = $linha["pago"];
            array_push($compras, $compra);
        }
        return $compras;

    }
    
    public function getComprasCli($idclientes){
        //usado em:
        $query = " SELECT * FROM compras WHERE id_cliente = ".$idclientes;
        $dao = new DAO();
        $linha = $dao->selecionarNLinhasSQL($query);

            $compra= new Compras();
            $compra->idcompras = $linha["id_compras"];
            $compra->idcliente = $linha["id_cliente"];
            $compra->valor = $linha["valor"];
            $compra->valorPago = $linha["valor_pago"];
            $compra->pago = $linha["pago"];
            array_push($compras, $compra);
            
        return $compras;       
    }
    
    public function somarCompras($idcliente){
        //usado em: cobrarCobrancasPlan, exibirValor
        $query = "SELECT SUM(valor) AS"."'Total'". "FROM compras WHERE (id_cliente)=".$idcliente;
        $dao = new DAO();
        $linha = $dao->selecionar1LinhaSQL($query);
    return $linha;
    }
    public function somarValorPago($idcliente){
        //usado em:cobrarCobrancapla, exibirValor
        $query = "SELECT SUM(valor_pago) AS"."'Total'". "FROM compras WHERE (id_cliente)=".$idcliente;
        $dao = new DAO();
        $linha = $dao->selecionar1LinhaSQL($query);
    return $linha;
}

function calcularValor( $valorCompra, $valorPago ) {
    //usado em: exibirValor
    foreach ( $valorPago as $total => $valor ) {
        if( array_key_exists( $total, $valorCompra ) ) {
            $valorCompra[$total] = $valorCompra[$total] - $valor;
            
    } else {
        $valorCompra[$total] = -$valor;
    }
    }
    return  Array(number_format($valorCompra[$total],2, ',', '.'));
    
}


function valorCompra($valorCompra, $valorPago){
    //usado em:cobranplan
    $total = $valorCompra - $valorPago;
    return $total;
}

public function getValorCompra($idCompra){
    //usado em:cobranplan
    $query = " SELECT valor FROM compras WHERE id_compras = $idCompra";
    $dao = new DAO();
    $linha = $dao->selecionar1LinhaSQL($query);
    return $linha;

}
public function verificaCompra($idcompra){
    //usado em:cobranplan
    $query = "SELECT id_compras FROM compras WHERE id_compras = $idcompra";
    $dao = new DAO();
    $linha = $dao->selecionar1LinhaSQL($query);
    return $linha;
}
public function verificaCliente($idcliente){
    //usado em:
    $query = "SELECT id_cliente FROM compras WHERE id_cliente = $idcliente";
    $dao = new DAO();
    $linha = $dao->selecionar1LinhaSQL($query);
    return $linha;
}


function resultado( $valorCompra, $valorPago ) {
    //usado em:cobrarCobrancapla
    foreach ( $valorPago as $total => $valor ) {
        if( array_key_exists( $total, $valorCompra ) ) {
            $valorCompra[$total] = $valorCompra[$total] - $valor;
            
    } else {
        $valorCompra[$total] = -$valor;
    }
    }
    return number_format($valorCompra[$total],2, ',', '.');
}



public function valorPagoCompra($idCompra){
    //usado em:cobrarCobrancapla
    $query = "SELECT valor_pago FROM compras WHERE id_compras= $idCompra";
    $dao = new DAO();
    $resultado = $dao->selecionar1LinhaSQL($query);
    $valor= new cobrancas();
    $valor= $resultado["valor_pago"];

    return number_format($valor,2, ',', '.');
}

public function subtrair($valorCompra, $valorPagoDaCompra){
    //usado em: cobrarCobrancapla
    $resultado = $valorPagoDaCompra - $valorCompra;
    return -$resultado;
}

public function subtrair2($SaldoDaCompra, $valorPagoCorrigido){
    //usado em: cobrarCobrancapla
    $resultado = $valorPagoCorrigido - $SaldoDaCompra;
    return number_format($resultado, 2, ',', '.');
}
public function valorTotalDaCompra($idCompra){
    $query = "SELECT valor FROM compras WHERE id_compras= $idCompra";
    $dao = new DAO();
    $resultado = $dao->selecionar1LinhaSQL($query);
    $valor= new cobrancas();
    $valor= $resultado["valor"];
    
    return number_format($valor,2, ',', '.');
}

public function corrigirValores($valor){
    $corigindo= str_replace('.','',$valor);
    $valorCorigido = str_replace(',','.',$corigindo);

    return $valorCorigido;
}

public function alterarValorPago($valorDaCompra,$idCompra){
    $configDB = new ConfigBD;
    $conn = $configDB->getConfig();
    $query= "UPDATE compras SET valor_pago = $valorDaCompra WHERE id_compras= '".$idCompra."'";
    $pagarUmaCompra = mysqli_query($conn, $query);

    return $pagarUmaCompra;
}

public function concluirCompra($idCompra){
    $configDB = new ConfigBD;
    $conn = $configDB->getConfig();
    $query= "UPDATE compras SET pago = 1 WHERE id_compras= '".$idCompra."'";
    $pagou = mysqli_query($conn, $query);
    return $pagou;
}

public function adicionarValorPago($valorPago,$idCompra){
    $configDB = new ConfigBD;
    $conn = $configDB->getConfig();
    $query = "UPDATE compras SET valor_pago =  compras.valor_pago + $valorPago WHERE id_compras= '".$idCompra."'";
    $pagarUmaCompra = mysqli_query($conn, $query);
    return $pagarUmaCompra;
}

public function corrigirString($valor){
    $corigindo= str_replace('.','',$valor);
    $valorCorigido = str_replace(',','.',$corigindo);
    return $valorCorigido;
}
public function subtrair3($SaldoDaCompra, $valorPagoCorrigido){
    //usado em: cobrarCobrancapla
    $resultado = $SaldoDaCompra - $valorPagoCorrigido;
    return number_format($resultado, 2, '.', ',');
}



}





?>