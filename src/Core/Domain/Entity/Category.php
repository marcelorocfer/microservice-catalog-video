<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MagicalMethodsTrait;

class Category
{
    use MagicalMethodsTrait;

    public function __construct(
        protected string $id = '',
        protected string $name = '',
        protected string $description = '',
        protected bool $isActive = true,
    ){}

    public function activate(): void
    {   
        $this->isActive = true;
    }

    public function deactivate(): void
    {   
        $this->isActive = false;
    }
}
