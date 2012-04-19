<?php

namespace MQM\ViewModelBundle\ViewModel;

use MQM\ViewModelBundle\ViewModel\ViewModelTypeInterface;
use MQM\ViewModelBundle\ViewModel\ViewModelBuilder;
use MQM\ViewModelBundle\ViewModel\ViewModel;

class ViewModelFactory
{
    /**
     * @param ViewModelTypeInterface $type
     * @param type $data
     * @param type $options
     * @return ViewModel 
     */
    public function create(ViewModelTypeInterface $type, $data = null, $options = array())
    {
        $builder = new ViewModelBuilder($this);
        if (!isset($options['data'])) {
            $options['data'] = $data;
        }
        $type->build($builder, $options);
        $children = $builder->buildChildren($data);
        $viewModel = new ViewModel($data, $children, $options);
        
        return $viewModel;
    }
}