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
    function selectData($fields, $limit) {
        $conn = self::connect();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT $fields FROM demoentity GROUP BY disease ORDER BY num_cases DESC LIMIT $limit";
        $result = $conn->query($sql);

        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;;
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        return $rows;
    }
    function selectCustomData($sql) {
        $conn = self::connect();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $result = $conn->query($sql);

        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;;
            }
        } else {
            $result = "0 results";
        }
        $conn->close();
        return $rows;
    }
    
    function getAll(){
        $conn = self::connect();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT *,CONCAT(fname,' ', SUBSTRING(mname,1,1), '. ', lname  ) as `name` FROM demoentity";
        $result = $conn->query($sql);

        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;;
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        return $rows;
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
        $id = $data["id"];
        // Create connection
        $conn = self::connect();
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        // sql to delete a record
        $sql = "DELETE FROM demoentity WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
        $result = "Record deleted successfully";
        } else {
        $result = "Error deleting record: " . $conn->error;
        }

        $conn->close();
        return array("result"=>"success","message"=>"ID: $data,  $result");
    }


}
$db = new MySQLDBHelper();
$db->connect();


