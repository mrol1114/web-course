<?php

namespace App\Service\Survey;

use App\Module\Survey\SurveyFileStorage;
use App\Module\Survey\SurveyLoader;

class ServicesSurvey implements InterfaceSurvey
{
    public function saveSurvey(): array
    {
        $requestSurvey = new SurveyLoader();
        $fileStorage = new SurveyFileStorage();

        $survey =  $requestSurvey->makeSurveyFromRequest();
        $fileStorage->saveSurvey($survey);
        return
            [
                'firstName' => $survey->getFirstName(),
                'lastName' => $survey->getLastName(),
                'age' => $survey->getAge(),
                'email' => $survey->getEmail(),
            ];
    }

    public function printSurvey(): array
    {
        $requestSurvey = new SurveyLoader();
        $fileStorage = new SurveyFileStorage();

        $survey = $requestSurvey->makeSurveyFromRequest();
        $loadedSurvey = $fileStorage->loadSurvey($survey);
        return
            [
                'fileFirstName' => $loadedSurvey->getFirstName(),
                'fileLastName' => $loadedSurvey->getLastName(),
                'fileAge' => $loadedSurvey->getAge(),
                'fileEmail' => $loadedSurvey->getEmail(),
                'email' => $survey->getEmail(),
            ];
    }
}