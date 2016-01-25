// Executado quando aberto a página
$(document).ready(function() {

  // Pesquisando sistema
  $('#research, #clean_search').on('click', function() {
    // Fechando Alert e chamada de pesquisa
    $('#alert').alert('close');
    ExecutarSearchButton(this);
  });

  // Incluindo sistema
  $('#save').on('click', function() {

    // Removendo toda classe existente nos inputs chamada 'invalido'
    $('input').removeClass('invalido');

    // Criando Objeto com dados e validando campos nulos
    var obj_dados = {
                     'descricao' : $('input[name=descricao]').val(),
                     'email' : $('input[name=email]').val(),
                     'sigla' : $('input[name=sigla]').val(),
                     'url' : $('input[name=url]').val()
                    };

    var validate = ValidarCampos(obj_dados);
    var email_validate = ValidarEmail(obj_dados.email);

    // Caso algum input esteja vazio
    if(validate.return){
      alert("Dados obrigatórios não informados.");
      $('input[name='+validate.key+']').addClass('invalido');
      return false;

    } else if(!email_validate){
      return false;

    } else {
      var dados = $('#newer').serialize();

      $.ajax({

         url: "../../actions/insert.php",
         type: "POST",
         dataType: "html",
         data: dados,

         success: function (result) {
            alert(result);
            setTimeout('window.location.href="./search"',0);
         },
         error: function(result) {
            alert(result);
         }
      });
    }
  });

  // Alterando sistema
  $('#alter').on('click', function() {

    var campo_nulo;

    // Removendo toda classe existente nos inputs chamada 'invalido'
    $('input').removeClass('invalido');

    // Criando Objeto com dados e validando campos nulos
    var obj_dados = {
                     'descricao' : $('input[name=descricao]').val(),
                     'email' : $('input[name=email]').val(),
                     'sigla' : $('input[name=sigla]').val(),
                     'url' : $('input[name=url]').val(),
                     'status' : $('select[name=status]').val(),
                     'justification' : $('textarea[name=justification]').val()
                    };

    var validate = ValidarCampos(obj_dados);
    var email_validate = ValidarEmail(obj_dados.email);

    // Caso algum input esteja vazio
    if(validate.return){
      alert("Dados obrigatórios não informados.");

      var textarea = $('textarea[name='+validate.key+']');

      if(textarea.length == 1){
        campo_nulo = $('textarea[name='+validate.key+']');

      } else {
        campo_nulo = $('input[name='+validate.key+']');
      }

      campo_nulo.addClass('invalido');
      campo_nulo.focus();
      return false;

    } else if(!email_validate){
      return false;

    } else {
      var dados = $('#alteration').serialize() + "&q=" + q;

      $.ajax({
         url: "../../actions/alter.php",
         type: "POST",
         dataType: "html",
         data: dados,

         success: function (result) {
            alert(result);
            setTimeout('window.location.href="./search"', 0);
         },
         error: function(result) {
            alert(result);
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

// Função executada quando acionado algum botão do formulário de pesquisa
function ExecutarSearchButton(seletor) {

  // Criando Objeto com dados e validando campos nulos
  var obj_dados = {
                   'descricao' : $('input[name=descricao]').val(),
                   'email' : $('input[name=email]').val(),
                   'sigla' : $('input[name=sigla]').val()
                  };

  var validate = ValidarCamposNulos(obj_dados);

  // Verifica se existe algo em email
  if(obj_dados.email) {
    var email_validate = ValidarEmail(obj_dados.email);
  }

  // Verificando se a os campos foram nulos e/ou se o botão clicado foi limpar pesquisa
  if(validate || $(seletor).attr('id') == 'clean_search'){
    var dados = "all=true";

    // Caso seja botão limpar pesquisa
    if($(seletor).attr('id') == 'clean_search') {
      CleanInputSearch(dados);
    }

  } else {
    var dados = $('#searching').serialize();

    // Verifica os campos com valores e lista dados da pesquisa
    if(
        ((obj_dados.descricao  || obj_dados.sigla) && !obj_dados.email)                     ||
        ((!obj_dados.descricao || !obj_dados.sigla) && (obj_dados.email && email_validate)) ||
        ((obj_dados.descricao  || obj_dados.sigla) && (obj_dados.email && email_validate))
      ){

      List(dados);
    }
  }

}

// Listagem de dados do banco
function List(dados) {

  $.ajax({

     url: "../../actions/search.php",
     type: "POST",
     dataType: "json",
     data: dados,
     success: RetornoPesquisar,
     error: function(result) {
        $('#alert').addClass('alert alert-danger').html(result);
     }
  });
}

// Retorno do callback da funcao de pesquisa
function RetornoPesquisar(result) {

  // Definindo variáveis como ID
  var table = $('#table_search');

  if(result.tabela.length == 0) {
    if(table.html()) {
      alert("Nenhum Sistema foi encontrado. Favor revisar os critérios da sua pesquisa!");
    }
  } else {
    // Inserindo tabela na página
    table.html('<table class="table table-responsive table-hover"><thead><tr><th class="col-md-4">Descrição</th><th>Sigla</th><th>E-mail de Atendimento</th><th>URL</th><th class="text-center">Status</th><th class="text-center">Ações</th></tr></thead><tbody></tbody></table><span id="paginacao"></span>');

    var tbody = $('tbody');
    var pagination = $('#paginacao');

    // Limpando e inserindo: paginação, e o resultado no tbody da tabela
    tbody.html('').append(PercorrerResult(result));
    pagination.html('').append(result.paginacao);
  }
}

// Navegando com paginação
function NavegarPaginacao(pagina_atual, apartir) {

  var dados = $('#searching').serialize();
  dados +=  "&pagina_atual=" + pagina_atual + "&apartir=" + apartir;

  $.ajax({
     url: "../../actions/search.php",
     type: "POST",
     dataType: "json",
     data: dados,
     success: RetornoPesquisar,
     error: function(result) {
        $('#alert').addClass('alert alert-danger').html(result);
     }
  });
}

// Percorrendo resultado, e criando e retornando html
function PercorrerResult(result) {
  var search = '';

  $.each(result.tabela, function(k, value) {
    search += "<tr>";
      search += "<td>" + value.description + "</td>";
      search += "<td class='col-md-1'>" + value.initial + "</td>";
      search += "<td class='col-md-3'>" + value.email + "</td>";
      search += "<td class='col-md-3'>" + value.url + "</td>";
      search += "<td id='table_status' class='text-center'>" + value.status + "</td>";
      search += "<td class='text-center'>";
        search += "<button class='btn btn-red-dark' onclick='location=\"alter?q=" + value.id + "\"'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button>";
      search += "</td>";
    search += "</tr>";
  });

  return search;
}

// Limpando campos de pesquisa
function CleanInputSearch(dados) {
  // Removendo toda classe existente nos inputs chamada 'invalido'
  $('input').removeClass('invalido');
  $('input[name=email]').get(0).setCustomValidity('');

  $('input[name=descricao], input[name=email], input[name=sigla]').val('');
  $('input[name=descricao]').focus();

  List(dados);
}
