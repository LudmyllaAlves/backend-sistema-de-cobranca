<?php
session_start();
include_once('../model/config.php');
include_once('../model/clienteDAO.php');
include_once('../model/DAO.php');
include_once('../model/cliente.php');
include_once('../model/upload.php');

$configDB = new ConfigBD;
$conn = $configDB->getConfig();
$clienteDAO = new ClienteDAO();
$cliente = $clienteDAO->getClientes();

if($_SESSION['tipo_funcionario'] ==1){
    if(isset($_FILES['arquivos'])){
        $obUpload = new Upload($_FILES['arquivos']);
        $sucesso = $obUpload->upload(__DIR__.'/upload');
        if($sucesso){
            $arquivoClientes = $obUpload->getRota(__DIR__.'/upload');
            $json= file_get_contents($arquivoClientes);
            $decodificado = json_decode($json,true);
            
            foreach($decodificado as $compra){
                $query = "SELECT * FROM `compras` WHERE id_compras = '".$compra['id_compras']."' ";
                $verifique = mysqli_query($conn, $query);
                    
                if(mysqli_num_rows($verifique) == 0){
                    
                        if($cliente['id_cliente'] = $compra['id_cliente']){
                            $query= "INSERT INTO `compras` ( `id_compras`,`id_cliente`, `valor`, `valor_pago`, `pago`) 
                            VALUES ('".$compra['id_compras']."','".$compra['id_cliente']."', '".$compra['valor']."', '".$compra['valor_pago']."', '".$compra['pago']."')";
                            $inserir = mysqli_query($conn, $query);
                            echo" Dados inseridos<br>";
                            
                        }else{
                            echo"<script>
                            alert('Não é possivel buscar clientes');
                            window.location.href='http://localhost:8080/importarcompras'
                            </script>";
                            echo "Não é possivel buscar clientes<br>";
                            //header('Location: http://localhost:8080/homeadmin');
                        }
                        }else{
                            echo"<script>
                            alert('Dados não podem ser inseridos');
                            window.location.href='http://localhost:8080/importarcompras'
                            </script>";
                            echo "Não é possivel buscar clientes<br>";
                    }
            }
        }
    }

}else{
    echo"<script>
    alert('Dados não podem ser inseridos');
    window.location.href='http://localhost:8080/importarcompras'
    </script>";
    echo "Não é possivel buscar clientes<br>";
}
    mysqli_close($conn);

?>
