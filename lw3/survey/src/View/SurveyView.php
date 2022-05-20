<?php

namespace App\View;

use App\Module\photoStorage\PhotoStorage;
use App\Module\Survey\Survey;

class SurveyView
{
    private Survey $survey;

    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
        $this->photoStorage = new PhotoStorage();
    }

    public function getTemplate(): string
    {
        return 'survey.html.twig';
    }

    public function getArgs(): array
    {
        return [
            'email' => $this->survey->getEmail(),
            'first_name' => $this->survey->getFirstName(),
            'last_name' => $this->survey->getLastName(),
            'age' => $this->survey->getAge(),
            'image_link' => $this->photoStorage->createImageLink($this->survey->getImageId(), $this->survey->getEmail()),
        ];
    }
}