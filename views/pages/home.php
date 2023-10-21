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
    <title>Home</title>
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
    

</body>
</html>