<?php

namespace Poker;

class Card {
    const SUITE_HEARTS = '♥';
    const SUITE_DIAMONDS = '♦';
    const SUITE_CLUBS = '♣';
    const SUITE_SPADES = '♠';

    private $suite,$value;

    public function __construct(string $suite, int $value)
    {
        $this->suite = $suite;
        $this->value = $value;
    }

    public function getValue() {
        return $this->value;
    }

    public function getSuite() {
        return $this->suite;
    }
}
