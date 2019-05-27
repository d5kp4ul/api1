<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../configuracion/database.php';
include_once '../objetos/pedidos_a_domicilio.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare pedido_a_domicilio object
$pedidos_a_domicilio = new Pedidos_a_Domicilio($db);
 
// get id of pedido_a_domicilio to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of pedido_a_domicilio to be edited
$pedidos_a_domicilio->idPedido_a_Domicilio = $data->idPedido_a_Domicilio;
 
// set pedido_a_domicilio property values
$pedidos_a_domicilio->Clientes_nombreCliente = $data->Clientes_nombreCliente;
$pedidos_a_domicilio->telefonoCliente = $data->telefonoCliente;
$pedidos_a_domicilio->fechaPedido = $data->fechaPedido;
$pedidos_a_domicilio->horarioSalida = $data->horarioSalida;
$pedidos_a_domicilio->ubicacionCliente = $data->ubicacionCliente;
$pedidos_a_domicilio->coordenadasCliente = $data->coordenadasCliente;
 
// update the pedido_a_domicilio
if($pedidos_a_domicilio->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Los datos del pedido han sido actualizados exitosamente"));
}
 
// if unable to update the pedido_a_domicilio, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Falla al actualizar los datos del pedido."));
}
?>