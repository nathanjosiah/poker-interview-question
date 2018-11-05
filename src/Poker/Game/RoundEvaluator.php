<?php

namespace Poker\Game;

use Poker\Hand\HandComparer;

class RoundEvaluator {
    private $comparer;

    public function __construct(HandComparer $comparer)
    {
        $this->comparer = $comparer;
    }

    public function evaluate(array $hands): RoundResult
    {
        $bestHand = $hands[0];
        $bestPlayer = 0;
        $bestHands = [0];
        for ($i = 1;$i < count($hands); $i++) {
            $winningPlayer = $this->comparer->compare($bestHand, $hands[$i]);
            if ($winningPlayer === 0) {
                $bestHands[] = $i;
            }
            else if ($winningPlayer === 1) {
                $bestPlayer = $i;
                $bestHand = $hands[$i];
                $bestHands = [$i];
            }
        }
        return new RoundResult($bestPlayer, $bestHands);
    }
}
