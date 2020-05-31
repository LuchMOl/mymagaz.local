<?php

class ProductDao extends BaseDao
{

    public function getIdTableKeyParam($table, $key, $param)
    {
        $sql = "SELECT id FROM $table WHERE $key = '$param'";
        return $this->GetOne($sql);
    }

    public function GetColumnTable($column, $table)
    {
        $sql = "SELECT $column FROM $table ORDER BY id";
        return $this->GetColumn($sql);
    }

    public function GetProduct($param, $value)
    {
        $sql = "SELECT id, name, brand, size, description, images "
                . "FROM products "
                . "WHERE $param = '$value'";
        return $this->GetRow($sql);
    }

    public function GetNameAndImagesOfProduct()
    {
        $sql = "SELECT id, name, images FROM products ORDER BY id";
        return $this->GetAll($sql);
    }

    public function GetColoursQuantity($id)
    {
        $sql = "SELECT colour, quantity "
                . "FROM colours c "
                . "INNER JOIN product_colour_quantity pcq "
                . "ON c.id = pcq.colour_id "
                . "INNER JOIN products p "
                . "ON pcq.product_id = p.id "
                . "WHERE p.id = '$id'";
        return $this->GetAll($sql);
    }

    public function GetCategories($id)
    {
        $sql = "SELECT category "
                . "FROM categories c "
                . "INNER JOIN product_category pc "
                . "ON c.id = pc.category_id "
                . "INNER JOIN products p "
                . "ON pc.product_id = p.id "
                . "WHERE p.id = '$id'";
        return $this->GetAll($sql);
    }

    public function insertNewProduct($newProduct)
    {
        $sql = "INSERT INTO products (name, brand, size, description, images)"
                . "VALUES (:name, :brand, :size, :description, :images)";
        $params = ['name' => $newProduct['name'],
            'brand' => $newProduct['brand'],
            'size' => $newProduct['size'],
            'description' => $newProduct['description'],
            'images' => $newProduct['images']];
        $this->Execute($sql, $params);
        $id = $this->GetOne("SELECT MAX(id) AS id FROM products");
        return $id;
    }

    public function insertColourQuantityOfNewProduct($productId, $colour, $quantity)
    {
        $sql = "INSERT INTO product_colour_quantity (product_id, colour_id, quantity)"
                . "VALUES (:product_id, :colour_id, :quantity)";
        $colourId = $this->getIdTableKeyParam('colours', 'colour', $colour);
        $params = ['product_id' => $productId,
            'colour_id' => $colourId,
            'quantity' => $quantity];
        return $this->Execute($sql, $params);
    }

    public function insertCategoryOfNewProduct($productId, $category)
    {
        $sql = "INSERT INTO product_category (product_id, category_id)"
                . "VALUES (:product_id, :category_id)";
        $categoryId = $this->getIdTableKeyParam('categories', 'category', $category);
        $params = ['product_id' => $productId,
            'category_id' => $categoryId];
        return $this->Execute($sql, $params);
    }

    public function insertNewColour($newColour)
    {
        $sql = "INSERT INTO colours (colour)"
                . "VALUES (:colour)";
        $params = ['colour' => $newColour];
        return $this->Execute($sql, $params);
    }

    public function insertNewCategory($newCategory)
    {
        $sql = "INSERT INTO categories (category)"
                . "VALUES (:category)";
        $params = ['category' => $newCategory];
        return $this->Execute($sql, $params);
    }

}
