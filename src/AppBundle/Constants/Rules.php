<?php

namespace AppBundle\Constants;

use AppBundle\Services\Poker\HandEvaluator;

final class Rules
{
    const EVALUATOR_STATIC_CLASS = HandEvaluator::class;
    const ROYAL_FLUSH_VALUE = 10;
    const STRAIGHT_FLUSH_VALUE = 9;
    const FOUR_OF_A_KIND_VALUE = 8;
    const FULL_HOUSE_VALUE = 7;
    const FLUSH_VALUE = 6;
    const STRAIGHT_VALUE = 5;
    const THREE_OF_A_KIND_VALUE = 4;
    const TWO_PAIR_VALUE = 3;
    const ONE_PAIR_VALUE = 2;
    const HIGH_CARD_VALUE = 1;

    const WINNING_HANDS = [
        'Royal Flush' => [
            'value' => self::ROYAL_FLUSH_VALUE,
            'conditions' => [
                [
                    'name' => 'isSameSuit',
                    'args' => [],
                    'output' => true,
                ],
                [
                    'name' => 'isSequential',
                    'args' => [],
                    'output' => true,
                ],
                [
                    'name' => 'isRankInHand',
                    'args' => ['K'],
                    'output' => true,
                ],
                [
                    'name' => 'isRankInHand',
                    'args' => ['A'],
                    'output' => true,
                ],
            ],
        ],
        'Straight Flush' => [
            'value' => self::STRAIGHT_FLUSH_VALUE,
            'conditions' => [
                [
                    'name' => 'isSameSuit',
                    'args' => [],
                    'output' => true,
                ],
                [
                    'name' => 'isSequential',
                    'args' => [],
                    'output' => true,
                ],
            ],
        ],
        'Four of a Kind' => [
            'value' => self::FOUR_OF_A_KIND_VALUE,
            'conditions' => [
                [
                    'name' => 'countSameRanks',
                    'args' => [4],
                    'output' => 1,
                ],
            ],
        ],
        'Full House' => [
            'value' => self::FULL_HOUSE_VALUE,
            'conditions' => [
                [
                    'name' => 'countSameRanks',
                    'args' => [3],
                    'output' => 1,
                ],
                [
                    'name' => 'countSameRanks',
                    'args' => [2],
                    'output' => 1,
                ],
            ],
        ],
        'Flush' => [
            'value' => self::FLUSH_VALUE,
            'conditions' => [
                [
                    'name' => 'isSameSuit',
                    'args' => [],
                    'output' => true,
                ],
            ],
        ],
        'Straight' => [
            'value' => self::STRAIGHT_VALUE,
            'conditions' => [
                [
                    'name' => 'isSequential',
                    'args' => [],
                    'output' => true,
                ],
            ],
        ],
        'Three of a Kind' => [
            'value' => self::THREE_OF_A_KIND_VALUE,
            'conditions' => [
                [
                    'name' => 'countSameRanks',
                    'args' => [3],
                    'output' => 1,
                ],
            ],
        ],
        'Two Pair' => [
            'value' => self::TWO_PAIR_VALUE,
            'conditions' => [
                [
                    'name' => 'countSameRanks',
                    'args' => [2],
                    'output' => 2,
                ],
            ],
        ],
        'One Pair' => [
            'value' => self::ONE_PAIR_VALUE,
            'conditions' => [
                [
                    'name' => 'countSameRanks',
                    'args' => [2],
                    'output' => 1,
                ],
            ],
        ],
        'High Card' => [
            'value' => self::HIGH_CARD_VALUE,
            'conditions' => [
                [
                    'name' => 'countSameRanks',
                    'args' => [1],
                    'output' => 5,
                ],
            ],
        ],
    ];
}