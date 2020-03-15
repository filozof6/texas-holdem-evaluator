<?php
namespace Tests\AppBundle\Service\Poker;

use AppBundle\Constants\Rules;
use AppBundle\Services\Poker\Hand;
use PHPUnit\Framework\TestCase;

class HandTest extends TestCase
{

    public function evaluateHandsProvider()
    {
        return [
            [['TH', 'JH', 'QH', 'KH', 'AH'], Rules::WINNING_HANDS['Royal Flush']['value']],
            [['9H', 'TH', 'JH', 'QH', 'KH'], Rules::WINNING_HANDS['Straight Flush']['value']],
            [['AD', 'AS', 'AC', 'KH', 'AH'], Rules::WINNING_HANDS['Four of a Kind']['value']],
            [['AD', 'AS', 'AC', 'KS', 'KH'], Rules::WINNING_HANDS['Full House']['value']],
            [['2H', '7H', '5H', 'KH', 'JH'], Rules::WINNING_HANDS['Flush']['value']],
            [['AD', '2H', '3H', '4H', '5H'], Rules::WINNING_HANDS['Straight']['value']],
            [['AD', 'AS', 'QH', 'KH', 'AH'], Rules::WINNING_HANDS['Three of a Kind']['value']],
            [['AD', 'AH', 'JH', '5H', '5H'], Rules::WINNING_HANDS['Two Pair']['value']],
            [['2D', 'TH', '5H', '2S', 'AH'], Rules::WINNING_HANDS['One Pair']['value']],
            [['2D', 'TH', '5H', 'QS', 'AH'], Rules::WINNING_HANDS['High Card']['value']],
        ];
    }

    /**
     * @dataProvider evaluateHandsProvider
     * @param array $cards
     * @param int $expectedResult
     */
    public function testEvaluateHand(array $cards, int $expectedResult)
    {
        $hand = new Hand($cards);
        $realResult = $hand->evaluateHand();
        $this->assertSame($expectedResult, $realResult->getValue());
    }
}