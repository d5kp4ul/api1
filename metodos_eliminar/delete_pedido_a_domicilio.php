<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../configuracion/database.php';
include_once '../objetos/pedidos_a_domicilio.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare pedido_a_domicilio object
$pedidos_a_domicilio = new Pedidos_a_Domicilio($db);
 
// get pedido_a_domicilio id
$data = json_decode(file_get_contents("php://input"));
 
// set pedido_a_domicilio id to be deleted
$pedidos_a_domicilio->idPedido_a_Domicilio = $data->idPedido_a_Domicilio;
 
// delete the pedido_a_domicilio
if($pedidos_a_domicilio->delete()){
  
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "El registro del pedido a domicilio se ha eliminado por completo."));
}
 
// if unable to delete the pedido_a_domicilio
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "El registro del pedido a domicilio no se logró eliminar con éxito."));
}
?>