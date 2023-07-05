<?php
session_start();
include_once('../model/config.php');
include_once('../model/upload.php');
$configDB = new ConfigBD;
$conn = $configDB->getConfig();

if($_SESSION['tipo_funcionario'] == 1){
    if(isset($_FILES['arquivos'])){
        $obUpload = new Upload($_FILES['arquivos']);
        $sucesso = $obUpload->upload(__DIR__.'/upload');
        if($sucesso){
            $arquivoClientes = $obUpload->getRota(__DIR__.'/upload');
            $json= file_get_contents($arquivoClientes);
            $decodificado = json_decode($json,true);

            foreach($decodificado as $cliente){
            $query = "SELECT * FROM `cliente` WHERE id_cliente = '".$cliente['id_cliente']."' ";
            $verifique = mysqli_query($conn, $query);

                if(mysqli_num_rows($verifique)==0){
                $query= "INSERT INTO `cliente` ( `id_cliente`,`nome`, `endereco`, `telefone`, `cpf`) 
                VALUES ('".$cliente['id_cliente']."','".$cliente['nome']."', '".$cliente['endereco']."', '".$cliente['telefone']."', '".$cliente['cpf']."')";
                $inserir = mysqli_query($conn, $query);
                }
        }
        echo"<script>
            alert('Arquivos enviados');
            window.location.href='http://localhost:8080/importarclientes'
            </script>";
    }
        }else{
                echo"<script>
                    alert('Pasta não enviada ');
                    window.location.href='http://localhost:8080/importarclientes'
                    </script>";
                }
        }else{
            echo"<script>
            alert('Este funcionario não pode realizar está função ');
            window.location.href='http://localhost:8080/importarclientes'
            </script>";
        }
                mysqli_close($conn);

?>
