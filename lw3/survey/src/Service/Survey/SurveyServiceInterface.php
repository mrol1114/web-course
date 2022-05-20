<?php

namespace App\Service\Survey;

use App\Module\Survey\Survey;
use Symfony\Component\HttpFoundation\Request;

interface SurveyServiceInterface
{
    public function saveSurvey(Request $request): void;
    public function getSurvey(Request $request): Survey;
}