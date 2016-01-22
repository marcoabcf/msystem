<?php

  include_once (__DIR__ . '../../controllers/SystemController.php');
  $system = new SystemController;

  $list = $system->toList();
  $paginacao = $system->pagination();
