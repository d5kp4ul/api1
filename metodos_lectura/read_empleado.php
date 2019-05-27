<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here

// include database and object files
include_once '../configuracion/database.php';
include_once '../objetos/empleados.php';
 
// instantiate database and empleado object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$empleados = new Empleados($db);
 
// read empleados will be here

// query empleados
$stmt = $empleados->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // empleados array
    $empleados_arr=array();
    //$empleados_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $empleado_item=array(
            "idEmpleado" => $idEmpleado,
            "nombreEmpleado" => $nombreEmpleado,
            "apellidosEmpleado" => $apellidosEmpleado,
            "direccionEmpleado" => $direccionEmpleado,
            "cargoEmpleado" => $cargoEmpleado,
            "telefonoEmpleado" => $telefonoEmpleado, //error corregido de cargo a telefono
            "e_mailEmpleado" => $e_mailEmpleado,
            "passwordEmpleado" => $passwordEmpleado 
        );
 
        array_push($empleados_arr, $empleado_item);
        //array_push($empleados_arr["records"], $empleado_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show empleados data in json format
    echo json_encode($empleados_arr);
}
 
// no empleados found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no empleados found
    echo json_encode(
        array("message" => "No hay empleados registrados.")
    );
}

