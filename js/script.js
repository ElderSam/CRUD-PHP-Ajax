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


