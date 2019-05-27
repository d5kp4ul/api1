<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here

// include database and object files
include_once '../configuracion/database.php';
include_once '../objetos/reservaciones.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$reservaciones = new Reservaciones($db);
 
// read reservaciones will be here

// query reservaciones
$stmt = $reservaciones->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // reservaciones array
    $reservaciones_arr=array();
    //$reservaciones_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $reservacion_item=array(
            "idReservacion" => $idReservacion,
            "Clientes_nombreCliente" => $Clientes_nombreCliente,
            "fechaReservacion" => $fechaReservacion,
            "horaReservacion" => $horaReservacion,
            "Mesas_idMesa" => $Mesas_idMesa,
            "Establecimientos_idEstablecimiento" => $Establecimientos_idEstablecimiento
        );
 
        array_push($reservaciones_arr, $reservacion_item);
        //array_push($reservaciones_arr["records"], $reservacion_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show reservaciones data in json format
    echo json_encode($reservaciones_arr);
}
 
// no reservaciones found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no reservaciones found
    echo json_encode(
        array("message" => "No se han registrado reservaciones por el momento.")
    );
}

