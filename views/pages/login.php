<?php
    session_start();
    require_once('../../models/Crud.php');
    require_once('../../controllers/Controller.php');

    $controller = new Controller();

    $session_id = session_id();

if( $controller->verificaLog($session_id) ){
    header('location: areaUtente.php');
    exit;
}else{
    
    if( isset($_POST['username']) ){
        $username = $_POST['username'];
        $pass = $_POST['pwd'];
        if( $result = $controller->verificaUsername($username) ){
            
            if( password_verify($pass, $result['password']) ){
                echo "Password verificata";
                $params = [':session_id' =>  $session_id, ':user_id' => $result['id']];
                $controller->login($params);
                if($result){
                    header('location: areaUtente.php');
                    exit;
                }
                else echo "Errore nel login";
            }else echo "Errore nel login";
            
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
    <title>Login</title>
</head>
<body>
    <?php require_once('../modules/navbarLogin.php'); ?>

    <div class="wForm flex">
        <?php 
            require_once('../modules/form_login.php');
        ?>
    </div>
</body>
</html>