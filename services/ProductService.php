<?php

namespace app\services;

use app\dao\ProductDao;
use app\dao\CategoryDao;
use app\dao\colorDao;
use app\dao\SizeDao;
use app\dao\mapper\CategoryMapper;
use app\dao\mapper\ProductMapper;
use app\services\CategoryService;

class ProductService
{

    private $productDao;
    private $categoryDao;
    private $colorDao;
    private $sizeDao;
    private $productMapper;

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

    public function mapProduct($productArray)
    {
        $product = $this->productMapper()->map($productArray);
        $product->addCategories($productArray['categories']);
        $product->addImageName($productArray['imageName']);
        $product->addcolors($productArray['colors']);
        $product->addSizes($productArray['sizes']);
        $product->setPrice($productArray['price']);

        return $product;
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
            $writecolors = $this->productDao()->insertProductcolors($product);
            $writeSizes = $this->productDao()->insertProductSizes($product);
            $progress = ($writeCategories && $writeImage && $writecolors && $writeSizes) ? true : false;
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
        $productcolorsTable = $this->productDao()->editProductcolors($product);
        $productSizesTable = $this->productDao()->editProductSizes($product);

        $changedProduct = ($productsTable && $productCategoriesTable && $productImageTable && $productcolorsTable && $productSizesTable) ? true : false;
        return $changedProduct;
    }

    public function getProductById($id)
    {
        $products = $this->getProducts([$id]);
        return isset($products[$id]) ? $products[$id] : false;
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

    public function getProducts($ids = [])
    {
        $allProducts = $this->productDao()->getAllProducts($ids);
        foreach ($allProducts as $row) {
            $product = $this->productMapper()->map($row);
            $products[$product->id] = $product;
        }
        $this->relationsWithCategories($products);
        $this->relationsWithImageName($products);
        $this->relationsWithcolors($products);
        $this->relationsWithSizes($products);

        return $products;
    }

    public function getAllProducts()
    {
        return $this->getProducts();
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

    public function relationsWithcolors($products)
    {
        foreach ($products as $product) {
            $productcolors = $this->productDao()->getProductcolorsByProductId($product->id);
            $product->addcolors($productcolors);
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
