<?php
class MySQLDBHelper
{
    function __construct() {

    }

    function connect(){
        global $config;
        require_once("../../../config.php");

        $servername = $config["dbhost"];
        $port = $config["dbport"];
        $username = $config["dbuser"];
        $password = "";
        $dbname = $config["dbpass"];
    
        return new mysqli($servername, $username, $password, $dbname, $port);
    
        if (self::connect()->connect_error) {
            die("Connection failed: " . self::connect()->connect_error);
        }
    }

    function create($data){
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
        $dtcreated = date("Y-m-d H:i:s");
        $dtupdate = date("Y-m-d H:i:s");
        $remarks = $data["remarks"];
        $datastatus = 1;
        
        $stmt = self::connect()->prepare("
            INSERT INTO `personnel` 
            (`fname`, `mname`, `lname`, `suffix`, `sex`, `civilstatus`, 
            `birthdate`, `height`, `weight`, `bloodtype`, `barangay`, 
            `citymun`, `province`, `email`, `contactno`, `contactno2`, 
            `isvaccinated`, `vaccinedetails`, `disease`, `symptoms`, 
            `medicationdetails`, `recommendation`, `dtcreated`, `dtupdate`, 
            `remarks`, `datastatus`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssssssssssssssssssssssi", 
        $fname, $mname, $lname, $suffix, $sex, $civilstatus, 
        $birthdate, $height, $weight, $bloodtype, 
        $barangay, $citymun, $province, $email, $contactno, 
        $contactno2, $isvaccinated, $vaccinedetails, $disease, 
        $symptoms, $medicationdetails, $recommendation, $dtcreated, 
        $dtupdate, $remarks, $datastatus);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Record inserted successfully.";
        } else {
            echo "Record was not inserted.";
        }

        $stmt->close();
        self::connect()->close();
    }
    function getAll($sql){
        $stmt = self::connect()->prepare("SELECT * FROM `personnel`");

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

        $stmt = self::connect()->prepare("SELECT * FROM `personnel` WHERE `$search_column` = ?");

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

    function selectData($conn, $table, $fields, $whereClause = "", $params = array()) {
        $sql = "SELECT " . implode(", ", $fields) . " FROM " . $table;
        if (!empty($whereClause)) {
            $sql .= " WHERE " . $whereClause;
        }
        
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Failed to prepare statement: " . $conn->error);
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

        $stmt = self::connect()->prepare("UPDATE `personnel` SET `fname`=?, `mname`=?, `lname`=?, `suffix`=?, `sex`=?, `civilstatus`=?, `birthdate`=?, `height`=?, `weight`=?, `bloodtype`=?, `barangay`=?, `citymun`=?, `province`=?, `email`=?, `contactno`=?, `contactno2`=?, `isvaccinated`=?, `vaccinedetails`=?, `disease`=?, `symptoms`=?, `medicationdetails`=?, `recommendation`=?, `dtupdate`=?, `remarks`=? WHERE `id`=?");

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
        $id = $data["i

        $stmt = self::connect()->prepare("DELETE FROM `personnel` WHERE `id`=?");

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


