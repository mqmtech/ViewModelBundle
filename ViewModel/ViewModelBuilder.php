<?php

namespace MQM\ViewModelBundle\ViewModel;

use MQM\ViewModelBundle\ViewModel\ViewModelTypeInterface;

class ViewModelBuilder
{    
    private $children;
    private $factory;
    private $appData;
    
    /**
     *
     * @param ViewModelFactory $factory 
     */
    public function __construct($factory) {
        $this->children = array();
        $this->factory = $factory;
    }
    
    public function add($child, $value = null, array $options = null)
    {
        $this->children[$child] = array(
            'value' => $value,
            'options' => $options
        );
       
        return $this;
    }
    
    public function buildChildren($data = null, $options = null)
    {
        $children = array();    
        foreach ($this->children as $name => $builder) {
            if ($builder instanceof ViewModelTypeInterface) {
                $factory = $this->factory;
                    
                $childData = null;
                $method = 'get' . $name;
                if ($data != null && method_exists($data, $method)) {
                        $childData = call_user_func(array($data, $method));
                }
                $builder = $factory->create($type, $childData, $options);
            }
            $children[$name] = $builder;
        }
        
        return $children;
    }
    
    public function getAppData()
    {
        return $this->appData;
    }

    public function setAppData($appData)
    {
        $this->appData = $appData;
    }
}