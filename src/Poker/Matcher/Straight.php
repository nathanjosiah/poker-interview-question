<?php

namespace Poker\Matcher;

use Poker\Card;

class Straight extends AbstractHandMatcher implements QuantifiableMatcherInterface {
    private $lastValue = null;
    private $hasFailed = false;
    private $sum = 0;
    private $highestCard = 0;

    public function observe(Card $card): void
    {
        if ($this->hasFailed) {
            return;
        }

        $value = $card->getValue();
        $this->highestCard = max($this->highestCard, $value);
        $this->sum += $value;
        if (!isset($this->lastValue)) {
            $this->lastValue = $value;
            return;
        }

        // handle ace as a "1": 2,3,4,5,14.
        if ($this->lastValue === 14 && $value !== 5 || $value - $this->lastValue !== 1) {
            $this->hasFailed = true;
            return;
        }

        $this->lastValue = $value;
    }

    public function matches(): bool
    {
        return !$this->hasFailed;
    }

    public function getMatchValue(): int
    {
        return $this->highestCard;
    }
}
