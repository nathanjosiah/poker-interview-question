<?php

namespace Poker;

use Poker\Card\DeckFactory;
use Poker\Game\RoundEvaluator;
use Poker\Game\RoundLogger;
use Poker\Hand\HandComparer;
use Poker\Logger\StdOutLogger;
use Poker\Matcher\Match\MatchCollectorFactory;
use Psr\Log\NullLogger;

class GameFactory {
    public function create() {
        $matchCollectorFactory = new MatchCollectorFactory();
        $comparer = new HandComparer($matchCollectorFactory);
        $deckFactory = new DeckFactory();
        $deck = $deckFactory->buildStandard();
        $roundEvaluator = new RoundEvaluator($comparer);
        $logger = new RoundLogger(new StdOutLogger());
        $game = new Game($deck, $roundEvaluator, $logger);

        return $game;
    }
}
