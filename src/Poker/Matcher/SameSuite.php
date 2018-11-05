<?php

namespace Poker\Matcher;

use Poker\Card;

class SameSuite extends AbstractHandMatcher {
    private $lastSuite = null;
    private $hasFailed = false;

    public function observe(Card $card): void
    {
        if ($this->hasFailed) {
            return;
        }

        if (!isset($this->lastSuite)) {
            $this->lastSuite = $card->getSuite();
            return;
        }

        if ($this->lastSuite !== $card->getSuite()) {
            $this->hasFailed = true;
            return;
        }
    }

    public function matches(): bool
    {
        return !$this->hasFailed;
    }
}
