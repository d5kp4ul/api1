<?php
class Establecimientos{
 
    // database connection and table name
    private $conn;
    private $table_name = "establecimientos";
 
    // object properties
    public $idEstablecimiento;
    public $nombreEstablecimiento;
    public $telefonoEstablecimiento;
    public $direccionEstablecimiento; 
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read establecimientos
    function read(){
 
    // select all query
    $query = "SELECT
                p.idEstablecimiento, p.nombreEstablecimiento, p.telefonoEstablecimiento, p.direccionEstablecimiento
            FROM
                " . $this->table_name . " p ";
                //tabla modificada
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
    }

    // create establecimientos
    function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                nombreEstablecimiento=:nombreEstablecimiento, telefonoEstablecimiento=:telefonoEstablecimiento, direccionEstablecimiento=:direccionEstablecimiento";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->nombreEstablecimiento=htmlspecialchars(strip_tags($this->nombreEstablecimiento));
    $this->telefonoEstablecimiento=htmlspecialchars(strip_tags($this->telefonoEstablecimiento));
    $this->direccionEstablecimiento=htmlspecialchars(strip_tags($this->direccionEstablecimiento));
 
    // bind values
    $stmt->bindParam(":nombreEstablecimiento", $this->nombreEstablecimiento);
    $stmt->bindParam(":telefonoEstablecimiento", $this->telefonoEstablecimiento);
    $stmt->bindParam(":direccionEstablecimiento", $this->direccionEstablecimiento);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
    }

    // actualizar el establecimiento
    function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                nombreEstablecimiento = :nombreEstablecimiento,
                telefonoEstablecimiento = :telefonoEstablecimiento,
                direccionEstablecimiento = :direccionEstablecimiento
            WHERE
                idEstablecimiento = :idEstablecimiento";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->nombreEstablecimiento=htmlspecialchars(strip_tags($this->nombreEstablecimiento));
    $this->telefonoEstablecimiento=htmlspecialchars(strip_tags($this->telefonoEstablecimiento));
    $this->direccionEstablecimiento=htmlspecialchars(strip_tags($this->direccionEstablecimiento));
    $this->idEstablecimiento=htmlspecialchars(strip_tags($this->idEstablecimiento));
 
    // bind new values
    $stmt->bindParam(':nombreEstablecimiento', $this->nombreEstablecimiento);
    $stmt->bindParam(':telefonoEstablecimiento', $this->telefonoEstablecimiento);
    $stmt->bindParam(':direccionEstablecimiento', $this->direccionEstablecimiento);
    $stmt->bindParam(':idEstablecimiento', $this->idEstablecimiento);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
    }

    // delete the product
    function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE idEstablecimiento = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->idEstablecimiento=htmlspecialchars(strip_tags($this->idEstablecimiento));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->idEstablecimiento);
 
    // execute query
    if($stmt->execute()){ 
        return true;
    }
 
    return false;
     
    }
}

