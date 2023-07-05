<?php
class ClienteDAO{

    public function selecionarClientes(){
        //usado em: ListaDeCliente
        $query= "SELECT DISTINCT compras.id_cliente, cliente.nome, cliente.id_cliente, cliente.cpf FROM compras INNER JOIN cliente 
        ON compras.id_cliente = cliente.id_cliente WHERE pago = 0";
        
        $dao = new DAO();
        $resultado = $dao->selecionarNLinhasSQL($query);
        $clientes=array();
        while ($linha = mysqli_fetch_assoc($resultado)) {
            
            $cliente = new Cliente();
            $cliente->idcliente = $linha["id_cliente"];
            $cliente->nome = $linha["nome"];
            $cliente->cpf = $linha["cpf"];
            
            array_push($clientes, $cliente);
        }
        return $clientes;
}

        public function selecionarCompra(){
            //usado em: ListaDeCliente
            $query= "SELECT  compras.*, cliente.nome, cliente.id_cliente, cliente.cpf FROM compras INNER JOIN cliente 
            ON compras.id_cliente = cliente.id_cliente WHERE pago = 0";
            
            $dao = new DAO();
            $resultado = $dao->selecionarNLinhasSQL($query);
            $clientes=array();
            
            $comprasDAO = new ComprasDAO();

            while ($linha = mysqli_fetch_assoc($resultado)) {
                
                $cliente = new Cliente();
                $cliente->idcompras = $linha["id_compras"];
                $cliente->idcliente = $linha["id_cliente"];
                $cliente->nome = $linha["nome"];
                $cliente->cpf = $linha["cpf"];
                $cliente-> valor = $linha["valor"];
                $cliente-> valorPago= $linha["valor_pago"];
                $valorCompra = $cliente->valor;
                $valorPago = $cliente->valorPago;
                $calcular = $comprasDAO-> valorCompra($valorCompra,$valorPago);
                $cliente->total= number_format($calcular,2, ',', '.' );
                array_push($clientes, $cliente);
            }
            return $clientes;
    }
    
    
    public function getIdCliente($nome){
        //usado em: Cobrar, exibirValor, planejarCobranca
        $query = " SELECT id_cliente FROM `cliente` WHERE nome = '".$nome."'";
        $dao = new DAO();
        $linha = $dao->selecionar1LinhaSQL($query);
            $cliente= new Cliente();
            $cliente= $linha["id_cliente"];
            return $cliente;
    }


    public function getClientes(){
        //usado em:
        $query= "SELECT * FROM cliente";
        
        $dao = new DAO();
        $resultado = $dao->selecionarNLinhasSQL($query);
        $clientes=array();
        while ($linha = mysqli_fetch_assoc($resultado)) {
            $cliente = new Cliente();
            $cliente->idcliente = $linha["id_cliente"];
            $cliente->nome = $linha["nome"];
            $cliente->endereco = $linha["endereco"];
            $cliente->telefone = $linha["cpf"];
            $cliente->cpf = $linha["cpf"];
            array_push($clientes, $cliente);
        }
        return $clientes;
}
}

?>

