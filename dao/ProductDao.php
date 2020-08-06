<?php

class ProductDao extends BaseDao
{

    public function insertProduct($productName)
    {
        $sql = 'INSERT INTO PRODUCTS (name) VALUES (:name)';
        $params = ['name' => $productName];
        return $this->execute($sql, $params);
    }

    public function insertProductCategories($id, $categories)
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

    public function insertProductImage($productId, $productImageName)
    {
        $sql = "INSERT INTO product_images (product_id, image_name) VALUES (:product_id, :imageName)";
        $params = ['product_id' => $productId, 'imageName' => $productImageName];
        return $this->execute($sql, $params);
    }

    public function getProductById($id)
    {
        $sql = "SELECT * FROM products WHERE id = $id";
        return $this->getRow($sql);
    }

    public function getProductImageByProductId($id)
    {
        $sql = "SELECT image_name FROM product_images WHERE product_id = $id";
        return $this->getOne($sql);
    }

    public function insertNew($name, $categories, $imageName)
    {
        $sql = "INSERT INTO products (name) VALUES (:name)";
        $params = ['name' => $name];
        $insertProduct = $this->execute($sql, $params);
        if ($insertProduct) {
            $id = $this->getOne("SELECT MAX(id) AS id FROM products");
            $insertCategories = $this->insertCategories($id, $categories);
            if ($insertCategories AND $imageName != 'none') {
                $write = $this->insertImage($id, $imageName);
            }
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

    public function editProduct($id, $editedProduct)
    {
        $sql = "UPDATE products SET name = :name WHERE id = :id";
        $params = ['name' => $editedProduct->name, 'id' => $id];
        return $this->execute($sql, $params);
    }

    public function editProductCategories($id, $categories)
    {
        $this->eraseCategories($id);
        $edit = $this->insertCategories($id, $categories);
        return $edit;
    }

    public function eraseCategories($id)
    {
        $sql = "DELETE FROM product_category WHERE product_id = $id";
        return $this->execute($sql);
    }

    public function editProductImageName($id, $productImageName)
    {
        $sql = "UPDATE product_images SET image_name = :name WHERE product_id = :id";
        $params = ['name' => $productImageName[0], 'id' => $id];
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

    public function getCategoryById($categoryId)
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

    public function getMaxId()
    {
        $sql = "SELECT MAX(id) FROM products";
        return $this->getOne($sql);
    }

}
