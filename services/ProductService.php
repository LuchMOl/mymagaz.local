<?php

namespace app\services;

use app\dao\ProductDao;
use app\dao\CategoryDao;
use app\dao\ColorDao;
use app\dao\SizeDao;
use app\dao\mapper\CategoryMapper;
use app\dao\mapper\ProductMapper;
use app\services\CategoryService;
use app\services\CurrencyService;

class ProductService
{

    private $productDao;
    private $categoryDao;
    private $colorDao;
    private $sizeDao;
    private $productMapper;
    private $currencyService;

    public function productDao()
    {
        if ($this->productDao === NULL) {
            $this->productDao = new ProductDao();
        }
        return $this->productDao;
    }

    public function categoryDao()
    {
        if ($this->categoryDao === NULL) {
            $this->categoryDao = new CategoryDao();
        }
        return $this->categoryDao;
    }

    public function colorDao()
    {
        if ($this->colorDao === NULL) {
            $this->colorDao = new colorDao();
        }
        return $this->colorDao;
    }

    public function sizeDao()
    {
        if ($this->sizeDao === NULL) {
            $this->sizeDao = new SizeDao();
        }
        return $this->sizeDao;
    }

    public function ProductMapper()
    {
        if ($this->productMapper === NULL) {
            $this->productMapper = new ProductMapper();
        }
        return $this->productMapper;
    }

    public function CurrencyService()
    {
        if ($this->currencyService === NULL) {
            $this->currencyService = new CurrencyService();
        }
        return $this->currencyService;
    }

    public function writeFile($file)
    {
        $fileName = $this->generateImageName($file);
        $upload = $this->uploadProductImage($file, $fileName);
        $result = $upload ? $fileName : '';
        return $result;
    }

    public function generateImageName($file)
    {
        $extention = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . "." . $extention;
        return $fileName;
    }

    public function uploadProductImage($file, $fileName)
    {
        $fileDestination = '../web/images/products/' . $fileName;
        $upload = move_uploaded_file($file['tmp_name'], $fileDestination);
        return $upload;
    }

    public function writeProduct($product)
    {
        $writedProductId = $this->productDao()->insertProduct($product);
        if (is_numeric($writedProductId)) {

            $product->setId($writedProductId);

            $writeCategories = $this->productDao()->insertProductCategories($product);
            $writeImage = $this->productDao()->insertProductImageName($product);
            $writeColors = $this->productDao()->insertProductColors($product);
            $writeSizes = $this->productDao()->insertProductSizes($product);
            $progress = ($writeCategories && $writeImage && $writeColors && $writeSizes) ? true : false;
        } else {
            $progress = false;
        }
        return $progress;
    }

    public function editProduct($product)
    {
        $productsTable = $this->productDao()->editProduct($product);
        $productCategoriesTable = $this->productDao()->editProductCategories($product);
        $productImageTable = $this->productDao()->editProductImageName($product);
        $productColorsTable = $this->productDao()->editProductColors($product);
        $productSizesTable = $this->productDao()->editProductSizes($product);

        $changedProduct = ($productsTable && $productCategoriesTable && $productImageTable && $productColorsTable && $productSizesTable) ? true : false;
        return $changedProduct;
    }

    public function getProductById($id)
    {
        $products = $this->getProducts([$id]);
        return isset($products[$id]) ? $products[$id] : false;
    }

    public function getProductForEdit($id)
    {
        $product = $this->productDao()->getProductById($id);
        $product = $this->ProductMapper()->map($product);
        $this->relationsWithComponents([$product]);
        return $product;
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
            $this->CurrencyService()->convertPrice($products);
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

    public function getProducts($ids = [])
    {
        $allProducts = $this->productDao()->getAllProducts($ids);
        foreach ($allProducts as $row) {
            $product = $this->productMapper()->map($row);
            $products[$product->id] = $product;
        }
        $this->relationsWithComponents($products);

        $this->CurrencyService()->convertPrice($products);

        return $products;
    }

    public function getAllProducts()
    {
        return $this->getProducts();
    }

    public function relationsWithComponents($products)
    {
        $this->relationsWithCategories($products);
        $this->relationsWithImageName($products);
        $this->relationsWithColors($products);
        $this->relationsWithSizes($products);
    }

    public function relationsWithCategories($products)
    {
        $categoryMapper = new CategoryMapper();
        $allCategories = $this->productDao()->getProductCategories();

        foreach ($allCategories as $row) {
            $category = $categoryMapper->map($row);
            foreach ($products as $product) {
                if ($product->id == $row['product_id']) {
                    $product->categories [] = $category;
                }
            }
        }
    }

    public function relationsWithImageName($products)
    {
        $allProductImages = $this->productDao()->getAllProductImages();

        foreach ($products as $product) {
            foreach ($allProductImages as $productImage) {
                if ($product->id == $productImage['product_id']) {
                    $product->addImageName($productImage['image_name']);
                }
            }
        }
    }

    public function relationsWithColors($products)
    {
        foreach ($products as $product) {
            $productColors = $this->productDao()->getProductColorsByProductId($product->id);
            $product->addColors($productColors);
        }
    }

    public function relationsWithSizes($products)
    {
        foreach ($products as $product) {
            $productSizes = $this->productDao()->getProductSizesByProductId($product->id);
            $product->addSizes($productSizes);
        }
    }

    public function selectCategories($categories)
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
