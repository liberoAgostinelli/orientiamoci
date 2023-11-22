<?php
    /*
        @author: Mirko Guida
        @date: 19/11/2023
        @input: gli input a questa quelli provenienti dalle richieste delle API
                - action: valore obbligatorio che indica qual è la richiesta
                - altri input sono dipendenti dalla richiesta
        @output: 
        @description: Questa pagina viene utilizzata come punto di ingresso per le chiamata API
    */
    session_start();
    header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Max-Age: 600");    // cache for 10 minutes
    header('Content-Type: application/json, charset=utf-8');

    require_once ('./utils/route.inc.php');
    require_once ('./utils/webToken.class.php');
    require_once ('./utils/response.class.php');
    require_once ('./models/Crud.php');
    require_once ('./models/Connection.php');
    require_once ('./controllers/Controller.php');
    require_once ('./utils/apiAction.class.php');

    $response = new Response();//Classe che gestisce le risposte ./utils/response.class.php
    $apiAction = new ApiAction();

    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);

    //Controllo se c'è una azione richiesta, nel caso non ci sia do un messaggio di errore
    if ( !isset($data->action) || $data->action == "" ){
        $response->result = 0;
        $response->errorMessage = 'Azione non consentita';
        $response->description = json_encode($data);
        echo json_encode($response);
        exit;
    }
    
    //$headers = getallheaders();
    if ( isset($data->token) && $data->token != "" ){
        try{
            $webToken = new WebToken();
            $token = $data->token;
            if ( !$webToken->checkJwt($token, $apiAction->webTokenSecretKey) ){
                http_response_code(404);
                die();
                exit;
            }
            $tokenPayload = explode(".", $data->token);
            $tempAuth = base64_decode($tokenPayload[1]);
            $TOKEN_LOGGED = json_decode($tempAuth);
            $USER_LOGGED = $TOKEN_LOGGED->user;
            
            if ( !isset($ROUTE_APP[$TOKEN_LOGGED->user_type][$data->action]) ){
                $response->result = 0;
                $response->errorMessage = 'Azione non autorizzata';
                $response->description = json_encode($data);
                echo json_encode($response);
                exit;
            }
        }catch(Exception $e){
            $response->result = 0;
            $response->errorMessage = 'Azione non autorizzata';
            $response->info = $e->getTraceAsString();
            $response->description = $e->getMessage();
            echo json_encode($response);
            exit;
        }catch (\Throwable $e) {
            $response->result = 0;
            $response->errorMessage = 'Azione non autorizzata';
            $response->info = $e->getTraceAsString();
            $response->description = $e->getMessage();
            echo json_encode($response);
            exit;
        }         
    }else{
        if ( !isset($ROUTE_APP['guest'][$data->action]) ){
            $response->result = 0;
            $response->errorMessage = 'Azione non consentita [NOAUTH]';
            $response->description = json_encode($data);
            echo json_encode($response);
            exit;
        }
    }

    try{
        $controller = new Controller();        
        $result;

        echo $apiAction->checkAction($data, $controller);
        exit;
        
    }catch(Exception $ex){
        $response->result = 0;
        $response->errorMessage = 'Errore nella richiesta';
        $response->description = "1";
        echo json_encode($response);
        exit;
    }catch(Throwable $tr){
        $response->result = 0;
        $response->errorMessage = 'Errore nella richiesta';
        $response->description = $tr->getMessage();
        $response->info = $tr->getTraceAsString();
        echo json_encode($response);
        exit;
    }

