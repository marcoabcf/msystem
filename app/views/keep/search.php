<?php include_once ('../_layouts/header.php'); ?>
<?php include_once ('../../actions/list.php'); ?>

<div id="loader-wrapper">
  <div id="loader"></div>
  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>
</div>

<div class="col-md-12">
  <div id="alert"></div>
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
            <input type="text" class="form-control" name="email" placeholder="sistema@exemplo.com" maxlength="100"/>
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

<?php if(count($list) != 0): ?>
  <div class="col-md-12">
    <table class="table table-responsive table-hover">
      <thead>
        <tr>
           <th class="col-md-4">Descrição</th>
           <th>Sigla</th>
           <th>E-mail de Atendimento</th>
           <th>URL</th>
           <th class="text-center">Status</th>
           <th class="text-center">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($list as $s): ?>
          <tr>
            <td><?= $s->description; ?></td>
            <td><?= $s->initial; ?></td>
            <td><?= $s->email; ?></td>
            <td><?= $s->url; ?></td>
            <td id="table_status" class="text-center"><?= $s->status; ?></td>
            <td class="text-center">
              <button class="btn btn-red-dark" onclick="location='alter?q=<?= $s->id; ?>'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <nav>
      <ul class="pagination">
        <li>
          <a href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li>
          <a href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
<?php endif; ?>

<script>
  $(document).ready(function(){
    $("#funcionalidades").addClass('active');
    $("#search").addClass('active');
  });
</script>

<?php include_once ('../_layouts/footer.php'); ?>
