<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../configuracion/database.php';
include_once '../objetos/mesas.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare mesa object
$mesas = new Mesas($db);
 
// get mesa id
$data = json_decode(file_get_contents("php://input"));
 
// set mesa id to be deleted
$mesas->idMesa = $data->idMesa;
 
// delete the mesa
if($mesas->delete()){
  
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "El registro de la mesa se ha eliminado por completo."));
}
 
// if unable to delete the mesa
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "El registro de la mesa no se logró eliminar con éxito."));
}
?>