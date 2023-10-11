<?php
    session_start();
    require_once('../../models/Crud.php');
    require_once('../../controllers/Controller.php');
    //require_once('../../assets/function/funzioni.php');
    
    $controller = new Controller();
    $session_id = session_id();

    if( !$controller->verificaLog($session_id) ){
        header('location: home.php');
        exit;
    }

    
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../assets/style/style.css">
  <title>Tecnologie</title>
</head>
<body>
  
  <?php 
  /**
   * IF Else che richiama la navbar a seconda che l'utente sia
   * loggato o meno
   */
    if( $controller->verificaLog($session_id) ){
      require_once('../modules/navbarLogout.php');
    }
    else {
        require_once('../modules/navbarLogin.php');
    }  
    
  ?>
<div class="wrapTable">
<table class='styled-table'>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Tipo</th>
        <th>Descrizione</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody id="t_body">
      
    </tbody>
    </table>
</div>

<div id="div_add">
  <div id="wrap_btn_add">
    <button id="btn_add" class="btn">Add</button>
  </div>
</div>
  
<div class="wForm" id="wForm">

</div>

  <script src="../../assets/script/tecnologie.js" type="module"></script>

</body>
</html>