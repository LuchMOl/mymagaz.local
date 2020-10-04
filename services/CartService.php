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

        $product = $this->productService()->getProductById($productCartForm['productId']);

        $cart = $this->getCart($user);
        $cart->addProduct($product, $productCartForm);
        $this->cartDao()->saveCart($cart);

        $this->userService()->saveUserInSession($user);
    }

    public function deleteCartRow($cartRowId)
    {
        $this->cartDao()->deleteCartRow($cartRowId);
    }

    public function combineCarts($user)
    {
        $cart = $this->getCart($user);
        $curentUser = $this->userService()->getCurrentUser();
        if ($curentUser->isGuest()) {
            $guestCart = $this->getCart($curentUser);
            if (!$guestCart->isEmpty()) {
                $cart->combineWithGuestCart($guestCart->getProducts());
                $this->cartDao()->eraseCart($guestCart);
                $this->cartDao()->saveCart($cart);
            }
        }
    }

    public function updateQuntity($post)
    {
        $update = $this->cartDao()->updateQuntity($post['cartRowId'], $post['action']);
        if ($update) {
            $quantityAndPricesFromCart = $this->cartDao()->getQuantityAndPrices($post['cartRowId']);
            $summs = $this->getSumms($post['cartRowId'], $quantityAndPricesFromCart);
            return $summs;
        }
    }

    public function getSumms($cartRowId, $quantityAndPricesFromCart)
    {
        $totalPrice = 0;
        foreach ($quantityAndPricesFromCart as $row) {
            $totalPrice = $row['price'] * $row['quantity'] + $totalPrice;
            if ($row['id'] == $cartRowId) {
                $quantity = $row['quantity'];
                $rowSumm = $row['price'] * $row['quantity'];
            }
        }
        $updatedDataFromCart = [
            'cartRowId' => $cartRowId,
            'quantity' => $quantity,
            'rowSumm' => $rowSumm,
            'totalPrice' => $totalPrice];
        return $updatedDataFromCart;
    }

}
