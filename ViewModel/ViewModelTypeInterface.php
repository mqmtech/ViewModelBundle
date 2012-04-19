<?php

namespace MQM\ViewModelBundle\ViewModel;

use MQM\ViewModelBundle\ViewModel\ViewModelBuilder;

interface ViewModelTypeInterface
{    
    public function build($builder, $options);
    public function getDefaultOptions(array $options);
}