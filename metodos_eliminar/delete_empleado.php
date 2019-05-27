<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../configuracion/database.php';
include_once '../objetos/empleados.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare empleado object
$empleados = new Empleados($db);
 
// get empleado id
$data = json_decode(file_get_contents("php://input"));
 
// set empleado id to be deleted
$empleados->idEmpleado = $data->idEmpleado;
 
// delete the empleado
if($empleados->delete()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "El registro del emplado ha sido eliminado"));
}
 
// if unable to delete the empleado
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "El registro del empleado no se logró eliminar."));
}
?>