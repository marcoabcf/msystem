<!DOCTYPE html>
<html lang="pt-BR">
  <?php include_once('basedir.php'); ?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Declarando o favicon do sistema -->
    <link rel="icon" type="image/png" href="<?= BASE_DIR; ?>public/img/favicon.png" />

    <!-- Declarando os estilos que são usados em todas as páginas -->
    <link rel="stylesheet" href="<?= BASE_DIR; ?>public/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_DIR; ?>public/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_DIR; ?>public/css/loader.css">

    <!-- Declarando os javascripts que são usados em todas as páginas -->
    <script src="<?= BASE_DIR; ?>public/js/jquery-1.11.1.min.js"></script>
    <script src="<?= BASE_DIR; ?>public/js/bootstrap.min.js"></script>
    <script src="<?= BASE_DIR; ?>public/js/jquery.mask.js"></script>
    <script src="<?= BASE_DIR; ?>public/js/java.geral.js"></script>
    <script src="<?= BASE_DIR; ?>public/js/valid.js"></script>

    <title>mSystem - Segurança Digital</title>

    <header>
      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <div class="logo">
              <img src="<?= BASE_DIR; ?>public/img/logo.png" class="img-responsive"/>
            </div>
          </div>
          <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
              <li id="home"><a href="<?= BASE_DIR; ?>app/views/">Pagina Inicial</a></li>
              <li class="dropdown" id="funcionalidades">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Funcionalidades <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li id="new"><a href="<?= BASE_DIR; ?>app/views/keep/new">Incluir Sistema</a></li>
                  <li id="search"><a href="<?= BASE_DIR; ?>app/views/keep/search">Pesquisar Sistema</a></li>
                  <li role="separator" class="divider"></li>
                  <li id="about"><a href="<?= BASE_DIR; ?>app/views/about">Sobre</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

  </head>
  <body>
  <div class="container">
    <div class="row corpo">
