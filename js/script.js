$(function(){

    $('form').submit(function(e){ //ao enviar formulário
        e.preventDefault();
        $.ajax({
            type: $(this).attr('method'), //'POST'
            url: $(this).attr('action'), //destino dos dados (ex: action.php)
            data: $(this).serialize(), //data: {    mensagem: $('textarea[name=mensagem]').val()//conteúdo do campo textarea do formulário    } 
            success:function(){
                loadData();
                resetForm();
            }
        }); 
    })

      
    });