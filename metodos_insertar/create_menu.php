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
include_once '../objetos/menus.php';
 
$database = new Database();
$db = $database->getConnection();
 
$menus = new Menus($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->nombreMenu) &&
    !empty($data->descripcionMenu) &&
    !empty($data->precioMenu)
){
 
    // set product property values
    $menus->nombreMenu = $data->nombreMenu;
    $menus->descripcionMenu = $data->descripcionMenu;
    $menus->precioMenu = $data->precioMenu;
 
    // create menu
    if($menus->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Menú registrado con éxito."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "No se logró registrar el menu."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No se logró registar el menu. Datos incompletos, favor de verificar."));
}
?>