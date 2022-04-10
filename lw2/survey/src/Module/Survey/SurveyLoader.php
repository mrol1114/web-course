<?php
namespace App\Module\Survey;
class SurveyLoader
{
    public function makeSurveyFromRequest() : Survey
    {
        $firstName = $_GET['first_name'] ?? '';
        $lastName = $_GET['last_name'] ?? '';
        $email = $_GET['email'] ?? '';
        $age = $_GET['age'] ?? '';
        return new Survey($firstName, $lastName, $email, $age);
    }
}