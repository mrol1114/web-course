<?php
class Survey
{
    private array $parametrs;

    function __construct(string $firstName = "", string $lastName = "", string $email = "", string $age = "")
    {
        $this->parametrs = [
            "First Name" => $firstName,
            "Last Name" => $lastName,
            "Email" => $email,
            "Age" => $age,    
        ];
    }

    public function getParametr(string $key) : string
    {
        return $this->parametrs[$key];
    }

    public function getFirstName() : string 
    {
        return $this->parametrs["First Name"];
    }

    public function getLastName() : string 
    {
        return $this->parametrs["Last Name"];
    }

    public function getAge() : string 
    {
        return $this->parametrs["Age"];
    }

    public function getEmail() : string 
    {
        return $this->parametrs["Email"];
    }
}