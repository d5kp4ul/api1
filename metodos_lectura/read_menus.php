<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here

// include database and object files
include_once '../configuracion/database.php';
include_once '../objetos/menus.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$menus = new Menus($db);
 
// read menus will be here

// query menus
$stmt = $menus->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // menus array
    $menus_arr=array();
    //$menus_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $menu_item=array(
            "idMenu" => $idMenu,
            "nombreMenu" => $nombreMenu,
            "descripcionMenu" => $descripcionMenu,
            "precioMenu" => $precioMenu
        );
 
        array_push($menus_arr, $menu_item);
        //array_push($menus_arr["records"], $menu_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show menus data in json format
    echo json_encode($menus_arr);
}
 
// no menus found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no menus found
    echo json_encode(
        array("message" => "No hay platillos registrados.")
    );
}

