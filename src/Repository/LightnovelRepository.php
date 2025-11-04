<?php

declare(strict_types=1);


namespace App\Repository;

use App\Entity\Lightnovel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LightnovelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lightnovel::class);
    }
}
