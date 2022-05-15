<?php

class Controller
{

    function __construct()
    {
    }

    /**
     * @param String $name Name of the model
     * @param String $path Location of the models
     */
    public function loadModel($name, $modelPath = 'models/')
    {
        $path = $modelPath . $name . '_model.php';
        if (file_exists($path)) {
            require $modelPath . $name . '_model.php';
            $modelName = $name . 'Model';
            $this->model = new $modelName;
        }
    }
}