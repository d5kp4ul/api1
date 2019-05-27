<?php
class Facturas{
 
    // database connection and table name
    private $conn;
    private $table_name = "facturas";
 
    // object properties
    public $idFactura;
    public $fechaFactura;
    public $Clientes_idCliente;
    public $Empleados_idEmpleado;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
 
    // select all query
    $query = "SELECT
                p.idFactura, p.fechaFactura, p.Clientes_idCliente, p.Empleados_idEmpleado
            FROM
                " . $this->table_name . " p ";
                //tabla modificada
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
    }

    // create facturas
    function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                fechaFactura=:fechaFactura, Clientes_idCliente=:Clientes_idCliente, Empleados_idEmpleado=:Empleados_idEmpleado";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->fechaFactura=htmlspecialchars(strip_tags($this->fechaFactura));
    $this->Clientes_idCliente=htmlspecialchars(strip_tags($this->Clientes_idCliente));
    $this->Empleados_idEmpleado=htmlspecialchars(strip_tags($this->Empleados_idEmpleado));
 
    // bind values
    $stmt->bindParam(":fechaFactura", $this->fechaFactura);
    $stmt->bindParam(":Clientes_idCliente", $this->Clientes_idCliente);
    $stmt->bindParam(":Empleados_idEmpleado", $this->Empleados_idEmpleado);
 
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
                fechaFactura = :fechaFactura,
                Clientes_idCliente = :Clientes_idCliente,
                Empleados_idEmpleado = :Empleados_idEmpleado
            WHERE
                idFactura = :idFactura";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->fechaFactura=htmlspecialchars(strip_tags($this->fechaFactura));
    $this->Clientes_idCliente=htmlspecialchars(strip_tags($this->Clientes_idCliente));
    $this->Empleados_idEmpleado=htmlspecialchars(strip_tags($this->Empleados_idEmpleado));
    $this->idFactura=htmlspecialchars(strip_tags($this->idFactura));
 
    // bind new values
    $stmt->bindParam(':fechaFactura', $this->fechaFactura);
    $stmt->bindParam(':Clientes_idCliente', $this->Clientes_idCliente);
    $stmt->bindParam(':Empleados_idEmpleado', $this->Empleados_idEmpleado);
    $stmt->bindParam(':idFactura', $this->idFactura);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
    }

    // delete the product
    function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE idFactura = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->idFactura=htmlspecialchars(strip_tags($this->idFactura));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->idFactura);
 
    // execute query
    if($stmt->execute()){ 
        return true;
    }
 
    return false;
     
    }
}

