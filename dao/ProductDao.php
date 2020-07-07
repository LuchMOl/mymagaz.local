<?php

class ProductDao extends BaseDao
{

    public function insertNew($name, $categories)
    {
        $sql = "INSERT INTO products (name) VALUES (:name)";
        $params = ['name' => $name];
        $insertProduct = $this->execute($sql, $params);
        if ($insertProduct) {
            $id = $this->getOne("SELECT MAX(id) AS id FROM products");
            $write = $this->insertCategories($id, $categories);
        } else {
            $write = false;
        }
        return $write;
    }

    public function insertCategories($id, $categories)
    {
        $subsql = '';
        $param = '';
        $count = 1;
        foreach ($categories as $category) {
            $subsql = $subsql . '(:product_id, ' . ':category_id' . $count . '), ';
            $param['category_id' . $count] = $category;
            $count++;
        }
        $subsql = substr($subsql, 0, -2);

        $sql = "INSERT INTO product_category (product_id, category_id) VALUES $subsql";
        $params = ['product_id' => $id] + $param;
        return $this->execute($sql, $params);
    }

    public function edit($id, $newName, $categories)
    {
        $sql = "UPDATE products SET name = :name WHERE id = :id";
        $params = ['name' => $newName, 'id' => $id];
        $updateProduct = $this->execute($sql, $params);
        if ($updateProduct) {
            $sql = "DELETE FROM product_category WHERE product_id = '$id'";
            $write = $this->insertCategories($id, $categories);
        } else {
            $write = false;
        }
        return $write;
    }

    public function getThisCategory($categoryId)
    {
        $sql = "SELECT * FROM categories WHERE id = $categoryId";
        return $this->getAll($sql);
    }

    public function getProductsThisCategory($categoryId)
    {
        $sql = "SELECT * FROM products p INNER JOIN product_category p_c ON p.id = p_c.product_id WHERE p_c.category_id = $categoryId";
        return $this->getAll($sql);
    }

    public function getProducts()
    {
        $sql = "SELECT * FROM products";
        return $this->getAll($sql);
    }

    public function getProductsCategories()
    {
        $sql = "SELECT product_id, category_id as id, name, parent_id, top_menu, rank, activity FROM product_category p_c INNER JOIN categories c WHERE p_c.category_id = c.id";
        return $this->getAll($sql);
    }

}
