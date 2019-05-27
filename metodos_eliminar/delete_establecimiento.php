<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../configuracion/database.php';
include_once '../objetos/establecimientos.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare establecimiento object
$establecimientos = new Establecimientos($db);
 
// get establecimiento id
$data = json_decode(file_get_contents("php://input"));
 
// set establecimiento id to be deleted
$establecimientos->idEstablecimiento = $data->idEstablecimiento;
 
// delete the establecimiento
if($establecimientos->delete()){
  
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "El registro del establecimiento ha sido eliminado"));
}
 
// if unable to delete the establecimiento
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "El registro del establecimiento no se logró eliminar con éxito."));
}
?>