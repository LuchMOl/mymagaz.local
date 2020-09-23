<?php

namespace app\services;

use app\services\UserService;
use app\services\ProductService;
use app\dao\CartDao;

class CartService
{

    private $userService;
    private $productService;
    private $cartDao;

    public function userService()
    {
        if ($this->userService === NULL) {
            $this->userService = new UserService();
        }
        return $this->userService;
    }

    public function productService()
    {
        if ($this->productService === NULL) {
            $this->productService = new ProductService();
        }
        return $this->productService;
    }

    public function cartDao()
    {
        if ($this->cartDao === NULL) {
            $this->cartDao = new CartDao();
        }
        return $this->cartDao;
    }

    public function addOrder($productCartForm)
    {
        $user = $this->userService()->getCurrentUser();
        $product = $this->productService()->getProductById($productCartForm['productId']);
        $product->addOrderCart($productCartForm);
        $user->addOrder($product);

        if (!$user->isGuest()) {
            $this->cartDao()->addOrder($user->id, $productCartForm);
        }

        $this->userService()->saveUserInSession($user);
    }

    public function deleteOrderItem($orderItemId)
    {
        $user = $this->userService()->getCurrentUser();
        if (!$user->isGuest()) {
            $this->cartDao()->deleteOrderItem($user->id, $user->order[$orderItemId]->orderCart);
        }

        $user->deleteOrderItem($_GET['orderItemId']);
        $this->userService()->saveUserInSession($user);
    }

}
