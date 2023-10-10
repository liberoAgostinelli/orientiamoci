<?php

class Connection{

    public static $a = "ciao";
    
    public static function connection(){
        $dsn = "mysql:host=localhost;dbname=autenticazione_01";
        $user = "libero"; $pwd = "Leomolly123?";
        try{
            $pdo = new PDO($dsn, $user, $pwd);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch(PDOException $e){
            return $e->getMessage();
        }
        
    }
}

?>