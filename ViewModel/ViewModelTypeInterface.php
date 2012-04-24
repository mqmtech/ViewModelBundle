<?php

namespace MQM\ViewModelBundle\ViewModel;



interface ViewModelTypeInterface
{    
    public function build($builder, $options);
    public function getDefaultOptions(array $options);
}