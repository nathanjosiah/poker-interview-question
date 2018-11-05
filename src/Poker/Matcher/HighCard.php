<?php

namespace Poker\Matcher;

use Poker\Card;

class HighCard extends AbstractHandMatcher implements QuantifiableMatcherInterface {
    private $highestCard = 0;

    public function observe(Card $card): void
    {
        if ($this->highestCard < $card->getValue()) {
            $this->highestCard = $card->getValue();
        }
    }

    public function matches(): bool
    {
        return true;
    }

    public function getMatchValue(): int
    {
        return $this->highestCard;
    }
}
