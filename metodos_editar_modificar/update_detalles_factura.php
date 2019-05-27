<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../configuracion/database.php';
include_once '../objetos/detalles_facturas.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare detalle_de_factura object
$detalles_facturas = new Detalles_Facturas($db);
 
// get id of detalle_de_factura to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of detalle_de_factura to be edited
$detalles_facturas->idDetalles_Factura = $data->idDetalles_Factura;
 
// set detalle_de_factura property values
$detalles_facturas->Menus_idMenu = $data->Menus_idMenu;
$detalles_facturas->Facturas_idFactura = $data->Facturas_idFactura;
 
// update detalle_de_factura
if($detalles_facturas->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Los detalles de la factura se han actualizado exitosamente"));
}
 
// if unable to update the detalle_de_factura, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Falla al actualizar los detalles de la factura."));
}
?>