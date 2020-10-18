<?php

namespace app\dao;

class CartDao extends BaseDao
{

    public function getCart($user)
    {
        if ($user->isGuest()) {
            $dbColumn = 'guest_sess_id';
            $id = $user->getSessionId();
        } else {
            $dbColumn = 'user_id';
            $id = $user->getId();
        }

        $sql = "SELECT id, "
                . "user_id as userId, "
                . "guest_sess_id as guestSessId, "
                . "product_id as productId, "
                . "color_id as colorId, "
                . "size_id as sizeId, "
                . "quantity "
                . "FROM cart "
                . "WHERE $dbColumn = :user_id";
        $params = [':user_id' => $id];
        $order = $this->getAll($sql, $params);
        return $order;
    }

    public function addProduct($user, $productCartForm)
    {
        $userId = ($user->isGuest()) ? NULL : $user->getId();
        $sessId = ($user->isGuest()) ? $user->getSessionId() : NULL;
        $sql = "INSERT INTO cart (user_id, guest_sess_id, product_id, color_id, size_id, quantity) "
                . "VALUES (:user_id, :guest_sess_id, :product_id, :color_id, :size_id, :quantity) "
                . "ON DUPLICATE KEY UPDATE quantity = quantity + :quantity";
        $params = ['user_id' => $userId,
            'guest_sess_id' => $sessId,
            'product_id' => $productCartForm['productId'],
            'color_id' => $productCartForm['colorId'],
            'size_id' => $productCartForm['sizeId'],
            'quantity' => $productCartForm['quantity']];

        $write = $this->execute($sql, $params);
    }

    public function saveCart($user, $guest, $guestCart)
    {
        $this->eraseCart($guest->getSessionId());
        foreach ($guestCart as $product) {
            $this->addProduct($user, $product);
        }
    }

    public function deleteCartRow($cartRowId)
    {
        $sql = "DELETE FROM cart "
                . "WHERE id = :id ";
        $params = ['id' => $cartRowId];

        $delete = $this->execute($sql, $params);
        return $delete;
    }

    public function eraseCart($guestSessionId)
    {
        $sql = "DELETE FROM cart "
                . "WHERE guest_sess_id = :guest_sess_id";
        $params = ['guest_sess_id' => $guestSessionId];

        $this->execute($sql, $params);
    }

    public function updateQuantity($cartRowId, $action)
    {
        $sql = "UPDATE cart "
                . "SET quantity = quantity $action 1 "
                . "WHERE id = :id";
        $params = ['id' => $cartRowId];

        $q = $this->execute($sql, $params);
        return $q;
    }

    public function getQuantityAndPrices($cartRowId)
    {
        $userIds = $this->getUserIdsThisCart($cartRowId);
        foreach ($userIds as $key => $value) {
            if (!is_null($value)) {
                $column = $key;
                $param = $value;
            }
        }
        $sql = "SELECT c.id, p.price, c.quantity "
                . "FROM cart c "
                . "INNER JOIN products p "
                . "ON c.product_id = p.id "
                . "WHERE c.$column = :id";
        $params = [':id' => $param];
        $result = $this->getAll($sql, $params);
        return $result;
    }

    public function getUserIdsThisCart($cartRowId)
    {
        $sql = "SELECT user_id, guest_sess_id "
                . "FROM cart "
                . "WHERE id = :id";
        $params = [':id' => $cartRowId];
        $userIds = $this->getRow($sql, $params);
        return $userIds;
    }

    public function getProductPrice($cartRowId)
    {
        $sql = "SELECT price "
                . "FROM products "
                . "INNER JOIN cart "
                . "ON products.id = cart.product_id "
                . "WHERE cart.id = :id";
        $params = [':id' => $cartRowId];
        $price = $this->getOne($sql, $params);
        return $price;
    }

}
