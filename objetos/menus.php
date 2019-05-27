<?php
class Menus{
 
    // database connection and table name
    private $conn;
    private $table_name = "menus";
 
    // object properties
    public $idMenu;
    public $nombreMenu;
    public $descripcionMenu;
    public $precioMenu;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
 
    // select all query
    $query = "SELECT
                p.idMenu, p.nombreMenu, p.descripcionMenu, p.precioMenu
            FROM
                " . $this->table_name . " p ";
                //tabla modificada
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
    }

    // create menus
    function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                nombreMenu=:nombreMenu, descripcionMenu=:descripcionMenu, precioMenu=:precioMenu";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->nombreMenu=htmlspecialchars(strip_tags($this->nombreMenu));
    $this->descripcionMenu=htmlspecialchars(strip_tags($this->descripcionMenu));
    $this->precioMenu=htmlspecialchars(strip_tags($this->precioMenu));
 
    // bind values
    $stmt->bindParam(":nombreMenu", $this->nombreMenu);
    $stmt->bindParam(":descripcionMenu", $this->descripcionMenu);
    $stmt->bindParam(":precioMenu", $this->precioMenu);
 
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
                nombreMenu = :nombreMenu,
                descripcionMenu = :descripcionMenu,
                precioMenu = :precioMenu
            WHERE
                idMenu = :idMenu";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->nombreMenu=htmlspecialchars(strip_tags($this->nombreMenu));
    $this->descripcionMenu=htmlspecialchars(strip_tags($this->descripcionMenu));
    $this->precioMenu=htmlspecialchars(strip_tags($this->precioMenu));
    $this->idMenu=htmlspecialchars(strip_tags($this->idMenu));
 
    // bind new values
    $stmt->bindParam(':nombreMenu', $this->nombreMenu);
    $stmt->bindParam(':descripcionMenu', $this->descripcionMenu);
    $stmt->bindParam(':precioMenu', $this->precioMenu);
    $stmt->bindParam(':idMenu', $this->idMenu);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
    }

    // delete the product
    function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE idMenu = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->idMenu=htmlspecialchars(strip_tags($this->idMenu));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->idMenu);
 
    // execute query
    if($stmt->execute()){ 
        return true;
    }
 
    return false;
     
    }
}