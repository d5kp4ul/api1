<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../configuracion/database.php';
include_once '../objetos/detalles_facturas.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare detalle_de_factura object
$detalles_facturas = new Detalles_Facturas($db);
 
// get detalle_de_factura id
$data = json_decode(file_get_contents("php://input"));
 
// set detalle_de_factura id to be deleted
$detalles_facturas->idDetalles_Factura = $data->idDetalles_Factura;
 
// delete the detalle_de_factura
if($detalles_facturas->delete()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "El detalle de la factura ha sido eliminado"));
}
 
// if unable to delete the detalle_de_factura
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "El registro del detalle de la factura no se logró eliminar."));
}
?>