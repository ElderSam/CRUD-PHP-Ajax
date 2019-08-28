<?php

$HOSTNAME = "localhost"; 			
$USERNAME = "root"; 			
$PASSWORD = ""; 			
$DBNAME = "test"; 	


//Conexão mysql
try{

$pdo = new PDO(
"mysql:dbname=".$DBNAME.";host=".$HOSTNAME, $USERNAME, $PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch(PDOException $e){
echo  'ERROR: ' . $e->getMessage();
//header('Location: index.php?bd=BDerror');
//echo "<script> window.location = 'index.php?bd=error'; </script>"; //volta para a página inicial com mensagem de erro
echo "<script> alert('ocorreu um erro com o banco de dados');</script>";    

}

?>