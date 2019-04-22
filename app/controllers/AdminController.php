<?php

namespace app\controllers;

class AdminController extends \app\core\BaseController {
    
    function IndexAction()
    {
        $model = new \app\models\ProductModel();
        $model->getAll();
        $orders = new \app\models\OrderModel();
        $orders->getAll();
        $this->render('index', [
            'data' => $model->data,
            'orders' => $orders->data,
        ]);
    }

    function CreateAction()
    {
        //валидации нет !!!
        if(isset($_POST['name'])) {
            $model = new \app\models\ProductModel();
            $data = [
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'description' => $_POST['description'],
            ];
            $id = $model->insert($data);
            $uploaddir = ROOT_DIR.DS.'uploads'.DS;
            $uploadfile = $uploaddir . DS . $id . '.jpg'; //JPG ONLY, todo: check format
            if (!move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
                 die('upload error!!');
            }
            $this->redirect('/admin/index');
        }
        $this->render('create');
    }

    function DeleteAction()
    {
        $id = $_GET['id'];
        $model = new \app\models\ProductModel();
        $model->delete(['id' => $id]);
        $this->redirect('/admin/index');
    }

}