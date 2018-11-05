<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace PokerTest;

use PHPUnit\Framework\TestCase;
use Poker\GameFactory;

class GameTest extends TestCase
{
    public function testSmokeTestFor10PlayerGame() {
        $gameFactory = new GameFactory();
        $game = $gameFactory->create();
        $game->play(10);
    }
}