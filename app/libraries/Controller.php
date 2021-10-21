<?php
/**
 * Base controller
 * Loads the views
 */
class Controller
{
    /**
     * Fetches the model
     *
     * @param [type] $model the file for the model
     * 
     * @return object
     */
    public function model($model)
    {
        //Require model file
        include_once '../app/models/' . $model . '.php';
        //Instantiate model
        return new $model();
    }

    /**
     * Loads the view file
     *
     * @param string $view the view
     * @param array  $data to be passed to the view
     * 
     * @return void
     */
    public function view($view, $data = [])
    {
        //Check for the view file
        if (file_exists('../app/views/' . $view . '.php')) {
            include_once '../app/views/' . $view . '.php';
        } else {
            //View does not exist
            die('Ayikho lento uyifunayo.');
        }
    }
}
?>