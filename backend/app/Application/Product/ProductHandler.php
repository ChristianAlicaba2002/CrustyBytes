<?php

namespace App\Application\Product;

use App\Domain\Product\ProductRepository;
use App\Domain\Product\Product;
use App\Models\ArchiveItems;
use App\Models\Products as ProductModel;

class ProductHandler
{
    public function __construct(private ProductRepository $productRepository)
    {
        return $this->productRepository = $productRepository;
    }

    public function getAllProducts(): array
    {
        $products = ProductModel::all();
        if ($products->isEmpty()) {
            return [];
        }
        return $products->toArray();
    }

    public function createProduct(
        int $id,
        string $name,
        string $description,
        string $category,
        string $size,
        float $price,
        ?string $image,
        bool $isAvailable
    ) {
        $product = new Product(
            id: $id,
            name: $name,
            description: $description,
            category: $category,
            size: $size,
            price: $price,
            image: $image,
            is_available: $isAvailable
        );

        return $this->productRepository->createProduct($product);
    }

    public function updateProduct(
        int $id,
        string $name,
        string $description,
        string $category,
        string $size,
        float $price,
        ?string $image,
        bool $isAvailable
    ) {
        $update = new Product(
            $id,
            $name,
            $description,
            $category,
            $size,
            $price,
            $image,
            $isAvailable
        );

        $this->productRepository->updateProduct($update);
    }

    public function deleteProduct(int $id)
    {
        $product = ArchiveItems::where('product_id', $id)->first();

        if (!$product) {
            return false; // Product not found
        }
        return $this->productRepository->deleteProduct($id);
    }

    public function archiveProduct(int $id)
    {
        $product = ProductModel::where('id', $id)->first();

        if (!$product) {
            return false; // Product not found
        }
        
        return $this->productRepository->archiveProduct($id);
    }
}
