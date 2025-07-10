<?php

namespace App\Domain\Product;

interface ProductRepository
{
    public function getAllProducts(): array;
    public function createProduct(Product $product);
    public function updateProduct(Product $product);
}
