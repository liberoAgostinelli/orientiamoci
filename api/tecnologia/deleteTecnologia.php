<?php 

session_start();
require_once('../../models/Crud.php');
require_once('../../controllers/Controller.php');
//require_once('../../assets/function/funzioni.php');

$controller = new Controller();
$session_id = session_id();

if( !$controller->verificaLog($session_id) ){
    //header('location: home.php');
    exit;
}else{
  header('Content-Type: application/json');
  $id = json_decode(file_get_contents('php://input'), true);
  $method = $_SERVER['REQUEST_METHOD'];
  if($method === "DELETE"){
    $controller->deleteTecnologia([":id" => $id]);
    echo json_encode("delete elem with id = ". $id);
  }
    
}

  //echo $_SERVER["REQUEST_URI"];

  
  //exit;
?>