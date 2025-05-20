<?php

namespace App\Command;

use App\Service\LightnovelService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:get-lightnovels')]
class GetLightnovelsCommand extends Command
{
    public function __construct(
        private readonly LightnovelService $lightnovelService
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        dump(
            $this->lightnovelService->getLightnovels()
        );

        return Command::SUCCESS;
    }
}