<?php
namespace Poker\Game;

use Poker\Hand;
use Psr\Log\LoggerInterface;

class RoundLogger
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param RoundResult $result
     * @param Hand[] $hands
     */
    public function log(RoundResult $result, array $hands): void
    {
        $bestHands = $result->getBestHands();

        if (count($bestHands) > 1) {
            $this->logger->info('Tie between players ' . implode(', ', $bestHands));
        }
        else {
            $this->logger->info('Player ' . ($result->getBestPlayer()) . ' Wins!');
        }

        $this->logger->info('====Hands====');
        foreach ($hands as $player => $hand) {
            $this->logger->info('Player ' . $player . 'Hand: ');
            $this->logger->info($hand);
        }
    }
}