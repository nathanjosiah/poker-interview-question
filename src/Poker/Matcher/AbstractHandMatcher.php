<?php

namespace Poker\Matcher;

use Poker\Card;

abstract class AbstractHandMatcher implements MatcherInterface {
    abstract public function observe(Card $card): void;
    abstract public function matches(): bool;
}
