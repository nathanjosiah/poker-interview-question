<?php

namespace Poker;

use Poker\Card\Deck;
use Poker\Game\RoundEvaluator;
use Poker\Game\RoundLogger;

class Game {
    private $deck, $roundEvaluator;
    /**
     * @var RoundLogger
     */
    private $logger;

    public function __construct(Deck $deck, RoundEvaluator $roundEvaluator, RoundLogger $logger)
    {
        $this->deck = $deck;
        $this->roundEvaluator = $roundEvaluator;
        $this->logger = $logger;
    }

    public function play(int $players): void {
        $this->deck->shuffle();

        $hands = [];
        for ($i = 0; $i < $players; $i++) {
            $hands[] = $this->deck->drawCards(5);
        }

        $result = $this->roundEvaluator->evaluate($hands);
        $this->logger->log($result, $hands);
    }
}