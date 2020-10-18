<?php

namespace app\controllers;

use app\services\CartService;

class CartController
{

    private $cartService;

    public function cartService()
    {
        if ($this->cartService === NULL) {
            $this->cartService = new CartService();
        }
        return $this->cartService;
    }

    public function actionIndex()
    {
        require_once '../views/product/cart.php';
    }

    public function actionAdd()
    {
        $productCartForm = [
            'productId' => $_POST['productId'],
            'colorId' => $_POST['colorId'],
            'sizeId' => $_POST['sizeId'],
            'quantity' => $_POST['quantity']];
        if (in_array('', $productCartForm)) {
            die('something went wrong');
        }
        $this->cartService()->addProduct($productCartForm);
        header("Location: /cart");
    }

    public function actionDelete()
    {
        if (isset($_GET['cartRowId'])) {
            $this->cartService()->deleteCartRow($_GET['cartRowId']);
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }

    public function actionUpdate()
    {
        $updatedDataFromCart = $this->cartService()->updateQuantity($_POST);

        $result['products'] = $updatedDataFromCart;
        header('Content-Type: application/json');
        echo json_encode($result); die;
    }

}
