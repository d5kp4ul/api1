<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here

// include database and object files
include_once '../configuracion/database.php';
include_once '../objetos/establecimientos.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$establecimientos = new Establecimientos($db);
 
// read establecimientos will be here

// query establecimientos
$stmt = $establecimientos->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // establecimientos array
    $Establecimientos_arr=array();
    //$Establecimientos_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $Establecimiento_item=array(
            "idEstablecimiento" => $idEstablecimiento,
            "nombreEstablecimiento" => $nombreEstablecimiento,
            "telefonoEstablecimiento" => $telefonoEstablecimiento,
            "direccionEstablecimiento" => $direccionEstablecimiento
        );
 
        array_push($Establecimientos_arr, $Establecimiento_item);
        //array_push($Establecimientos_arr["records"], $Establecimiento_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show establecimientos data in json format
    echo json_encode($Establecimientos_arr);
}
 
// no establecimientos found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no establecimientos found
    echo json_encode(
        array("message" => "No hay ningún registro de establecimientos.")
    );
}

