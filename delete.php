<?php

include_once 'connection.php';

if(isset($_GET['deleteId'])){
    $deleteId = $_GET['deleteId'];
    $sql = "DELETE FROM comments WHERE comment_id =?";
    $del = $pdo->prepare($sql);
    $del->execute(array($deleteId));
    
    if($del){
        echo "Data Deleted!";
    }
    else{
        echo "Erro ao tentar excluir, possivelmente tem algo errado com a conexão com o banco de dados";
    }
}
else{
    echo "não recebeu ID para excluir do banco de dados
    <br/> Exclusão cancelada";
}


?>