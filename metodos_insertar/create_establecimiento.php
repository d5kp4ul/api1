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
include_once '../objetos/establecimientos.php';
 
$database = new Database();
$db = $database->getConnection();
 
$establecimientos = new Establecimientos($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->nombreEstablecimiento) &&
    !empty($data->telefonoEstablecimiento) &&
    !empty($data->direccionEstablecimiento)
){
 
    // set product property values
    $establecimientos->nombreEstablecimiento = $data->nombreEstablecimiento;
    $establecimientos->telefonoEstablecimiento = $data->telefonoEstablecimiento;
    $establecimientos->direccionEstablecimiento = $data->direccionEstablecimiento;
 
    // create establecimiento
    if($establecimientos->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Establecimiento registrado con éxito."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "No se logró registrar el establecimiento."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No se logró registar el establecimiento. Datos incompletos, favor de verificar."));
}
?>