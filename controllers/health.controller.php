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
        $result = self::db()->selectData("disease, COUNT(*) AS num_cases", $limit);
        return $result;
    }

    function getAllEntities(){
        $result = self::db()->getAll();
        return $result;
    }
}
