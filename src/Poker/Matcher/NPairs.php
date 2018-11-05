<?php

namespace Poker\Matcher;

use Poker\Card;

class NPairs extends AbstractHandMatcher {
    private $n;
    protected $pairs = [];
    protected $matches = [];

    public function __construct($n)
    {
        $this->n = $n;
    }

    public function observe(Card $card): void
    {
        $value = $card->getValue();

        if (!empty($this->matches[$value])) {
            $this->matches[$value]++;
        } else {
            $this->matches[$value] = 1;
        }

        // We don't care about 2 pairs of the same value because 4 of a kind will win in that case
        if ($this->matches[$value] >= 2) {
            if (isset($this->pairs[$value])) {
                $this->pairs[$value]++;
            }
            else {
                $this->pairs[$value] = 1;
            }
        }
    }

    public function matches(): bool
    {
        return count($this->pairs) === $this->n;
    }
}
