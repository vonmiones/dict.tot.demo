<?php
// require_once "libs/core/database/mysql.php";
// $db = new MySQLDBHelper();

require_once "controllers/health.controller.php";
$method = "";
$action = "";
if(isset($_POST)){
    $method = isset($_POST["method"])? $_POST["method"] :"";
    $action = isset($_POST["action"])? $_POST["action"] :"";
}else{
    $method = isset($_GET["method"])? $_GET["method"] :"";
    $action = isset($_GET["action"])? $_GET["action"] :"";
}

switch ($method) {
    case 'post':
            switch ($action) {
                case 'update':
                    break;
                case 'create':
                        $request = "";
                        $data = array();
                        foreach ($_POST['data']  as $key => $value) {
                            $data[$value['name']] = $value['value'];
                        }
                        $healthinfo = new HealthInformationClass();
                        $result = $healthinfo->addNewCase($data);
                        header("Content-type: application/json; charset=utf-8");
                        echo json_encode($result);
                    break;
                
            }
        break;
        case 'get':
            switch ($action) {
                case 'update':
                    break;
                case 'all':
                        $request = "";
                        $data = array();
                        foreach ($_POST['data']  as $key => $value) {
                            $data[$value['name']] = $value['value'];
                        }
                        $healthinfo = new HealthInformationClass();
                        $result = $healthinfo->getAll();
                        header("Content-type: application/json; charset=utf-8");
                        echo json_encode($result);
                    break;
                
            }
        break;
    default:
            http_response_code(404);
            die("Page Not Found");
        break;
}