<?php
session_start();
include_once("../model/config.php");
include_once("../model/funcionariosDAO.php");

if($_SESSION['tipo_funcionario'] == 1){
    $nome =$_POST["nome"];
    $senha=$_POST["senha"];
    $tipofuncionario= $_POST["tipofuncionario"];
    $configDB = new ConfigBD;
    $conn = $configDB->getConfig();

    $funcionarioDAO = new FuncionariosDAO();
    $validar = $funcionarioDAO->ValidarLogin($nome, $senha);
    $tipofunc =  $funcionarioDAO->getTipoFuncionarios($tipofuncionario);


    if(isset($_POST['cadastrar'])){
        if($validar < 1){
            //Cria um novo funcionario
            $query ="INSERT INTO `funcionario` (`nome`, `senha`)
            VALUES ('$nome', '$senha')";
            $funcionario = mysqli_query($conn,$query);
            if($funcionario){
                $idfuncionario = $funcionarioDAO->getIdFuncionario();
                    if($idfuncionario != 0){
                        if($tipofunc != 0){
                            //cria um novo funcionario com tipo e id;
                                $query1 = "INSERT INTO `funcionario_tipofun` (`id_funcionario`, `id_tipofuncionario`) 
                                VALUES ('$idfuncionario', '$tipofunc')";
                                $inserir = mysqli_query($conn, $query1);
                                
                                echo("<script>
                                window.location.href = 'http://localhost:8080/cadastrarfuncionario'
                                alert('Funcionario Cadastrado com Sucesso " ) ;
                                echo ("');</script>");
                                
                                
                            }else{
                                echo("<script>
                                window.location.href = 'http://localhost:8080/cadastrarfuncionario'
                                alert('Funcionario não cadastrado" ) ;
                                echo ("');</script>");
                                
                            }
                    }else{
                        echo("<script>
                                window.location.href = 'http://localhost:8080/'
                                alert('Você não pode fazer essas alterações!!! " ) ;
                                echo ("');</script>");
                    }
                }
        }else{
            echo("<script>
            window.location.href = 'http://localhost:8080/cadastrarfuncionario'
            alert('Este Funcionario já está cadastrado!!!" ) ;
            echo ("');</script>");
        }
    }
}else{
    echo("<script>
        window.location.href = 'http://localhost:8080/'
        alert('Você não é administrador " ) ;
        echo ("');</script>");
}
?>

