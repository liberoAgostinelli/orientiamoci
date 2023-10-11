<?php 
    session_start();
    
    require_once('../../models/Crud.php');
    require_once('../../controllers/Controller.php');
    
    $session_id = session_id();
    
    $controller = new Controller();
    //$controller->cancellaUtentiLoggati();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/style/style.css">
    <title>Azienda</title>
</head>
<body>

    <?php 
    
        if( $controller->verificaLog($session_id) ){
            require_once('../modules/navbarLogout.php');
        }
        else {
            //$controller->cancellaUtentiLoggati();
            require_once('../modules/navbarLogin.php');
        }
    ?>

<div class="wrapTable">
<table class='styled-table'>
    <thead>
      <tr id="tr">
        <!-- <th>Ragione Sociale</th>
        <th>P. iva</th>
        <th>N. dipendenti</th>
        <th>N. tel</th>
        <th>Email</th>
        <th>indirizzo</th>
        <th>Referente</th>
        <th>Ambito</th>
        <th>Note</th>
        <th>Descrizione</th> -->
        
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

    <div class="wForm flex" id="wForm">
        <?php //include('../modules/form_azienda.php'); ?>
    </div>
<script src="../../assets/script/azienda.js"></script>

</body>
</html>