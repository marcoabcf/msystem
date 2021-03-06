<?php include_once ('../_layouts/header.php'); ?>

<div id="loader-wrapper">
  <div id="loader"></div>
  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>
</div>

<div class="col-md-12">
  <form id="searching" method="POST" onsubmit="return false;" role="form" enctype="multipart/form-data" accept-charset="utf-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Filtro de Consulta</h3>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" name="descricao" placeholder="O sistema tem o objetivo..." maxlength="100" autofocus/>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="email">E-mail de Atendimento do Sistema</label>
            <input type="text" class="form-control" name="email" placeholder="sistema@exemplo.com" maxlength="100" novalidate/>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="sigla">Sigla</label>
            <input type="text" class="form-control" name="sigla" placeholder="NDS" maxlength="10"/>
          </div>
        </div>
      </div>
      <div class="form-group pull-right">
        <button class="btn btn-red-dark" id="research">Pesquisar</button>
        <button class="btn btn-primary-dark" id="clean_search">Limpar</button>
      </div>
    </div>
  </form>
</div>

<div class="col-md-12" id="table_search"></div>

<script>
  $(document).ready(function(){
    $("#funcionalidades").addClass('active');
    $("#search").addClass('active');

    // Executando listagem tbody ao carregar página
    List("pagina_atual=1");
  });
</script>

<?php include_once ('../_layouts/footer.php'); ?>
