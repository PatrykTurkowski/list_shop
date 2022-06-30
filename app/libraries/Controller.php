<?php
//Load the model and the view
class Controller
{
    public function model($model)
    {
        //Require model file
        require_once '../app/models/' . $model . '.php';
        //Instantiate model
        return new $model();
    }

    public function database($database)
    {
        //Require model file
        require_once '../app/databases/' . $database . '.php';
        //Instantiate model
        return new $database();
    }

    //Load the view (checks for the file)
    public function view($view, $data = [])
    {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die("View does not exists.");
        }
    }
}
