<?php

namespace Poker\Card;

use Poker\Card;
use Poker\Hand;

class Deck
{
    /**
     * @var Card[]
     */
    public $cards = [];

    public function __construct(array $cards)
    {
        $this->cards = $cards;
    }

    public function shuffle() {
        shuffle($this->cards);
    }

    public function drawCards(int $count) {
        $cards = [];
        $i = 0;
        foreach($this->cards as $k => $card) {
            if ($i++ === $count) {
                break;
            }
            $cards[] = $this->cards[$k];
            unset($this->cards[$k]);
        }
        return new Hand($cards);
    }
}
