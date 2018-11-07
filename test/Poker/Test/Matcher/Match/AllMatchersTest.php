<?php
namespace Poker\Test\Matcher\Match;


use PHPUnit\Framework\TestCase;
use Poker\Hand;
use Poker\Matcher\Match;
use Poker\Matcher\Match\MatchCollectorFactory;
use Poker\Matcher\QuantifiableMatch;
use Poker\Test\HandBuilder;

class AllMatchersTest extends TestCase
{
    /**
     * @param string $template
     * @param $rank
     * @param null $quantifiableValue
     * @dataProvider casesProvider
     */
    public function testAllMatchers(string $template, $rank, $quantifiableValue, $name) {
        $collectorFactory = new MatchCollectorFactory();
        $collector = $collectorFactory->create();

        $handBuilder = new HandBuilder();
        $hand = $handBuilder->build($template);
        $matches = $collector->match(new Hand($hand));
        /**
         * @var $firstMatch Match
         */
        $firstMatch = array_shift($matches);
        $this->assertSame($rank, $firstMatch->getRank(), $name);
        if (isset($quantifiableValue)) {
            $this->assertInstanceOf(QuantifiableMatch::class, $firstMatch, $name);
            $this->assertSame($quantifiableValue, $firstMatch->getValue(), $name);
        }
        else {
            $this->assertNotInstanceOf(QuantifiableMatch::class, $firstMatch, $name);
        }
    }

    public function casesProvider() {
        return [
            ['13H 2C 3C 5D 6D', 1, 13, 'High Card'],
            ['12H 2C 3C 5D 6D', 1, 12, 'High Card'],
            ['12H 2C 2D 5D 6D', 2, 2, 'One Pair'],
            ['12H 2C 2D 5D 5D', 3, 5, 'Two Pairs'],
            ['2D 3C 3D 3C 5C', 4, 3, 'Three of a kind'],
            ['2D 12C 12D 12C 5C', 4, 12, 'Three of a kind'],
            ['6D 3C 4D 5D 2D', 5, 6, 'Straight'],
            ['2D 3C 4D 5D 14D', 5, 14, 'Straight - ace as 1'],
            ['10D 11C 12D 13D 14D', 5, 14, 'Straight - ace as 14'],
            ['1D 2D 5D 13D 14D', 6, null, 'Flush'],
            ['2D 6D 12D 13D 14D', 6, null, 'Flush'],
            ['2D 2D 2D 13D 13C', 7, 13, 'Full House'],
            ['2D 2C 2S 5D 5C', 7, 5, 'Full House'],
            ['2D 2C 2S 2H 5C', 8, 2, 'Four of a kind'],
            ['2D 4D 3D 5D 6D', 9, null, 'Straight flush'],
            ['2D 14D 4D 5D 3D', 9, null, 'Straight flush - ace as 1'],
            ['10D 11D 12D 13D 14D', 10, null, 'Royal flush'],
            ['10C 11C 12C 13C 14C', 10, null, 'Royal flush'],
        ];
    }
}
