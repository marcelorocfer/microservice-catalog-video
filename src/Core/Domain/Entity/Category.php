<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MagicalMethodsTrait;
use Core\Domain\Validation\DomainValidation;

class Category
{
    use MagicalMethodsTrait;

    public function __construct(
        protected string $id = '',
        protected string $name = '',
        protected string $description = '',
        protected bool $isActive = true,
    ){
        $this->validate();
    }

    public function activate(): void
    {   
        $this->isActive = true;
    }

    public function deactivate(): void
    {   
        $this->isActive = false;
    }

    public function update(string $name, string $description = '')
    { 
        $this->name = $name;
        $this->description = $description;

        $this->validate();
    }

    public function validate()
    {
        DomainValidation::strMaxLength($this->name);
        DomainValidation::strMinLength($this->name);
        DomainValidation::strCanNullAndMaxLength($this->name);
    }
}
