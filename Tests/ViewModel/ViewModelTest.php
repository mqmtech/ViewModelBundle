<?php

namespace MQM\ViewModelBundle\Tests\ViewModel;

use MQM\ViewModelBundle\ViewModel\ViewModel;

class ViewModelTest extends \Symfony\Bundle\DoctrineBundle\Tests\TestCase
{    
    public function testViewModel()
    {
        $sampleModel = new SampleModel();
        $sampleModel->setName("sampleName");
        $viewModelType = new ViewModelSampleType();        
        $viewModelFactory = new \MQM\ViewModelBundle\ViewModel\ViewModelFactory();
        $viewModel = $viewModelFactory->create($viewModelType, $sampleModel);
        
        $this->assertEquals("sampleName", $viewModel->name);
        $this->assertEquals("sampleDescription", $viewModel->description);
    }
}
