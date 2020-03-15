<?php

namespace AppBundle\Command;

use AppBundle\Traits\ConsoleAuthTrait;
use AppBundle\Entity\PlayerHands;
use AppBundle\Services\Poker\Round;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AppShowWinsCommand extends ContainerAwareCommand
{
    use ConsoleAuthTrait;

    protected function configure()
    {
        $this
            ->setName('app:show-wins')
            ->setDescription('...')
            ->addArgument('playerId', InputArgument::OPTIONAL, 'Identifier of the player');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->authenticate($input, $output);

        $playerId = $input->getArgument('playerId');
        /** @var Round[] $rounds */
        $rounds = $this
            ->getContainer()
            ->get('doctrine')
            ->getManager()
            ->getRepository(PlayerHands::class)
            ->getRounds();
        $playerWins = $this->countNumberOfWins($rounds, $playerId);

        $output->writeln("Player $playerId won $playerWins times.");
    }

    /**
     * @param Round[] $rounds
     * @param int $playerId
     * @return int
     */
    private function countNumberOfWins(array $rounds, int $playerId): int
    {
        $toReturn = 0;

        foreach ($rounds as $round) {
            $winningPlayerId = $round->getWinnerId();
            if ($winningPlayerId === $playerId) {
                $toReturn++;
            }
        }

        return $toReturn;
    }
}
