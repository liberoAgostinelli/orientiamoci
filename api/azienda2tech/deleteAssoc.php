<?php 

session_start();
require_once('../../models/Crud.php');
require_once('../../controllers/Controller.php');
//require_once('../../assets/function/funzioni.php');

$controller = new Controller();
$session_id = session_id();

$id_azienda = $_GET['id_azienda'];
$id_tecnologia = $_GET['id_tecnologia'];

if( !$controller->verificaLog($session_id) ){
    //header('location: home.php');
    exit;
}else{
  header('Content-Type: application/json');
  $input = json_decode(file_get_contents('php://input'), true);
  $method = $_SERVER['REQUEST_METHOD'];
  if($method === "DELETE"){
    $controller->deleteAssocAzienda([":id_azienda" => $id_azienda, ":id_tecnologia" => $id_tecnologia]);
    echo json_encode("delete elem with id_azienda = ". $id_azienda . " id_tecnologia = " . $id_tecnologia);
  }
    
}

?>