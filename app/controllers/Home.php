<?php


class Home extends BaseController implements IController
{

    public function __construct()
    {
        $this->vegetableModel = $this->model(new Vegetable());
    }


    public function index()
    {

        $data = [
            'title' => 'Welcome',
            'text'=>'VEGAN SHOP 1.0'
        ];

        $this->view('pages/index',$data);
    }


}