$(document).ready(function(){

// Executa quando o email tem alguma alteração
  $('input[type=email], input[name=email]').on('input change', function(){

    ValidarEmail($(this).val());

  });

  // Validando quantidade de caracteres da justificativa
  if($('textarea[name=justification]').length == 1){
    var max = 500;
    var count_characters = $('.count_characters');

    // Colocando valor máximo quando carregado a página
    count_characters.text(max);

    // Executado quando muda valor
    $('textarea[name=justification]').on('input keyup', function() {
      var digitado = $(this).val().length;
      var restante = max - digitado;
      var $this = $(this);

      if(restante < 0) {
        $this.val($this.val().substr(0, max));

      } else {
        count_characters.text(restante);
      }

    });
  }

});

// Validando Campos Obrigatórios
function ValidarCampos(obj) {
  var k = {};
  var count = 0;

  $.each(obj, function(key, value) {
    if(value == '') {
      k['key'] = key;
      count++;
      return false;
    }
  });

  if(count > 0) {
    k['return'] = true;
  } else {
    k['return'] = false;
  }

  return k;
}

// Validando Campos Nulos Pesquisa
function ValidarCamposNulos(obj) {
  var count = 0;
  var count_obj = Object.keys(obj).length;

  $.each(obj, function(key, value) {
    if(value == '') {
      count++;
    }
  });

  if(count == count_obj) {
    return true;
  } else {
    return false;
  }

}

// Validando Email
function ValidarEmail(email){

  er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;

  var input = $('input[name=email]');

  if(er.exec(email)) {
    input.get(0).setCustomValidity('');
    input.removeClass('invalido');
    return true;

  } else {
    input.addClass('invalido');
    input.popover({
      trigger: 'manual',
      placement: 'bottom',
      content: 'Email Inválido!',
    });
    input.popover('show');

    input.on('shown.bs.popover', function() {
      setTimeout(function() {
          input.popover('hide');
      }, 2000);
    });

    return false;
  }
}
