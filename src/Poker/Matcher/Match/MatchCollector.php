<?php

namespace Poker\Matcher\Match;

use Poker\Hand;
use Poker\Matcher\MatcherInterface;
use Poker\Matcher\QuanitfiableMatch;
use Poker\Matcher\QuantifiableMatcherInterface;

class MatchCollector {
    private $matchers;

    /**
     * @param MatcherInterface[] $matchers
     */
    public function __construct(array $matchers)
    {
        $this->matchers = $matchers;
    }

    public function match(Hand $hand): array
    {
        foreach ($hand->getCards() as $card) {
            foreach ($this->matchers as $matcher) {
                $matcher->observe($card);
            }
        }
        $matches = [];
        $matcherCount = count($this->matchers);
        foreach ($this->matchers as $i => $matcher) {
            if ($matcher->matches()) {
                if ($matcher instanceof QuantifiableMatcherInterface) {
                    $matches[] = new QuanitfiableMatch($matcherCount - $i, $matcher->getMatchValue());
                    continue;
                }
                $matches[] = new Match($matcherCount - $i);
            }
        }

        return $matches;
    }
}
