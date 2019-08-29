<?php

include_once 'connection.php';

if(isset($_GET['updateId']) && isset($_POST['mensagem'])){
    $updateId = $_GET['updateId'];
    $mensagem = $_POST['mensagem'];


    $sql = "UPDATE comments SET comment_content = ? WHERE comment_id =?";
    $up = $pdo->prepare($sql);
    $up->execute(array($mensagem, $updateId ));
    
    if($up){
        echo "Data Updated!";
    }
    else{
        echo "Erro ao tentar Atualizar, possivelmente tem algo errado com a conexão com o banco de dados";
  
    }
    
}
else{
    echo "não recebeu os dados necessários para Atualização do banco de dados
    <br/> Atualização cancelada";
}


?>