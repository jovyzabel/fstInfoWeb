<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Contact
{
    #[Assert\NotBlank()]
    private string $fullName;

    #[Assert\NotBlank()]
    #[Assert\Email()]
    private string $email;

    #[Assert\NotBlank()]
    private string $object;

    #[Assert\NotBlank()]
    private string $content;
    
    public function getEmail():string
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
 
    public function getObject()
    {
        return $this->object;
    }
 
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }
 
    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }
}