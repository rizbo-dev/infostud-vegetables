<?php


class ErrorController extends BaseController implements IController
{

    public function index()
    {
        $this->view('/pages/error');
    }
}