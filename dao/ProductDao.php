<?php

namespace app\dao;

class ProductDao extends BaseDao
{

    public function insertProduct($product)
    {
        $sql = 'INSERT INTO products (name, price) VALUES (:name, :price)';
        $params = ['name' => $product->name, 'price' => $product->price];
        $write = $this->execute($sql, $params);
        $lastInsertId = $write ? $this->insert_ID() : false;
        return $lastInsertId;
    }

    public function insertProductCategories($product)
    {
        foreach ($product->categories as $categoryId) {
            $sql = "INSERT INTO product_category (product_id, category_id) VALUES (:product_id, :category_id)";
            $params = ['product_id' => $product->id, 'category_id' => $categoryId];
            $progress [] = $this->execute($sql, $params);
        }
        $progress = in_array(false, $progress) ? false : true;

        return $progress;
    }

    public function insertProductImageName($product)
    {
        if ($product->imageName != '') {
            $sql = "INSERT INTO product_images (product_id, image_name) VALUES (:product_id, :imageName)";
            $params = ['product_id' => $product->id, 'imageName' => $product->imageName];
            $progress = $this->execute($sql, $params);
        }
        return isset($progress) ? $progress : true;
    }

    public function insertProductColours($product)
    {
        $progress = [];
        foreach ($product->colours as $colourId) {
            $sql = "INSERT INTO product_colours (product_id, colour_id)"
                    . "VALUES (:product_id, :colour_id)";
            $params = ['product_id' => $product->id, 'colour_id' => $colourId];
            $progress [] = $this->execute($sql, $params);
        }
        $progress = in_array(false, $progress) ? false : true;
        return $progress;
    }

    public function insertProductSizes($product)
    {
        $progress = [];
        foreach ($product->sizes as $sizeId) {
            $sql = "INSERT INTO product_sizes (product_id, size_id)"
                    . "VALUES (:product_id, :size_id)";
            $params = ['product_id' => $product->id, 'size_id' => $sizeId];
            $progress [] = $this->execute($sql, $params);
        }
        $progress = in_array(false, $progress) ? false : true;
        return $progress;
    }

    public function getProductById($editedProductId)
    {
        $sql = "SELECT * FROM products WHERE id = $editedProductId";
        $rowFromProductsTable = $this->getRow($sql);
        return $rowFromProductsTable;
    }

    public function getAllProductImages()
    {
        $sql = "SELECT * FROM product_images";
        $allProductImage = $this->getAll($sql);
        return $allProductImage;
    }

    public function getProductColoursByProductId($id)
    {
        $sql = "SELECT p_c.colour_id as id, c.colour "
                . "FROM product_colours p_c "
                . "INNER JOIN colours c "
                . "ON c.id = p_c.colour_id "
                . "WHERE p_c.product_id = $id";
        $productColours = $this->getAll($sql);
        return $productColours;
    }

    public function getProductSizesByProductId($id)
    {
        $sql = "SELECT p_s.size_id as id, s.size "
                . "FROM product_sizes p_s "
                . "INNER JOIN sizes s "
                . "ON s.id = p_s.size_id "
                . "WHERE p_s.product_id = $id";
        $productSizes = $this->getAll($sql);
        return $productSizes;
    }

    public function editProduct($product)
    {
        $sql = "UPDATE products SET name = :name, price = :price WHERE id = :id";
        $params = ['name' => $product->name, 'price' => $product->price, 'id' => $product->id];
        $update = $this->execute($sql, $params);
        return $update;
    }

    public function editProductCategories($product)
    {
        $this->eraseCategoriesByProductId($product->id);
        $edit = $this->insertProductCategories($product);
        return $edit;
    }

    public function eraseCategoriesByProductId($id)
    {
        $sql = "DELETE FROM product_category WHERE product_id = $id";
        $this->execute($sql);
    }

    public function editProductImageName($product)
    {
        $sql = "UPDATE product_images SET image_name = :name WHERE product_id = :id";
        $params = ['name' => $product->imageName, 'id' => $product->id];
        return $this->execute($sql, $params);
    }

    public function editProductColours($product)
    {
        $this->eraseProductColoursByProductId($product->id);
        $edit = $this->insertProductColours($product);
        return $edit;
    }

    public function eraseProductColoursByProductId($id)
    {
        $sql = "DELETE FROM product_colours WHERE product_id = $id";
        $this->execute($sql);
    }

    public function editProductSizes($product)
    {
        $this->eraseProductSizesByProductId($product->id);
        $edit = $this->insertProductSizes($product);
        return $edit;
    }

    public function eraseProductSizesByProductId($id)
    {
        $sql = "DELETE FROM product_sizes WHERE product_id = $id";
        $this->execute($sql);
    }

    public function getCategoryById($categoryId)
    {
        $sql = "SELECT * FROM categories WHERE id = $categoryId";
        return $this->getAll($sql);
    }

    public function getProductsThisCategory($categoryId)
    {
        $sql = "SELECT * FROM products p "
                . "INNER JOIN product_category p_c "
                . "ON p.id = p_c.product_id "
                . "WHERE p_c.category_id = $categoryId";
        return $this->getAll($sql);
    }

    public function getAllProducts($ids = [])
    {
        $sql = "SELECT * FROM products";
        if (!empty($ids)) {
            $sql .= ' WHERE id IN(' . join(',', $ids) . ')';
        }
        return $this->getAll($sql);
    }

    public function getProductCategories()
    {
        $sql = "SELECT product_id, category_id as id, name, parent_id, top_menu, rank, activity "
                . "FROM product_category p_c "
                . "INNER JOIN categories c "
                . "WHERE p_c.category_id = c.id";
        return $this->getAll($sql);
    }

}
