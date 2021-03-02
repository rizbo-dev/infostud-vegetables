<?php


class BaseController
{
    public function model(IModel $model): IModel
    {
        require_once '../app/models/'. $model->getNameOfModel() . '.php';

        return new $model();
    }

    public function view($view, $data = [])
    {
        if (file_exists('../app/views/'.$view.'.php')) {
            require_once '../app/views/'.$view.'.php';
        }
        else {
            die('View not found');

        }
    }
}