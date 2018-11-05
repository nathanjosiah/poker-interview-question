<?php

namespace Poker\Matcher;

use Poker\Card;

class AllRoyal extends AbstractHandMatcher {
    private $observedCards = [
        14 => false,
        13 => false,
        12 => false,
        11 => false,
        10 => false,
    ];

    private $hasFailed = false;

    public function observe(Card $card): void
    {
        if ($this->hasFailed) {
            return;
        }

        $value = $card->getValue();

        // Not a card we care about or already found
        if (!isset($this->observedCards[$value]) || $this->observedCards[$value]) {
            $this->hasFailed = true;
            return;
        }

        $this->observedCards[$value] = true;
    }

    public function matches(): bool
    {
        return !$this->hasFailed;
    }
}
