<?php
    session_start();
    require_once('../../models/Crud.php');
    require_once('../../controllers/Controller.php');

    $session_id = session_id();

    $controller = new Controller();

    if( $controller->verificaLog($session_id) ){
        $result = $controller->logout($session_id);
        if($result){
            header('location: home.php');
            exit;
        }else echo "Errore nel logout";
        
    }else{
        header('location: home.php');
        exit;
    }
?>