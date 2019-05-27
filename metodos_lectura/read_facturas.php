<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here

// include database and object files
include_once '../configuracion/database.php';
include_once '../objetos/facturas.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$facturas = new Facturas($db);
 
// read facturas will be here

// query facturas
$stmt = $facturas->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // facturas array
    $facturas_arr=array();
    //$facturas_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $factura_item=array(
            "idFactura" => $idFactura,
            "fechaFactura" => $fechaFactura,
            "Clientes_idCliente" => $Clientes_idCliente,
            "Empleados_idEmpleado" => $Empleados_idEmpleado
        );
 
        array_push($facturas_arr, $factura_item);
        //array_push($facturas_arr["records"], $factura_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show facturas data in json format
    echo json_encode($facturas_arr);
}
 
// no facturas found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no facturas found
    echo json_encode(
        array("message" => "No se han registrado facturas por el momento.")
    );
}

