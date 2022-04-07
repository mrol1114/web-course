<?php
class SurveyPrinter
{
    private const SEPARATOR = "<br>";
    private const ASSIGNMENT = ': ';
    private const WEB_FIRST_NAME = 'First Name';
    private const WEB_LAST_NAME = 'Last Name';
    private const WEB_AGE = 'Age';
    private const WEB_EMAIL = 'Email';

    public function printSurvey(Survey $survey) : void
    {
        $resString = '';
        $values = [
            self::WEB_FIRST_NAME => $survey->getFirstName(),
            self::WEB_LAST_NAME => $survey->getLastName(),
            self::WEB_AGE => $survey->getAge(),
            self::WEB_EMAIL => $survey->getEmail(),
        ];
        foreach (array_keys($values) as $key)
        {
            $resString .= $key . self::ASSIGNMENT . $values[$key] . self::SEPARATOR;
        }
        echo $resString;
    }
}