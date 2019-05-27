<?php
class Mesas{
 
    // database connection and table name
    private $conn;
    private $table_name = "mesas";
 
    // object properties
    public $idMesa;
    public $nombreMesa;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
 
    // select all query
    $query = "SELECT
                p.idMesa, p.nombreMesa
            FROM
                " . $this->table_name . " p ";
                //tabla modificada
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
    }

    // create table
    function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                nombreMesa=:nombreMesa";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->nombreMesa=htmlspecialchars(strip_tags($this->nombreMesa));
 
    // bind values
    $stmt->bindParam(":nombreMesa", $this->nombreMesa);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
    }

    // actualizar mesas
    function update(){

    // update query 
    $query = "UPDATE
                " . $this->table_name . "
            SET
                nombreMesa = :nombreMesa
            WHERE
                idMesa = :idMesa";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->nombreMesa=htmlspecialchars(strip_tags($this->nombreMesa));
    $this->idMesa=htmlspecialchars(strip_tags($this->idMesa));
 
    // bind new values
    $stmt->bindParam(':nombreMesa', $this->nombreMesa);
    $stmt->bindParam(':idMesa', $this->idMesa);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
    }

    // delete the product
    function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE idMesa = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->idMesa=htmlspecialchars(strip_tags($this->idMesa));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->idMesa);
 
    // execute query
    if($stmt->execute()){ 
        return true;
    }
 
    return false;
     
    }
}

