<?php

namespace Poker\Matcher;

use Poker\Card;

class Straight extends AbstractHandMatcher {
    private $lastValue = null;
    private $hasFailed = false;

    public function observe(Card $card): void
    {
        if ($this->hasFailed) {
            return;
        }

        $value = $card->getValue();
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
}