<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../configuracion/database.php';
include_once '../objetos/facturas.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare factura object
$facturas = new Facturas($db);
 
// get id of factura to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of factura to be edited
$facturas->idFactura = $data->idFactura;
 
// set factura property values
$facturas->fechaFactura = date('Y-m-d');
$facturas->Clientes_idCliente = $data->Clientes_idCliente;
$facturas->Empleados_idEmpleado = $data->Empleados_idEmpleado;
 
// update the factura
if($facturas->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Los datos de la factura se han actualizado exitosamente"));
}
 
// if unable to update the factura, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Falla al actualizar los datos de la factura."));
}
?>