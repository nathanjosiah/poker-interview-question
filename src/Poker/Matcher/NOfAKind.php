<?php

namespace Poker\Matcher;

use Poker\Card;

class NOfAKind extends AbstractHandMatcher implements QuantifiableMatcherInterface {
    private $n, $duplicates = [], $matchedValue = null;

    public function __construct($n)
    {
        $this->n = $n;
    }

    public function observe(Card $card): void
    {
        if ($this->matchedValue) {
            return;
        }

        $value = $card->getValue();
        if (!empty($this->duplicates[$value])) {
            $this->duplicates[$value]++;
        } else {
            $this->duplicates[$value] = 1;
        }

        if ($this->duplicates[$value] === $this->n) {
            $this->matchedValue = $value;
        }
    }

    public function matches(): bool
    {
        return (bool)$this->matchedValue;
    }

    public function getMatchValue(): int
    {
        return $this->matchedValue;
    }
}
