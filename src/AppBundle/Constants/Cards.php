<?php

namespace AppBundle\Constants;

final class Cards
{
    const DELIMITER = " ";

    const ACE = 'A';
    const TWO = '2';
    const THREE = '3';
    const FOUR = '4';
    const FIVE = '5';
    const SIX = '6';
    const SEVEN = '7';
    const EIGHT = '8';
    const NINE = '9';
    const TEN = 'T';
    const JACK = 'J';
    const QUEEN = 'Q';
    const KING = 'K';

    const CORE_RANKS = [
        self::TWO,
        self::THREE,
        self::FOUR,
        self::FIVE,
        self::SIX,
        self::SEVEN,
        self::EIGHT,
        self::NINE,
        self::TEN,
        self::JACK,
        self::QUEEN,
        self::KING,
    ];

    /**
     * @param bool $aceIsHighest
     * @return array
     */
    public static function getRanks($aceIsHighest = true): array
    {
        if ($aceIsHighest) {
            $toReturn = array_merge(self::CORE_RANKS, [self::ACE]);
        } else {
            $toReturn = array_merge([self::ACE], self::CORE_RANKS);
        }

        return $toReturn;
    }

    /**
     * @param string $rank
     * @param bool $aceIsHighest
     * @return int
     */
    public static function getRankValue(string $rank, $aceIsHighest = true): int
    {
        $ranks = self::getRanks($aceIsHighest);

        // we need to take into account that the A can be used as first (lowest) card
        $valueAddition = $aceIsHighest ? 2 : 1;

        return array_search($rank[0], $ranks) + $valueAddition;
    }
}