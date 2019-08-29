<?php

   /* if(isset($_GET['bd'])){
        if($_GET['bd'] == 'error'){
            echo "<script> alert('Ocorreu um erro no banco de dados, tente novamente mais tarte'); </script>";
        }
    }*/
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AJAX</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- JS, Popper.js, and jQuery -->
    <script src="jquery-3.4.1.min.js"></script>
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script-->
    
    <!--script type="text/javascript" src="js/script.js"></script-->
    <style>
    body{
        margin: 0;
        padding: 0;
    }
    section{
        padding: 0 30%;
    }
    @media(max-width: 700px){
        section{
            padding: 0 10%;
        }
    }
    </style>
</head>
<body>
    <section>
        <div class="cadastro">
            <form action="action.php" method="POST">
                
                   
                        <input type="text" name="mensagem" required=""/>
                      
                   
                    <input type="submit" name="submit" value="submit"/>
              
            </form>
        </div>

        <div id="comments">

        
        <!--recebe o que está no banco de dados-->
        </div>
    </section>

    <script>
        $(document).ready(function(){ //quando a página estiver 'baixada', pronta
            loadData(); //carrega os dados

            $('form').on('submit', function(e){ //ao enviar formulário
                e.preventDefault();
                $.ajax({
                    type: $(this).attr('method'), //'POST'
                    url: $(this).attr('action'), //destino dos dados (ex: action.php)
                    data: $(this).serialize(), //data: {    mensagem: $('input[name=mensagem]').val()//conteúdo do campo input do formulário    } 
                    success:function(){
                        loadData();
                        resetForm();
                    }
                }); 
            })
        })



        function loadData(){
            $.get('data.php', function(data){
                $('#comments').html(data); //mostra o conteúdo retornado na página
                
                //para deletar dados
                $('.deleteData').click(function(e){
                    e.preventDefault();
                    $.ajax({
                        type: 'get',
                        url: $(this).attr('href'),
                        success:function(){
                            loadData(); //recarrega os dados toda vez que deletar
                        }
                    });
                });

                //para atualizar dados
                $('.updateData').click(function(atualiza){
                    atualiza.preventDefault();
                    $('[name=mensagem]').val($(this).attr('comment_content'));
                    $('form').attr('action', $(this).attr('href'));
                });
            })
        }

        function resetForm(){
            $('[type=text]').val(''); //esvazia o input
            $('[name=mensagem]').focus(); //coloca o cursos do mouse na caixa de texto
            $('form').attr('action', 'action.php');
        }


        
    </script>
</body>
</html>