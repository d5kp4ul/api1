<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here

// include database and object files
include_once '../configuracion/database.php';
include_once '../objetos/mesas.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$mesas = new Mesas($db);
 
// read mesas will be here

// query mesas
$stmt = $mesas->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // mesas array
    $mesas_arr=array();
    //$mesas_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $mesa_item=array(
            "idMesa" => $idMesa,
            "nombreMesa" => $nombreMesa
        );
 
        array_push($mesas_arr, $mesa_item);
        //array_push($mesas_arr["records"], $mesa_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show mesas data in json format
    echo json_encode($mesas_arr);
}
 
// no mesas found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no mesas found
    echo json_encode(
        array("message" => "No hay mesas registrados.")
    );
}

