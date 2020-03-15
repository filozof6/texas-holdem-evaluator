<?php
namespace Tests\AppBundle\Service\Poker;

use AppBundle\Services\Poker\HandEvaluator;
use PHPUnit\Framework\TestCase;

class HandEvaluatorTest extends TestCase
{

    public function highCardProvider()
    {
        return [
            [['QC', 'KS', 'QH', '7S', 'AH'], 'A'],
            [['KD', '9C', 'JH', '7H', 'KC'], 'K'],
        ];
    }


    /**
     * @dataProvider highCardProvider
     * @param array $hand
     * @param string $expectedResult
     */
    public function testGetHighCardRank(array $hand, string $expectedResult)
    {
        $realResult = HandEvaluator::getHighCardRank($hand);
        $this->assertSame($expectedResult, $realResult);
    }

    public function sameSuitProvider()
    {
        return [
            [['QC', 'KS', 'QH', '7S', 'AH'], false],
            [['KD', '9D', 'JD', '7D', 'KD'], true],
        ];
    }

    /**
     * @dataProvider sameSuitProvider
     * @param array $hand
     * @param bool $expectedResult
     */
    public function testIsSameSuit(array $hand, bool $expectedResult)
    {
        $realResult = HandEvaluator::isSameSuit($hand);
        $this->assertSame($expectedResult, $realResult);
    }

    public function countSameRanksProvider()
    {
        return [
            [['QC', 'KD', 'QH', 'KS', 'KH'], 2, 1],
            [['QC', 'KD', 'QH', 'KS', 'KH'], 3, 1],
            [['KD', '9D', 'JD', '7D', 'KD'], 1, 3],
            [['KD', '9D', '9D', '7D', 'KD'], 2, 2],
        ];
    }

    /**
     * @dataProvider countSameRanksProvider
     * @param array $hand
     * @param int $occurrences
     * @param int $expectedResult
     */
    public function testSameOccurrences(array $hand, int $occurrences, int $expectedResult)
    {
        $realResult = HandEvaluator::countSameRanks($hand, $occurrences);
        $this->assertSame($expectedResult, $realResult);
    }

    public function isSequentialProvider()
    {
        return [
            [['TC', 'JD', 'QH', 'KS', 'AH'], true],
            [['AC', '2D', '3H', '4S', '5H'], true],
            [['KD', '9D', 'JD', '7D', 'KD'], false],
            [['AC', 'KD', '3H', '4S', '5H'], false],
        ];
    }

    /**
     * @dataProvider isSequentialProvider
     * @param array $hand
     * @param bool $expectedResult
     */
    public function testIsSequential(array $hand, bool $expectedResult)
    {
        $realResult = HandEvaluator::isSequential($hand);
        $this->assertSame($expectedResult, $realResult);
    }

    public function isRankInHandProvider()
    {
        return [
            [['TC', 'JD', 'QH', 'KS', 'AH'], 'K', true],
            [['KD', '9D', 'JD', '7D', 'KD'], '2', false],
        ];
    }

    /**
     * @dataProvider isRankInHandProvider
     * @param array $hand
     * @param string $rank
     * @param bool $expectedResult
     */
    public function testIsRankInHand(array $hand, string $rank, bool $expectedResult)
    {
        $realResult = HandEvaluator::isRankInHand($hand, $rank);
        $this->assertSame($expectedResult, $realResult);
    }

    public function getHighCardRankValueProvider()
    {
        return [
            [['TC', 'JD', 'QH', 'KS', 'AH'], 14],
            [['2D', '3D', '4D', '7D', 'TD'], 10],
        ];
    }

    /**
     * @dataProvider getHighCardRankValueProvider
     * @param array $hand
     * @param int $expectedResult
     */
    public function testGetHighCardRankValue(array $hand, int $expectedResult)
    {
        $realResult = HandEvaluator::getHighCardRankValue($hand);
        $this->assertSame($expectedResult, $realResult);
    }

    public function sumValuesOfMagnitudeProvider()
    {
        return [
            [['2C', '2D', 'QH', 'KS', 'AH'], 2, true, 2],
            [['AD', 'AS', 'AH', '5D', '6D'], 3, true, 14],
            [['AD', 'AD', '3S', '4S', '5S'], 2, true, 14],
            [['TC', 'JD', 'QH', 'KS', 'AH'], 1, true, 60],
            [['2S', '3D', '4D', '5D', '6D'], 1, true, 20],
            [['AD', '2D', '3D', '4S', '5D'], 1, false, 15],
            [['2D', '2H', '3D', '3D', '5D'], 2, true, 5],
        ];
    }

    /**
     * @dataProvider sumValuesOfMagnitudeProvider
     * @param array $hand
     * @param int $magnitude
     * @param int $expectedResult
     */
    public function testSumValuesOfMagnitude(array $hand, int $magnitude, bool $aceIsHighest, int $expectedResult)
    {
        $realResult = HandEvaluator::sumValuesOfMagnitude($hand, $magnitude, $aceIsHighest);
        $this->assertSame($expectedResult, $realResult);
    }

    public function sortHandProvider()
    {
        return [
            [['2C', '3D', '5H', '4S', 'AH'], true, ['2C', '3D', '4S', '5H', 'AH']],
            [['2C', '3D', '4H', '5S', 'AH'], false, ['AH', '2C', '3D', '4H', '5S' ]],
        ];
    }

    /**
     * @dataProvider sortHandProvider
     * @param array $hand
     * @param bool $aceIsHighest
     * @param array $expectedResult
     */
    public function testSortHandProvider(array $hand, bool $aceIsHighest, array $expectedResult)
    {
        $realResult = HandEvaluator::sortHand($hand, $aceIsHighest);
        $this->assertSame($expectedResult, $realResult);
    }
}