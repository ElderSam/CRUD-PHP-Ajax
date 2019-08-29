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
        if($row){
            $link_delete = "<a class='deleteData' href='delete.php?deleteId=". $row->comment_id."'>Delete</a>";
            $link_update = "<a class='updateData'  href='update.php?updateId=". $row->comment_id. "' comment_content='" . $row->comment_content . "'>Update</a>";
           
            echo "<p>";
            echo "$row->comment_content  | $link_delete | $link_update <br/>";    
            echo "</p>";
        }
        else{
            echo "Error Message Data <br/>" . $pdo->errorInfo();
        }
    }
?>