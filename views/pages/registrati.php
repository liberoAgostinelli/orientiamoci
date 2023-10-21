<?php
    session_start();
    require_once('../../models/Crud.php');
    require_once('../../controllers/Controller.php');
    require_once('../../assets/function/funzioni.php');

    $controller = new Controller();

    $session_id = session_id();
    // echo $session_id;

    //$result = $controller->verificaLog($session_id);

    $token = generaStringaRandom(10, $_POST);
    
    
    if( !$controller->verificaLog($session_id) ){
        header('location: areaUtente.php');
        exit;
    }else{
        /* Verifico l'invio del form */
        if( isset($_POST['username']) ){

            $params = [
                ':nome' => $_POST['nome'],
                ':cognome' => $_POST['cognome'],
                ':date' => $_POST['date'],
                ':numero_tel' => $_POST['numero_tel'],
                ':token' => $token,
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
    <link rel="stylesheet" href="../../assets/style/style_nav/style_nav.css">
    <title>Registrati</title>
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

    <div class="wForm flex">
        <?php require_once('../modules/form_registrati.php'); ?>
    </div>
</body>
</html>