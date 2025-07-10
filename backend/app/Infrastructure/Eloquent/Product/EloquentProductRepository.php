<?php

namespace App\Infrastructure\Eloquent\Product;
use App\Domain\Product\ProductRepository;
use App\Domain\Product\Product;
use App\Models\Products as ProductModel;

class EloquentProductRepository implements ProductRepository
{
    
    public function getAllProducts(): array
    {
        $allProducts = ProductModel::all();
        if ($allProducts->isEmpty()) {
            return [];
        }
        return $allProducts->toArray();
    }

    public function createProduct(Product $product)
    {
        $ProductModel = ProductModel::find($product->getId()) ?? new ProductModel();
        $ProductModel->id = $product->getId();
        $ProductModel->name = $product->getName();
        $ProductModel->price = $product->getPrice();
        $ProductModel->description = $product->getDescription();
        $ProductModel->category = $product->getCategory();
        $ProductModel->size = $product->getSize();
        $ProductModel->price = $product->getPrice();
        $ProductModel->image = $product->getImage();
        $ProductModel->is_available = $product->getIsAvailable();
        $ProductModel->save();

    }

    public function updateProduct(Product $product)
    {
        $ProductModel = ProductModel::find($product->getId()) ?? new ProductModel();
        $ProductModel->id = $product->getId();
        $ProductModel->name = $product->getName();
        $ProductModel->price = $product->getPrice();
        $ProductModel->description = $product->getDescription();
        $ProductModel->category = $product->getCategory();
        $ProductModel->size = $product->getSize();
        $ProductModel->price = $product->getPrice();
        $ProductModel->image = $product->getImage();
        $ProductModel->is_available = $product->getIsAvailable();
        $ProductModel->save();
    }
}