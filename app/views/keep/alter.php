<?php include_once ('../_layouts/header.php'); ?>

<?php
  if($_GET['q']):
    include_once ('../../actions/visualize.php');
  else:
    header('Location: ./search');
  endif;
?>

<div class="col-md-12 bottom">
  <div id="alert"></div>
  <button type="button" class="btn btn-red-dark" onclick="window.location='./search'"><span class="glyphicon glyphicon-menu-left"></span> Voltar</button>
  <h4>Alterar Sistema</h4>

  <form id="alteration" method="POST" onsubmit="return false;" role="form" enctype="multipart/form-data" accept-charset="utf-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Dados do Sistema</h3>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <div class="form-group">
            <label for="descricao">Descrição <span class="obrigatorio">*</span></label>
            <input type="text" class="form-control" name="descricao" placeholder="Exemplo: O sistema tem o objetivo..." value="<?= $s->description; ?>" maxlength="100" autofocus required/>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="email">E-mail de Atendimento do Sistema <span class="obrigatorio">*</span></label>
            <input type="email" class="form-control" name="email" placeholder="Exemplo: sistema@exemplo.com" value="<?= $s->email; ?>" maxlength="100" required/>
          </div>
        </div>

        <div class="col-md-6">
          <div class="row">
            <div class="form-group">
              <div class="col-md-6">
                <label for="sigla">Sigla <span class="obrigatorio">*</span></label>
                <input type="text" class="form-control" id="sigla" name="sigla" placeholder="Exemplo: NDS" value="<?= $s->initial; ?>" maxlength="10"/>
              </div>
              <div class="col-md-6">
                <label for="url">URL <span class="obrigatorio">*</span></label>
                <input type="text" class="form-control" name="url" placeholder="Exemplo: http://www.nomedosistema.com.br" value="<?= $s->url; ?>" maxlength="50"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Controle do Sistema</h3>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <div class="form-group">
            <label for="status">Status <span class="obrigatorio">*</span></label>
            <select id="select_status" name="status" class="form-control" required>
              <option value="1">ATIVO</option>
              <option value="0">CANCELADO</option>
            </select>
          </div>
        </div>
        <div class="col-md-4 d">
          <div class="form-group">
            <label for="usuario">Usuário Responsável pela Última Alteração</label>
            <input type="text" class="form-control" name="usuario" value="MANOEL VERISSIMO DOS SANTOS NETO" disabled/>
          </div>
        </div>
        <div class="col-md-2 s">
          <div class="form-group">
            <label for="data">Data da Última Alteração</label>
            <input type="text" class="form-control" name="data" value="<?= $s->last_change; ?>" disabled/>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="data">Justificativa da Última Alteração</label>
            <textarea class="form-control" rows="3" disabled><?= $s->last_justification; ?></textarea>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="data">Nova Justificativa de Alteração <span class="obrigatorio">*</span></label>
            <textarea class="form-control" name="justification" rows="3"></textarea>
            <span class="length">Quantidade de caracteres disponíveis: <span class="count_characters"></span></span>
          </div>
        </div>
      </div>
      <span class="obrigatorio">* Campo Obrigatório</span>
    </div>
    <div class="col-md-12">
      <div class="bottom">
        <button class="btn btn-red-dark pull-right" id="alter">Salvar</button>
      </div>
    </div>
  </form>

</div>

<script>
  $(document).ready(function(){
    $("#funcionalidades").addClass('active');
    $("#search").addClass('active');
  });
</script>

<?php include_once ('../_layouts/footer.php'); ?>
