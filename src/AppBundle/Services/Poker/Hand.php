<?php

namespace AppBundle\Services\Poker;

use AppBundle\Constants\Cards;
use AppBundle\Constants\Rules;
use http\Exception\InvalidArgumentException;

class Hand
{
    /**
     * @var string[]
     */
    private $cards;

    /**
     * Hand constructor.
     * @param string[] $cards
     */
    public function __construct(array $cards = [])
    {
        $this->cards = $cards;
    }

    /**
     * @param string $hand
     * @return Hand
     */
    public static function createFromStringFactory(string $hand): Hand
    {
        $exploded = explode(Cards::DELIMITER, $hand);

        return new Hand($exploded);
    }


    /**
     * @return string[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * @return HandResult
     */
    public function evaluateHand(): HandResult
    {
        $handResult = new HandResult();

        foreach (Rules::WINNING_HANDS as $type => $metadata) {
            $handResult->setType($type)->setValue($metadata['value']);
            if ($this->isComplyingToConditions($metadata['conditions'])) {
                $handResult->setSubValue($this->calculateSubValue($handResult));
                break;
            }
        }

        return $handResult;
    }

    public function calculateSubValue(HandResult $handResult): int
    {
        switch ($handResult->getValue()) {
            case Rules::ROYAL_FLUSH_VALUE:
            case Rules::STRAIGHT_FLUSH_VALUE:
            case Rules::STRAIGHT_VALUE:
                $aceIsHighest = true;
                if (HandEvaluator::isRankInHand($this->getCards(), 'A') && HandEvaluator::isRankInHand($this->getCards(), '2')) {
                    $aceIsHighest = false;
                }
                return HandEvaluator::sumValuesOfMagnitude($this->getCards(), 1, $aceIsHighest);
            case Rules::FLUSH_VALUE:
                return HandEvaluator::sumValuesOfMagnitude($this->getCards(), 1);
            case Rules::FOUR_OF_A_KIND_VALUE:
                return HandEvaluator::sumValuesOfMagnitude($this->getCards(), 4) +
                    HandEvaluator::sumKickerValues($this->getCards());
            case Rules::FULL_HOUSE_VALUE:
                return HandEvaluator::sumValuesOfMagnitude($this->getCards(), 3);
            case Rules::THREE_OF_A_KIND_VALUE:
                return HandEvaluator::sumValuesOfMagnitude($this->getCards(), 3) +
                    HandEvaluator::sumKickerValues($this->getCards());
            case Rules::TWO_PAIR_VALUE:
            case Rules::ONE_PAIR_VALUE:
                return HandEvaluator::sumValuesOfMagnitude($this->getCards(), 2) +
                    HandEvaluator::sumKickerValues($this->getCards());
            case Rules::HIGH_CARD_VALUE:
                return HandEvaluator::getHighCardRankValue($this->getCards());
            default:
                throw new InvalidArgumentException('Unknown value of winning hand!');
        }
    }

    /**
     * @param array $conditions
     * @return bool
     */
    private function isComplyingToConditions(array $conditions): bool
    {
        $toReturn = true;

        foreach ($conditions as $condition) {
            $methodToCall = Rules::EVALUATOR_STATIC_CLASS . '::' . $condition['name'];
            $toReturn = $toReturn && (
                    call_user_func(
                        $methodToCall,
                        $this->getCards(),
                        ...$condition['args']
                    ) === $condition['output']
                );

            if (!$toReturn) {
                break;
            }
        }

        return $toReturn;
    }

    public function __toString(): string
    {
        $handString = '';

        /** @var Card $card */
        foreach ($this->cards as $card) {
            $handString .= (string)$card . Cards::DELIMITER;
        }

        return rtrim($handString, Cards::DELIMITER);
    }


}