<?php

namespace App\Entity;

use App\Enum\ProductTypeEnum;
use App\Repository\ProductsRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{



    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(UuidGenerator::class)]
    private Uuid $id;

    #[ORM\Column(type: 'string', length: 255, enumType: ProductTypeEnum::class)]
    private ProductTypeEnum $productType;

    
    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
    }


    /**
     * Get the value of cratedAt
     */
    public function getCratedAt()
    {
        return $this->cratedAt;
    }


    /**
     * Get the value of id
     */
    public function getId(): null|Uuid
    {
        return $this->id;
    }

    /**
     * Get the value of productType
     */
    public function getProductType(): ProductTypeEnum
    {
        return $this->productType;
    }

    /**
     * Set the value of productType
     */
    public function setProductType(ProductTypeEnum $productType): static
    {
        $this->productType = $productType;

        return $this;
    }
}
