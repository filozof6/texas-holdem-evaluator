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

    const RANK_VALUE_MULTIPLIER = 3;

    const ACE_LOW_VALUE = 2;
    const TWO_VALUE = self::ACE_LOW_VALUE * self::RANK_VALUE_MULTIPLIER;
    const THREE_VALUE = self::TWO_VALUE * self::RANK_VALUE_MULTIPLIER;
    const FOUR_VALUE = self::THREE_VALUE * self::RANK_VALUE_MULTIPLIER;
    const FIVE_VALUE = self::FOUR_VALUE * self::RANK_VALUE_MULTIPLIER;
    const SIX_VALUE = self::FIVE_VALUE * self::RANK_VALUE_MULTIPLIER;
    const SEVEN_VALUE = self::SIX_VALUE * self::RANK_VALUE_MULTIPLIER;
    const EIGHT_VALUE = self::SEVEN_VALUE * self::RANK_VALUE_MULTIPLIER;
    const NINE_VALUE = self::EIGHT_VALUE * self::RANK_VALUE_MULTIPLIER;
    const TEN_VALUE = self::NINE_VALUE * self::RANK_VALUE_MULTIPLIER;
    const JACK_VALUE = self::TEN_VALUE * self::RANK_VALUE_MULTIPLIER;
    const QUEEN_VALUE = self::JACK_VALUE * self::RANK_VALUE_MULTIPLIER;
    const KING_VALUE = self::QUEEN_VALUE * self::RANK_VALUE_MULTIPLIER;
    const ACE_HIGH_VALUE = self::KING_VALUE * self::RANK_VALUE_MULTIPLIER;

    const CORE_RANKS = [
        self::TWO => self::TWO_VALUE,
        self::THREE => self::THREE_VALUE,
        self::FOUR => self::FOUR_VALUE,
        self::FIVE => self::FIVE_VALUE,
        self::SIX => self::SIX_VALUE,
        self::SEVEN => self::SEVEN_VALUE,
        self::EIGHT => self::EIGHT_VALUE,
        self::NINE => self::NINE_VALUE,
        self::TEN => self::TEN_VALUE,
        self::JACK => self::JACK_VALUE,
        self::QUEEN => self::QUEEN_VALUE,
        self::KING => self::KING_VALUE,
    ];

    /**
     * @param bool $aceIsHighest
     * @return array
     */
    public static function getRanks($aceIsHighest = true): array
    {
        $toReturn = self::CORE_RANKS;
        if ($aceIsHighest) {
            $toReturn[self::ACE] = self::ACE_HIGH_VALUE;
        } else {
            $toReturn[self::ACE] = self::ACE_LOW_VALUE;
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

        return $ranks[$rank[0]];
    }
}