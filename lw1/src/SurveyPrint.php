<?php
class SurveyPrint
{
    private array $keys = ["First Name", "Last Name", "Email", "Age"];
    private string $assigment = ": ";
    private string $separator = "<br>";

    public function printSurvey(Survey $survey) 
    {
        $resString = "";
        for ($i = 0; $i < count($this->keys); $i++) 
        {
            $value = $survey->getParametr($this->keys[$i]);
            $resString .= $this->keys[$i] . $this->assigment . $value . $this->separator;
        }
        echo $resString;
    }
}