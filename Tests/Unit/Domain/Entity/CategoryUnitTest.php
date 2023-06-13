<?php

namespace Tests\Unit\Domain\Entity;

use Throwable;
use PHPUnit\Framework\TestCase;
use Core\Domain\Entity\Category;
use Core\Domain\Exceptions\EntityValidationException;

class CategoryUnitTest extends TestCase
{
    public function testAttributes() 
    {
        $category = new Category(
            name: 'New Category',
            description: 'New Description',
            isActive: true,
        );

        $this->assertEquals('New Category', $category->name);
        $this->assertEquals('New Description', $category->description);
        $this->assertEquals(true, $category->isActive);
    }

    public function testIsActivated()
    {
        $category = new Category(
            name: 'New Category',
            isActive: false,
        );

        $this->assertFalse($category->isActive);
        $category->activate();
        $this->assertTrue($category->isActive);
    }

    public function testIsDeactivated()
    {
        $category = new Category(
            name: 'New Category',
        );

        $this->assertTrue($category->isActive);
        $category->deactivate();
        $this->assertFalse($category->isActive);
    }   
    
    public function testUpdate()
    {
        $uuid = 'uuid.value';

        $category = new Category(
            id: $uuid,
            name: 'Category',
            description: 'Description',
            isActive: true,
        );

        $category->update(
            name: 'New Name',
            description: 'New Description',
        );

        $this->assertEquals('New Name', $category->name);
        $this->assertEquals('New Description', $category->description);
    }

    public function testExceptionName()
    {
        try {
            $category = new Category(
                name: 'N',
                description: 'New Description',
            );

            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }
}