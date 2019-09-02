$(document).ready(function() {
    $("#addNew").on('click', function () { //ao clicar para adicionar um novo
       $("#tableManager").modal('show');
    });

    $("#tableManager").on('hidden.bs.modal', function () { //quando esconde o modal
       $("#showContent").fadeOut();
       $("#editContent").fadeIn();
       $("#editRowID").val(0);
       $("#longDesc").val("");
       $("#shortDesc").val("");
       $("#countryName").val("");
       $("#closeBtn").fadeOut();
       $("#manageBtn").attr('value', 'Add New').attr('onclick', "manageData('addNew')").fadeIn();
    });

    getExistingData(0, 50);
});

function deleteRow(rowID) {  /* Excluir um registro ------------------------------------------------------------------- */
    if (confirm('Are you sure??')) {
        $.ajax({
            url: 'ajax.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key: 'deleteRow',
                rowID: rowID
            }, success: function (response) {
                $("#country_"+rowID).parent().remove();
                alert(response);
            }
        });
    }
}

function viewORedit(rowID, type) { /* para ver ou editar um registro (esta função apenas carrega os dados) ------------ */
    $.ajax({
        url: 'ajax.php',
        method: 'POST',
        dataType: 'json',
        data: {
            key: 'getRowData',
            rowID: rowID
        }, success: function (response) {
            if (type == "view") { //se for apenas para ver os detalhes
                $("#showContent").fadeIn();
                $("#editContent").fadeOut();
                $("#longDescView").html(response.longDesc);
                $("#shortDescView").html(response.shortDesc);
                $("#manageBtn").fadeOut();
                $("#closeBtn").fadeIn();
            } else { //se for para editar
                $("#editContent").fadeIn();
                $("#editRowID").val(rowID);
                $("#showContent").fadeOut();
                $("#longDesc").val(response.longDesc);
                $("#shortDesc").val(response.shortDesc);
                $("#countryName").val(response.countryName);
                $("#closeBtn").fadeOut();
                $("#manageBtn").attr('value', 'Save Changes').attr('onclick', "manageData('updateRow')");
            }

            $(".modal-title").html(response.countryName);
            $("#tableManager").modal('show');
        }
    });
}

function getExistingData(start, limit) {
    $.ajax({
        url: 'ajax.php',
        method: 'POST',
        dataType: 'text',
        data: {
            key: 'getExistingData',
            start: start,
            limit: limit
        }, success: function (response) {
            if (response != "reachedMax") {
                $('tbody').append(response);
                start += limit;
                getExistingData(start, limit);
            } else
                $(".table").DataTable();
        }
    });
}

function manageData(key) {
    var name = $("#countryName");
    var shortDesc = $("#shortDesc");
    var longDesc = $("#longDesc");
    var editRowID = $("#editRowID");

    if (isNotEmpty(name) && isNotEmpty(shortDesc) && isNotEmpty(longDesc)) {
        $.ajax({
           url: 'ajax.php',
           method: 'POST',
           dataType: 'text',
           data: {
               key: key,
               name: name.val(),
               shortDesc: shortDesc.val(),
               longDesc: longDesc.val(),
               rowID: editRowID.val()
           }, success: function (response) {
               if (response != "success"){

                   alert(response);
                   $('#tableManager').modal('hide');// Desaparece o modal
               }else {
                   $("#country_"+editRowID.val()).html(name.val());
                   name.val('');
                   shortDesc.val('');
                   longDesc.val('');
                   $("#tableManager").modal('hide'); 
                   $("#manageBtn").attr('value', 'Add').attr('onclick', "manageData('addNew')");
                  
               }
           }
        });
    }
}

function isNotEmpty(caller) {
    if (caller.val() == '') {
        caller.css('border', '1px solid red');
        return false;
    } else
        caller.css('border', '');

    return true;
}