<?php

namespace Tests\Unit\UseCase\Category;

use Mockery;
use stdClass;
use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\TestCase;
use Core\Domain\Entity\Category;
use Core\UseCase\Category\UpdateCategoryUseCase;
use Core\Domain\Repository\CategoryRepositoryInterface;

class UpdateCategoryUseCaseUnitTest extends TestCase 
{
    public function testRenameCategory()
    {
        $uuid = (string) Uuid::uuid4()->toString();
        $categoryName = 'Name';
        $categoryDescription = 'Description';

        $this->mockEntity = Mockery::mock(Category::class, [
            $uuid,
            $categoryName,
            $categoryDescription
        ]);

        $this->mockEntity->shouldReceive('update');

        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepository->shouldReceive('findById')->andReturn($this->mockEntity);
        $this->mockRepository->shouldReceive('update')->andReturn($this->mockEntity);

        $this->mockInputDTO = Mockery::mock(CategoryUpdateInputDTO::class, [
            $uuid,
            'New name',
            ''
        ]);

        $useCase = new UpdateCategoryUseCase($this->mockRepository);
        $response = $useCase->execute($this->mockInputDTO);

        $this->assertInstanceOf(CategoryUpdateOutputDTO::class, $response);
    }
}