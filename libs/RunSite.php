<?php

class RunSite
{

    private $_url = null;
    private $_controller = null;

    private $_controllerPath = 'controllers/';
    private $_modelPath = 'models/';
    private $_404Path = 'err404.php';
    private $_defaultFile = 'home.php';

    /**
     * Starts the Bootstrap
     */
    public function init()
    {
        $this->_getUrl();
        if (empty($this->_url[0])) {
            $this->_loadDefaultController();
            return false;
        }
        $this->_loadExistingcontroller();
        $this->_callControllerMethod();
    }


    /**
     * @optional
     * @param controllers folder name
     */
    public function setControllerPath($path)
    {
        $this->_controllerPath = trim($path, '/') . '/';
    }

    /**
     * @optional
     * @param model folder name
     */
    public function setModelPath($path)
    {
        $this->_modelPath = trim($path, '/') . '/';
    }

    /**
     * @optional
     * @param 404 file name
     */
    public function set404File($path)
    {
        $this->_404Path = trim($path, '/');
    }

    /**
     * @optional
     * @param default file name, eg: index.php
     */
    public function setDefaultFile($path)
    {
        $this->_defaultFile = trim($path, '/');
    }
    //end of custom folder initialization


    //getting url
    private function _getUrl()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->_url = explode('/', $url);
    }


    // loading defualt controller for render default index view
    private function _loadDefaultController()
    {
        if (file_exists($this->_controllerPath . $this->_defaultFile)) {
            require $this->_controllerPath . $this->_defaultFile;
            $this->_controller = new Home();
            $this->_controller->index();
        } else
            $this->_404();
    }


    // loding other controllers
    private function _loadExistingcontroller()
    {
        $file = $this->_controllerPath . $this->_url[0] . '.php';
        if (file_exists($file)) {
            require $file;
            $this->_controller = new $this->_url[0];
            $this->_controller->loadModel($this->_url[0], $this->_modelPath);
        } else {
            $this->_404();
        }
    }


    //loading methods inside the controller
    private function _callControllerMethod()
    {
        $lenght = count($this->_url);

        if ($lenght > 1) {
            // make sure method exist
            if (!method_exists($this->_controller, $this->_url[1])) {
                $this->_404();
                return false;
            }
        }
        //determine what to load
        switch ($lenght) {
            case 5:
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
                break;
            case 4:
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
                break;
            case 3:
                $this->_controller->{$this->_url[1]}($this->_url[2]);
                break;
            case 2:
                $this->_controller->{$this->_url[1]}();
                break;
            default:
                $this->_controller->index();
                break;
        }
    }

    //loading 404 error page
    private function _404()
    {
        require_once $this->_controllerPath . $this->_404Path;
        $this->_controller = new Err404();
        $this->_controller->index();
        exit;
    }
}