<?php

class ProductService
{

    private $productDao;

    public function productDao()
    {
        if ($this->productDao === NULL) {
            $this->productDao = new ProductDao();
        }
        return $this->productDao;
    }

    public function insertNew($name, $category)
    {
        return $this->productDao()->insertNew($name, $category);
    }

    public function edit($id, $newName, $categories)
    {
        return $this->productDao()->edit($id, $newName, $categories);
    }

    public function getThisCategory($categoryId)
    {
        $categoryMapper = new CategoryMapper();
        $category = $this->productDao()->getThisCategory($categoryId);
        if (!empty($category[0])) {
            $category = $categoryMapper->map($category[0]);
        }
        return $category;
    }

    public function getProductsThisCategory($categoryId)
    {
        $productMapper = new ProductMapper();
        $allProducts = $this->productDao()->getProductsThisCategory($categoryId);
        if (!empty($allProducts)) {
            foreach ($allProducts as $row) {
                $product = $productMapper->map($row);
                $products[$product->id] = $product;
            }
        } else {
            $products = $this->getEmptyProduct();
        }
        return $products;
    }

    public function getEmptyProduct()
    {
        $productMapper = new ProductMapper();
        $row = ['id' => '', 'name' => '', 'category_id' => ''];
        $product = $productMapper->map($row);
        return $product;
    }

    public function getProducts()
    {
        $productMapper = new ProductMapper();
        $allProducts = $this->productDao()->getProducts();
        foreach ($allProducts as $row) {
            $product = $productMapper->map($row);
            $products[$product->id] = $product;
        }
        $this->relationsWithCategories($products);
        return $products;
    }

    public function getCurrentProduct($products, $get)
    {
        foreach ($products as $product) {
            if ($product->id == $get) {
                return $product;
                break;
            }
        }
    }

    public function relationsWithCategories($products)
    {
        $categoryMapper = new CategoryMapper();
        $allCategories = $this->productDao()->getProductsCategories();

        foreach ($allCategories as $row) {
            $category = $categoryMapper->map($row);
            foreach ($products as $product) {
                if ($product->id == $row['product_id']) {
                    $product->category [] = $category;
                }
            }
        }
    }

    public function selectCategory($allCategories, $categories)
    {
        $space = '';
        foreach ($categories as $cat) {
            $cats [] = $cat->id;
        }
        foreach ($allCategories as $category) {
            if ($category->isRoot()) {
                $selected = in_array($category->id, $cats) ? 'selected' : '';
                echo "<optgroup label='$category->name'><option value = '$category->id' $selected>$space$category->name</option></optgroup>";
                $this->selectCildren($category->children, $space, $cats);
            }
        }
    }

    public function selectCildren($children, $space, $cats)
    {
        $space = $space . '-&nbsp&nbsp&nbsp&nbsp';
        if (!empty($children)) {
            foreach ($children as $category) {
                $selected = in_array($category->id, $cats) ? 'selected' : '';
                echo "<option value = '$category->id' $selected>$space$category->name</option>";
                $this->selectCildren($category->children, $space, $cats);
            }
        }
    }

}
