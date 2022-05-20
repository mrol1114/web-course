<?php

namespace App\Controller;

use App\Service\Survey\SurveyService;
use App\Service\Survey\SurveyServiceInterface;
use App\View\SurveyView;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyController extends AbstractController
{
    function __construct()
    {
        $this->formTemplate = 'form.html.twig';
        $this->searchTemplate = 'search.html.twig';
    }

    public function renderSurveyForm(): Response
    {
        return $this->render($this->formTemplate, []);
    }

    public function renderSurveySearch(): Response
    {
        return $this->render($this->searchTemplate, []);
    }

    public function saveSurvey(Request $request, SurveyServiceInterface $surveyService): Response
    {
        $surveyService->saveSurvey($request);
        return $this->render($this->formTemplate, []);
    }

    public function printSurvey(Request $request, SurveyServiceInterface $surveyService): Response
    {
        $survey = $surveyService->getSurvey($request);
        $view = new SurveyView($survey);

        return $this->render($view->getTemplate(), $view->getArgs());
    }
}
