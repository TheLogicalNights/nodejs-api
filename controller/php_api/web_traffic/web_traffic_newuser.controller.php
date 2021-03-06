<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    //include database and table files
    include ("C:/xampp/htdocs/php-api/model/config/path.model.php");
    include ("$model/config/database.model.php");
    include ("$model/traffic.model.php");
    
    $db = new Database();
    $conn = $db->getConnection();

    $traffic = new Trafic($conn);

    $stmt = $traffic->viewNewUser();
    $num = $stmt->rowCount();
    $traffic_record = array();
    if($num>0)
    {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $traffic_record = array(
                "newusers"  => $sessioncount
            );
            http_response_code(200);
            echo json_encode($traffic_record);
        }
    }
    else
    {
        http_response_code(404);
        echo json_encode(array(
            "message" => "Data not found"
        ));
    }
?>