<?php

class Controller{

    private $crud;

    public function __construct()
    {
        $this->crud = new Crud();
    }

    public function registraUtente($params){
        $query = "insert into Users(nome, cognome, data_nascita, numero_tel, token, username, email, password) 
        values(:nome, :cognome, :date, :numero_tel, :token, :username, :email, :password)";
        return $this->crud->insert($query, $params);
    }

    public function login($params){
        $query = "insert into UtentiLoggati2(session_id, id_user) values(:session_id, :id_user)";
        return $this->crud->insert($query, $params);
    }

    public function logout($session_id){
        return $this->crud->delete("UtentiLoggati2", "session_id = :session_id", [':session_id' => $session_id]);
    }

    public function verificaLog($session_id){
        $query = "select * from UtentiLoggati2 where session_id = :session_id";
        $params = [':session_id' => $session_id];
        return  $this->crud->select($query, $params);
    }

    public function verificaUsername($username){
        $query = "select id_user, username, password from Users where username = :user";
        $params = [':user' => $username];
        return $this->crud->select($query, $params);
    }

    public function getIdUserLoggato($session_id){
        $query = "select id_user from UtentiLoggati2 where session_id=:session_id";
        $params = [':session_id' => $session_id];
        $user_id = $this->crud->select($query, $params);
        
        return $user_id;
    
    }

    public function cancellaUtentiLoggati(){
        $query = "delete from UtentiLoggati2";
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
        $query = " insert into Tecnologia(nome, tipo, descrizione, id_user) values(:nome, :tipo, :descrizione, :id_user)";
        return $this->crud->insert($query, $params);
    }

    public function modTecnologie($params){
        $query = "update Tecnologia set nome=:nome, tipo=:tipo, descrizione=:descrizione, id_user=:id_user where id_tecnologia=:id";
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
        Azienda(
            ragione_sociale, 
            p_iva, 
            numero_dipendenti, 
            numero_tel, 
            email, 
            indirizzo, 
            comune,
            provincia,
            regione,
            referente, 
            note,
            descrizione,
            ambito,
            id_user
            ) 
        values(
            :ragione_sociale,
            :p_iva,
            :numero_dipendenti,
            :numero_tel,
            :email,
            :indirizzo,
            :comune,
            :provincia,
            :regione,
            :referente,
            :note,
            :descrizione,
            :ambito,
            :id_user
        )";
        return $this->crud->insert($query, $params);
    }

    public function deleteAzienda($params){
        $query = "delete from Azienda where id_azienda=:id";
        return $this->crud->select($query, $params);
    }

    public function getAzienda($params){
        $query = "select * from Azienda where id_azienda=:id";
        return $this->crud->select($query, $params);
    }

    public function modAzienda($params){
        $query = "update Azienda set 
        ragione_sociale=:ragione_sociale, 
        p_iva=:p_iva,
        numero_dipendenti=:numero_dipendenti,
        numero_tel=:numero_tel,
        email=:email,
        indirizzo=:indirizzo,
        comune=:comune,
        provincia=:provincia,
        regione=:regione,
        referente=:referente,
        note=:note,
        descrizione=:descrizione,
        ambito=:ambito,
        id_user=:id_user
        where id_azienda=:id";
        return $this->crud->update($query, $params);
    }
    /**
     * Funzioni Azienda usa tech
     */

    public function getAziende_usa_tech($params){
        $query = "select * from Azienda_usa_tech where id_azienda=:id";
        return $this->crud->selectAll($query, $params);
    }

    public function deleteAssocAzienda($params){
        $query = "delete from Azienda_usa_tech where id_azienda=:id_azienda && id_tecnologia=:id_tecnologia";
        return $this->crud->select($query, $params);
    }

    public function getAziende_usa_techFull($params){
        $query = "select nome, tipo, descrizione, at.id_azienda, at.id_tecnologia from Azienda_usa_tech at, Tecnologia t where at.id_azienda=:id  && at.id_tecnologia = t.id_tecnologia";
        return $this->crud->selectAll($query, $params);
    }

    public function setAzienda2tech($params){
        $query = " insert into Azienda_usa_tech(id_azienda, id_tecnologia, id_user) values(:id_azienda, :id_tecnologia, :id_user)";
        return $this->crud->insert($query, $params);
    }
}
?>