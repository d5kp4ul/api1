<?php
class Detalles_Facturas{
 
    // database connection and table name
    private $conn;
    private $table_name = "detalles_facturas";
 
    // object properties
    public $idDetalles_Factura;
    public $Menus_idMenu;
    public $Facturas_idFactura;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
 
    // select all query
    $query = "SELECT
                p.idDetalles_Factura, p.Menus_idMenu, p.Facturas_idFactura
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
                Menus_idMenu=:Menus_idMenu, Facturas_idFactura=:Facturas_idFactura";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->Menus_idMenu=htmlspecialchars(strip_tags($this->Menus_idMenu));
    $this->Facturas_idFactura=htmlspecialchars(strip_tags($this->Facturas_idFactura));
 
    // bind values
    $stmt->bindParam(":Menus_idMenu", $this->Menus_idMenu);
    $stmt->bindParam(":Facturas_idFactura", $this->Facturas_idFactura);
 
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
                Menus_idMenu = :Menus_idMenu,
                Facturas_idFactura = :Facturas_idFactura
            WHERE
                idDetalles_Factura = :idDetalles_Factura";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->Menus_idMenu=htmlspecialchars(strip_tags($this->Menus_idMenu));
    $this->Facturas_idFactura=htmlspecialchars(strip_tags($this->Facturas_idFactura));
    $this->idDetalles_Factura=htmlspecialchars(strip_tags($this->idDetalles_Factura));
 
    // bind new values
    $stmt->bindParam(':Menus_idMenu', $this->Menus_idMenu);
    $stmt->bindParam(':Facturas_idFactura', $this->Facturas_idFactura);
    $stmt->bindParam(':idDetalles_Factura', $this->idDetalles_Factura);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
    }

    // delete the product
    function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE idDetalles_Factura = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->idDetalles_Factura=htmlspecialchars(strip_tags($this->idDetalles_Factura));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->idDetalles_Factura);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
    }
}

