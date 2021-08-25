<?php
/**
 * App's core class
 * Creates url and loads core controller
 * url format - /controller/method/params
 */
class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {

        $url = $this->getUrl();

        //Look in controllers for first value
        if (isset($url)) {
            
            if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                //if exists then set to current controller
                $this->currentController = ucwords($url[0]);
    
                //unset 0 index
                unset($url[0]);
            }
        }

        //Require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        //Instantiate current class
        $this->currentController = new $this->currentController;

        //Check for the second part of the url
        if (isset($url[1])) {
            //Check to see if method exists in current controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                //Unset 1 index
                unset($url[1]);
            }
        }
        //Get params
        $this->params = $url ? array_values($url) : [];

        //Call a callback with an array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}