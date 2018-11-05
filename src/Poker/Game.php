<?php

namespace Poker;

use Poker\Card\Deck;
use Poker\Game\RoundEvaluator;

class Game {
    private $deck, $roundEvaluator;

    public function __construct(Deck $deck, RoundEvaluator $roundEvaluator)
    {
        $this->deck = $deck;
        $this->roundEvaluator = $roundEvaluator;
    }

    public function play(int $players): void {
        $this->deck->shuffle();

        $hands = [];
        for ($i = 0; $i < $players; $i++) {
            $hands[] = $this->deck->drawCards(5);
        }

        $result = $this->roundEvaluator->evaluate($hands);

        $bestHands = $result->getBestHands();
        if (count($bestHands) > 1) {
            echo 'Tie between players ' . implode(', ', $bestHands) . \PHP_EOL;
        }
        else {
            echo 'Player ' . ($result->getBestPlayer()) . ' Wins!' . \PHP_EOL;
        }

        echo '====Hands====' . \PHP_EOL;
        foreach ($hands as $player => $hand) {
            echo 'Player ' . $player . 'Hand: ' . \PHP_EOL;
            echo $hand . \PHP_EOL;
            echo \PHP_EOL;
        }
    }
}