<?php

namespace Poker\Matcher\Match;

use Poker\Matcher\AggregateMatcher;
use Poker\Matcher\AllRoyal;
use Poker\Matcher\FullHouse;
use Poker\Matcher\HighCard;
use Poker\Matcher\NOfAKind;
use Poker\Matcher\NPairs;
use Poker\Matcher\SameSuite;
use Poker\Matcher\Straight;

class MatchCollectorFactory {
    public function create(): MatchCollector {
        $highCard = new HighCard();
        $onePair = new NPairs(1);
        $twoPair = new NPairs(2);
        $threeOfKind = new NOfAKind(3);
        $straight = new Straight();
        $flush = new SameSuite();
        $fullHouse = new FullHouse();
        $fourOfKind = new NOfAKind(4);
        $straightFlush = new AggregateMatcher([
            new Straight(),
            new SameSuite()
        ]);

        $royalFlush = new AggregateMatcher([
            new AllRoyal(),
            new SameSuite()
        ]);

        return new MatchCollector([
            $royalFlush,
            $straightFlush,
            $fourOfKind,
            $fullHouse,
            $flush,
            $straight,
            $threeOfKind,
            $twoPair,
            $onePair,
            $highCard
        ]);
    }
}
