$(function(){

    $('form#form-msg').submit(function(e){ //ao enviar formulário
        e.preventDefault();
        $.ajax({
            type: $(this).attr('method'), //'POST'
            url: $(this).attr('action'), //destino dos dados (ex: action.php)
            data: $(this).serialize(), //data: {    mensagem: $('textarea[name=mensagem]').val()//conteúdo do campo textarea do formulário    } 
            success:function(){
                loadData();
            }
        }); /*.done(function(e) {
                $('div#comments').append(e); //mostra o conteúdo do registro salvo no banco recentemente
                $('textarea[name=mensagem]').val('') //esvazia o input
              //alert( 'Data Saved: ' + msg );*/
        })

       // return false;
    });