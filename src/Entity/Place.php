<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Contract\UserOwnedInterface;
use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\ApiPlatform\Filter\GeolocalizedFilter;
//use App\ApiPlatform\Filter\UserOwnedFilter;

/**
 * @ORM\Entity(repositoryClass=PlaceRepository::class)
 * @ApiResource(
 *  paginationClientItemsPerPage=true,
 *  collectionOperations={
 *     "get"={"normalization_context"={"groups"="read:place:collection"}},
 *     "post"={
 *          "denormalization_context"={"groups"="post:place:collection"},
 *          "normalization_context"={"groups"="read:place:collection"}
 *     }
 *     },
 *  itemOperations={
 *     "get"={"normalization_context"={"groups"={"read:place:collection","read:place:item"}}},
 *     "publish"={
 *          "method"="POST",
 *          "path"="/places/{id}/publish",
 *          "controller"="App\Controller\PublishController",
 *          "openapi_context"={
 *            "summary"="Publier un endroit",
 *            "requestBody"={}
 *          }
 *     }
 *     },
 * )
 * @ApiFilter(SearchFilter::class, properties={"id"="exact", "name"="partial"})
 * @ApiFilter(GeolocalizedFilter::class)
 */
class Place implements UserOwnedInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:user"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:place:collection", "post:place:collection"})
     * @Assert\Length(min="5")
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"read:place:collection", "post:place:collection"})
     */
    private $description;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"read:place:collection", "post:place:collection"})
     */
    private $longitude;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"read:place:collection", "post:place:collection"})
     */
    private $latitude;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=Topic::class, inversedBy="places", cascade={"persist"})
     * @Groups({"read:place:collection", "post:place:collection"})
     * @Assert\Valid()
     */
    private $topics;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"read:place:collection", "post:place:collection"})
     */
    private $picture;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isEnabled;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="no")
     */
    private $user;

    public function __construct()
    {
        $this->topics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Topic[]
     */
    public function getTopics(): Collection
    {
        return $this->topics;
    }

    public function addTopic(Topic $topic): self
    {
        if (!$this->topics->contains($topic)) {
            $this->topics[] = $topic;
        }

        return $this;
    }

    public function removeTopic(Topic $topic): self
    {
        $this->topics->removeElement($topic);

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getIsEnabled(): ?bool
    {
        return $this->isEnabled;
    }

    public function setIsEnabled(?bool $isEnabled): self
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
