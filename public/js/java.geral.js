// Executado quando aberto a página
$(document).ready(function() {

// Limpando Campos de Pesquisa
  function CleanInputSearch() {
    $('input[name=descricao], input[name=email], input[name=sigla]').val('');
    $('input[name=descricao]').focus();
  }

// Pesquisando sistema
  $('#research, #clean_search').on('click', function() {

    var obj_dados = {
                     'descricao' : $('input[name=descricao]').val(),
                     'email' : $('input[name=email]').val(),
                     'sigla' : $('input[name=sigla]').val()
                    };

    var validate = ValidarCamposNulos(obj_dados);
    var search = "";

    if(validate || $(this).attr('id') == 'clean_search'){
      var dados = "all="+null;

      if($(this).attr('id') == 'clean_search') {
        CleanInputSearch();
      }

    } else {
      var dados = $('#searching').serialize();
    }

    $.ajax({

       url: "../../actions/search.php",
       type: "POST",
       dataType: "json",
       data: dados,

       success: function (result) {
          var tbody = $('tbody');

          if(result.length != 0) {
            tbody.html('');

            $.each(result, function(k, value) {
              search += "<tr>";
                search += "<td>" + value.description + "</td>";
                search += "<td>" + value.initial + "</td>";
                search += "<td>" + value.email + "</td>";
                search += "<td>" + value.url + "</td>";
                search += "<td id='table_status' class='text-center'>" + value.status + "</td>";
                search += "<td class='text-center'>";
                  search += "<button class='btn btn-red-dark' onclick='location=\"alter?q=" + value.id + "\"'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button>";
                search += "</td>";
              search += "</tr>";
            });

          } else {
            $('#alert').addClass('alert alert-danger').html('Nenhum Sistema foi encontrado. Favor revisar os critérios da sua pesquisa!').delay(4000).fadeOut(0);
          }

          tbody.append(search);
       },
       error: function(result) {
          $('#alert').addClass('alert alert-danger').html().show('100');
       }
    });
  });

// Incluindo sistema
  $('#save').on('click', function() {
    $('input').removeClass('invalido');
    var obj_dados = {
                     'descricao' : $('input[name=descricao]').val(),
                     'email' : $('input[name=email]').val(),
                     'sigla' : $('input[name=sigla]').val(),
                     'url' : $('input[name=url]').val()
                    };

    var validate = ValidarCampos(obj_dados);

    if(validate.return){
      alert("Dados obrigatórios não informados.");
      $('input[name='+validate.key+']').addClass('invalido');
      return false;

    } else {
      var dados = $('#newer').serialize();

      $.ajax({

         url: "../../actions/insert.php",
         type: "POST",
         dataType: "html",
         data: dados,

         success: function (result) {
            $('#alert').addClass('alert alert-success').html(result).delay(4000).fadeOut(0);
            setTimeout('window.location.href="./search"',1400);
         },
         error: function(result) {
            $('#alert').addClass('alert alert-danger').html().show('100');
         }
      });
    }
  });

// Alterando sistema
  $('#alter').on('click', function() {
    $('input').removeClass('invalido');
    var obj_dados = {
                     'descricao' : $('input[name=descricao]').val(),
                     'email' : $('input[name=email]').val(),
                     'sigla' : $('input[name=sigla]').val(),
                     'url' : $('input[name=url]').val(),
                     'status' : $('select[name=status]').val()
                    };

    var validate = ValidarCampos(obj_dados);

    if(validate.return){
      alert("Dados obrigatórios não informados.");
      $('input[name='+validate.key+']').addClass('invalido');
      return false;

    } else {
      var dados = $('#alteration').serialize() + "&q=" + q;

      $.ajax({

         url: "../../actions/alter.php",
         type: "POST",
         dataType: "html",
         data: dados,

         success: function (result) {
            $('#alert').addClass('alert alert-success').html(result).delay(4000).fadeOut(0);
            $('html,body').animate({ scrollTop: 0 }, 'slow');
            setTimeout('window.location.href="./search"', 1400);
         },
         error: function(result) {
            $('#alert').addClass('alert alert-danger').html().show('100');
         }
      });
    }
  });

// Selecionando status na alteração
  if($('#select_status').length == 1){
    var $this = $('#select_status');
    $this.children('option[value="' + status + '"]').attr('selected',true);
  }

});
