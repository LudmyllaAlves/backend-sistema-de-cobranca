<?php
class CobrancasDAO{
    public function getCobrancaIdCliente($idCliente){
        //usado em: PlanejarCobranca
        $query = " SELECT * FROM cobranca WHERE id_cliente = $idCliente AND cobranca_efetuada = 0 ";
        $dao = new DAO();
        $resultado = $dao->selecionar1LinhaSQL($query);

        $id =0;
        try {
            if (isset($resultado["id_cliente"]) ){
                $id = $resultado["id_cliente"];
            }
        } catch(Exception $e) {
            $id =0;
        }
        
        $retorno = -1;
        if ($id>=1){
            $retorno = $id;
        }
        return $retorno;
    }     
    
    public function cobrancasPlanejadas($idfuncionario){
        //usado em: ListaPlanejada
        $query = $query =
        " SELECT  cobranca.*, cliente.nome, cliente.id_cliente, cliente.endereco FROM cobranca INNER JOIN cliente 
        ON cobranca.id_cliente = cliente.id_cliente WHERE cobranca_efetuada = 0  AND id_funcionario = '".$idfuncionario."'";
        $dao = new DAO();
        $resultado = $dao->selecionarNLinhasSQL($query);            
        $cobrancas=array();
        $cliente = new Cliente();

        while ($linha = mysqli_fetch_assoc($resultado)) {
            $cobranca = new Cobrancas();
            $cobranca->idCobranca = $linha["id_cobranca"];
            $cobranca->idCliente = $linha["id_cliente"];
            $cobranca->endereco = $cliente->endereco= $linha["endereco"];
            $cobranca->idFuncionario = $linha["id_funcionario"];
            $cobranca->valorPlanejado =number_format($linha["valor_planejado"],2, ',', '.' );
            $cobranca->valorPago = $linha["valor_pago"];
            $cobranca->dataPrevista = $linha["data_prevista"];
            $cobranca->dataHoraExec = $linha["data_hora_exec"];
            $cobranca->cobrancaEfetuada = $linha["cobranca_efetuada"];
            $cobranca->nome = $cliente->nome = $linha['nome'];
            array_push($cobrancas, $cobranca);
            }
            return $cobrancas;
    
        }
        public function cobrancasEfetuadas(){
            //usado em :ListaDeCobrancasEfetuadas
            $query = "SELECT  cobranca.*, cliente.nome, cliente.id_cliente, cliente.cpf FROM cobranca INNER JOIN cliente 
            ON cobranca.id_cliente = cliente.id_cliente WHERE cobranca_efetuada = 1 ";
            $dao = new DAO();
            $resultado = $dao->selecionarNLinhasSQL($query);            
            $cobrancas=array();
            $cliente = new Cliente();
            while ($linha = mysqli_fetch_assoc($resultado)) {
                $cobranca = new Cobrancas();

                $cobranca->idCobranca = $linha["id_cobranca"];
                $cobranca->idCliente = $linha["id_cliente"];
                $cobranca->idFuncionario = $linha["id_funcionario"];
                $cobranca->valorPlanejado = number_format($linha["valor_planejado"],2, ',', '.' );
                $cobranca->valorPago = number_format($linha["valor_pago"],2, ',', '.' ); 
                $cobranca->dataPrevista = $linha["data_prevista"];
                $cobranca->dataHoraExec = $linha["data_hora_exec"];
                $cobranca->cobrancaEfetuada = $linha["cobranca_efetuada"];
                $cobranca->nome = $cliente->nome = $linha['nome'];

                array_push($cobrancas, $cobranca);
                }
                return $cobrancas;
        
            }
            public function cobrancasEfetuadasFunc($idfuncionario){
                //Usado em: ListaDeCobrancasEfetuadas
                $query= "SELECT  cobranca.*, cliente.nome, cliente.id_cliente, cliente.cpf FROM cobranca INNER JOIN cliente 
            ON cobranca.id_cliente = cliente.id_cliente WHERE cobranca_efetuada = 1  AND id_funcionario = $idfuncionario";
                $dao = new DAO();
                $resultado = $dao->selecionarNLinhasSQL($query);            
                $cobrancas=array();
                $cliente = new Cliente();
        
                while ($linha = mysqli_fetch_assoc($resultado)) {
                    $cobranca = new Cobrancas();
                    $cobranca->idCobranca = $linha["id_cobranca"];
                    $cobranca->idCliente = $linha["id_cliente"];
                    $cobranca->idFuncionario = $linha["id_funcionario"];
                    $cobranca->valorPlanejado = number_format($linha["valor_planejado"],2, ',', '.' );
                    $cobranca->valorPago = number_format($linha["valor_pago"],2, ',', '.' );
                    $cobranca->dataPrevista = $linha["data_prevista"];
                    $cobranca->dataHoraExec = $linha["data_hora_exec"];
                    $cobranca->cobrancaEfetuada = $linha["cobranca_efetuada"];
                    $cobranca->nome = $cliente->nome = $linha['nome'];
            
                    array_push($cobrancas, $cobranca);
                    }
                    return $cobrancas;
            
                }
            public function getIdCobranca(){
                //usado em:cobrar
                $query ="SELECT MAX(id_cobranca) as id_cobranca FROM cobranca" ;
                $dao = new DAO();
                $linha = $dao->selecionar1LinhaSQL($query);
                    $cobranca= new cobrancas();
                    $cobranca= $linha["id_cobranca"];
                    return $cobranca;
                }

