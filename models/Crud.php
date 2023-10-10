<?php

require_once('Connection.php');

class Crud{
    private $conn;

    public function __construct()
    {
        $this->conn = Connection::connection();
    }

    public function select($query, $params = []){
        $st = $this->conn->prepare($query);
        // for($i = 0; $i<count($params); $i++){
        //     $st->bindParam($i + 1, $params[$i]);
        // }
        $st->execute($params);
        return $st->fetch();
    }

    public function selectAll($query, $params = []){
        $st = $this->conn->prepare($query);
        // for($i = 0; $i<count($params); $i++){
        //     $st->bindParam($i + 1, $params[$i]);
        // }
        $st->execute($params);
        return $st->fetchAll();
    }
    
    public function insert($query, $params){
        $st = $this->conn->prepare($query);

        // for($i = 0; $i<count($params); $i++){
        //     $st->bindParam($i + 1, $params[$i]);
        // }

        return $st->execute($params);
    }

    public function update($query, $params){
        $st = $this->conn->prepare($query);
        return $st->execute($params);
    }

    public function delete($table, $conditions, $params){
        $query = "delete from $table where $conditions";
        $st = $this->conn->prepare($query);
        return $st->execute($params);
    }
}

?>