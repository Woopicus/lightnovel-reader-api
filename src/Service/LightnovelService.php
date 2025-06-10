<?php

namespace App\Service;

use App\Entity\Lightnovel;
use App\Repository\LightnovelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

readonly class LightnovelService
{
    public function __construct(
       private EntityManagerInterface $entityManager,
       private LightnovelRepository $lightnovelRepository,
    ) {}

    public function getLightnovels(): array
    {
       return $this->lightnovelRepository->findAll();
    }

   public function getLightnovel(int $lightnovelId): ?Lightnovel
    {
       return $this->lightnovelRepository->find($lightnovelId);
    }

    public function createLightnovel(string $name, int $price, string $description): Lightnovel
    {
        $lightnovel = new Lightnovel();
        $lightnovel->setName($name);
        $lightnovel->setPrice($price);
        $lightnovel->setDescription($description);

        $this->entityManager->persist($lightnovel);
        $this->entityManager->flush();

        return $lightnovel;
    }

    public function updateLightnovel(int $lightnovelId, string $name, int $price, string $description): ?Lightnovel
    {
        $lightnovel = $this->getLightnovel($lightnovelId);

        if  ($lightnovel) {
            $lightnovel->setName($name);
            $lightnovel->setPrice($price);
            $lightnovel->setDescription($description);

            $this->entityManager->persist($lightnovel);
            $this->entityManager->flush();
        }

        return $lightnovel;
    }

    public function removeLightnovel(int $lightnovelId): void
    {
        $lightnovel = $this->getLightnovel($lightnovelId);

        if ($lightnovel) {
            $this->entityManager->remove($lightnovel);
            $this->entityManager->flush();
        }
    }

    public function imageLightnovel(UploadedFile $file, int $lightnovelId): ?Lightnovel
    {
        $lightnovel = $this->getLightnovel($lightnovelId);

        if ($lightnovel) {

            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $originalFilename.'-'.uniqid().'.'.$file->guessExtension();
            $target = 'E:\Uploads';

            $file->move($target, $fileName);

            $lightnovel->setImageFilename($fileName);
            $lightnovel->setImageFilelocation($target);

            $this->entityManager->persist($lightnovel);
            $this->entityManager->flush();

            return $lightnovel;
        }

        return null;
    }
}