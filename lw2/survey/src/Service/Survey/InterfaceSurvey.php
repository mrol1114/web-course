<?php

namespace App\Service\Survey;

interface InterfaceSurvey
{
    public function saveSurvey(): array;
    public function printSurvey(): array;
}