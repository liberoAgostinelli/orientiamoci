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
    <link rel="stylesheet" href="../../assets/style/style_nav/style_nav.css">
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
        
    </div>

<script type="module" src="../../assets/script/myFunction.js"></script>
<script src="../../assets/script/azienda.js" type="module"></script>

</body>
</html>