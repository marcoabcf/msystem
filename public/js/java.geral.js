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

    // Caso algum input esteja vazio
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
            $('#alert').addClass('alert alert-success').html('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + result);
            setTimeout('window.location.href="./search"',1400);
         },
         error: function(result) {
            $('#alert').addClass('alert alert-danger').html(result);
         }
      });
    }
  });

  // Alterando sistema
  $('#alter').on('click', function() {

    // Removendo toda classe existente nos inputs chamada 'invalido'
    $('input').removeClass('invalido');

    // Criando Objeto com dados e validando campos nulos
    var obj_dados = {
                     'descricao' : $('input[name=descricao]').val(),
                     'email' : $('input[name=email]').val(),
                     'sigla' : $('input[name=sigla]').val(),
                     'url' : $('input[name=url]').val(),
                     'status' : $('select[name=status]').val()
                    };

    var validate = ValidarCampos(obj_dados);

    // Caso algum input esteja vazio
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
            $('#alert').addClass('alert alert-success').html('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + result);
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

  // Executando listagem tbody ao carregar página
  if($('#searching').length == 1) {
    List("all=true");
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

  // Verificando se a os campos foram nulos e/ou se o botão clicado foi limpar pesquisa
  if(validate || $(seletor).attr('id') == 'clean_search'){
    var dados = "all=true";

    // Caso seja botão limpar pesquisa
    if($(seletor).attr('id') == 'clean_search') {
      CleanInputSearch();
    }

  } else {
    var dados = $('#searching').serialize();
  }

  List(dados);
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
  var pagination = $('#paginacao');
  var tbody = $('tbody');

  if(result.tabela.length != 0) {

    // Limpando e inserindo: paginação, e o resultado no tbody da tabela
    tbody.html('').append(PercorrerResult(result));
    pagination.html('').append(result.paginacao);

  } else {
    $('#alert').addClass('alert alert-danger').html('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Nenhum Sistema foi encontrado. Favor revisar os critérios da sua pesquisa!');
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
      search += "<td>" + value.initial + "</td>";
      search += "<td>" + value.email + "</td>";
      search += "<td>" + value.url + "</td>";
      search += "<td id='table_status' class='text-center'>" + value.status + "</td>";
      search += "<td class='text-center'>";
        search += "<button class='btn btn-red-dark' onclick='location=\"alter?q=" + value.id + "\"'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button>";
      search += "</td>";
    search += "</tr>";
  });

  return search;
}

// Limpando campos de pesquisa
function CleanInputSearch() {
    $('input[name=descricao], input[name=email], input[name=sigla]').val('');
    $('input[name=descricao]').focus();
}

