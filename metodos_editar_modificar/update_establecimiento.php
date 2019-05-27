<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../configuracion/database.php';
include_once '../objetos/establecimientos.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare establecimiento object
$establecimientos = new Establecimientos($db);
 
// get id of establecimiento to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of establecimiento to be edited
$establecimientos->idEstablecimiento = $data->idEstablecimiento;
 
// set establecimiento property values
$establecimientos->nombreEstablecimiento = $data->nombreEstablecimiento;
$establecimientos->telefonoEstablecimiento = $data->telefonoEstablecimiento;
$establecimientos->direccionEstablecimiento = $data->direccionEstablecimiento;
 
// update the establecimiento
if($establecimientos->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Los datos del establecimiento han sido actualizados"));
}
 
// if unable to update the establecimiento, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Falla al actualizar los datos del establecimiento."));
}
?>