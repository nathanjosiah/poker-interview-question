<?php
namespace Poker\Test;


use Poker\Card;

class HandBuilder
{
    const MAP = [
        'H' => Card::SUITE_HEARTS,
        'D' => Card::SUITE_DIAMONDS,
        'C' => Card::SUITE_CLUBS,
        'S' => Card::SUITE_SPADES,
    ];

    /**
     * @param string $template
     * @return Card[]
     */
    public function build(string $template): array
    {
        $cards = [];
        foreach (explode(' ', $template) as $item) {
            $cards[] = new Card(self::MAP[substr($item, -1, 1)], (int)$item);
        }
        return $cards;
    }
}