<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../configuracion/database.php';
include_once '../objetos/reservaciones.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare reservacion object
$reservaciones = new Reservaciones($db);
 
// get id of reservacion to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of reservacion to be edited
$reservaciones->idReservacion = $data->idReservacion;
 
// set reservacion property values
$reservaciones->Clientes_nombreCliente = $data->Clientes_nombreCliente;
$reservaciones->fechaReservacion = $data->fechaReservacion;
$reservaciones->horaReservacion = $data->horaReservacion;
$reservaciones->Mesas_idMesa = $data->Mesas_idMesa;
$reservaciones->Establecimientos_idEstablecimiento = $data->Establecimientos_idEstablecimiento;
 
// update the reservacion
if($reservaciones->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Los datos de la reservación han sido actualizados"));
}
 
// if unable to update the reservacion, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Falla al actualizar los datos de la reservación."));
}
?>