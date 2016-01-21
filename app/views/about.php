<?php include_once ('_layouts/header.php'); ?>

<div id="loader-wrapper">
  <div id="loader"></div>
  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>
</div>

<div class="row">

	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h1 class="panel-title h1">Conheça o Employer System</h1>
	  </div>
	  <div class="panel-body marginMax">
	    <div class="col-md-6">
		    <div class="foto">
					<img src="<?= BASE_DIR; ?>public/img/loja.jpg" alt="Foto" class="img-responsive"/>
		    </div>
			</div>

			<div class="col-md-6 ">
				<div class="row">
					<h3 class="h3">O Que É...</h3>
				 	É um sistema feito para um melhor controle empregador para uma empresa.
				</div>
				<div class="row marginMin">
					<h3 class="h3 margin">Pode ser usado em Qualquer Lugar...</h3>
					Por se tratar de um sistema Web, pode ser acessado em qualquer lugar por um dispositivo conectado à internet.
				</div>
				<div class="row marginMid">
					<h3 class="h3 margin">Seu Objetivo...</h3>
				 	Busca, com foco no usuário, fazer o controle dos empregados com facilidade.
				</div>
				<div class="row marginMax">
					<h3 class="h3 margin">Totalmente Grátis...</h3>
				 	Basta acessar o site e terá acesso livre, a qualquer hora.
				</div>
			</div>

	  </div>
	</div>

</div>

<script>
	$(document).ready(function(){
		$("#funcionalidades").addClass('active');
		$("#about").addClass('active');
	});
</script>

<?php include_once ('_layouts/footer.php'); ?>
