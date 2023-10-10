<?php
    session_start();
    require_once('../../models/Crud.php');
    require_once('../../controllers/Controller.php');
    
    $controller = new Controller();
    $session_id = session_id();

    if( !$controller->verificaLog($session_id) ){
        header('location: home.php');
        exit;
    }
    
    //$username = $controller->getNomeUtente($session_id);

    //var_dump($username);
    // $user_id = $user_id['user_id'];
    // $query = "select username from User where id = :id";
    // $params = [':id' => $user_id];
    // $username = $crud->select($query, $params);
    // $username = $username['username'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/style/style.css">
    <title>Pagina Utente</title>
</head>
<body>
    <?php require_once('../modules/navbarLogout.php'); ?>
    
</body>
</html>