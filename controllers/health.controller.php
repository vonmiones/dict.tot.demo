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


    function getTopDiseases($limit=3){
        $fields = array("disease", "COUNT(*) AS num_cases");

        // define the WHERE clause and parameters (optional)
        $whereClause = "";
        $params = array();

        // define the GROUP BY and ORDER BY clauses
        $groupBy = "disease";
        $orderBy = "num_cases DESC";
        $result = self::db()->selectData("demoentity", $fields, $whereClause = "", $params = array());
        return $result;
    }

    function getEntities(){
        $fields = array("disease", "COUNT(*) AS num_cases");

        // define the WHERE clause and parameters (optional)
        $whereClause = "";
        $params = array();

        // define the GROUP BY and ORDER BY clauses
        $groupBy = "disease";
        $orderBy = "num_cases DESC";
        $result = self::db()->selectData("demoentity", $fields, $whereClause = "", $params = array());
        return $result;
    }
}
