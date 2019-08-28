<?php
    /* toda vez que carrega a página principal */
    
    include_once "connection.php";

    $sql = "SELECT * FROM comments";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_OBJ); //Fatia todos os registros retornados em array

    foreach($row as $r){
        echo "<p>";
        echo $r->comment_content;
        
        echo "</p>";
    }
?>