<?php

namespace Poker;

class Hand {
    /**
     * @var Card[]
     */
    private $cards;

    public function __construct(array $cards)
    {
        $this->cards = $cards;
    }

    public function getCards() {
        return $this->cards;
    }

    public function __toString() {
        $output = [];
        foreach($this->cards as $card) {
            $output[] = $card->getValue() . $card->getSuite();
        }
        return implode(' ', $output);
    }
}
