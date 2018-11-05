<?php

namespace Poker\Matcher;

use Poker\Card;

class AggregateMatcher extends AbstractHandMatcher {
    private $matchers;

    /**
     * @param MatcherInterface[] $matchers
     */
    public function __construct(array $matchers)
    {
        $this->matchers = $matchers;
    }

    public function observe(Card $card): void
    {
        foreach ($this->matchers as $matcher) {
            $matcher->observe($card);
        }
    }

    public function matches(): bool
    {
        foreach ($this->matchers as $matcher) {
            if (!$matcher->matches()) {
                return false;
            }
        }

        return true;
    }
}
