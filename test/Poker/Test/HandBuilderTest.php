<?php
namespace Poker\Test;

use PHPUnit\Framework\TestCase;
use Poker\Card;

class HandBuilderTest extends TestCase
{
    public function testBuild() {
        $builder = new HandBuilder();
        $result = $builder->build('12D 4S 5H 6C 7C');
        $expected = [
            new Card(Card::SUITE_DIAMONDS, 12),
            new Card(Card::SUITE_SPADES, 4),
            new Card(Card::SUITE_HEARTS, 5),
            new Card(Card::SUITE_CLUBS, 6),
            new Card(Card::SUITE_CLUBS, 7),
        ];
        $this->assertEquals($expected, $result);
    }
}
