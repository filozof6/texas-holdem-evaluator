<?php

namespace AppBundle\Services\Poker;

class Round
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Player[]
     */
    private $players;

    /**
     * Game constructor.
     * @param int $id
     * @param Player[] $players
     */
    public function __construct(int $id, array $players = [])
    {
        $this->id = $id;
        $this->players = $players;
    }

    /**
     * @return int
     */
    public function getWinnerId(): int
    {
        $this->sortHandResultsWinnerFirst();
        /** @var Player $winner */
        $winner = current($this->players);
        return $winner->getId();
    }

    /**
     * @param Player $player
     * @return void
     */
    public function addPlayer(Player $player)
    {
        array_push($this->players, $player);
    }

    /**
     * @return void
     */
    private function sortHandResultsWinnerFirst()
    {
        usort(
            $this->players,
            function (Player $a, Player $b) {
                $aValue = $a->getHandResult()->getValue();
                $bValue = $b->getHandResult()->getValue();

                if ($aValue === $bValue) {
                    $aSubValue = $a->getHandResult()->getSubValue();
                    $bSubValue = $b->getHandResult()->getSubValue();

                    if ($aSubValue === $bSubValue) {
                        $aKickersValue = $a->getHandResult()->getKickersValue();
                        $bKickersValue = $b->getHandResult()->getKickersValue();

                        if ($aKickersValue === $bKickersValue) {
                            return 0;
                        }

                        return ($aKickersValue < $bKickersValue) ? 1 : -1;
                    }

                    return ($aSubValue < $bSubValue) ? 1 : -1;
                }

                return ($aValue < $bValue) ? 1 : -1;
            }
        );
    }
}