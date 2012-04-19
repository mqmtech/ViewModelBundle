<?php

namespace MQM\ViewModelBundle\Tests\ViewModel;

class SampleModel
{    
    private $name;
    
    public function __construct()
    {
        $this->name = "My Name";
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}