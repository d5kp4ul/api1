<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../configuracion/database.php';
include_once '../objetos/menus.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare menu object
$menus = new Menus($db);
 
// get id of menu to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of menu to be edited
$menus->idMenu = $data->idMenu;
 
// set menu property values
$menus->nombreMenu = $data->nombreMenu;
$menus->descripcionMenu = $data->descripcionMenu;
$menus->precioMenu = $data->precioMenu;
 
// update the menu
if($menus->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Los datos del menú han sido actualizados"));
}
 
// if unable to update the menu, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Falla al actualizar los datos del menu."));
}
?>