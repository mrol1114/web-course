<?php
namespace App\Module\Survey;

use Symfony\Component\HttpFoundation\Request;

class SurveyLoader
{
    public function makeSurveyFromRequest(Request $request, string $imageId = ''): Survey
    {
        $firstName = $request->get('first_name') ?? '';
        $lastName = $request->get('last_name') ?? '';
        $email = $request->get('email') ?? '';
        $age = $request->get('age') ?? '';
        return new Survey($firstName, $lastName, $email, $age, $imageId);
    }
}