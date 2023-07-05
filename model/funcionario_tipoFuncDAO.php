<?php
include_once('../model/funcionario_tipoFunc.php');
include_once('../model/DAO.php');
class TipoFuncDAO{
    public function validarTipoFunc($idFuncionario, $idTipoFuncionario){
        $query =
        " SELECT * ".
        "   FROM funcionario_tipoFun ".
        "  WHERE id_funcionario= '".$idFuncionario."'".
        "    AND id_tipofuncionario= '".$idTipoFuncionario."'";
        
        $dao = new DAO();
        $resultado = $dao->selecionar1LinhaSQL($query);

        $id =0;
        try {
            if ( isset($resultado["id"]) ){
                $id = $resultado["id"];
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
    
    public function selecionarCobrador(){
        $query = " SELECT id_funcionario FROM funcionario_tipoFun WHERE id_tipofuncionario = '2'";
        $dao = new DAO();
        $resultado = $dao->selecionarNLinhasSQL($query);
        $funcionarios=array();
        
        while ($linha = mysqli_fetch_assoc($resultado)) {
            $funcionario = new TipoFunc();
            $funcionario->idFuncionario = $linha["id_funcionario"];
            array_push($funcionarios, $funcionario);
        }
        return $funcionarios;
    }    
}



?>