<?php

namespace App\DataTransferObject;

class ProductDto
{
    private ?string $name;

    private ?string $description;

    private string $userId;

    private ?string $priceCurrency;

    private ?float $price;

    private string $categoryId;

    /**
     * @param string|null $name
     * @param string|null $description
     * @param string $userId
     * @param string|null $priceCurrency
     * @param float|null $price
     * @param string $categoryId
     */
    public function __construct(
        ?string $name,
        ?string $description,
        string $userId,
        ?string $priceCurrency,
        ?float $price,
        string $categoryId
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->userId = $userId;
        $this->priceCurrency = $priceCurrency;
        $this->price = $price;
        $this->categoryId = $categoryId;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return string|null
     */
    public function getPriceCurrency(): ?string
    {
        return $this->priceCurrency;
    }

    /**
     * @return string|null
     */
    public function getPrice(): ?string
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getCategoryId(): string
    {
        return $this->categoryId;
    }
}
