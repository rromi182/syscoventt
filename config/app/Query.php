<?php 

class Query extends Conexion{
    private $pdo, $con, $sql, $datos;
    public function __construct(){
        $this->pdo = new Conexion();
        $this->con = $this->pdo->conect();
    }

    // Método select CORREGIDO para aceptar parámetros
    public function select(string $sql, array $params = []){
        $this->sql = $sql;
        $result = $this->con->prepare($this->sql);
        
        // Si hay parámetros, pasarlos al execute
        if (!empty($params)) {
            $result->execute($params);
        } else {
            $result->execute();
        }
        
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    // public function select(string $sql){
    //     $this->sql = $sql;
    //     $result = $this->con->prepare($this->sql);
    //     $result ->execute();
    //     $data = $result->fetch(PDO::FETCH_ASSOC);
    //     return $data;
    // }

    public function selectAll(string $sql){
        $this->sql = $sql;
        $result = $this->con->prepare($this->sql);
        $result ->execute();
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function save(string $sql, array $datos){
        $this->sql = $sql;
        $this->datos = $datos;
        $insert = $this->con->prepare($this->sql);
        $data = $insert->execute($this->datos);
        if($data){
            $response = 1;
        }else{
            $response = 0;
        }
        return $response;
    }

    public function update(string $sql){
        $this->sql = $sql;
        $result = $this->con->prepare($this->sql);
        $result ->execute();
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function insert(string $sql){
        $this->sql = $sql;
        $result = $this->con->prepare($this->sql);
        $result ->execute();
        return $result;
    }

    
}