<?php

namespace MQM\ViewModelBundle\Tests\ViewModel;

use MQM\ViewModelBundle\ViewModel\ViewModelTypeInterface;

class ViewModelSampleType implements ViewModelTypeInterface
{    
    public function build($builder, $options)
    {
        $builder->add('description', 'sampleDescription');
    }

    public function getDefaultOptions(array $options)
    {        
    }
}