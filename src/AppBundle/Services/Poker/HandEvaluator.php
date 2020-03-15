<?php

namespace AppBundle\Services\Poker;

use AppBundle\Constants\Cards;

class HandEvaluator
{
    /**
     * @param String[] $hand
     * @return bool
     */
    public static function isSameSuit(array $hand): bool
    {
        $toReturn = true;
        $firstCard = array_shift($hand);
        $suitSymbol = $firstCard[1];

        foreach ($hand as $card) {
            if ($suitSymbol !== $card[1]) {
                $toReturn = false;
                break;
            }
        }

        return $toReturn;
    }

    /**
     * @param string[] $hand
     * @return bool
     */
    public static function isSequential(array $hand): bool
    {
        $toReturn = false;

        foreach ([true, false] as $aceIsHighest) {
            $sortedHand = self::sortHand($hand, $aceIsHighest);
            $previousCard = array_shift($sortedHand);
            $toReturn = true;

            foreach ($sortedHand as $card) {
                $previousCardRank = Cards::getRankValue($previousCard[0], $aceIsHighest);
                $currentCardRank = Cards::getRankValue($card[0], $aceIsHighest);
                $diff = $currentCardRank - $previousCardRank;

                if ($diff !== 1) {
                    $toReturn = false;
                    break;
                }
                $previousCard = $card;
            }

            if ($toReturn) {
                break;
            }
        }

        return $toReturn;
    }

    /**
     * @param string[] $hand
     * @param bool $aceIsHighest
     * @return string[]
     */
    public static function sortHand(array $hand, bool $aceIsHighest = true): array
    {
        usort($hand, function (string $a, string $b) use ($aceIsHighest) {
            $rankA = Cards::getRankValue($a[0], $aceIsHighest);
            $rankB = Cards::getRankValue($b[0], $aceIsHighest);

            if ($rankA == $rankB) {
                $toReturn = 0;
            } else {
                $toReturn = ($rankA < $rankB) ? -1 : 1;
            }

            return $toReturn;
        });

        return $hand;
    }

    /**
     * @param string[] $hand
     * @return int[]
     */
    private static function sameOccurrences(array $hand): array
    {
        $occurrences = [];
        foreach ($hand as $card) {
            if ($occurrences[$card[0]] ?? false) {
                $occurrences[$card[0]] += 1;
            } else {
                $occurrences[$card[0]] = 1;
            }
        }

        return $occurrences;
    }

    /**
     * @param string[] $hand
     * @param int $occurrence
     * @return int
     */
    public static function countSameRanks(array $hand, int $occurrence): int
    {
        $toReturn = 0;
        $occurrences = self::sameOccurrences($hand);
        foreach ($occurrences as $rank => $rankOccurrences) {
            if ($rankOccurrences === $occurrence) {
                $toReturn++;
            }
        }

        return $toReturn;
    }

    /**
     * @param array $hand
     * @return string
     */
    public static function getHighCardRank(array $hand): string
    {
        $sortedHand = self::sortHand($hand);

        return array_pop($sortedHand)[0];
    }

    /**
     * @param array $hand
     * @return int
     */
    public static function getHighCardRankValue(array $hand): int
    {
        $sortedHand = self::sortHand($hand);
        $highestRank = array_pop($sortedHand);

        return Cards::getRankValue($highestRank);
    }

    /**
     * @param array $hand
     * @param string $rank
     * @return bool
     */
    public static function isRankInHand(array $hand, string $rank): bool
    {
        $toReturn = false;

        foreach ($hand as $card) {
            if ($rank === $card[0]) {
                $toReturn = true;
                break;
            }
        }

        return $toReturn;
    }

    /**
     * @param string[] $hand
     * @param int $magnitude
     * @param bool $aceIsHighest
     * @return int
     */
    public static function sumValuesOfMagnitude(array $hand, int $magnitude, bool $aceIsHighest = true): int
    {
        $sameOccurrences = self::sameOccurrences($hand);
        $ranks = array_keys($sameOccurrences, $magnitude);

        return array_reduce($ranks, function (int $totalSum, string $rank) use ($aceIsHighest) {
            return $totalSum + Cards::getRankValue($rank, $aceIsHighest);
        }, 0);
    }
}