<?php
// require_once "libs/core/database/mysql.php";
// $db = new MySQLDBHelper();

require_once "controllers/health.controller.php";
$method = "";
if(isset($_POST)){
    $method = array("method"=>"get","request"=>isset($_POST["method"])? $_POST["method"]:"");
}
if(isset($_GET)){
    $method = array("method"=>"get","request"=>isset($_GET["method"])? json_encode($_GET["method"]):"");
}
switch ($method["method"]) {
    case 'post':
            echo "post";
        break;
        case 'get':
            $request = "";
            $data = array();
            foreach ($_GET['data']  as $key => $value) {
                $data[$value['name']] = $value['value'];
            }
            $healthinfo = new HealthInformationClass();
            $result = $healthinfo->addNewCase($data);
            echo "Get " . json_encode( $result);
        break;
    default:
            http_response_code(404);
            die("Page Not Found");
        break;
}