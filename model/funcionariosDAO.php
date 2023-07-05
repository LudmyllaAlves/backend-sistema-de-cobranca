<?php

include_once('../model/funcionarios.php');
include_once('../model/tipoFuncionario.php');
include_once('../model/DAO.php');
class FuncionariosDAO{
    public function validarLogin($nome, $senha){
        //usado em: cadastrarFuncionario, Login
        $query =
        " SELECT * ".
        "   FROM funcionario ".
        "  WHERE nome= '".$nome."'".
        "    AND senha= '".$senha."'";
        
        $dao = new DAO();
        $resultado = $dao->selecionar1LinhaSQL($query);

        $id =0;
        try {
            if (isset($resultado["id_funcionario"]) ){
                $id = $resultado["id_funcionario"];
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
    public function validarTipo($id_funcionario){
        //usado em: Login, 
        $query =
        " SELECT * ".
        "   FROM funcionario_tipofun ".
        "  WHERE id_funcionario= '".$id_funcionario."'"
        ;
        
        $dao = new DAO();
        $resultado = $dao->selecionar1LinhaSQL($query);

        $id =0;
        try {
            if (isset($resultado["id_tipofuncionario"]) ){
                $id = $resultado["id_tipofuncionario"];
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

    public function getTipoFuncionarios($tipofuncionario){
        //usado em: cadastrarFuncionario
            $query = " SELECT * FROM `tipo_funcionario` WHERE tipo_funcionario = '".$tipofuncionario."'";
            $dao = new DAO();
            $linha = $dao->selecionar1LinhaSQL($query);
                $tipofuncionario= new TipoFuncionario();
                $tipofuncionario= $linha["id_tipofunc"];
                return $tipofuncionario;
        }


    public function getIdFuncionario(){
        //usado em:Cadastrofuncionario
        $query ="SELECT MAX(id_funcionario) as id_funcionario FROM funcionario" ;
        $dao = new DAO();
        $linha = $dao->selecionar1LinhaSQL($query);
        $funcionario= new TipoFuncionario();
        $funcionario= $linha["id_funcionario"];
        return $funcionario;
        }



    public function selecionarfuncionario(){
    //usado em:ListaDeCobrador,
    $query = "SELECT funcionario_tipofun.*, funcionario.nome 
    FROM funcionario_tipofun INNER JOIN funcionario 
    ON funcionario_tipofun.id_funcionario = funcionario.id_funcionario 
    WHERE funcionario_tipofun.id_tipofuncionario = 2; ";
    $dao = new DAO();
    $resultado = $dao->selecionarNLinhasSQL($query);
    $funcionarios= array();
    while ($linha = mysqli_fetch_assoc($resultado)){
        $funcionario= new Funcionarios();
        $funcionario->nome = $linha["nome"];
        $funcionario->idFuncionario = $linha["id_funcionario"];
        $funcionario->idTipoFuncionario = $linha["id_tipofuncionario"];
        array_push($funcionarios, $funcionario);
        }
        return ($funcionarios);       
    }
    public function getIdCobrador($nome){
    //usado em:cobrar
    $query = " SELECT * FROM `funcionario` WHERE nome = '".$nome."'";
    $dao = new DAO();
    $linha = $dao->selecionar1LinhaSQL($query);
        $funcionario= new Funcionarios();
        $funcionario= $linha["id_funcionario"];
        return $funcionario;
    }

}
    



?>
