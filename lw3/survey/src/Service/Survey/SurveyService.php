<?php

namespace App\Service\Survey;

use App\Module\photoStorage\PhotoStorage;
use App\Module\Survey\Survey;
use App\Module\Survey\SurveyFileStorage;
use App\Module\Survey\SurveyLoader;
use App\View\SurveyView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyService implements SurveyServiceInterface
{
    function __construct()
    {
        $this->requestSurvey = new SurveyLoader();
        $this->photoStorage = new PhotoStorage();
        $this->fileStorage = new SurveyFileStorage();
    }

    public function saveSurvey(Request $request): void
    {
        $email = $request->get('email');
        if ($email && $email != '')
        {
            $imageId = $this->photoStorage->saveImg($request, 'img', $email);
            $survey = $this->requestSurvey->makeSurveyFromRequest($request, $imageId);
            $this->fileStorage->saveSurvey($survey);
        }
    }

    public function getSurvey(Request $request): Survey
    {
        $email = $request->get('email');

        $survey = $this->fileStorage->loadSurvey($email);

        return $survey;
    }
}