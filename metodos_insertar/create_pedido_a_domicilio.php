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
include_once '../objetos/pedidos_a_domicilio.php';
 
$database = new Database();
$db = $database->getConnection();
 
$pedidos_a_domicilio = new Pedidos_A_Domicilio($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->Clientes_nombreCliente) &&
    !empty($data->telefonoCliente) &&
    !empty($data->fechaPedido) &&
    !empty($data->horarioSalida) &&
    !empty($data->ubicacionCliente) &&
    !empty($data->coordenadasCliente)  
){
   
    // set product property values
    $pedidos_a_domicilio->Clientes_nombreCliente = $data->Clientes_nombreCliente;
    $pedidos_a_domicilio->telefonoCliente = $data->telefonoCliente;
    $pedidos_a_domicilio->fechaPedido = date('Y-m-d');
    $pedidos_a_domicilio->horarioSalida = $data->horarioSalida;
    $pedidos_a_domicilio->ubicacionCliente = $data->ubicacionCliente;
    $pedidos_a_domicilio->coordenadasCliente = $data->coordenadasCliente;
 
    // create pedido a domicilio
    if($pedidos_a_domicilio->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Pedido a domicilio registrada con éxito."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "No se logró registar el pedido."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No se logró registar el pedido. Datos incompletos, favor de verificar."));
}
?>