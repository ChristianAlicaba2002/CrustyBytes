<?php

namespace App\Domain\Product;

interface ProductRepository
{
    public function getAllProducts(): array;
    public function createProduct(Product $product);
    public function updateProduct(Product $product);
    public function deleteProduct(int $id);
    public function archiveProduct(int $id);
}
