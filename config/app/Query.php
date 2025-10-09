<?php 

class Query extends Conexion{
    private $pdo, $con, $sql;
    public function __construct(){
        $this->pdo = new Conexion();
        $this->con = $this->pdo->conect();
    }

    public function select(string $sql){
        $this->sql = $sql;
        $result = $this->con->prepare($this->sql);
        $result ->execute();
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function selectAll(string $sql){
        $this->sql = $sql;
        $result = $this->con->prepare($this->sql);
        $result ->execute();
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function save(string $sql){
        $this->sql = $sql;
        $result = $this->con->prepare($this->sql);
        $result ->execute();
        return $result;
    }
}