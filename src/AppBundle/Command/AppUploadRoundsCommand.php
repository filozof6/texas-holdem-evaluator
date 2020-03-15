<?php

namespace AppBundle\Command;

use AppBundle\Constants\Players;
use AppBundle\Entity\PlayerHands;
use AppBundle\Traits\ConsoleAuthTrait;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AppUploadRoundsCommand extends ContainerAwareCommand
{
    use ConsoleAuthTrait;

    protected function configure()
    {
        $this
            ->setName('app:upload-rounds')
            ->setDescription('Parse and upload rounds to db')
            ->addArgument('filePath', InputArgument::OPTIONAL, 'Path to rounds file');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     * @throws OptimisticLockException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->authenticate($input, $output);

        $filePath = $input->getArgument('filePath');
        $parsedRounds = $this->parseRoundsFromFile($filePath);
        $this->persistPlayerHands($parsedRounds);

        $output->writeln('Data parsed.');
    }

    /**
     * @param array $parsedRounds
     * @return void
     * @throws OptimisticLockException
     */
    private function persistPlayerHands(array $parsedRounds)
    {
        /** @var EntityManager $em */
        $em = $this->getContainer()->get('doctrine')->getManager('default');

        foreach ($parsedRounds as $roundId => $round) {
            foreach ($round as $playerId => $hand) {
                $playerHand = new PlayerHands();
                $playerHand
                    ->setRoundId($roundId)
                    ->setPlayerId($playerId)
                    ->setHand($hand);
                $em->persist($playerHand);
            }
        }

        $em->flush();
    }

    /**
     * @param string $filePath
     * @return array
     */
    private function parseRoundsFromFile(string $filePath): array
    {
        $toReturn = [];
        $fn = fopen($filePath, "r");
        $i = 1;

        while (!feof($fn)) {
            $lineString = fgets($fn);
            if (strlen($lineString) > 0) {
                $toReturn[$i] = $this->parseRoundLine($lineString);
            }
            $i++;
        }

        fclose($fn);

        return $toReturn;
    }

    /**
     * @param string $string
     * @return array
     */
    private function parseRoundLine(string $string): array
    {
        $halfLength = strlen($string) / 2;

        return [
            Players::PLAYER_1_ID => substr($string, 0, $halfLength-1),
            Players::PLAYER_2_ID => substr($string, $halfLength, $halfLength-1),
        ];
    }

}
