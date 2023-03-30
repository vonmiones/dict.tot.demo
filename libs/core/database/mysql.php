<?php
error_reporting(E_ALL ^ E_WARNING); 
class MySQLDBHelper
{
    function __construct() {

    }

    function connect(){
        global $config;
        require_once("config.php");

        $servername = $config["dbhost"];
        $port = $config["dbport"];
        $username = $config["dbuser"];
        $password = $config["dbpass"];
        $dbname = $config["dbname"];
    
        return new mysqli($servername, $username, $password, $dbname, $port);
    
        if (self::connect()->connect_error) {
            die("Connection failed: " . self::connect()->connect_error);
        }
    }
    function create($data) {
        $conn = self::connect();
        $table = "demoentity";
        $fields = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";
        
        $stmt = mysqli_prepare($conn, $sql);
        if (!$stmt) {
            error_log("Error preparing statement: " . mysqli_error($conn));
            return false;
        }
        
        $values = array_values($data);
        $types = str_repeat("s", count($data));
        array_unshift($values, $types);
        
        call_user_func_array("mysqli_stmt_bind_param", array_merge(array($stmt), $values));
        
        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            error_log("Error executing statement: " . mysqli_error($conn));
            return false;
        }
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return array("result"=>"success","message"=>$affected_rows);
    }
    function create1($data){

        $conn = self::connect();
        $fname = mysqli_real_escape_string($conn, $data["fname"]);
        $mname = mysqli_real_escape_string($conn, $data["mname"]);
        $lname = mysqli_real_escape_string($conn, $data["lname"]);
        $suffix = mysqli_real_escape_string($conn, $data["suffix"]);
        $sex = mysqli_real_escape_string($conn, $data["sex"]);
        $civilstatus = mysqli_real_escape_string($conn, $data["civilstatus"]);
        $birthdate = mysqli_real_escape_string($conn, $data["birthdate"]);
        $height = mysqli_real_escape_string($conn, $data["height"]);
        $weight = mysqli_real_escape_string($conn, $data["weight"]);
        $bloodtype = mysqli_real_escape_string($conn, $data["bloodtype"]);
        $barangay = mysqli_real_escape_string($conn, $data["barangay"]);
        $citymun = mysqli_real_escape_string($conn, $data["citymun"]);
        $province = mysqli_real_escape_string($conn, $data["province"]);
        $email = mysqli_real_escape_string($conn, $data["email"]);
        $contactno = mysqli_real_escape_string($conn, $data["contactno"]);
        $contactno2 = mysqli_real_escape_string($conn, $data["contactno2"]);
        $isvaccinated = mysqli_real_escape_string($conn, $data["isvaccinated"]);
        $vaccinedetails = mysqli_real_escape_string($conn, $data["vaccinedetails"]);
        $disease = mysqli_real_escape_string($conn, $data["disease"]);
        $symptoms = mysqli_real_escape_string($conn, $data["symptoms"]);
        $medicationdetails = mysqli_real_escape_string($conn, $data["medicationdetails"]);
        $recommendation = mysqli_real_escape_string($conn, $data["recommendation"]);
        
        $stmt = self::connect()->prepare("
            INSERT INTO `demoentity` 
            (`fname`, `mname`, `lname`, `suffix`, `sex`, `civilstatus`, 
            `birthdate`, `height`, `weight`, `bloodtype`, `barangay`, 
            `citymun`, `province`, `email`, `contactno`, `contactno2`, 
            `isvaccinated`, `vaccinedetails`, `disease`, `symptoms`, 
            `medicationdetails`, `recommendation`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )");

        $stmt->bind_param("ssssssssssssssssssssss", 
        $fname, $mname, $lname, $suffix, $sex, $civilstatus, 
        $birthdate, $height, $weight, $bloodtype, 
        $barangay, $citymun, $province, $email, $contactno, 
        $contactno2, $isvaccinated, $vaccinedetails, $disease, 
        $symptoms, $medicationdetails, $recommendation);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Record inserted successfully.";
        } else {
            echo "Record was not inserted.";
        }

        $stmt->close();
        self::connect()->close();
    }
    function getAll(){
        $stmt = self::connect()->prepare("SELECT * FROM `demoentity`");

        $stmt->execute();

        $stmt->bind_result($id, $fname, $mname, $lname, $suffix, $sex, $civilstatus, $birthdate, $height, $weight, $bloodtype, $barangay, $citymun, $province, $email, $contactno, $contactno2, $isvaccinated, $vaccinedetails, $disease, $symptoms, $medicationdetails, $recommendation, $dtcreated, $dtupdate, $remarks, $datastatus);

        $results = array();

        while ($stmt->fetch()) {
            $row = array(
                "id" => $id,
                "fname" => $fname,
                "mname" => $mname,
                "lname" => $lname,
                "suffix" => $suffix,
                "sex" => $sex,
                "civilstatus" => $civilstatus,
                "birthdate" => $birthdate,
                "height" => $height,
                "weight" => $weight,
                "bloodtype" => $bloodtype,
                "barangay" => $barangay,
                "citymun" => $citymun,
                "province" => $province,
                "email" => $email,
                "contactno" => $contactno,
                "contactno2" => $contactno2,
                "isvaccinated" => $isvaccinated,
                "vaccinedetails" => $vaccinedetails,
                "disease" => $disease,
                "symptoms" => $symptoms,
                "medicationdetails" => $medicationdetails,
                "recommendation" => $recommendation,
                "dtcreated" => $dtcreated,
                "dtupdate" => $dtupdate,
                "remarks" => $remarks,
                "datastatus" => $datastatus
            );
            $results[] = $row;
        }

        $stmt->close();
        self::connect()->close();

        echo json_encode($results);

    }

    function getSingle($sql,$data){
        $id = $data['id'];

        $search_column = "id";

        $stmt = self::connect()->prepare("SELECT * FROM `demoentity` WHERE `$search_column` = ?");

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $stmt->bind_result($id, $fname, $mname, $lname, $suffix, $sex, $civilstatus, $birthdate, $height, $weight, $bloodtype, $barangay, $citymun, $province, $email, $contactno, $contactno2, $isvaccinated, $vaccinedetails, $disease, $symptoms, $medicationdetails, $recommendation, $dtcreated, $dtupdate, $remarks, $datastatus);

        $stmt->fetch();

        $result = array(
            "id" => $id,
            "fname" => $fname,
            "mname" => $mname,
            "lname" => $lname,
            "suffix" => $suffix,
            "sex" => $sex,
            "civilstatus" => $civilstatus,
            "birthdate" => $birthdate,
            "height" => $height,
            "weight" => $weight,
            "bloodtype" => $bloodtype,
            "barangay" => $barangay,
            "citymun" => $citymun,
            "province" => $province,
            "email" => $email,
            "contactno" => $contactno,
            "contactno2" => $contactno2,
            "isvaccinated" => $isvaccinated,
            "vaccinedetails" => $vaccinedetails,
            "disease" => $disease,
            "symptoms" => $symptoms,
            "medicationdetails" => $medicationdetails,
            "recommendation" => $recommendation,
            "dtcreated" => $dtcreated,
            "dtupdate" => $dtupdate,
            "remarks" => $remarks,
            "datastatus" => $datastatus
        );

        $stmt->close();
        self::connect()->close();

        echo json_encode($result);
    }

    function selectData($table, $fields, $whereClause = "", $params = array()) {
        $sql = "SELECT " . implode(", ", $fields) . " FROM " . $table;
        if (!empty($whereClause)) {
            $sql .= " WHERE " . $whereClause;
        }
        
        $stmt = self::connect()->prepare($sql);
        if (!$stmt) {
            die("Failed to prepare statement: " . self::connect()->error);
        }
        
        if (!empty($params)) {
            $types = str_repeat("s", count($params));
            $stmt->bind_param($types, ...$params);
        }
        
        if (!$stmt->execute()) {
            die("Failed to execute statement: " . $stmt->error);
        }
        
        $result = $stmt->get_result();
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        
        $stmt->close();
        return $rows;
    }
    

    function update($table,$data)
    {
        $id = $data["id"]; 
        $fname = $data["fname"];
        $mname = $data["mname"];
        $lname = $data["lname"];
        $suffix = $data["suffix"];
        $sex = $data["sex"];
        $civilstatus = $data["civilstatus"];
        $birthdate = $data["birthdate"];
        $height = $data["height"];
        $weight = $data["weight"];
        $bloodtype = $data["bloodtype"];
        $barangay = $data["barangay"];
        $citymun = $data["citymun"];
        $province = $data["province"];
        $email = $data["email"];
        $contactno = $data["contactno"];
        $contactno2 = $data["contactno2"];
        $isvaccinated = $data["isvaccinated"];
        $vaccinedetails = $data["vaccinedetails"];
        $disease = $data["disease"];
        $symptoms = $data["symptoms"];
        $medicationdetails = $data["medicationdetails"];
        $recommendation = $data["recommendation"];
        $dtupdate = date("Y-m-d H:i:s");
        $remarks = $data["remarks"];

        $stmt = self::connect()->prepare("UPDATE `demoentity` SET `fname`=?, `mname`=?, `lname`=?, `suffix`=?, `sex`=?, `civilstatus`=?, `birthdate`=?, `height`=?, `weight`=?, `bloodtype`=?, `barangay`=?, `citymun`=?, `province`=?, `email`=?, `contactno`=?, `contactno2`=?, `isvaccinated`=?, `vaccinedetails`=?, `disease`=?, `symptoms`=?, `medicationdetails`=?, `recommendation`=?, `dtupdate`=?, `remarks`=? WHERE `id`=?");

        $stmt->bind_param("sssssssssssssssssssssssi", $fname, $mname, $lname, $suffix, $sex, $civilstatus, $birthdate, $height, $weight, $bloodtype, $barangay, $citymun, $province, $email, $contactno, $contactno2, $isvaccinated, $vaccinedetails, $disease, $symptoms, $medicationdetails, $recommendation, $dtupdate, $remarks, $id);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Record updated successfully.";
        } else {
            echo "Record was not updated.";
        }

        $stmt->close();
        self::connect()->close();


    }

    function delete($data){
        $id = $data["i"];

        $stmt = self::connect()->prepare("DELETE FROM `demoentity` WHERE `id`=?");

        $stmt->bind_param("i", $id);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Record deleted successfully.";
        } else {
            echo "Record was not deleted.";
        }

        $stmt->close();
        self::connect() ->close();

    }


}
$db = new MySQLDBHelper();
$db->connect();


