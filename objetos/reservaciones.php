<?php
class Reservaciones{
 
    // database connection and table name
    private $conn;
    private $table_name = "reservaciones";
 
    // object properties
    public $idReservacion;
    public $Clientes_nombreCliente;
    public $fechaReservacion;
    public $horaReservacion;
    public $Mesas_idMesa;
    public $Establecimientos_idEstablecimiento;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
 
    // select all query
    $query = "SELECT
                p.idReservacion, p.Clientes_nombreCliente, p.fechaReservacion, p.horaReservacion, p.Mesas_idMesa, p.Establecimientos_idEstablecimiento
            FROM
                " . $this->table_name . " p ";
                //tabla modificada
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
    }

    // create reservaciones
    function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                Clientes_nombreCliente=:Clientes_nombreCliente, fechaReservacion=:fechaReservacion, horaReservacion=:horaReservacion, Mesas_idMesa=:Mesas_idMesa, Establecimientos_idEstablecimiento=:Establecimientos_idEstablecimiento";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->Clientes_nombreCliente=htmlspecialchars(strip_tags($this->Clientes_nombreCliente));
    $this->fechaReservacion=htmlspecialchars(strip_tags($this->fechaReservacion));
    $this->horaReservacion=htmlspecialchars(strip_tags($this->horaReservacion));
    $this->Mesas_idMesa=htmlspecialchars(strip_tags($this->Mesas_idMesa));
    $this->Establecimientos_idEstablecimiento=htmlspecialchars(strip_tags($this->Establecimientos_idEstablecimiento));
 
    // bind values
    $stmt->bindParam(":Clientes_nombreCliente", $this->Clientes_nombreCliente);
    $stmt->bindParam(":fechaReservacion", $this->fechaReservacion);
    $stmt->bindParam(":horaReservacion", $this->fechaReservacion);
    $stmt->bindParam(":Mesas_idMesa", $this->Mesas_idMesa);
    $stmt->bindParam(":Establecimientos_idEstablecimiento", $this->Establecimientos_idEstablecimiento);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
    }

    // update the product
    function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                Clientes_nombreCliente = :Clientes_nombreCliente,
                fechaReservacion = :fechaReservacion,
                horaReservacion = :horaReservacion,
                Mesas_idMesa = :Mesas_idMesa,
                Establecimientos_idEstablecimiento = :Establecimientos_idEstablecimiento
            WHERE
                idReservacion = :idReservacion";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->Clientes_nombreCliente=htmlspecialchars(strip_tags($this->Clientes_nombreCliente));
    $this->fechaReservacion=htmlspecialchars(strip_tags($this->fechaReservacion));
    $this->horaReservacion=htmlspecialchars(strip_tags($this->horaReservacion));
    $this->Mesas_idMesa=htmlspecialchars(strip_tags($this->Mesas_idMesa));
    $this->Establecimientos_idEstablecimiento=htmlspecialchars(strip_tags($this->Establecimientos_idEstablecimiento));
    $this->idReservacion=htmlspecialchars(strip_tags($this->idReservacion));
 
    // bind new values
    $stmt->bindParam(':Clientes_nombreCliente', $this->Clientes_nombreCliente);
    $stmt->bindParam(':fechaReservacion', $this->fechaReservacion);
    $stmt->bindParam(':horaReservacion', $this->horaReservacion);
    $stmt->bindParam(':Mesas_idMesa', $this->Mesas_idMesa);
    $stmt->bindParam(':Establecimientos_idEstablecimiento', $this->Establecimientos_idEstablecimiento);
    $stmt->bindParam(':idReservacion', $this->idReservacion);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
    }

    // delete the product
    function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE idReservacion = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->idReservacion=htmlspecialchars(strip_tags($this->idReservacion));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->idReservacion);
 
    // execute query
    if($stmt->execute()){ 
        return true;
    }
 
    return false;
     
    }

}

