<?php
class Survey
{
    private string $firstName;
    private string $lastName;
    private string $age;
    private string $email;

    function __construct(string $firstName = '', string $lastName = '', string $email = '', string $age = '')
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->email = $email;
    }

    public function getFirstName() : string 
    {
        return $this->firstName;
    }

    public function getLastName() : string 
    {
        return $this->lastName;
    }

    public function getAge() : string 
    {
        return $this->age;
    }

    public function getEmail() : string 
    {
        return $this->email;
    }
}