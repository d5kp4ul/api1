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
include_once '../objetos/detalles_facturas.php';
 
$database = new Database();
$db = $database->getConnection();
 
$detalles_facturas = new Detalles_facturas($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->Menus_idMenu) &&
    !empty($data->Facturas_idFactura)
){
 
    // set product property values
    $detalles_facturas->Menus_idMenu = $data->Menus_idMenu;
    $detalles_facturas->Facturas_idFactura = $data->Facturas_idFactura;
 
    // create detalles_facturas
    if($detalles_facturas->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Detalles de factura creada exitosamente."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "No se logró crear el detalle de la factura."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No se logró crear el detalle de la factura. Datos incompletos, favor de verificar."));
}
?>