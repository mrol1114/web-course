<?php

namespace App\Controller;

use App\Service\Survey\InterfaceSurvey;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SurveyController extends AbstractController
{
    public function saveSurvey(InterfaceSurvey $surveyServices): Response
    {
        $values = $surveyServices->saveSurvey();
        return $this->render('upload.html.twig',
            [
                'firstName' => $values['firstName'],
                'lastName' => $values['lastName'],
                'age' => $values['age'],
                'email' => $values['email'],
            ]
        );
    }

    public function printSurvey(InterfaceSurvey $surveyServices): Response
    {
        $values = $surveyServices->printSurvey();
        return $this->render('load.html.twig',
            [
                'fileFirstName' => $values['fileFirstName'],
                'fileLastName' => $values['fileLastName'],
                'fileAge' => $values['fileAge'],
                'fileEmail' => $values['fileEmail'],
                'email' => $values['email'],
            ]
        );
    }
}
