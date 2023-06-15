<?php

namespace Core\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\UseCase\DTO\Category\CategoryCreateInputDTO;
use Core\UseCase\DTO\Category\CategoryCreateOutputDTO;
use Core\Domain\Repository\CategoryRepositoryInterface;

class CreateCategoryUseCase
{
    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CategoryCreateInputDTO $input): CategoryCreateOutputDTO
    {
        $category = new Category(
            name: $input->name,
            description: $input->description,
            isActive: $input->isActive,
        );

        $newCategory = $this->repository->insert($category);

        return new CategoryCreateOutputDTO(
            id: $newCategory->id(),
            name: $newCategory->name,
            description: $newCategory->description,
            isActive: $newCategory->isActive,
        );
    }
}