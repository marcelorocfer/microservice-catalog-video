<?php

namespace Tests\Unit\UseCase\Category;

use Mockery;
use stdClass;
use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\TestCase;
use Core\Domain\Entity\Category;
use Core\UseCase\Category\ListCategoryUseCase;
use Core\UseCase\DTO\Category\CategoryInputDTO;
use Core\UseCase\DTO\Category\CategoryOutputDTO;
use Core\Domain\Repository\CategoryRepositoryInterface;

class ListCategoryUseCaseUnitTest extends TestCase
{
    public function testGetById()
    {
        $id = (string) Uuid::uuid4()->toString();

        $this->mockEntity = Mockery::mock(Category::class, [
            $id,
            'Test Category'
        ]);

        $this->mockEntity->shouldReceive('id')->andReturn($id);
        
        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepository->shouldReceive('findById')
                            ->with($id)
                            ->andReturn($this->mockEntity);

        $this->mockInputDTO = Mockery::mock(CategoryInputDTO::class, [
            $id,
        ]);

        $useCase = new ListCategoryUseCase($this->mockRepository);
        $response = $useCase->execute($this->mockInputDTO);

        $this->assertInstanceOf(CategoryOutputDTO::class, $response);
        $this->assertEquals('Test Category', $response->name);
        $this->assertEquals($id, $response->id);
    }
}