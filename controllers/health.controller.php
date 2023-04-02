<?php


class HealthInformationClass
{
    function db(){
        require_once "libs/core/database/mysql.php";
        return new MySQLDBHelper();
    }

    function addNewCase($data){
        return self::db()->create($data);
    }

    function UpdateCase($data){
        return self::db()->update($data);
    }


    function getTopDiseases($limit=5){
        $result = self::db()->selectData("disease, COUNT(*) AS num_cases", $limit);
        return $result;
    }

    function getAllDiseases(){
        $result = self::db()->selectCustomData("SELECT * FROM diseases");
        return $result;
    }

    function getTopCountriesWithCovid($limit=2){
        $result = self::db()->selectCustomData("SELECT country, COUNT(*) AS num_cases FROM demoentity WHERE coviddiagnosed = 1 GROUP BY country ORDER BY num_cases DESC LIMIT ".$limit);
        return $result;
    }

    function getAllCovidData(){
        $result = self::db()->selectCustomData("SELECT (SELECT COUNT(*) FROM demoentity WHERE covidencounter = 1 ) AS encounter, (SELECT COUNT(*) FROM demoentity WHERE coviddiagnosed = 1) as diagnosed;");
        return $result;
    }

    function getAllCovidDataForMinors(){
        $result = self::db()->selectCustomData("SELECT COUNT(*) as 'cases',TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS minor FROM demoentity WHERE TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) < 18 AND coviddiagnosed = 1  GROUP BY minor");
        return $result;
    }

    function getAllCovidDataForAdults(){
        $result = self::db()->selectCustomData("SELECT COUNT(*) as 'cases',TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS adult FROM demoentity WHERE TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) > 18 && TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) < 60 AND coviddiagnosed = 1 GROUP BY adult");
        return $result;
    }

    function getAllCovidDataForSeniors(){
        $result = self::db()->selectCustomData("SELECT COUNT(*) as 'cases',TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS senior FROM demoentity WHERE TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) > 60 AND coviddiagnosed = 1 GROUP BY senior");
        return $result;
    }

    function DeleteData($data){
        $result = self::db()->delete($data);
        return $result;
    }

    function getAllEntities($draw,$start,$length,$searchValue){
        // $result = self::db()->selectCustomData("SELECT *,CONCAT(fname,' ', SUBSTRING(mname,1,1), '. ', lname  ) as `name` FROM demoentity LIMIT 1000");
        // construct the SQL query with pagination and search parameters

        $start = ($draw-1)*$length;
        //$length = $draw;

        $sql = "SELECT CONCAT(fname,' ', SUBSTRING(mname,1,1), '. ', lname) AS `name`,sex,birthdate,disease,temp,coviddiagnosed,covidencounter,isvaccinated,citymun,country,id FROM demoentity";
        $sql .= " WHERE CONCAT(fname,' ', SUBSTRING(mname,1,1), '. ', lname) LIKE '%$searchValue%'";
        $sql .= " ORDER BY lname ASC LIMIT $length OFFSET $start;
        ";

        // retrieve the data from the database
        $total = self::db()->getDataCount();
        $data = self::db()->selectCustomData($sql);

        // get the total number of records in the database
        $totalRecords = $total[0]['total'];

        // get the total number of records after filtering with the search parameter
        $filterRecords = count(self::db()->selectCustomData("$sql WHERE CONCAT(fname,' ', SUBSTRING(mname,1,1), '. ', lname) LIKE '%$searchValue%'"));

        $xd = [];
        foreach ($data as $key => $value) {
            $xd[] = array_values($value);
        }

        // create the JSON response with the required format for DataTables
        $result = json_encode(array(
            "draw" => intval($draw),
            "recordsTotal" =>  intval($totalRecords),
            "recordsFiltered" =>  intval($totalRecords),
            "data" => $xd
        ));

        return $result;
    }

    function getSingleData($id){

        $sql = "SELECT * FROM demoentity";
        $sql .= " WHERE id = $id";
        $data = self::db()->selectCustomData($sql);

        // create the JSON response with the required format for DataTables
        $result = json_encode(array(
            "data" => $data
        ));

        return $result;
    }
}
