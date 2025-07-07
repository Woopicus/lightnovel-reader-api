<?php

namespace App\Entity;

use App\Repository\LightnovelRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: LightnovelRepository::class)]
class Lightnovel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column]
    private ?string $description = null;

    #[ORM\Column]
    private ?string $imageFilename = null;

    #[ORM\Column]
    private ?string $imageFilelocation = null;

    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'lightnovels')]
    #[ORM\JoinTable(name: 'lightnovel_genre')]
    private Collection $genres;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): void
    {
        $this->price = $price;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getImageFilename(): ?string
    {
        return $this->imageFilename;
    }

    public function setImageFilename(?string $imageFilename): void
    {
        $this->imageFilename = $imageFilename;
    }

    public function getImageFilelocation(): ?string
    {
        return $this->imageFilelocation;
    }

    public function setImageFilelocation(?string $imageFilelocation): void
    {
        $this->imageFilelocation = $imageFilelocation;
    }

    public function getImagefile(): string
    {
        return $this->getImageFilelocation() . '\\' . $this->getImageFilename();
    }

    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): void
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
            $genre->addLightnovel($this);
        }
    }

    public function removeGenre(Genre $genre): void
    {
        if ($this->genres->contains($genre)) {
            $this->genres->removeElement($genre);
            $genre->removeLightnovel($this);
        }
    }
}
