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
include_once '../objetos/facturas.php';
 
$database = new Database();
$db = $database->getConnection();
 
$facturas = new Facturas($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    //!empty($data->fechaFactura) &&
    !empty($data->Clientes_idCliente) &&
    !empty($data->Empleados_idEmpleado)
){
 
    // set product property values
    $facturas->fechaFactura = date('Y-m-d');
    $facturas->Clientes_idCliente = $data->Clientes_idCliente;
    $facturas->Empleados_idEmpleado = $data->Empleados_idEmpleado;
 
    // create factura
    if($facturas->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Factura registrada con éxito."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "No se logró registrar la factura."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No se logró registar la factura. Datos incompletos, favor de verificar."));
}
?>