<?php
class Empleados{
 
    // database connection and table name
    private $conn;
    private $table_name = "empleados";
 
    // object properties
    public $idEmpleado;
    public $nombreEmpleado;
    public $apellidosEmpleado;
    public $direccionEmpleado;
    public $cargoEmpleado;
    public $telefonoEmpleado;
    public $e_mailEmpleado;
    public $passwordEmpleado;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
 
    // select all query
    $query = "SELECT
                p.idEmpleado, p.nombreEmpleado, p.apellidosEmpleado, p.direccionEmpleado, p.cargoEmpleado, p.telefonoEmpleado, p.e_mailEmpleado, p.passwordEmpleado 
            FROM
                " . $this->table_name . " p ";
                //tabla modificada
   
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
    }

    //nueva función
    //verificar funcionalidad 
    //Función para insertar un nuevo empleado en la tabla empleados

    // create empleados
    function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                nombreEmpleado=:nombreEmpleado, apellidosEmpleado=:apellidosEmpleado, direccionEmpleado=:direccionEmpleado, cargoEmpleado=:cargoEmpleado, telefonoEmpleado=:telefonoEmpleado";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->nombreEmpleado=htmlspecialchars(strip_tags($this->nombreEmpleado));
    $this->apellidosEmpleado=htmlspecialchars(strip_tags($this->apellidosEmpleado));
    $this->direccionEmpleado=htmlspecialchars(strip_tags($this->direccionEmpleado));
    $this->cargoEmpleado=htmlspecialchars(strip_tags($this->cargoEmpleado));
    $this->telefonoEmpleado=htmlspecialchars(strip_tags($this->telefonoEmpleado));
 
    // bind values
    $stmt->bindParam(":nombreEmpleado", $this->nombreEmpleado);
    $stmt->bindParam(":apellidosEmpleado", $this->apellidosEmpleado);
    $stmt->bindParam(":direccionEmpleado", $this->direccionEmpleado);
    $stmt->bindParam(":cargoEmpleado", $this->cargoEmpleado);
    $stmt->bindParam(":telefonoEmpleado", $this->telefonoEmpleado);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
    }

    //nueva función
    //actualización de datos de empleados
    // update the product
    function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                nombreEmpleado = :nombreEmpleado,
                apellidosEmpleado = :apellidosEmpleado,
                direccionEmpleado = :direccionEmpleado,
                cargoEmpleado = :cargoEmpleado,
                telefonoEmpleado = :telefonoEmpleado,
                e_mailEmpleado = :e_mailEmpleado,
                passwordEmpleado = :passwordEmpleado
            WHERE
                idEmpleado = :idEmpleado";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->nombreEmpleado=htmlspecialchars(strip_tags($this->nombreEmpleado));
    $this->apellidosEmpleado=htmlspecialchars(strip_tags($this->apellidosEmpleado));
    $this->direccionEmpleado=htmlspecialchars(strip_tags($this->direccionEmpleado));
    $this->cargoEmpleado=htmlspecialchars(strip_tags($this->cargoEmpleado));
    $this->telefonoEmpleado=htmlspecialchars(strip_tags($this->telefonoEmpleado));
    $this->e_mailEmpleado=htmlspecialchars(strip_tags($this->e_mailEmpleado));
    $this->passwordEmpleado=htmlspecialchars(strip_tags($this->passwordEmpleado));
    $this->idEmpleado=htmlspecialchars(strip_tags($this->idEmpleado));
 
    // bind new values
    $stmt->bindParam(':nombreEmpleado', $this->nombreEmpleado);
    $stmt->bindParam(':apellidosEmpleado', $this->apellidosEmpleado);
    $stmt->bindParam(':direccionEmpleado', $this->direccionEmpleado);
    $stmt->bindParam(':cargoEmpleado', $this->cargoEmpleado);
    $stmt->bindParam(':telefonoEmpleado', $this->telefonoEmpleado);
    $stmt->bindParam(':e_mailEmpleado', $this->e_mailEmpleado);
    $stmt->bindParam(':passwordEmpleado', $this->passwordEmpleado);
    $stmt->bindParam(':idEmpleado', $this->idEmpleado);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
    }

    //nuevo método 27/04/2004 14:41:00 horas
    //metodo eliminar empleado
    // delete the product
    function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE idEmpleado = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->idEmpleado=htmlspecialchars(strip_tags($this->idEmpleado));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->idEmpleado);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
    }

    //nuevo método
    //verificar funcionalidad
    //hacerlo funcional
    // used when filling up the update product form
    function readOne(){
 
    // query to read single record
    $query = "SELECT
                p.idEmpleado, p.nombreEmpleado, p.apellidosEmpleado, p.price, p.category_id, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            WHERE
                p.id = ?
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->name = $row['name'];
    $this->price = $row['price'];
    $this->description = $row['description'];
    $this->category_id = $row['category_id'];
    $this->category_name = $row['category_name'];
    }
}

