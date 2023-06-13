<?php

namespace Tests\Unit\Domain\Entity;

use PHPUnit\Framework\TestCase;
use Core\Domain\Entity\Category;

class CategoryUnitTest extends TestCase
{
    public function testAttributes() 
    {
        $category = new Category(
            id: 'foo',
            name: 'New Category',
            description: 'New Description',
            isActive: true,
        );

        $this->assertEquals('New Category', $category->name);
        $this->assertEquals('New Description', $category->description);
        $this->assertEquals(true, $category->isActive);
    }
}