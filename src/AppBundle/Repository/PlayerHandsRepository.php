<?php

namespace AppBundle\Repository;

use AppBundle\Entity\PlayerHands;
use AppBundle\Services\Poker\Hand;
use AppBundle\Services\Poker\Player;
use AppBundle\Services\Poker\Round;
use Doctrine\ORM\EntityRepository;

class PlayerHandsRepository extends EntityRepository
{
    /**
     * @return Round[]
     */
    public function getRounds(): array
    {
        /** @var Round[] $toReturn */
        $toReturn = [];
        $playerHands = $this->findAll();

        /** @var PlayerHands $playerHand */
        foreach ($playerHands as $playerHand) {
            $roundId = $playerHand->getRoundId();
            if (!array_key_exists($roundId, $toReturn)) {
                $toReturn[$roundId] = new Round($roundId);
            }
            $hand = Hand::createFromStringFactory($playerHand->getHand());
            $player = new Player($playerHand->getPlayerId(), $hand);
            $toReturn[$roundId]->addPlayer($player);
        }

        return $toReturn;
    }
}