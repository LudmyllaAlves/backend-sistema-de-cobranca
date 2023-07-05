<?php
class DAO{
    public function executarQuery($query){
        $configDB = new ConfigBD;
        $conn = $configDB->getConfig();

        $retorno =0;
        $erroSQL = '';

        if (mysqli_query($conn, $query)) {
            $retorno = 1;
            //echo "New record created successfully";
        } else {
            $erroSQL = "Error: " . $query . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
        
        return $retorno;
    }
    public function selecionar1LinhaSQL($query){
        $configDB = new ConfigBD();
        $conn = $configDB->getConfig();

        $sql = mysqli_query($conn, $query) 
        or die(
            mysqli_error($conn) //caso haja um erro na consulta
            );
        $dados = mysqli_fetch_assoc($sql);
        mysqli_close($conn);
        return $dados;

    }
    public function selecionarNLinhasSQL($query){
        $configDB = new ConfigBD();
        $conn = $configDB->getConfig();

        $result = mysqli_query($conn, $query) or die(
            mysqli_error($conn) //caso haja um erro na consulta
            );
        mysqli_close($conn);
        return $result;
        
    }
    }




?>