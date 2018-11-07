<?php

namespace Poker\Matcher;

use Poker\Card;

class Straight extends AbstractHandMatcher implements QuantifiableMatcherInterface {
    private $needToSee = [];
    private $alreadySeen = [];
    private $hasFailed = false;
    private $highestCard = 0;

    public function observe(Card $card): void
    {
        if ($this->hasFailed) {
            return;
        }
        $value = $card->getValue();

        if (isset($this->alreadySeen[$value])) {
            $this->hasFailed = true;
            return;
        }
        if (isset($this->needToSee[$value])) {
            unset($this->needToSee[$value]);
        }

        // Handle ace as 1
        $previousValue = ($value === 2 ? 14 : $value - 1);
        if (!isset($this->alreadySeen[$previousValue])) {
            $this->needToSee[$previousValue] = true;
        }

        // Handle ace as 1
        $nextValue = ($value === 14 ? 2 : $value + 1);
        if (!isset($this->alreadySeen[$nextValue])) {
            $this->needToSee[$nextValue] = true;
        }

        $this->highestCard = max($this->highestCard, $value);
        $this->alreadySeen[$value] = true;
    }

    public function matches(): bool
    {
        return !$this->hasFailed && count($this->needToSee) === 2;
    }

    public function getMatchValue(): int
    {
        return $this->highestCard;
    }
}
