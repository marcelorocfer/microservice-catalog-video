<?php

namespace Core\UseCase\DTO\Category\ListCategories;

class ListCategoriesOutputDTO
{
    public function __construct(
        public array $items,
        public int $total,
    )
    {

    }
}