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

    function getDeleteData($data){
        $result = self::db()->delete($data);
        return $result;
    }

    function getAllEntities(){
        $result = self::db()->getAll();
        return $result;
    }
}
