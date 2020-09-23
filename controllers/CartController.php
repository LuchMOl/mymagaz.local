<?php

namespace app\controllers;

use app\services\CartService;
use app\services\UserService;

class CartController
{

    private $cartService;
    private $userService;

    public function userService()
    {
        if ($this->userService === NULL) {
            $this->userService = new UserService();
        }
        return $this->userService;
    }

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
        $this->cartService()->addOrder($productCartForm);
        header("Location: /cart");
    }

    public function actionDelete()
    {
        if (isset($_GET['orderItemId'])) {
            $this->cartService()->deleteOrderItem($_GET['orderItemId']);
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }

}
