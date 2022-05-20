<?php
namespace App\Module\Survey;
class Survey
{
    private string $firstName;
    private string $lastName;
    private string $age;
    private string $email;
    private string $imageId;

    function __construct(string $firstName = '', string $lastName = '', string $email = '', string $age = '', string $imageId = '')
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->email = $email;
        $this->imageId = $imageId;
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

    public function getImageId() : string
    {
        return $this->imageId;
    }
}