<?php

namespace Poker\Matcher;

use Poker\Card;

interface MatcherInterface {
    public function observe(Card $card): void;
    public function matches(): bool;
}

