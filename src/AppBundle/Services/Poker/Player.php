<?php

namespace AppBundle\Services\Poker;

class Player
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Hand
     */
    private $hand;

    /**
     * @var HandResult
     */
    private $handResult;

    /**
     * Player constructor.
     * @param int $id
     * @param Hand $hand
     */
    public function __construct(int $id, Hand $hand)
    {
        $this->id = $id;
        $this->hand = $hand;
        $this->handResult = $hand->evaluateHand();
    }

    /**
     * @return Hand
     */
    public function getHand(): Hand
    {
        return $this->hand;
    }

    /**
     * @return HandResult
     */
    public function getHandResult(): HandResult
    {
        return $this->handResult;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
