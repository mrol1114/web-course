<?php
class Survey
{
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $age;

    function __construct(string $firstName = "", string $lastName = "", string $email = "", string $age = "")
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->age = $age;
    }

    public function getDataArray() {
        return [
            "First Name" => $this->firstName,
            "Last Name" => $this->lastName,
            "Email" => $this->email,
            "Age" => $this->age,
        ];
    }
}

class RequestSurveyLoader
{
    public function getParametrs() 
    {
        $firstName = $_GET["first_name"] ? $_GET["first_name"] : "";
        $lastName = $_GET["last_name"] ? $_GET["last_name"] : "";
        $email = $_GET["email"] ? $_GET["email"] : "";
        $age = $_GET["age"] ? $_GET["age"] : "";
        return new Survey($firstName, $lastName, $email, $age);
    }
}

class SurveyFileStorage 
{
    private function parseString(string $text, string $separator, string $assignment) 
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

    private function formatArray($props) 
    {
        return [
            "Email" => $props["Email"] ? $props["Email"] : "",
            "First Name" => $props["First Name"] ? $props["First Name"] : "",
            "Last Name" => $props["Last Name"] ? $props["Last Name"] : "",
            "Age" => $props["Age"] ? $props["Age"] : ""        
        ];
    }

    public function readf(Survey $user) 
    {
        $props = $user->getDataArray();
        if  ($props["Email"] <> "") 
        {
            $path = './' . $props["Email"] . ".txt";
            $elements = [];
            $text = '';
            $fp = fopen($path, 'r');
            if ($fp) 
            {
                while (($buffer = fgets($fp, 4096)) !== false) 
                {
                    $elements[] = str_replace("\n", '', $buffer);
                }
                fclose($fp);
                for ($i = 0; $i < count($elements) - 1; $i++) 
                {
                    $text .= $elements[$i] . "&";
                    if ($i === (count($elements) - 2)) 
                    {
                        $text .= $elements[$i + 1];
                    }
                }
                $array = $this->formatArray($this->parseString($text, "&", ": "));
                return new Survey($array["First Name"], $array["Last Name"], $array["Email"], $array["Age"]);    
            }
        }
        return new Survey();
    }

    public function writef(Survey $user) 
    {
        $props = $user->getDataArray();
        if ($props["Email"] <> "") 
        {
            $path = './' . $props["Email"] . ".txt";
            $resString = "";
            $keys = ["First Name", "Last Name", "Email", "Age"];
            $curProps = $this->formatArray($props);
            if (file_exists($path)) 
            {
                $prevProps = $this->formatArray($this->readf($user)->getDataArray());
            } 
            else 
            {
                $prevProps = $this->formatArray([]);
            }
            for ($i = 0; $i < count($curProps); $i++) 
            {
                $value = $curProps[$keys[$i]] === "" ? $prevProps[$keys[$i]] : $curProps[$keys[$i]];
                $resString .= $keys[$i] . ": " . $value . "\n";
            }
            file_put_contents($path, $resString);
        }
    } 
}

class SurveyPrint
{
    public function printArray(Survey $user) 
    {
        $array = $user -> getDataArray();
        $keys = ["First Name", "Last Name", "Email", "Age"];
        $resString = "";
        for ($i = 0; $i < count($array); $i++) 
        {
            $value = $array[$keys[$i]];
            $resString .= $keys[$i] . ': ' . $value . "<br>";
        }
        echo $resString;
    }
}

$request = new RequestSurveyLoader();
$print = new SurveyPrint();
$fileStorage = new SurveyFileStorage();


$survey = $request -> getParametrs();
$print -> printArray($survey);
$fileStorage->writef($survey);
    
echo "<br>";
$data = $fileStorage->readf($survey);
$print -> printArray($data);