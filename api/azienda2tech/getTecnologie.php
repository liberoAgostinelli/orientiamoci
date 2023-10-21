<?php 

session_start();
require_once('../../models/Crud.php');
require_once('../../controllers/Controller.php');
//require_once('../../assets/function/funzioni.php');

$controller = new Controller();
$session_id = session_id();

$id = $_GET['id'];

if( !$controller->verificaLog($session_id) ){
    //header('location: home.php');
    exit;
}else{
  header('Content-Type: application/json');
  //$input_data = json_decode(file_get_contents('php://input'), true);

    $out = $controller->getAziende_usa_techFull([":id" => $id]);
    echo json_encode($out);
  
}
?>