<?php

namespace app\dao;

class CartDao extends BaseDao
{

    public function getOrder($user)
    {
        $sql = "SELECT product_id as productId, color_id as colorId, size_id as sizeId, quantity "
                . "FROM cart "
                . "WHERE user_id = :user_id";
        $params = [':user_id' => $user->id];
        $order = $this->getAll($sql, $params);
        return $order;
    }

    public function addOrder($userId, $productCartForm)
    {
        $sql = "INSERT INTO cart (user_id, product_id, color_id, size_id, quantity) "
                . "VALUES (:user_id, :product_id, :color_id, :size_id, :quantity)";
        $params = ['user_id' => $userId,
            'product_id' => $productCartForm['productId'],
            'color_id' => $productCartForm['colorId'],
            'size_id' => $productCartForm['sizeId'],
            'quantity' => $productCartForm['quantity']];

        $write = $this->execute($sql, $params);
        return $write;
    }

    public function deleteOrderItem($userId, $orderItemCart)
    {
        $sql = "DELETE FROM cart "
                . "WHERE user_id = :user_id "
                . "AND product_id = :product_id "
                . "AND color_id = :color_id "
                . "AND size_id = :size_id "
                . "AND quantity = :quantity "
                . "limit 1";
        $params = ['user_id' => $userId,
            'product_id' => $orderItemCart['productId'],
            'color_id' => $orderItemCart['colorId'],
            'size_id' => $orderItemCart['sizeId'],
            'quantity' => $orderItemCart['quantity']];

        $write = $this->execute($sql, $params);
        return $write;
    }

}
