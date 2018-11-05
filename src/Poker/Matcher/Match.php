<?php

namespace Poker\Matcher;

class Match {
    private $rank;

    public function __construct(int $rank)
    {
        $this->rank = $rank;
    }
    public function getRank(): int
    {
        return $this->rank;
    }
}
