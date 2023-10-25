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
  $input_data = json_decode(file_get_contents('php://input'), true);

  $params = [
    ":id_azienda" => $input_data[0],
    ":id_tecnologia" => $input_data[1],
    ":id_user" => $input_data[3],
  ];
  $out = $controller->setAzienda2tech($params);
  echo json_encode($input_data);
}

?>