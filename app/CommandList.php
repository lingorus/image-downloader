<?php

namespace App;

class CommandList {
    private $_commands = [];
    
    public function addCommand($name, $cmd)
    {
        $this->_commands[$name]= $cmd;
    }

    public function runCommand($name, $args) 
    {
        if (isset($this->_commands[$name]))
        {
            $this->_commands[$name]->run($args);
        }
    }
}
