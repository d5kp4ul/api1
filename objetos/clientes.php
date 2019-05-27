<?php
class Clientes{
 
    // database connection and table name
    private $conn;
    private $table_name = "clientes";
 
    // object properties
    public $idCliente;
    public $nombreCliente;
    public $telefonoCliente;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read login
    function read(){
 
    // select all query
    $query = "SELECT
                p.idCliente, p.nombreCliente, p.telefonoCliente
            FROM
                " . $this->table_name . " p ";
                //tabla modificada
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
    }

    // create login
    function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                nombreCliente=:nombreCliente, telefonoCliente=:telefonoCliente";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->nombreCliente=htmlspecialchars(strip_tags($this->nombreCliente));
    $this->telefonoCliente=htmlspecialchars(strip_tags($this->telefonoCliente));
 
    // bind values
    $stmt->bindParam(":nombreCliente", $this->nombreCliente);
    $stmt->bindParam(":telefonoCliente", $this->telefonoCliente);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
    }

    // actualizar el login de usuario
    function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                nombreCliente = :nombreCliente,
                telefonoCliente = :telefonoCliente
            WHERE
                idCliente = :idCliente";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->nombreCliente=htmlspecialchars(strip_tags($this->nombreCliente));
    $this->telefonoCliente=htmlspecialchars(strip_tags($this->telefonoCliente));
    $this->idCliente=htmlspecialchars(strip_tags($this->idCliente));
 
    // bind new values
    $stmt->bindParam(':nombreCliente', $this->nombreCliente);
    $stmt->bindParam(':telefonoCliente', $this->telefonoCliente);
    $stmt->bindParam(':idCliente', $this->idCliente);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
    }

    // delete the product
    function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE idCliente = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->idCliente=htmlspecialchars(strip_tags($this->idCliente));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->idCliente);
 
    // execute query
    if($stmt->execute()){ 
        return true;
    }
 
    return false;
     
    }
}

