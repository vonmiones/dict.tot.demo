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
            return "0 results";
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
    
    function getDataCount() {
        $conn = self::connect();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $result = $conn->query("SELECT COUNT(*) as `total` FROM demoentity");

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

        $sql = "SELECT *,CONCAT(fname,' ', SUBSTRING(mname,1,1), '. ', lname  ) as `name` FROM demoentity LIMIT 1000";
        $result = $conn->query($sql);

        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;;
            }
        } else {
            return "0 results";
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

        return json_encode($result);
    }


    function update($data)
    {
        $conn = self::connect();
        $msg = "";
        $fname = htmlspecialchars($data['fname'],ENT_QUOTES);
        $mname = htmlspecialchars($data['mname'],ENT_QUOTES);
        $lname = htmlspecialchars($data['lname'],ENT_QUOTES);
        $suffix = htmlspecialchars($data['suffix'],ENT_QUOTES);
        $sex = htmlspecialchars($data['sex'],ENT_QUOTES);
        $civilstatus = htmlspecialchars($data['civilstatus'],ENT_QUOTES);
        $birthdate = htmlspecialchars($data['birthdate'],ENT_QUOTES);
        $height = htmlspecialchars($data['height'],ENT_QUOTES);
        $weight = htmlspecialchars($data['weight'],ENT_QUOTES);
        $bloodtype = htmlspecialchars($data['bloodtype'],ENT_QUOTES);
        $barangay = htmlspecialchars($data['barangay'],ENT_QUOTES);
        $citymun = htmlspecialchars($data['citymun'],ENT_QUOTES);
        $province = htmlspecialchars($data['province'],ENT_QUOTES);
        $email = htmlspecialchars($data['email'],ENT_QUOTES);
        $contactno = htmlspecialchars($data['contactno'],ENT_QUOTES);
        $contactno2 = htmlspecialchars($data['contactno2'],ENT_QUOTES);
        $isvaccinated = htmlspecialchars($data['isvaccinated'],ENT_QUOTES);
        $vaccinedetails = htmlspecialchars($data['vaccinedetails'],ENT_QUOTES);
        $disease = htmlspecialchars($data['disease'],ENT_QUOTES);
        $symptoms = htmlspecialchars($data['symptoms'],ENT_QUOTES);
        $medicationdetails = htmlspecialchars($data['medicationdetails'],ENT_QUOTES);
        $recommendation = htmlspecialchars($data['recommendation'],ENT_QUOTES);
        $remarks = htmlspecialchars($data['remarks'],ENT_QUOTES);
        $datastatus = htmlspecialchars($data['datastatus'],ENT_QUOTES);
        $temp = htmlspecialchars($data['temp'],ENT_QUOTES);
        $coviddiagnosed = htmlspecialchars($data['coviddiagnosed'],ENT_QUOTES);
        $covidencounter = htmlspecialchars($data['covidencounter'],ENT_QUOTES);
        $id = $data['id'];

        $sql = "UPDATE demoentity SET fname = ?, mname = ?, lname = ?, suffix = ?, sex = ?, civilstatus = ?, birthdate = ?, height = ?, weight = ?, bloodtype = ?, barangay = ?, citymun = ?, province = ?, email = ?, contactno = ?, contactno2 = ?, isvaccinated = ?, vaccinedetails = ?, disease = ?, symptoms = ?, medicationdetails = ?, recommendation = ?, remarks = ?, datastatus = ?, temp = ?, coviddiagnosed = ?, covidencounter = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if (!$stmt) {
            return ("Error preparing statement: " . mysqli_error($conn));
            // return false;
        }

        mysqli_stmt_bind_param($stmt, "sssssssssssssssssssssssssssi", $fname, $mname, $lname, $suffix, $sex, $civilstatus, $birthdate, $height, $weight, $bloodtype, $barangay, $citymun, $province, $email, $contactno, $contactno2, $isvaccinated, $vaccinedetails, $disease, $symptoms, $medicationdetails, $recommendation, $remarks, $datastatus, $temp, $coviddiagnosed, $covidencounter, $id);

        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            $msg = ("Error executing statement: " . mysqli_error($conn));
            // $msg = false;
        }

        $affected_rows = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        if ($affected_rows > 0) {
            $msg = "Record updated successfully.";
            return array("result"=>"success","message"=>$msg);
        } else {
            $msg = "Record was not updated.";
            return array("result"=>"success","message"=>$msg);
        }
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


