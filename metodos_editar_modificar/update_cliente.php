<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../configuracion/database.php';
include_once '../objetos/clientes.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$clientes = new Clientes($db);
 
// get id of login to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of login to be edited
$clientes->idCliente = $data->idCliente;
 
// set login property values
$clientes->nombreCliente = $data->nombreCliente;
$clientes->telefonoCliente = $data->telefonoCliente;
 
// update the login
if($clientes->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Los datos del cliente han sido actualizados"));
}
 
// if unable to update the login, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Falla al actualizar los datos del cliente."));
}
?>