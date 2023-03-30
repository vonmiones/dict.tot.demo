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
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }

    function create(){
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
         
            $query = "INSERT INTO `users`(`name`, `email`, `phone`, `address`) VALUES ('$name','$email','$phone','$address')";
            $result = mysqli_query(self::connect(), $query);
         
            if($result){
                return $result;
            }
        }
    }
    function getAll($sql){
        $query = $sql;
        $result = mysqli_query(self::connect(), $query);

        $data = array();
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = array(
                "name" => $row["name"],
                "email" => $row["email"],
                "phone" => $row["phone"],
                "address" => $row["address"]
            );
        }

        echo json_encode($data);

    }

    function getSingle($sql,$data){
        // define the search criteria as an associative array
        // $data = array(
        //     "fname" => "John",
        //     "lname" => "Doe",
        //     "city" => "New York"
        // );

        // initialize the WHERE clause string and the array of bind parameters
        $where = "";
        $bindParams = array();

        // loop through the search criteria and add each condition to the WHERE clause
        foreach ($data as $column => $value) {
            if ($value != "") {
                $where .= " AND `$column`=?";
                $bindParams[] = $value;
            }
        }

        // remove the first "AND" from the WHERE clause
        $where = ltrim($where, " AND");

        // prepare and execute the SELECT statement with the WHERE clause
        $stmt = self::connect()->prepare("SELECT * FROM `users` WHERE $where");
        $stmt->bind_param(str_repeat("s", count($bindParams)), ...$bindParams);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = array();
        while($row = $result->fetch_assoc()) {
            $data[] = array(
                "name" => $row["name"],
                "email" => $row["email"],
                "phone" => $row["phone"],
                "address" => $row["address"]
            );
        }

        echo json_encode($data);

    }

    function update($table,$data)
    {
        // define the values to update
        $id = 1;
        // $data = array(
        //     "name" => "John Doe",
        //     "email" => "john.doe@example.com",
        //     "phone" => "555-1234",
        //     "address" => "123 Main St, New York"
        // );

        // initialize the SET clause string and the array of bind parameters
        $setClause = "";
        $bindParams = array();

        // loop through the update values and add each column-value pair to the SET clause
        foreach ($data as $column => $value) {
            $setClause .= "`$column`=?, ";
            $bindParams[] = $value;
        }

        // remove the trailing comma and space from the SET clause
        $setClause = rtrim($setClause, ", ");

        // prepare the UPDATE statement
        $stmt = self::connect()->prepare("UPDATE $table SET $setClause WHERE `id`=?");

        // add the ID to the bind parameters array
        $bindParams[] = $id;

        // generate the types string for the bind_param() method
        $typesString = str_repeat("s", count($bindParams) - 1) . "i";

        // bind the values to the placeholders in the prepared statement
        $stmt->bind_param($typesString, ...$bindParams);

        // execute the prepared statement
        $stmt->execute();

        // check the number of affected rows
        if ($stmt->affected_rows > 0) {
            echo "Record updated successfully.";
        } else {
            echo "No records were updated.";
        }


    }

    function delete(){
        $id = $_GET['id'];
        $query = "DELETE FROM `users` WHERE `id`='$id'";
        $result = mysqli_query(self::connect(), $query);

        if($result){
            header("location:index.php");
        }

    }


}
$db = new MySQLDBHelper();
$db->connect();