            public function getIdCompra($idCliente){
                //usado em:cobrarCobrancapla
                $query = " SELECT MIN(id_compras) as id_compras FROM compras WHERE id_cliente = $idCliente AND pago = 0";
                $dao = new DAO();
                $linha = $dao->selecionar1LinhaSQL($query);
                $cobranca= new cobrancas();
                    $cobranca= $linha["id_compras"];
                    return $cobranca;
                
                }

            public function getIdCliente($idCobranca){
                //usado em:cobrarCobrancapla
                $query = " SELECT id_cliente FROM cobranca WHERE id_cobranca = $idCobranca";
                $dao = new DAO();
                $resultado = $dao->selecionar1LinhaSQL($query);
                $cobranca= new cobrancas();
                $cobranca= $resultado["id_cliente"];
                return $cobranca;
            }

            public function listaExcluir(){
                //Usado em: ListaDeCobrancasEfetuadas
                $query = $query =
                " SELECT  cobranca.*, cliente.nome, cliente.id_cliente, cliente.cpf FROM cobranca INNER JOIN cliente 
                ON cobranca.id_cliente = cliente.id_cliente WHERE cobranca_efetuada = 0";
                $dao = new DAO();
                $resultado = $dao->selecionarNLinhasSQL($query);            
                $cobrancas=array();
                $cliente = new Cliente();
        
                while ($linha = mysqli_fetch_assoc($resultado)) {
                    $cobranca = new Cobrancas();
                    $cobranca->idCobranca = $linha["id_cobranca"];
                    $cobranca->idCliente = $linha["id_cliente"];
                    $cobranca->idFuncionario = $linha["id_funcionario"];
                    $cobranca->valorPlanejado =number_format( $linha["valor_planejado"],2, ',', '.' );
                    $cobranca->valorPago =number_format($linha["valor_pago"],2, ',', '.' );
                    $cobranca->dataPrevista = $linha["data_prevista"];
                    $cobranca->dataHoraExec = $linha["data_hora_exec"];
                    $cobranca->cobrancaEfetuada = $linha["cobranca_efetuada"];
                    $cobranca->nome = $cliente->nome = $linha['nome'];
            
                    array_push($cobrancas, $cobranca);
                    }
                    return $cobrancas;
            
                }
                
                public function inserirCobranca($idCliente, $idFuncionario, $valorPago, $dataHoraExec){
                    $query = "INSERT INTO `cobranca` (`id_cliente`, `id_funcionario`, `valor_pago`, `data_hora_exec`,`cobranca_efetuada`)
                    VALUES ('$idCliente', '$idFuncionario', '$valorPago', '$dataHoraExec', 1)";
                    $configDB = new ConfigBD;
                    $conn = $configDB->getConfig();
                    $executar = mysqli_query($conn, $query);
                    return $executar;
                }

                public function excluir($idCobranca){
                    $query = "DELETE FROM cobranca WHERE `id_cobranca` = $idCobranca";
                    $configDB = new ConfigBD;
                    $conn = $configDB->getConfig();
                    $executar = mysqli_query($conn, $query);
                    return $executar;
                }
                public function adicionarData($dataHoraExec,$idCobranca){
                    $query = "UPDATE cobranca SET data_hora_exec = '".$dataHoraExec."' WHERE id_cobranca= '".$idCobranca."'";
                    $configDB = new ConfigBD;
                    $conn = $configDB->getConfig();
                    $executar = mysqli_query($conn, $query);
                    return $executar;
                }
                public function cobrancaEfetuada($idCobranca){
                    $query = "UPDATE cobranca SET cobranca_efetuada = 1 WHERE id_cobranca= '".$idCobranca."'";
                    $configDB = new ConfigBD;
                    $conn = $configDB->getConfig();
                    $executar = mysqli_query($conn, $query);
                    return $executar;
                }
                public function adicionarValorPago($valorPagoCorrigido, $idCobranca){
                    $query = "UPDATE cobranca SET valor_pago = $valorPagoCorrigido WHERE id_cobranca= '".$idCobranca."'";
                    $configDB = new ConfigBD;
                    $conn = $configDB->getConfig();
                    $executar = mysqli_query($conn, $query);
                    return $executar;
                }

                public function PlanejarCobranca($idCliente, $idCobrador, $valorPlanejado, $dataPrevista){
                    $query = "INSERT INTO `cobranca` (`id_cliente`, `id_funcionario`, `valor_planejado`, `data_prevista`)
                    VALUES ('$idCliente', '$idCobrador', '$valorPlanejado', '$dataPrevista')";
                    $configDB = new ConfigBD;
                    $conn = $configDB->getConfig();
                    $executar = mysqli_query($conn, $query);
                    return $executar;
                }


    }

?>