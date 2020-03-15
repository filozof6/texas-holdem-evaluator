<?php

namespace AppBundle\Services\Poker;

use AppBundle\Constants\Cards;

class Card
{
    /**
     * @var string
     */
    private $rank;

    /**
     * @var string
     */
    private $suit;

    /**
     * Card constructor.
     * @param string $card
     */
    public function __construct(string $card)
    {
        $cardExploded = explode(Cards::DELIMITER, $card);

        $this->rank = strtoupper($cardExploded[0]);
        $this->suit = strtoupper($cardExploded[1]);
    }

    /**
     * @return string
     */
    public function getRank(): string
    {
        return $this->rank;
    }

    /**
     * @return string
     */
    public function getSuit(): string
    {
        return $this->suit;
    }

    public function __toString()
    {
        return $this->getRank() . $this->getSuit();
    }
}