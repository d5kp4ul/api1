<?php
class Pedidos_a_Domicilio{
 
    // database connection and table name
    private $conn;
    private $table_name = "pedidos_a_domicilio";
 
    // object properties
    public $idPedido_a_Domicilio;
    public $Clientes_nombreCliente;
    public $telefonoCliente;
    public $fechaPedido;
    public $horarioSalida;
    public $ubicacionCliente;
    public $coordenadasCliente;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
 
    // select all query
    $query = "SELECT
                p.idPedido_a_Domicilio, p.Clientes_nombreCliente, p.telefonoCliente, p.fechaPedido, p.horarioSalida, p.ubicacionCliente, p.coordenadasCliente
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
                Clientes_nombreCliente=:Clientes_nombreCliente, telefonoCliente=:telefonoCliente, fechaPedido=:fechaPedido, horarioSalida=:horarioSalida, ubicacionCliente=:ubicacionCliente, coordenadasCliente=:coordenadasCliente";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->Clientes_nombreCliente=htmlspecialchars(strip_tags($this->Clientes_nombreCliente));
    $this->telefonoCliente=htmlspecialchars(strip_tags($this->telefonoCliente));
    $this->fechaPedido=htmlspecialchars(strip_tags($this->fechaPedido));
    $this->horarioSalida=htmlspecialchars(strip_tags($this->horarioSalida));
    $this->ubicacionCliente=htmlspecialchars(strip_tags($this->ubicacionCliente));
    $this->coordenadasCliente=htmlspecialchars(strip_tags($this->coordenadasCliente));
 
    // bind values
    $stmt->bindParam(":Clientes_nombreCliente", $this->Clientes_nombreCliente);
    $stmt->bindParam(":telefonoCliente", $this->telefonoCliente);
    $stmt->bindParam(":fechaPedido", $this->fechaPedido);
    $stmt->bindParam(":horarioSalida", $this->horarioSalida);
    $stmt->bindParam(":ubicacionCliente", $this->ubicacionCliente);
    $stmt->bindParam(":coordenadasCliente", $this->coordenadasCliente);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
    }

    //Actualizar los datos de los pedidos a domicilio
    function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                Clientes_nombreCliente = :Clientes_nombreCliente,
                telefonoCliente = :telefonoCliente,
                fechaPedido = :fechaPedido,
                horarioSalida = :horarioSalida,
                ubicacionCliente = :ubicacionCliente,
                coordenadasCliente = :coordenadasCliente
            WHERE
                idPedido_a_Domicilio = :idPedido_a_Domicilio";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->Clientes_nombreCliente=htmlspecialchars(strip_tags($this->Clientes_nombreCliente));
    $this->telefonoCliente=htmlspecialchars(strip_tags($this->telefonoCliente));
    $this->fechaPedido=htmlspecialchars(strip_tags($this->fechaPedido));
    $this->horarioSalida=htmlspecialchars(strip_tags($this->horarioSalida));
    $this->ubicacionCliente=htmlspecialchars(strip_tags($this->ubicacionCliente));
    $this->coordenadasCliente=htmlspecialchars(strip_tags($this->coordenadasCliente));
    $this->idPedido_a_Domicilio=htmlspecialchars(strip_tags($this->idPedido_a_Domicilio));
 
    // bind new values
    $stmt->bindParam(':Clientes_nombreCliente', $this->Clientes_nombreCliente);
    $stmt->bindParam(':telefonoCliente', $this->telefonoCliente);
    $stmt->bindParam(':fechaPedido', $this->fechaPedido);
    $stmt->bindParam(':horarioSalida', $this->horarioSalida);
    $stmt->bindParam(':ubicacionCliente', $this->ubicacionCliente);
    $stmt->bindParam(':coordenadasCliente', $this->coordenadasCliente);
    $stmt->bindParam(':idPedido_a_Domicilio', $this->idPedido_a_Domicilio);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
    }

    // delete the product
    function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE idPedido_a_Domicilio = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->idPedido_a_Domicilio=htmlspecialchars(strip_tags($this->idPedido_a_Domicilio));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->idPedido_a_Domicilio);
 
    // execute query
    if($stmt->execute()){ 
        return true;
    }
 
    return false;
     
    }
}

