<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Module\Survey\Survey;
use App\Module\Survey\SurveyLoader;
use App\Module\Survey\SurveyFileStorage;

class SurveyController extends AbstractController
{
    public function saveSurvey(Request $request): Response
    {
        $requestSurvey = new SurveyLoader();
        $fileStorage = new SurveyFileStorage();

        $survey =  $requestSurvey->makeSurveyFromRequest($request);
        $fileStorage->saveSurvey($survey);
        $values = [$survey->getFirstName(), $survey->getLastName(), $survey->getAge(), $survey->getEmail()];
        return $this->render('upload.html.twig',
            [
                'firstName' => $values[0],
                'lastName' => $values[1],
                'age' => $values[2],
                'email' => $values[3],
            ]
        );
    }

    public function printSurvey(Request $request): Response
    {
        $requestSurvey = new SurveyLoader();
        $fileStorage = new SurveyFileStorage();

        $survey = $requestSurvey->makeSurveyFromRequest($request);
        $loadedSurvey = $fileStorage->loadSurvey($survey);
        $values = [$loadedSurvey->getFirstName(), $loadedSurvey->getLastName(), $loadedSurvey->getAge(), $loadedSurvey->getEmail(), $survey->getEmail()];
        return $this->render('load.html.twig',
            [
                'fileFirstName' => $values[0],
                'fileLastName' => $values[1],
                'fileAge' => $values[2],
                'fileEmail' => $values[3],
                'email' => $values[4],
            ]
        );
    }
}
