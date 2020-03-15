<?php

namespace Tests\AppBundle\Service\Poker;

use AppBundle\Constants\Players;
use AppBundle\Services\Poker\Hand;
use AppBundle\Services\Poker\Player;
use AppBundle\Services\Poker\Round;
use PHPUnit\Framework\TestCase;

class RoundTest extends TestCase
{
    const ROYAL_FLUSH_HAND = ['AH', 'KH', 'QH', 'JH', 'TH'];

    const STRAIGHT_FLUSH_HAND_HIGHEST = ['KH', 'QH', 'JH', 'TH', '9H'];
    const STRAIGHT_FLUSH_HAND_LOWER = ['QH', 'JH', 'TH', '9H', '8H'];
    const STRAIGHT_FLUSH_HAND_LOWEST = ['AH', '2H', '3H', '4H', '5H'];

    const FOUR_OF_A_KIND_HAND_HIGHEST = ['AH', 'AS', 'AD', 'AC', 'KS'];
    const FOUR_OF_A_KIND_HAND_LOWER = ['AH', 'AS', 'AD', 'AC', 'QS'];
    const FOUR_OF_A_KIND_HAND_LOWEST = ['2H', '2S', '2D', '2C', '3S'];

    const FULL_HOUSE_HAND_HIGHEST = ['AH', 'AS', 'AD', 'KH', 'KS'];
    const FULL_HOUSE_HAND_LOWER = ['AH', 'AS', 'AD', 'QH', 'QS'];
    const FULL_HOUSE_HAND_LOWEST = ['2H', '2S', '2D', '3H', '3S'];

    const FLUSH_HAND_HIGHEST = ['AH', 'KH', 'QH', 'JH', '9H'];
    const FLUSH_HAND_LOWER = ['AH', 'KH', 'QH', 'JH', '8H'];
    const FLUSH_HAND_LOWEST = ['2H', '3H', '4H', '5H', '7H'];

    const STRAIGHT_HAND_HIGHEST = ['AC', 'KH', 'QH', 'JH', 'TH'];
    const STRAIGHT_HAND_LOWER = ['KC', 'QH', 'JH', 'TH', '9H'];
    const STRAIGHT_HAND_LOWEST = ['AC', '2H', '3H', '4H', '5H'];

    const THREE_OF_A_KIND_HAND_HIGHEST = ['AC', 'AS', 'AD', 'KH', 'QH'];
    const THREE_OF_A_KIND_HAND_LOWER = ['AC', 'AS', 'AD', 'KH', 'JH'];
    const THREE_OF_A_KIND_HAND_LOWEST = ['2C', '2S', '2D', '3H', '4C'];

    const TWO_PAIR_HAND_HIGHEST = ['AC', 'AH', 'KH', 'KS', 'QC'];
    const TWO_PAIR_HAND_LOWER = ['AC', 'AH', 'KH', 'KS', 'JC'];
    const TWO_PAIR_HAND_LOWEST = ['2C', '2H', '3H', '3S', '4C'];

    const ONE_PAIR_HAND_HIGHEST = ['AC', 'AH', 'KH', 'QH', 'JH'];
    const ONE_PAIR_HAND_LOWER = ['AC', 'AH', 'KH', 'QH', 'TH'];
    const ONE_PAIR_HAND_LOWEST = ['2C', '2H', '3H', '4H', '5H'];

    const HIGH_CARD_HAND_HIGHEST = ['AC', 'KH', 'JS', '9C', 'TH'];
    const HIGH_CARD_HAND_LOWER = ['AC', 'KH', 'JS', '8C', 'TH'];
    const HIGH_CARD_HAND_LOWEST = ['2C', '3H', '4S', '5H', '7H'];

