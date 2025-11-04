<?php

declare(strict_types=1);


namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Attribute\Ignore;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column]
    private ?string $name = null;
    #[ORM\Column]
    private ?string $category = null;
    #[ORM\Column]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Lightnovel::class, mappedBy: 'genres')]
    private Collection $lightnovels;

    public function __construct()
    {
        $this->lightnovels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): void
    {
        $this->category = $category;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    #[Ignore]
    public function getLightnovels(): Collection
    {
        return $this->lightnovels;
    }

    public function addLightnovel(Lightnovel $lightnovel): void
    {
        if (!$this->lightnovels->contains($lightnovel)) {
            $this->lightnovels->add($lightnovel);
        }
    }

    public function removeLightnovel(Lightnovel $lightnovel): void
    {
        $this->lightnovels->removeElement($lightnovel);
    }
}
