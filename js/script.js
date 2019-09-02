$(document).ready(function(){ //quando a página estiver 'baixada', pronta
    loadData(); //carrega os dados

   
    $('form').on('submit', function(e){ //ao enviar formulário
        //$('#addModal').modal('hide');
        
        e.preventDefault();
        $.ajax({
            type: $(this).attr('method'), //'POST'
            url: $(this).attr('action'), //destino dos dados (ex: action.php)
            data: $(this).serialize(), //data: {    mensagem: $('input[name=mensagem]').val()//conteúdo do campo input do formulário    } 
            success:function(){
                loadData();      
                resetForm();
                $('.modal').modal('hide');
                
            }
        }); 
    })
})



function loadData(){
    $.get('data.php', function(data){

        $('#comments').html(data); //mostra o conteúdo retornado na página

        //para atualizar dados
        $('.updateData').click(function(atualiza){
          
            atualiza.preventDefault();
            $('[name=mensagem]').val($(this).attr('comment_content'));
            $('form').attr('action', $(this).attr('href'));
        });

                
        //para deletar dados
        $('.deleteData').click(function(deleta){

            deleta.preventDefault();
            $('[name=commentDelete]').val($(this).attr('comment_content')); //mostra qual ele está tentando excluir
            $('form').attr('action', $(this).attr('href'));
        });


    })
}

function resetForm(){
    $('[type=text]').val(''); //esvazia o input
    $('[name=mensagem]').focus(); //coloca o cursos do mouse na caixa de texto
    $('form').attr('action', 'action.php');
}


