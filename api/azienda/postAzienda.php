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
    ":Ragione_sociale" => $input_data[0],
    ":p_iva" => $input_data[1],
    ":numeri_dipendenti" => $input_data[2],
    ":numero_tel" => $input_data[3],
    ":email" => $input_data[4],
    ":indirizzo" => $input_data[5],
    ":referente" => $input_data[6],
    ":note" => $input_data[7],
    ":descrizione" => $input_data[8],
    ":ambito" => $input_data[9],
    ":id_user" => $input_data[10]
  ];
  $out = $controller->setAzienda($params);
  echo json_encode($input_data);
}

?>