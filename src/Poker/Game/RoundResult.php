<?php

namespace Poker\Game;

class RoundResult {
    private $bestPlayer, $bestHands;

    public function __construct(int $bestPlayer, array $bestHands)
    {
        $this->bestPlayer = $bestPlayer;
        $this->bestHands = $bestHands;
    }

    public function getBestPlayer(): int
    {
        return $this->bestPlayer;
    }

    public function getBestHands(): array
    {
        return $this->bestHands;
    }
}
