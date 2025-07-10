<?php

namespace App\Domain\Product;

class Product
{

    public function __construct(
        private int $id,
        private string $name,
        private string $description,
        private string $category,
        private string $size,
        private float $price,
        private ?string $image = null,
        private bool $is_available = true
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->size = $size;
        $this->price = $price;
        $this->image = $image;
        $this->is_available = $is_available;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getSize(): string
    {
        return $this->size;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getIsAvailable(): bool
    {
        return $this->is_available;
    }
}