<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here

// include database and object files
include_once '../configuracion/database.php';
include_once '../objetos/pedidos_a_domicilio.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$pedidos_a_domicilio = new Pedidos_a_Domicilio($db);
 
// read pedidos_a_domicilio will be here

// query pedidos_a_domicilio
$stmt = $pedidos_a_domicilio->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // pedidos_a_domicilio array
    $pedidos_a_domicilio_arr=array();
    //$pedidos_a_domicilio_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $pedido_a_domicilio_item=array(
            "idPedido_a_Domicilio" => $idPedido_a_Domicilio,
            "Clientes_nombreCliente" => $Clientes_nombreCliente,
            "telefonoCliente" => $telefonoCliente,
            "fechaPedido" => $fechaPedido,
            "horarioSalida" => $horarioSalida,
            "ubicacionCliente" => $ubicacionCliente,
            "coordenadasCliente" => $coordenadasCliente
        );
 
        array_push($pedidos_a_domicilio_arr, $pedido_a_domicilio_item);
        //array_push($pedidos_a_domicilio_arr["records"], $pedido_a_domicilio_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show pedidos_a_domicilio data in json format
    echo json_encode($pedidos_a_domicilio_arr);
}
 
// no pedidos_a_domicilio found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no pedidos_a_domicilio found
    echo json_encode(
        array("message" => "No hay ningún pedido registrado.")
    );
}

