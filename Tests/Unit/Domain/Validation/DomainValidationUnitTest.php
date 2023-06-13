<?php

namespace Tests\Unit\Domain\Validation;

use Throwable;
use PHPUnit\Framework\TestCase;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\Exceptions\EntityValidationException;

class DomainValidationUnitTest extends TestCase
{
    public function testNotNull()
    {
        try {
            $value = '';
            DomainValidation::notNull($value);

            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }
}