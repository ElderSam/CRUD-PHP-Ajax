<?php 
    if(count($_POST) > 0){
        
        include_once "connection.php";

        $msg = $_POST['mensagem'];
       
        //inserção
        $sql = "INSERT INTO comments(comment_content) VALUES(?)";
        $query = $pdo->prepare($sql);
        $query->execute(array($msg));
       
        //Consulta
        $sql = "SELECT * FROM comments ORDER BY comment_id DESC LIMIT 1";
        $query = $pdo->prepare($sql);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_OBJ); //pega apenas uma linha (fetch)
        
        echo "<p>";   
        echo $row->comment_content;
     
        echo "</p>";

    }
?>