    public function evaluateHandsProvider()
    {
        return [
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(['AH', 'AS', 'AD', 'KH', 'KS'])),
                    new Player(Players::PLAYER_2_ID, new Hand(['AH', 'AS', 'AD', 'QH', 'QS'])),
                ]),
                Players::PLAYER_1_ID,
            ],
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(['AH', 'AS', 'AD', '2H', '2S'])),
                    new Player(Players::PLAYER_2_ID, new Hand(['AH', 'AS', 'AD', '5H', '5S'])),
                ]),
                Players::PLAYER_2_ID,
            ],
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(['JH', 'JS', 'JD', 'AH', 'AS'])),
                    new Player(Players::PLAYER_2_ID, new Hand(['AH', 'AS', 'AD', '5H', '5S'])),
                ]),
                Players::PLAYER_2_ID,
            ],
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(['AH', 'AS', 'AD', 'KH', 'KS'])),
                    new Player(Players::PLAYER_2_ID, new Hand(['JH', 'JS', 'JD', 'AH', 'AS'])),
                ]),
                Players::PLAYER_1_ID,
            ],
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(['AH', '2S', '3H', '4H', '5H'])),
                    new Player(Players::PLAYER_2_ID, new Hand(['2H', '3H', '4H', '5H', '6S'])),
                ]),
                Players::PLAYER_2_ID,
            ],
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::STRAIGHT_HAND_LOWEST)),
                    new Player(Players::PLAYER_2_ID, new Hand(['2C', '3H', '4H', '5H', '6H'])),
                ]),
                Players::PLAYER_2_ID,
            ],
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(['AH', 'TS', '3H', 'JH', '5H'])),
                    new Player(Players::PLAYER_2_ID, new Hand(['2H', '3D', '4H', '5H', 'KS'])),
                ]),
                Players::PLAYER_1_ID,
            ],
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(['AH', '2S', '3H', '4H', '5H'])),
                    new Player(Players::PLAYER_2_ID, new Hand(['2H', '3D', '4H', '5H', 'KS'])),
                ]),
                Players::PLAYER_1_ID,
            ],
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(['AH', 'AS', 'AH', '4D', '4S'])),
                    new Player(Players::PLAYER_2_ID, new Hand(['KH', 'KS', 'KH', 'AD', 'AS'])),
                ]),
                Players::PLAYER_1_ID,
            ],
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(['AH', 'AS', 'JH', 'TD', 'QS'])),
                    new Player(Players::PLAYER_2_ID, new Hand(['AH', 'AS', 'KH', '2D', '3S'])),
                ]),
                Players::PLAYER_2_ID,
            ],
            // Royal Flush vs Straight Flush
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::ROYAL_FLUSH_HAND)),
                    new Player(Players::PLAYER_2_ID, new Hand(self::STRAIGHT_FLUSH_HAND_HIGHEST)),
                ]),
                Players::PLAYER_1_ID,
            ],
            // Straight Flush vs Four of a kind
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::STRAIGHT_FLUSH_HAND_LOWEST)),
                    new Player(Players::PLAYER_2_ID, new Hand(self::FOUR_OF_A_KIND_HAND_HIGHEST)),
                ]),
                Players::PLAYER_1_ID,
            ],
            // Four of a kind vs Full House
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::FOUR_OF_A_KIND_HAND_LOWEST)),
                    new Player(Players::PLAYER_2_ID, new Hand(self::FULL_HOUSE_HAND_HIGHEST)),
                ]),
                Players::PLAYER_1_ID,
            ],
            // Full House vs Flush
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::FULL_HOUSE_HAND_LOWEST)),
                    new Player(Players::PLAYER_2_ID, new Hand(self::FLUSH_HAND_HIGHEST)),
                ]),
                Players::PLAYER_1_ID,
            ],
            // Flush vs Straight
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::FLUSH_HAND_LOWEST)),
                    new Player(Players::PLAYER_2_ID, new Hand(self::STRAIGHT_HAND_HIGHEST)),
                ]),
                Players::PLAYER_1_ID,
            ],
            // Straight vs Three of a kind
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::STRAIGHT_HAND_LOWEST)),
                    new Player(Players::PLAYER_2_ID, new Hand(self::THREE_OF_A_KIND_HAND_HIGHEST)),
                ]),
                Players::PLAYER_1_ID,
            ],
            // Three of a kind vs Two pair
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::THREE_OF_A_KIND_HAND_LOWEST)),
                    new Player(Players::PLAYER_2_ID, new Hand(self::TWO_PAIR_HAND_HIGHEST)),
                ]),
                Players::PLAYER_1_ID,
            ],
            // Two pair vs One pair
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::TWO_PAIR_HAND_LOWEST)),
                    new Player(Players::PLAYER_2_ID, new Hand(self::ONE_PAIR_HAND_HIGHEST)),
                ]),
                Players::PLAYER_1_ID,
            ],
            // One pair vs High card
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::ONE_PAIR_HAND_LOWEST)),
                    new Player(Players::PLAYER_2_ID, new Hand(self::HIGH_CARD_HAND_HIGHEST)),
                ]),
                Players::PLAYER_1_ID,
            ],
            // Straight flush vs Straight flush
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::STRAIGHT_FLUSH_HAND_HIGHEST)),
                    new Player(Players::PLAYER_2_ID, new Hand(self::STRAIGHT_FLUSH_HAND_LOWER)),
                ]),
                Players::PLAYER_1_ID,
            ],
            // Four of a kind vs Four of a kind
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::FOUR_OF_A_KIND_HAND_HIGHEST)),
                    new Player(Players::PLAYER_2_ID, new Hand(self::FOUR_OF_A_KIND_HAND_LOWER)),
                ]),
                Players::PLAYER_1_ID,
            ],
            // Full house vs Full house
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::FULL_HOUSE_HAND_HIGHEST)),
                    new Player(Players::PLAYER_2_ID, new Hand(self::FULL_HOUSE_HAND_LOWER)),
                ]),
                Players::PLAYER_1_ID,
            ],
            // Flush vs Flush
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::FLUSH_HAND_HIGHEST)),
                    new Player(Players::PLAYER_2_ID, new Hand(self::FLUSH_HAND_LOWER)),
                ]),
                Players::PLAYER_1_ID,
            ],
            // Straight vs Straight
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::STRAIGHT_HAND_HIGHEST)),
                    new Player(Players::PLAYER_2_ID, new Hand(self::STRAIGHT_HAND_LOWER)),
                ]),
                Players::PLAYER_1_ID,
            ],
            // Three of a kind vs Three of a kind
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::THREE_OF_A_KIND_HAND_HIGHEST)),
                    new Player(Players::PLAYER_2_ID, new Hand(self::THREE_OF_A_KIND_HAND_LOWER)),
                ]),
                Players::PLAYER_1_ID,
            ],
            // Two pair vs Two pair
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::TWO_PAIR_HAND_HIGHEST)),
                    new Player(Players::PLAYER_2_ID, new Hand(self::TWO_PAIR_HAND_LOWER)),
                ]),
                Players::PLAYER_1_ID,
            ],
            // One pair vs One pair
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::ONE_PAIR_HAND_HIGHEST)),
                    new Player(Players::PLAYER_2_ID, new Hand(self::ONE_PAIR_HAND_LOWER)),
                ]),
                Players::PLAYER_1_ID,
            ],
            // High card vs High card
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::HIGH_CARD_HAND_HIGHEST)),
                    new Player(Players::PLAYER_2_ID, new Hand(self::HIGH_CARD_HAND_LOWER)),
                ]),
                Players::PLAYER_1_ID,
            ],
            // Straight flush vs High card
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(self::STRAIGHT_FLUSH_HAND_LOWEST)),
                    new Player(Players::PLAYER_2_ID, new Hand(self::HIGH_CARD_HAND_HIGHEST)),
                ]),
                Players::PLAYER_1_ID,
            ],
        ];
    }

    /**
     * @dataProvider evaluateHandsProvider
     * @param Round $round
     * @param int $expectedResult
     */
    public function testGetWinnerId(Round $round, int $expectedResult)
    {
        $realResult = $round->getWinnerId();

        $this->assertSame($expectedResult, $realResult);
    }
}