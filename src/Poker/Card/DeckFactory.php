<?php

namespace Poker\Card;

use Poker\Card;

class DeckFactory {
    public function buildStandard() {
        $cards = [];

        for ($i = 2; $i < 14;$i++) {
            $cards[] = new Card(Card::SUITE_SPADES, $i);
            $cards[] = new Card(Card::SUITE_CLUBS, $i);
            $cards[] = new Card(Card::SUITE_HEARTS, $i);
            $cards[] = new Card(Card::SUITE_DIAMONDS, $i);
        }

        return new Deck($cards);
    }
}
