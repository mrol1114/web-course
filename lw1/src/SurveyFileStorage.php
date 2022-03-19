<?php
class SurveyFileStorage 
{
    private array $keys = ["First Name", "Last Name", "Email", "Age"];
    private string $separator = "&";
    private string $assignment = ": ";
    private string $base = "./data/";

    public function loadSurvey(Survey $survey) : Survey 
    {
        $path = $this->base . $survey->getEmail() . ".txt";

        if  (file_exists($path)) 
        {
            $fp = fopen($path, "r");
            if ($fp) 
            {
                $text = $this->readFileToString($fp);
                fclose($fp);
                $array = $this->formatArray($this->splitStringToArray($text, $this->separator, $this->assignment));
                return new Survey($array["First Name"], $array["Last Name"], $array["Email"], $array["Age"]);    
            }
        }

        return new Survey();
    }

    public function saveSurvey(Survey $survey) : void
    {
        $email = $survey->getEmail();

        if (!is_dir(substr($this->base, 2, -1)))
        {
            mkdir(substr($this->base, 2, -1));
        }

        if ($email !== "") 
        {
            $path = $this->base . $email . ".txt";
            $text = $this->makeStringToSave($survey);
            file_put_contents($path, $text);
        }
    }

    private function makeStringToSave(Survey $survey) : string 
    {
        $text = "";
        $prevSurvey = $this->loadSurvey($survey);
        for ($i = 0; $i < count($this->keys); $i++) 
        {
            $value = $survey->getParametr($this->keys[$i]) === "" ? $prevSurvey->getParametr($this->keys[$i]) : $survey->getParametr($this->keys[$i]);
            $text .= $this->keys[$i] . $this->assignment . $value . "\n";
        }
        return $text;
    }

    private function readFileToString($fp) : string
    {
        $text = "";
        while (($buffer = fgets($fp, 4096)) !== false) 
        {
            $text .= str_replace("\n", "", $buffer) . $this->separator;
        }
        return substr($text, 0, -1);
    }

    private function splitStringToArray(string $text, string $separator, string $assignment) : array
    {
        $arr = explode($separator, $text);
        $parsedArr = [];
        foreach ($arr as $value) 
        {
            $para = explode($assignment, $value);
            $parsedArr[$para[0]] = $para[1];
        } 
        return $parsedArr;
    }

    private function formatArray($props) : array
    {
        return [
            "Email" => $props["Email"] ? $props["Email"] : "",
            "First Name" => $props["First Name"] ? $props["First Name"] : "",
            "Last Name" => $props["Last Name"] ? $props["Last Name"] : "",
            "Age" => $props["Age"] ? $props["Age"] : ""        
        ];
    } 
}