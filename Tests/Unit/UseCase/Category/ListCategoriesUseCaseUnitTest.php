<?php

namespace Tests\Unit\UseCase\Category;

use Mockery;
use stdClass;
use PHPUnit\Framework\TestCase;
use Core\Domain\Repository\PaginationInterface;
use Core\UseCase\Category\ListCategoriesUseCase;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\ListCategories\ListCategoriesInputDTO;
use Core\UseCase\DTO\Category\ListCategories\ListCategoriesOutputDTO;

class ListCategoriesUseCaseUnitTest extends TestCase
{
    public function testListCategoriesEmpty()
    {
        $this->mockPagination = Mockery::mock(stdClass::class, PaginationInterface::class);
        $this->mockPagination->shouldReceive('items')->andReturn([]);
        $this->mockPagination->shouldReceive('total')->andReturn(0);

        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepository->shouldReceive('paginate')->andReturn($this->mockPagination);

        $this->mockInputDTO = Mockery::mock(ListCategoriesInputDTO::class, ['filter', 'desc']);

        $useCase = new ListCategoriesUseCase($this->mockRepository);
        $response = $useCase->execute($this->mockInputDTO);

        $this->assertCount(0, $response->items);
        $this->assertInstanceOf(ListCategoriesOutputDTO::class, $response);
    }
}