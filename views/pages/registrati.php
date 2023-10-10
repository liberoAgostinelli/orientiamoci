<?php
    session_start();
    require_once('../../models/Crud.php');
    require_once('../../controllers/Controller.php');

    $controller = new Controller();

    $session_id = session_id();
    // echo $session_id;

    $result = $controller->verificaLog($session_id);
    
    if($result){
        //..sono loggato
        header('location: areaUtente.php');
        exit;
    }else{
        /* Verifico l'invio del form */
        if( isset($_POST['username']) ){

            $params = [
                ':username' => $_POST['username'],
                ':email' => $_POST['email'],
                ':password' => password_hash($_POST['pwd'], PASSWORD_DEFAULT)
            ];
            $result = $controller->registraUtente($params);

            if($result){
                header('location: login.php');
                exit;
            }else{
                echo "Errore nella registrazione";
            }
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../../assets/style/style.css">
    <title>Registrati</title>
</head>
<body>
    <?php require_once('../modules/navbarLogin.php');?>

    <div class="wForm flex">
        <?php require_once('../modules/form_registrati.php'); ?>
    </div>
</body>
</html>