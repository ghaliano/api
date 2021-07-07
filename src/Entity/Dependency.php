<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DependencyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Dependency
 * @package App\Entity
 * @ApiResource(
 * )
 */

class Dependency
{

    /**
     * @ApiProperty(identifier=true)
     */
    private $id;
    private $name;
    private $version;

    public function __construct($name, $version)
    {
        $this->setName($name);
        $this->setVersion($version);
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }
}
