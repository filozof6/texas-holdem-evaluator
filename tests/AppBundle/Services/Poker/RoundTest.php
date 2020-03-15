<?php

namespace Tests\AppBundle\Service\Poker;

use AppBundle\Constants\Players;
use AppBundle\Services\Poker\Hand;
use AppBundle\Services\Poker\Player;
use AppBundle\Services\Poker\Round;
use PHPUnit\Framework\TestCase;

class RoundTest extends TestCase
{

    public function evaluateHandsProvider()
    {
        return [
            [
                new Round(1, [
                    new Player(Players::PLAYER_1_ID, new Hand(['AH', '2S', '3H', '4H', '5H'])),
                    new Player(Players::PLAYER_2_ID, new Hand(['2H', '3H', '4H', '5H', '6S'])),
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