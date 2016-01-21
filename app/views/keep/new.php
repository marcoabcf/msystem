<?php include_once ('../_layouts/header.php'); ?>

<div class="col-md-12">
<div id="alert"></div>
  <button type="button" class="btn btn-red-dark" onclick="window.location='./search'"><span class="glyphicon glyphicon-menu-left"></span> Voltar</button>
  <h4>Novo Sistema</h4>

  <form id="newer" method="POST" onsubmit="return false;" role="form" enctype="multipart/form-data" accept-charset="utf-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Dados do Sistema</h3>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <div class="form-group">
            <label for="descricao">Descrição <span class="obrigatorio">*</span></label>
            <input type="text" class="form-control" name="descricao" placeholder="Exemplo: O sistema tem o objetivo..." maxlength="100" autofocus required/>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="email">E-mail de Atendimento do Sistema <span class="obrigatorio">*</span></label>
            <input type="email" class="form-control" name="email" placeholder="Exemplo: sistema@exemplo.com" maxlength="100" required/>
          </div>
        </div>

        <div class="col-md-6">
          <div class="row">
            <div class="form-group">
              <div class="col-md-6">
                <label for="sigla">Sigla <span class="obrigatorio">*</span></label>
                <input type="text" class="form-control" id="sigla" name="sigla" placeholder="Exemplo: NDS" maxlength="10"/>
              </div>
              <div class="col-md-6">
                <label for="url">URL <span class="obrigatorio">*</span></label>
                <input type="text" class="form-control" name="url" placeholder="Exemplo: http://www.nomedosistema.com.br" maxlength="50"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <span class="obrigatorio">* Campo Obrigatório</span>
    </div>
    <button class="btn btn-red-dark pull-right" id="save">Salvar</button>
  </form>
</div>

<script>
  $(document).ready(function(){
    $("#funcionalidades").addClass('active');
    $("#new").addClass('active');
  });
</script>

<?php include_once ('../_layouts/footer.php'); ?>
