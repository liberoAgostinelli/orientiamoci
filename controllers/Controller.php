<?php

class Controller{

    private $crud;

    public function __construct()
    {
        $this->crud = new Crud();
    }

    public function registraUtente($params){
        $query = "insert into User(username, email, password) values(:username, :email, :password)";
        return $this->crud->insert($query, $params);
    }

    public function login($params){
        $query = "insert into UtentiLoggati(session_id, user_id) values(:session_id, :user_id)";
        return $this->crud->insert($query, $params);
    }

    public function logout($session_id){
        return $this->crud->delete("UtentiLoggati", "session_id = :session_id", [':session_id' => $session_id]);
    }

    public function verificaLog($session_id){
        $query = "select * from UtentiLoggati where session_id = :session_id";
        $params = [':session_id' => $session_id];
        return  $this->crud->select($query, $params);
    }

    public function verificaUsername($username){
        $query = "select id, username, password from User where username = :user";
        $params = [':user' => $username];
        return $this->crud->select($query, $params);
    }

    public function getNomeUtente($session_id){
        $query = "select * from UtentiLoggati";
        $params = [':user_id' => 5];
        $user_id = $this->crud->select($query, $params);
        
        return $user_id;
    
    }

    public function cancellaUtentiLoggati(){
        $query = "delete from UtentiLoggati";
        $this->crud->select($query);
    }
    /**
     * Function Tecnologia
     */
    public function getTecnologie(){
        $query = "select * from Tecnologia";
        return $this->crud->selectAll($query);
    }

    public function getTecnologia($params){
        $query = "select * from Tecnologia where id_tecnologia=:id";
        return $this->crud->select($query, $params);
    }

    public function setTecnologia($params){
        $query = " insert into Tecnologia(nome, tipo, descrizione) values(:nome, :tipo, :descrizione)";
        return $this->crud->insert($query, $params);
    }

    public function modTecnologie($params){
        $query = "update Tecnologia set nome=:nome, tipo=:tipo, descrizione=:descrizione where id_tecnologia=:id";
        return $this->crud->update($query, $params);
    }

    public function deleteTecnologia($params){
        $query = "delete from Tecnologia where id_tecnologia=:id";
        return $this->crud->select($query, $params);
    }
    /**
     * Function Azienda
     */
    public function getAziende(){
        $query = "select * from Azienda";
        return $this->crud->selectAll($query);
    }

    public function setAzienda($params){
        $query = " insert into 
        Tecnologia(
            Ragione_sociale, 
            p_iva, 
            numeri_dipendenti, 
            numero_tel, 
            email, 
            indirizzo, 
            referente, 
            note,
            descrizione,
            ambito,
            id_user
            ) 
        values(
            ':Ragione_sociale' ,
            ':p_iva' ,
            ':numeri_dipendenti',
            ':numero_tel',
            ':email',
            ':indirizzo',
            ':referente',
            ':note',
            ':descrizione',
            ':ambito',
            ':id_user'
        )";
        return $this->crud->insert($query, $params);
    }
}
?>