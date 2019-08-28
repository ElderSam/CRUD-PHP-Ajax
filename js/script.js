$(function(){

    $('form#form-msg').submit(function(){ //ao enviar formulário
        $.ajax({
            type: 'POST',
            url: 'action.php', //destino dos dados
            data: {
                mensagem: $('textarea[name=mensagem]').val()//conteúdo do campo textarea do formulário
            } 
         
        }).done(function(e) {
                $('div#comments').append(e); //mostra o conteúdo do registro salvo no banco recentemente
                $('textarea[name=mensagem]').val('') //esvazia o input
              //alert( 'Data Saved: ' + msg );
        });

        return false;
    });




});