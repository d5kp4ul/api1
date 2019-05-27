<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here

// include database and object files
include_once '../configuracion/database.php';
include_once '../objetos/detalles_facturas.php';
 
// instantiate database and detalles_de_facturas object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$detalles_facturas = new Detalles_Facturas($db);
 
// read detalles_de_facturas will be here

// query detalles_de_facturas
$stmt = $detalles_facturas->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // detalles_de_facturas array
    $detalles_facturas_arr=array();
    //$detalles_facturas_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $detalles_factura_item=array(
            "idDetalles_Factura" => $idDetalles_Factura,
            "Menus_idMenu" => $Menus_idMenu,
            "Facturas_idFactura" => $Facturas_idFactura,
        );
 
        array_push($detalles_facturas_arr, $detalles_factura_item);
        //array_push($detalles_facturas_arr["records"], $detalles_factura_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show detalles_de_facturas data in json format
    echo json_encode($detalles_facturas_arr);
}
 
// no detalles_de_facturas found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no detalles_de_facturas found
    echo json_encode(
        array("message" => "No hay detalles de facturas por el momento.")
    );
}

