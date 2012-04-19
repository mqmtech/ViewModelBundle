<?php

namespace MQM\ViewModelBundle\ViewModel;

use Doctrine\Common\Util\Inflector;

class ViewModel
{
    private $data;
    private $children;
    private $options;
    
    public function __construct($data, array $children, array $options = null)
    {
        $this->data = $data;
        $this->children = $children;
        $this->options = $options;
    }
    
    public function __get($name)
    {
        if (isset ($this->children[$name])) {
            $value = $this->children[$name]['value'];
            if ($value === null) {
                return $this->getFromChildren($name);
            }
            return $value;
        }
        else {
            return $this->getFromChildren($name);
        }
    }
    
    private function getFromChildren($name)
    {
        $method = 'get' . Inflector::classify($name);
        return call_user_func(array($this->data, $method));
    }
    
    public function __set($name, $value)
    {
        if (isset($this->children[$name])) {
            $this->children[$name]['value'] = $value;
        }        
        
        $options = isset ($this->children[$name]['options']) ? $this->children[$name]['options'] : null;        
        if ($options!= null && !isset ($options['read_only']) || $options['read_only'] == FALSE) {
            $method = 'set' . Inflector::classify($name);
            if (method_exists($this->data, $method)) {
                call_user_func(array($this->data, $method), $value);
            }
        }        
    }
    
    public function __call($method, $args)
    {
        $len = strlen($method);
        $attribute = substr($method, 3, $len - 2);
        $attribute = Inflector::camelize($attribute);

        if (isset($this->children[$attribute])) {
            return $this->children[$attribute]['value'];
        }
        else {
           return call_user_func(array($this->data, $method), $args);
        }
    }
    
    public function printViewModel()
    {
        foreach ($this->children as $key => $value) {
            echo "key: $key, value: " . $value['value'];
        }
    }
}
