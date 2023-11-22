<?php

    class ApiAction{

        public $webTokenSecretKey = "dsAsd3R54gDgBdeAsxc342wd3dF43FQ";//usato per la firma del webtoken da restituire
        public $tokenExpiredConf = 600000;

        function login($data, $controller){
            
            $user = $controller->verificaUsername($data->username);
            
            if ( $user ){
                if ( password_verify($data->password, $user['password']) ){
                    
                    unset($user['password']);
                    //Genero Token
                    $webToken = new WebToken();
                    $tokenTime = new DateTime();
                    $tokenExpired = $tokenTime;
                    $tokenExpired->add(new DateInterval("PT".$this->tokenExpiredConf."S"));

                    $iss = "orientiamoci.itsdallachiesa.edu.it";
                    $tokenParams = [
                        'iss' => $iss,//nome identificativo dell’entità che ha generato il token
                        'user_type' => $user['tipo'],//abilità del token
                        'expire' => $tokenExpired->getTimestamp(),//numero intero (timestamp in secondi) che indica fino a quando il token sarà valido
                        'user' => $user,
                        ];
                    $tokenSecret = $webToken->getJwt( $tokenParams, $this->webTokenSecretKey);

                    return ['user'=>$user,'result'=>($user==false?0:$user),'token'=>$tokenSecret];
                }
            }
            return false;            
        }

        function insertTestUser($data, $controller){
            return $controller->insertTestUser($data->username, $data->password);            
        }

        function getTecnologie($controller){
            return $controller->getTecnologie();
        }

        //Function per gestire le chiamate
        function checkAction($data, $controller){
            $response = new Response();
            switch ( $data->action ){
                case "login":
                    
                    $result = $this->login($data->data, $controller);
                    if ( $result['result'] ){
                        $response->result = ($result['result']?1:0);
                        $response->data = $result['user'];
                        $response->errorMessage = '';
                        $response->description = '';
                        $response->token = $result['token'];
                        return json_encode($response);
                    }
                    
                    exit;
                case "getTecnologie":
                    $result = $this->getTecnologie($controller);
                    $response->result = ($result?1:0);
                    $response->data = $result;
                    $response->errorMessage = '';
                    $response->description = '';
                    $response->token = '';
                    return json_encode($response);
            }
        }
        //Function per gestire le chiamate

    }