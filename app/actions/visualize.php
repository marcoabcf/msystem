<?php

  include_once(__DIR__ . '../../controllers/SystemController.php');
  $system = new SystemController;

  $query = $_GET['q'];

  $s = $system->getData($query);

  echo '<script>status = '.$s->status.'; q = '. $query .'</script>';
