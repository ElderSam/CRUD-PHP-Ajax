<?php
    /* toda vez que carrega a página principal */
    
    include_once "connection.php";

    $sql = "SELECT * FROM comments";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_OBJ); //Fatia todos os registros retornados em array

    foreach($row as $r){
        $link_delete = "<a class='deleteData' href='delete.php?deleteId=".$r->comment_id."'>Delete</a>";
        echo "<p>";
        echo $r->comment_content . " | $link_delete<br/>";    
        echo "</p>";
    }
?>