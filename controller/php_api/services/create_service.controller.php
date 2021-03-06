<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    //include database and table files
    include ("C:/xampp/htdocs/php-api/model/config/path.model.php");
    include ("$model/config/database.model.php");
    include ("$model/service.model.php");

    //created object of database and table
    $db = new Database();
    $conn = $db->getConnection();
    // instantiate product object
    $service = new Service($conn);

    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // set product property values
    $service->title = $data->title;
    $service->description = $data->description;
    $service->img = $data->img;

    if($service->createService())
    {
        http_response_code(200);
        echo json_encode(array("message" => "Service Created successfully"));
    }
    else
    {
        http_response_code(404);
        echo json_encode(array("message" => "Unable to create service"));
    }
?>