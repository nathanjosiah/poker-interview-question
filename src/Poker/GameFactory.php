<?php

namespace Poker;

use Poker\Card\DeckFactory;
use Poker\Game\RoundEvaluator;
use Poker\Hand\HandComparer;
use Poker\Matcher\Match\MatchCollectorFactory;

class GameFactory {
    public function create() {
        $matchCollectorFactory = new MatchCollectorFactory();
        $comparer = new HandComparer($matchCollectorFactory);
        $deckFactory = new DeckFactory();
        $deck = $deckFactory->buildStandard();
        $roundEvaluator = new RoundEvaluator($comparer);
        $game = new Game($deck, $roundEvaluator);

        return $game;
    }
}
