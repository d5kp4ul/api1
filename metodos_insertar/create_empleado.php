<?php
// required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
   
// get database connection
include_once '../configuracion/database.php';
// instantiate product object
include_once '../objetos/empleados.php';
 
$database = new Database();
$db = $database->getConnection();
 
$empleados = new Empleados($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->nombreEmpleado) &&
    !empty($data->apellidosEmpleado) &&
    !empty($data->direccionEmpleado) &&
    !empty($data->cargoEmpleado) &&
    !empty($data->telefonoEmpleado)
){
 
    // set product property values
    $empleados->nombreEmpleado = $data->nombreEmpleado;
    $empleados->apellidosEmpleado = $data->apellidosEmpleado;
    $empleados->direccionEmpleado = $data->direccionEmpleado;
    $empleados->cargoEmpleado = $data->cargoEmpleado;
    $empleados->telefonoEmpleado = $data->telefonoEmpleado;
 
    // create empleado
    if($empleados->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Empleado registrado con éxito."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "No se logró registrar el empleado."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No se logró registar el empleado. Datos incompletos, favor de verificar."));
}
?>