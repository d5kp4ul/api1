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
include_once '../objetos/reservaciones.php';
 
$database = new Database();
$db = $database->getConnection();
 
$reservaciones = new Reservaciones($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    
    !empty($data->Clientes_nombreCliente) &&
    !empty($data->fechaReservacion) &&
    !empty($data->horaReservacion) &&
    !empty($data->Mesas_idMesa) &&
    !empty($data->Establecimientos_idEstablecimiento) 
){
    $reservaciones->Clientes_nombreCliente = $data->Clientes_nombreCliente;
    // set product property values
    $reservaciones->fechaReservacion = $data->fechaReservacion; //$reservaciones->fechaReservacion = date('Y-m-d H:i:s');
    $reservaciones->horaReservacion = $data->horaReservacion;
    $reservaciones->Mesas_idMesa = $data->Mesas_idMesa;
    $reservaciones->Establecimientos_idEstablecimiento = $data->Establecimientos_idEstablecimiento;
 
    // create reservacion
    if($reservaciones->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Reservación registrada con éxito."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "No se logró registar la reservación."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No se logró registar la reservación. Datos incompletos, favor de verificar."));
}
?>