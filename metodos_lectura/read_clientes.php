<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here

// include database and object files
include_once '../configuracion/database.php';
include_once '../objetos/clientes.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$cliente = new Login($db);
 
// read logins will be here

// query logins
$stmt = $cliente->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // logins array
    $cliente_arr=array();
    //$login_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $clientee_item=array(
            "idCliente" => $idCliente,
            "nombreCliente" => $nombreCliente,
            "telefonoCliente" => $telefonoCliente
        );
 
        array_push($cliente_arr, $clientee_item);
        //array_push($login_arr["records"], $loginn_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show logins data in json format
    echo json_encode($cliente_arr);
}
 
// no logins found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no logins found
    echo json_encode(
        array("message" => "Ningún cliente ha visitado a la App.")
    );
}

