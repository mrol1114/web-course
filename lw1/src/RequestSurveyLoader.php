<?php
class RequestSurveyLoader
{
    public function makeSurveyFromParametrs() : Survey
    {
        $firstName = $_GET["first_name"] ? $_GET["first_name"] : "";
        $lastName = $_GET["last_name"] ? $_GET["last_name"] : "";
        $email = $_GET["email"] ? $_GET["email"] : "";
        $age = $_GET["age"] ? $_GET["age"] : "";
        return new Survey($firstName, $lastName, $email, $age);
    }
}