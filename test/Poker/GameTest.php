<?php
namespace Poker;

use PHPUnit\Framework\TestCase;
use Poker\Card\DeckFactory;
use Poker\Game\RoundEvaluator;
use Poker\Game\RoundLogger;
use Poker\GameFactory;
use Poker\Hand\HandComparer;
use Poker\Matcher\Match\MatchCollectorFactory;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

class GameTest extends TestCase
{
    public function testSmokeTestFor10PlayerGame() {
        $this->markTestSkipped();
        $matchCollectorFactory = new MatchCollectorFactory();
        $comparer = new HandComparer($matchCollectorFactory);
        $deckFactory = new DeckFactory();
        $deck = $deckFactory->buildStandard();
        $roundEvaluator = new RoundEvaluator($comparer);
        $logger = new RoundLogger(new class extends AbstractLogger {
            public function log($level, $message, array $context = array()){}
        });

        $game = new Game($deck, $roundEvaluator, $logger);
        $game->play(10);
    }
}
