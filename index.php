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
    
    <script type="text/javascript" src="js/script.js"></script>
  
</head>
<body>
    <section>
        <div class="cadastro">
            <form id="form-msg" action="" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <p>
                        <h1> digite seu comentário: </h1>
                        <textarea name="mensagem" required=""></textarea>
                    </p>
                    <input type="submit" value="enviar">
                </fieldset>
            </form>
        </div>

        <div id="comments">

        
        <!--recebe o que está no banco de dados-->
        </div>
    </section>

    <script>
        $(document).ready(function(){
            loadData();
        });

        function loadData(){
            $.get('data.php', function(data){
                $('#comments').html(data) //mostra o conteúdo retornado na página
            })
        }
    </script>
</body>
</html>