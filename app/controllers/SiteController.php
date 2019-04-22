<?php

namespace app\controllers;

class SiteController extends \app\core\BaseController {
    
    public function IndexAction()
    {
        $prod = new \app\models\ProductModel();
        $prod->getAll();
        $this->render('index', [
            'products' => $prod->data,
        ]);
    }

    public function BuyAction()
    {
        $model = new \app\models\OrderModel();
        $data = [
            'name' => $_POST['name'],
            'tel' => $_POST['phone'],
            'products' => $_POST['products']
        ];
        $model->insert($data);
        //send to mail message
        $prodsArr = json_decode($data['products']);
        $prods = '';
        $sum = 0;
        foreach($prodsArr as $item) {
            $prods .= $item->name . " (".$item->count.") sum:" . $item->price*$item->count . "\r\n";
            $sum += $item->price*$item->count;
        }
        $message = "Name: ".$data['name']."\r\nTelephone: ".$data['tel']."\r\nProducts: \r\n".$prods."Total: ".$sum;
        mail('mail@vatius.ru', 'My Shop - order', $message);
        //todo: add config
        die("{'success': true}");
    }
}