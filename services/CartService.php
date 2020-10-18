<?php

namespace app\services;

use app\services\UserService;
use app\services\ProductService;
use app\dao\CartDao;
use app\models\Cart;

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

    public function getCart($user)
    {
        $products = [];
        $cart = new Cart();

        $rows = $this->cartDao()->getCart($user);
        foreach ($rows as $row) {
            $product = $this->productService()->getProductById($row['productId']);
            $product->setColorId($row['colorId']);
            $product->setSizeId($row['sizeId']);
            $product->setQuantity($row['quantity']);
            $product->setCartRowId($row['id']);
            $products [] = $product;
        }
        $cart->setUserId($user);
        $cart->setProducts($products);
        return $cart;
    }

    public function addProduct($productCartForm)
    {
        $user = $this->userService()->getCurrentUser();
        $this->cartDao()->addProduct($user, $productCartForm);
    }

    public function deleteCartRow($cartRowId)
    {
        $this->cartDao()->deleteCartRow($cartRowId);
    }

    public function combineCarts($user)
    {
        $curentUser = $this->userService()->getCurrentUser();
        if ($curentUser->isGuest()) {
            $guestCart = $this->cartDao()->getCart($curentUser);
            $this->cartDao()->saveCart($user, $curentUser, $guestCart);
        }
    }

    public function updateQuantity($post)
    {
        $update = $this->cartDao()->updateQuantity($post['cartRowId'], $post['action']);
        if ($update) {
            $updatedDataFromCart = $this->getSumms($post['cartRowId']);
            return $updatedDataFromCart;
        }
    }

    public function getSumms($cartRowId)
    {
        $user = $this->userService()->getCurrentUser();
        $cart = $this->getCart($user);

        foreach ($cart->getProducts() as $product) {
            if ($product->getCartRowId() == $cartRowId) {
                $quantity = $product->getQuantity();
                $rowSumm = $product->getPrice() * $quantity;
            }
        }
        $summs = [
            'cartRowId' => $cartRowId,
            'quantity' => $quantity,
            'rowSumm' => $rowSumm,
            'totalPrice' => $cart->getProductsPrice()];
        return $summs;
    }

}
