<?php

class ProductService
{

    private $productDao;
    private $productMapper;

    public function productDao()
    {
        if ($this->productDao === NULL) {
            $this->productDao = new ProductDao();
        }
        return $this->productDao;
    }

    public function ProductMapper()
    {
        if ($this->productMapper === NULL) {
            $this->productMapper = new ProductMapper();
        }
        return $this->productMapper;
    }

    public function mapEditedProduct($editedProduct)
    {
        $product = $this->productMapper()->map($editedProduct);
        $product->category = ($editedProduct['categories']);
        $product->imageName [] = $editedProduct['imageName'];
        return $product;
    }

    public function generateImageName($uploadedFile)
    {
        $extention = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
        return uniqid() . "." . $extention;
    }

    public function uploadProductImage($uploadedFile, $imageName)
    {
        $uploadFileDestination = '../web/images/products/' . $imageName;
        return move_uploaded_file($uploadedFile['tmp_name'], $uploadFileDestination);
    }

    public function writeProduct($productName, $categories, $productImageName)
    {
        $writeProduct = $this->productDao()->insertProduct($productName);
        $productId = $writeProduct ? $this->productDao()->getMaxId() : '';
        if (is_numeric($productId)) {
            $writeCategories = $this->productDao()->insertProductCategories($productId, $categories);
            if ($writeCategories) {
                $writeImage = $this->productDao()->insertProductImage($productId, $productImageName);
                $progress = $writeImage ? true : false;
            } else {
                $progress = false;
            }
        } else {
            $progress = false;
        }
        return $progress;
    }

    public function editProduct($currentProduct, $editedProduct)
    {
        if ($currentProduct->isChangedContentProductsTable($editedProduct)) {
            $productsTable = $this->productDao()->editProduct($currentProduct->id, $editedProduct);
        } else {
            $productsTable = true;
        }

        if ($currentProduct->isChangedCategories($editedProduct->category)) {
            $productCategoriesTable = $this->productDao()->editProductCategories($currentProduct->id, $editedProduct->category);
        } else {
            $productCategoriesTable = true;
        }

        if ($currentProduct->isChangedImageName($editedProduct->imageName)) {
            $productImageTable = $this->productDao()->editProductImageName($currentProduct->id, $editedProduct->imageName);
        } else {
            $productImageTable = true;
        }

        $editProduct = ($productsTable AND $productCategoriesTable AND $productImageTable) ? true : false;
        return $editProduct;
    }

    public function getProductById($id)
    {
        $row = $this->productDao()->getProductById($id);
        $product = $this->productMapper()->map($row);
        $this->relationsWithCategories([$product]);
        $imageName = $this->getProductImageByProductId($product->id);
        $product->imageName [] = $imageName;
        return $product;
    }

    public function getProductImageByProductId($id)
    {
        $imageName = $this->productDao()->getProductImageByProductId($id);
        return $imageName == false ? '' : $imageName;
    }

    public function getCategoryById($categoryId)
    {
        $categoryMapper = new CategoryMapper();
        $category = $this->productDao()->getCategoryById($categoryId);
        if (!empty($category[0])) {
            $category = $categoryMapper->map($category[0]);
        }
        return $category;
    }

    public function getProductsThisCategory($categoryId)
    {
        $allProducts = $this->productDao()->getProductsThisCategory($categoryId);
        if (!empty($allProducts)) {
            foreach ($allProducts as $row) {
                $product = $this->productMapper()->map($row);
                $products[$product->id] = $product;
            }
            $this->relationsWithImageName($products);
        } else {
            $products = $this->getEmptyProduct();
        }
        return $products;
    }

    public function getEmptyProduct()
    {
        $row = ['id' => '', 'name' => '', 'category_id' => ''];
        $product = $this->productMapper()->map($row);
        return $product;
    }

    public function getProducts()
    {
        $allProducts = $this->productDao()->getProducts();
        foreach ($allProducts as $row) {
            $product = $this->productMapper()->map($row);
            $products[$product->id] = $product;
        }
        $this->relationsWithCategories($products);
        $this->relationsWithImageName($products);
        return $products;
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

    public function relationsWithImageName($products)
    {
        foreach ($products as $product) {
            $imageName = $this->getProductImageByProductId($product->id);
            $product->imageName [] = $imageName;
        }
    }

    public function getMaxId()
    {
        return $this->productDao()->getMaxId();
    }

    public function selectCategory($categories)
    {
        $categoryService = new CategoryService();
        $allCategories = $categoryService->getCategories();
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
