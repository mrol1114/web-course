<?php
namespace App\Module\Survey;
class SurveyFileStorage 
{
    private const SEPARATOR = '&';
    private const ASSIGNMENT = ': ';
    private const BASE = 'data';
    private const FILE_SEPARATOR = "\n";
    private const FILE_FIRST_NAME = 'First Name';
    private const FILE_LAST_NAME = 'Last Name';
    private const FILE_AGE = 'Age';
    private const FILE_EMAIL = 'Email';
    private const FILE_IMAGE_ID = 'Image Id';
    private const FILE_TYPE = '.txt';

    public function loadSurvey(string $email) : Survey
    {
        $path = $this->createPath($email);

        if  (file_exists($path)) 
        {
            $fp = fopen($path, 'r');
            if ($fp) 
            {
                $text = $this->readFileToString($fp);
                fclose($fp);
                $array = $this->splitStringToArray($text, self::SEPARATOR, self::ASSIGNMENT);
                return new Survey(
                    $array[self::FILE_FIRST_NAME],
                    $array[self::FILE_LAST_NAME],
                    $array[self::FILE_EMAIL],
                    $array[self::FILE_AGE],
                    $array[self::FILE_IMAGE_ID]);
            }
        }

        return new Survey();
    }

    public function saveSurvey(Survey $survey) : void
    {
        $email = $survey->getEmail();

        if (!is_dir(self::BASE . '/' . $email))
        {
            mkdir(self::BASE . '/' . $email, 0777, true);
        }

        if ($email !== '')
        {
            $path = $this->createPath($email);
            $prevSurvey = $this->loadSurvey($email);
            $text = $this->makeStringToSave($survey, $prevSurvey);
            file_put_contents($path, $text);
        }
    }

    private function makeStringToSave(Survey $survey, Survey $prevSurvey) : string
    {
        $resString = '';
        $values = [
            self::FILE_FIRST_NAME => $survey->getFirstName() !== '' ? $survey->getFirstName() : $prevSurvey->getFirstName(),
            self::FILE_LAST_NAME => $survey->getLastName() !== '' ? $survey->getLastName() : $prevSurvey->getLastName(),
            self::FILE_AGE => $survey->getAge() !== '' ? $survey->getAge() : $prevSurvey->getAge(),
            self::FILE_EMAIL => $survey->getEmail() !== '' ? $survey->getEmail() : $prevSurvey->getEmail(),
            self::FILE_IMAGE_ID => $survey->getImageId() !== '' ? $survey->getImageId() : $prevSurvey->getImageId(),
        ];
        foreach (array_keys($values) as $key)
        {
            $resString .= $key . self::ASSIGNMENT . $values[$key] . self::FILE_SEPARATOR;
        }
        return $resString;
    }

    private function readFileToString($fp) : string
    {
        $text = '';
        while ($buffer = fgets($fp, 4096))
        {
            $text .= str_replace("\n", '', $buffer) . self::SEPARATOR;
        }
        return substr($text, 0, -1);
    }

    private function splitStringToArray(string $text, string $separator, string $assignment) : array
    {
        $arr = explode($separator, $text);
        $parsedArr = [];
        foreach ($arr as $value) 
        {
            $pair = explode($assignment, $value);
            $parsedArr[$pair[0]] = $pair[1];
        } 
        return $parsedArr;
    }

    private function createPath(string $email) : string
    {
        return self::BASE . '/' . $email . '/' . $email . self::FILE_TYPE;
    }
}