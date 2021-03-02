<?php


class Products extends BaseController implements IController
{
    private IModel $vegetableModel;
    public function __construct()
    {
        $this->vegetableModel = $this->model(new Vegetable());
    }
    public function index()
    {
        $result = $this->vegetableModel->getVegetables();
        $data = [
            'vegetables' =>$result
        ];

        $this->view('pages/allVegetables',$data);
    }
    public function product($id)
    {
        $result = $this->vegetableModel->getVegetable($id);

        $data = [
            'vegetable' => $result
        ];

        $this->view('pages/singleVegetable',$data);

    }
    public function search()
    {

        if ($_SERVER['REQUEST_METHOD']==='POST'){
            $key =  $_POST['key'];
            $result = $this->vegetableModel->getVegetableWithFilterKey($key);

            try {
                echo json_encode($result, JSON_THROW_ON_ERROR);
            } catch (JsonException $e) {
            }
        }
        else {
            $result = $this->vegetableModel->getVegetables();
            $data = [
                'vegetables' => $result
            ];

            $this->view('pages/allVegetables',$data);
        }

    }
    public function add()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if (!empty($_POST['name']) && !empty($_POST['price']) && !empty($_FILES['picture']['name'])) {

                if(is_numeric($_POST['price']) && ctype_alpha($_POST['name'])) {
                    if ($this->vegetableModel
                        ->insert
                        (new VegetableDataMapper($_POST['name'], (float)$_POST['price']))) {

                        $target_dir = 'img/';
                        $file = $_FILES['picture']['name'];
                        $path = pathinfo($file);
                        $filename = $_POST['name'];
                        $ext = $path['extension'];
                        $temp_name = $_FILES['picture']['tmp_name'];
                        $path_filename_ext = $target_dir . $filename . "." . $ext;
                        move_uploaded_file($temp_name, $path_filename_ext);
                        $data = [
                            'inserted' => $_POST['name'] . " is inserted!",
                            'vegetables' => $this->vegetableModel->getVegetables()
                        ];
                        $this->view('/pages/allVegetables', $data);
                    }
                    else {
                        $data = [
                            'inserted' => "Something went wrong",
                            'vegetables' => $this->vegetableModel->getVegetables()
                        ];
                        $this->view('/pages/allVegetables', $data);
                    }
                }
                else {
                    $data = [
                        'inserted' => "Please check formats that u inserted"
                    ];
                    $this->view('/pages/addVegetables',$data);
                }
            }
            else {
                $data = [
                    'inserted' => "Please fill the form"
                ];
                $this->view('/pages/addVegetables',$data);
            }
        }
        else {
            $this->view('/pages/addVegetables');
        }
    }
}