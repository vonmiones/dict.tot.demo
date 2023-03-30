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
    
        // Create connection
        return new mysqli($servername, $username, $password, $dbname, $port);
    
        // Check connection
        if (self::connect()->connect_error) {
            die("Connection failed: " . self::connect()->connect_error);
        }
    }

    function create($data){
        // define the input values
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
        
        // prepare the INSERT statement with placeholders for the input values
        $stmt = self::connect()->prepare("
            INSERT INTO `personnel` 
            (`fname`, `mname`, `lname`, `suffix`, `sex`, `civilstatus`, 
            `birthdate`, `height`, `weight`, `bloodtype`, `barangay`, 
            `citymun`, `province`, `email`, `contactno`, `contactno2`, 
            `isvaccinated`, `vaccinedetails`, `disease`, `symptoms`, 
            `medicationdetails`, `recommendation`, `dtcreated`, `dtupdate`, 
            `remarks`, `datastatus`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // bind the input values to the placeholders in the prepared statement
        $stmt->bind_param("ssssssssssssssssssssssssi", 
        $fname, $mname, $lname, $suffix, $sex, $civilstatus, 
        $birthdate, $height, $weight, $bloodtype, 
        $barangay, $citymun, $province, $email, $contactno, 
        $contactno2, $isvaccinated, $vaccinedetails, $disease, 
        $symptoms, $medicationdetails, $recommendation, $dtcreated, 
        $dtupdate, $remarks, $datastatus);

        // execute the prepared statement
        $stmt->execute();

        // check the number of affected rows
        if ($stmt->affected_rows > 0) {
            echo "Record inserted successfully.";
        } else {
            echo "Record was not inserted.";
        }

        // close the statement and the database connection
        $stmt->close();
        self::connect()->close();
    }
    function getAll($sql){
        // prepare the SELECT statement
        $stmt = self::connect()->prepare("SELECT * FROM `personnel`");

        // execute the prepared statement
        $stmt->execute();

        // bind the result set columns to variables
        $stmt->bind_result($id, $fname, $mname, $lname, $suffix, $sex, $civilstatus, $birthdate, $height, $weight, $bloodtype, $barangay, $citymun, $province, $email, $contactno, $contactno2, $isvaccinated, $vaccinedetails, $disease, $symptoms, $medicationdetails, $recommendation, $dtcreated, $dtupdate, $remarks, $datastatus);

        // create an array to store the results
        $results = array();

        // fetch each row and store it in the results array
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

        // close the statement and the database connection
        $stmt->close();
        self::connect()->close();

        // output the results array as JSON
        echo json_encode($results);

    }

    function getSingle($sql,$data){
        // define the variable for the ID
        $id = $data['id'];

        // define the variable for the column to search
        $search_column = "id";

        // prepare the SELECT statement
        $stmt = self::connect()->prepare("SELECT * FROM `personnel` WHERE `$search_column` = ?");

        // bind the ID variable to the prepared statement
        $stmt->bind_param("i", $id);

        // execute the prepared statement
        $stmt->execute();

        // bind the result set columns to variables
        $stmt->bind_result($id, $fname, $mname, $lname, $suffix, $sex, $civilstatus, $birthdate, $height, $weight, $bloodtype, $barangay, $citymun, $province, $email, $contactno, $contactno2, $isvaccinated, $vaccinedetails, $disease, $symptoms, $medicationdetails, $recommendation, $dtcreated, $dtupdate, $remarks, $datastatus);

        // fetch the first (and only) row
        $stmt->fetch();

        // create an array to store the result
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

        // close the statement and the database connection
        $stmt->close();
        self::connect()->close();

        // output the result array as JSON
        echo json_encode($result);
    }

    function selectData($conn, $table, $fields, $whereClause = "", $params = array()) {
        // construct the SQL query
        $sql = "SELECT " . implode(", ", $fields) . " FROM " . $table;
        if (!empty($whereClause)) {
            $sql .= " WHERE " . $whereClause;
        }
        
        // prepare the SQL statement
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Failed to prepare statement: " . $conn->error);
        }
        
        // bind the query parameters
        if (!empty($params)) {
            $types = str_repeat("s", count($params));
            $stmt->bind_param($types, ...$params);
        }
        
        // execute the query
        if (!$stmt->execute()) {
            die("Failed to execute statement: " . $stmt->error);
        }
        
        // fetch the result set and return as an array
        $result = $stmt->get_result();
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        
        // clean up and return the result set
        $stmt->close();
        return $rows;
    }
    

    function update($table,$data)
    {
        // define the input values
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

        // prepare the UPDATE statement with placeholders for the input values
        $stmt = self::connect()->prepare("UPDATE `personnel` SET `fname`=?, `mname`=?, `lname`=?, `suffix`=?, `sex`=?, `civilstatus`=?, `birthdate`=?, `height`=?, `weight`=?, `bloodtype`=?, `barangay`=?, `citymun`=?, `province`=?, `email`=?, `contactno`=?, `contactno2`=?, `isvaccinated`=?, `vaccinedetails`=?, `disease`=?, `symptoms`=?, `medicationdetails`=?, `recommendation`=?, `dtupdate`=?, `remarks`=? WHERE `id`=?");

        // bind the input values to the placeholders in the prepared statement
        $stmt->bind_param("sssssssssssssssssssssssi", $fname, $mname, $lname, $suffix, $sex, $civilstatus, $birthdate, $height, $weight, $bloodtype, $barangay, $citymun, $province, $email, $contactno, $contactno2, $isvaccinated, $vaccinedetails, $disease, $symptoms, $medicationdetails, $recommendation, $dtupdate, $remarks, $id);

        // execute the prepared statement
        $stmt->execute();

        // check the number of affected rows
        if ($stmt->affected_rows > 0) {
            echo "Record updated successfully.";
        } else {
            echo "Record was not updated.";
        }

        // close the statement and the database connection
        $stmt->close();
        self::connect()->close();


    }

    function delete($data){
        // define the input values
        $id = $data["id"]; // assuming this is the ID of the row to be deleted

        // prepare the DELETE statement with a placeholder for the input value
        $stmt = self::connect()->prepare("DELETE FROM `personnel` WHERE `id`=?");

        // bind the input value to the placeholder in the prepared statement
        $stmt->bind_param("i", $id);

        // execute the prepared statement
        $stmt->execute();

        // check the number of affected rows
        if ($stmt->affected_rows > 0) {
            echo "Record deleted successfully.";
        } else {
            echo "Record was not deleted.";
        }

        // close the statement and the database connection
        $stmt->close();
        self::connect() ->close();

    }


}
$db = new MySQLDBHelper();
$db->connect();


