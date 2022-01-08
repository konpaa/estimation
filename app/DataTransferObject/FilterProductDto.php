<?php

namespace App\DataTransferObject;

class FilterProductDto
{
    private string $start_at;

    private string $end_at;

    private ?string $categoryName;

    /**
     * @param string $start_at
     * @param string $end_at
     * @param string|null $categoryName
     */
    public function __construct(string $start_at, string $end_at, ?string $categoryName)
    {
        $this->start_at = $start_at;
        $this->end_at = $end_at;
        $this->categoryName = $categoryName;
    }

    /**
     * @return string
     */
    public function getStartAt(): string
    {
        return $this->start_at;
    }

    /**
     * @return string
     */
    public function getEndAt(): string
    {
        return $this->end_at;
    }

    /**
     * @return string|null
     */
    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }
}
