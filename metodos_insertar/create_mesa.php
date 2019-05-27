<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../configuracion/database.php';
 
// instantiate product object
include_once '../objetos/mesas.php';
 
$database = new Database();
$db = $database->getConnection();
 
$mesas = new Mesas($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->nombreMesa)
){
 
    // set product property values
    $mesas->nombreMesa = $data->nombreMesa;
 
    // create mesa
    if($mesas->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Se registró la mesa con éxito."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "No se logró el registro de la mesa."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No se logró el registro de la mesa. Datos incompletos, favor de verificar."));
}
?>