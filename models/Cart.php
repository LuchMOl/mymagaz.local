<?php

namespace app\models;

class Cart
{

    private $userId;
    private $guestSessId;
    private $products = [];

    public function getGuestSessId()
    {
        return $this->guestSessId;
    }

    public function setGuestSessId($guestSessId)
    {
        $this->guestSessId = $guestSessId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function setUserId($user)
    {
        if ($user->isGuest()) {
            $this->guestSessId = $user->getGuestSessId();
        } else {
            $this->userId = $user->getId();
        }
    }

    public function setProducts($products)
    {
        $this->products = $products;
    }

    public function addProduct($product, $form = [])
    {
        if (!empty($form)) {
            $product->setColorId($form['colorId']);
            $product->setSizeId($form['sizeId']);
            $product->setQuantity($form['quantity']);
        }
        $this->products [] = $product;
    }

    public function isEmpty()
    {
        return empty($this->products);
    }

    public function isGuestCart()
    {
        if (empty($this->userId) && !empty($this->guestSessId)) {
            return true;
        }
    }

    public function getProductsPrice()
    {
        $result = 0;
        foreach ($this->products as $product) {
            $result += $product->getCartPrice();
        }
        return $result;
    }

    public function combineWithGuestCart($products)
    {
        foreach ($products as $product) {
            $this->products [] = $product;
        }
    }

}
