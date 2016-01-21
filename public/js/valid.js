$(document).ready(function(){

// Executa quando o email tem alguma alteração
  $('input[type=email]').on('change', function(){

    var validate = ValidarEmail($(this).val());

    if(!validate){

      $(this).addClass('invalido');
      $(this).get(0).setCustomValidity('E-mail inválido.');
      return false;

    } else {
      $(this).get(0).setCustomValidity('');
      $(this).removeClass('invalido');
    }

  });

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

  if(er.exec(email)) {
    return true;

  } else {
    return false;
  }
}
