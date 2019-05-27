<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../configuracion/database.php';
include_once '../objetos/empleados.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare empleado object
$empleados = new Empleados($db);
 
// get id of empleado to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of empleado to be edited
$empleados->idEmpleado = $data->idEmpleado;
 
// set empleado property values
$empleados->nombreEmpleado = $data->nombreEmpleado;
$empleados->apellidosEmpleado = $data->apellidosEmpleado;
$empleados->direccionEmpleado = $data->direccionEmpleado;
$empleados->cargoEmpleado = $data->cargoEmpleado;
$empleados->telefonoEmpleado = $data->telefonoEmpleado;
$empleados->e_mailEmpleado = $data->e_mailEmpleado;
$empleados->passwordEmpleado = $data->passwordEmpleado;
 
// update the empleado
if($empleados->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Los datos del empleado han sido actualizados"));
}
 
// if unable to update the empleado, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Falla al actualizar los datos del empleado."));
}
?>