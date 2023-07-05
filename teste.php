<?php
/*
        
        $nome = ($_POST['nome']);
        $sexo = ($_POST['sexo']);
        $idade= ($_POST['idade']);
        printf($nome);
        echo($sexo); 
        printf('<script>alert: </script>',$idade);

        /*$json= file_get_contents($arquivoClientes);
        if($arquivoClientes !=0){
        $decodificado = json_decode($json,true);
        print($decodificado);
        }
        
        die('erro ao enviar');*/
    
/*
if(isset($_FILES['nomecliente'])){
    $obUpload = new Upload($_FILES['nomecliente']);
    $sucesso = $obUpload->upload(__DIR__.'/upload');
    if($sucesso){
        echo "arquivo enviado com sucesso";
        $arquivoClientes = $obUpload->getRota(__DIR__.'/upload');
        $json= file_get_contents($arquivoClientes);
        $decodificado = json_decode($json,true);}
        else{
    print('errro');
}
}else{
    print('não post');
}*/
$nome = ($_POST['numero']);

print (json_encode("Isso ai mano, tudo certo"));

header("http://localhost:8080/teste1");
?>