<?php

namespace Poker\Hand;

use Poker\Hand;
use Poker\Matcher\Match\MatchCollectorFactory;
use Poker\Matcher\QuanitfiableMatch;

class HandComparer {
    private $matchCollectorFactory;
    public function __construct(MatchCollectorFactory $matchCollectorFactory)
    {
        $this->matchCollectorFactory = $matchCollectorFactory;
    }

    public function compare(Hand $hand1, Hand $hand2): int {
        $hand1Matches = $this->matchCollectorFactory->create()->match($hand1);
        $hand2Matches = $this->matchCollectorFactory->create()->match($hand2);

        while(true) {
            $match1 = array_shift($hand1Matches);
            $match2 = array_shift($hand2Matches);

            if ($match1 && !$match2) {
                return -1;
            }
            else if ($match2 && !$match1) {
                return 1;
            }
            else if ($match1->getRank() > $match2->getRank()) {
                return -1;
            }
            else if ($match1->getRank() < $match2->getRank()) {
                return 1;
            }
            else if ($match1 instanceof QuanitfiableMatch && $match2 instanceof QuanitfiableMatch) {
                if ($match1->getValue() > $match2->getValue()) {
                    return -1;
                }
                else if ($match1->getValue() < $match2->getValue()) {
                    return 1;
                }
                return 0;
            }
            // Equal rank of non-quantifiable matches
            else if (!$match1 instanceof QuanitfiableMatch && !$match2 instanceof QuanitfiableMatch) {
                // Tie
                continue;
            }
            else {
                throw new \RuntimeException('Unhandled comparison corner case.');
            }
        }

        return 0;
    }
}