<?php
namespace App\Factory;

use App\Entity\Product;
use App\Enum\ProductTypeEnum;

class ProductFactory
{
    public function create(ProductTypeEnum $productType, string $name, string $description, float $price): Product
    {
        switch ($productType) {
            case 'book':
                $product = new Product();
                $product->setName($name)
                    ->setDescription($description)
                    ->setPrice($price);
                return $product;
            case 'dvd':
                $product = new Product();
                $product->setName($name)
                    ->setDescription($description)
                    ->setPrice($price);
                return $product;
            case 'furniture':
                $product = new Product();
                $product->setName($name)
                    ->setDescription($description)
                    ->setPrice($price);
                return $product;
            default:
                throw new \InvalidArgumentException('Invalid product type');
        }
    }
}